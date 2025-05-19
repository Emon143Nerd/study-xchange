<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;

class CareerRecommendationService
{
    protected $userId;
    protected $userSkills;
    protected $userEducation;
    protected $userPreferences;

    public function getRecommendations($userId)
    {
        $this->userId = $userId;
        $this->loadUserProfile();

        // Job Recommendations with scoring
        $jobRecommendations = $this->getJobRecommendations();

        // Resource Space Recommendations with scoring
        $resourceSpaceRecommendations = $this->getResourceSpaceRecommendations();

        // Combine and sort all recommendations by score
        $recommendations = $jobRecommendations
            ->union($resourceSpaceRecommendations)
            ->orderBy('score', 'desc')
            ->get();

        return $recommendations;
    }

    protected function loadUserProfile()
    {
        // Load user skills
        $this->userSkills = DB::table('user_skills')
            ->where('user_id', $this->userId)
            ->where('status', 1)
            ->pluck('skill_name', 'proficiency_level');

        // Load user education
        $this->userEducation = DB::table('user_education')
            ->where('user_id', $this->userId)
            ->where('status', 1)
            ->get();

        // Load user preferences
        $this->userPreferences = DB::table('user_job_preferences')
            ->where('user_id', $this->userId)
            ->where('status', 1)
            ->first();
    }

    protected function getJobRecommendations()
    {
        $preferredLocation = $this->userPreferences ? $this->userPreferences->preferred_location : '';
        $preferredJobType = $this->userPreferences ? DB::getPdo()->quote($this->userPreferences->preferred_job_type) : DB::getPdo()->quote('');
        $salaryExpectation = $this->userPreferences ? $this->userPreferences->salary_expectation : 0;

        return DB::table('job_circulars')
            ->select([
                'job_circulars.title as title',
                'job_circulars.description as description',
                'companies.name as subtitle',
                'job_circulars.location as extra_field1',
                'job_circulars.salary_range as extra_field2',
                DB::raw('1 as recommendation_type'),
                DB::raw("(
                -- Location match with fuzzy matching (20%)
                CASE
                    WHEN job_circulars.location LIKE CONCAT('%', " . DB::getPdo()->quote($preferredLocation) . ", '%') THEN 20
                    WHEN SOUNDEX(job_circulars.location) = SOUNDEX(" . DB::getPdo()->quote($preferredLocation) . ") THEN 15
                    WHEN job_circulars.location REGEXP CONCAT('[[:<:]]', " . DB::getPdo()->quote($preferredLocation) . ", '[[:>:]]') THEN 10
                    ELSE 0
                END +

                -- Salary match (15%)
                CASE
                    WHEN CAST(SUBSTRING_INDEX(job_circulars.salary_range, '-', -1) AS UNSIGNED) >= {$salaryExpectation} THEN 15
                    ELSE 0
                END +

                -- Job type match with fuzzy matching (15%)
                CASE
                    WHEN job_circulars.type = {$preferredJobType} THEN 15
                    WHEN SOUNDEX(job_circulars.type) = SOUNDEX({$preferredJobType}) THEN 10
                    ELSE 0
                END +

                -- Recent posting bonus (10%)
                CASE
                    WHEN DATEDIFF(NOW(), job_circulars.created_at) <= 7 THEN 10
                    WHEN DATEDIFF(NOW(), job_circulars.created_at) <= 14 THEN 5
                    ELSE 0
                END +

                -- View count significance (5%)
                CASE
                    WHEN hit_count > 100 THEN 5
                    WHEN hit_count > 50 THEN 3
                    ELSE 0
                END
            ) as score")
            ])
            ->join('companies', 'companies.id', '=', 'job_circulars.company_id')
            ->where('job_circulars.status', 1)
            ->whereRaw('DATEDIFF(application_deadline, NOW()) > 0')
//            ->having('score', '>', 30)
            ->orderBy('score', 'desc')
            ->limit(5);
    }

    protected function getResourceSpaceRecommendations()
    {
        return DB::table('resource_spaces as rs')
            ->select([
                'rs.name as title',
                'rs.description as description',
                'users.name as subtitle',
                DB::raw('NULL as extra_field1'),
                DB::raw('NULL as extra_field2'),
                DB::raw('3 as recommendation_type'),
                DB::raw("(
                -- Match with User Skills (20%)
                IFNULL((
                    SELECT 20 * SUM(
                        CASE
                            WHEN rs.name LIKE CONCAT('%', us.skill_name, '%')
                                OR rs.description LIKE CONCAT('%', us.skill_name, '%') THEN 1
                            WHEN SOUNDEX(rs.name) = SOUNDEX(us.skill_name)
                                OR SOUNDEX(rs.description) = SOUNDEX(us.skill_name) THEN 0.8
                            WHEN rs.name REGEXP CONCAT('[[:<:]]', us.skill_name, '[[:>:]]')
                                OR rs.description REGEXP CONCAT('[[:<:]]', us.skill_name, '[[:>:]]') THEN 0.6
                            ELSE 0
                        END
                    ) / NULLIF((
                        SELECT COUNT(*) FROM user_skills WHERE user_id = {$this->userId}
                    ), 0)
                    FROM user_skills us
                    WHERE us.user_id = {$this->userId}
                ), 0) +

                -- Match with User Education Field (20%)
                IFNULL((
                    SELECT 20 * SUM(
                        CASE
                            WHEN rs.name LIKE CONCAT('%', ue.field_of_study, '%')
                                OR rs.description LIKE CONCAT('%', ue.field_of_study, '%') THEN 1
                            WHEN SOUNDEX(rs.name) = SOUNDEX(ue.field_of_study)
                                OR SOUNDEX(rs.description) = SOUNDEX(ue.field_of_study) THEN 0.8
                            WHEN rs.name REGEXP CONCAT('[[:<:]]', ue.field_of_study, '[[:>:]]')
                                OR rs.description REGEXP CONCAT('[[:<:]]', ue.field_of_study, '[[:>:]]') THEN 0.6
                            ELSE 0
                        END
                    ) / NULLIF((
                        SELECT COUNT(*) FROM user_education WHERE user_id = {$this->userId}
                    ), 0)
                    FROM user_education ue
                    WHERE ue.user_id = {$this->userId}
                ), 0) +

                -- Match with Job Preferences (15%)
                IFNULL((
                    SELECT 15 * SUM(
                        CASE
                            WHEN rs.name LIKE CONCAT('%', ujp.preferred_industry, '%')
                                OR rs.description LIKE CONCAT('%', ujp.preferred_industry, '%') THEN 1
                            WHEN SOUNDEX(rs.name) = SOUNDEX(ujp.preferred_industry)
                                OR SOUNDEX(rs.description) = SOUNDEX(ujp.preferred_industry) THEN 0.8
                            WHEN rs.name REGEXP CONCAT('[[:<:]]', ujp.preferred_industry, '[[:>:]]')
                                OR rs.description REGEXP CONCAT('[[:<:]]', ujp.preferred_industry, '[[:>:]]') THEN 0.6
                            ELSE 0
                        END
                    ) / NULLIF((
                        SELECT COUNT(*) FROM user_job_preferences WHERE user_id = {$this->userId}
                    ), 0)
                    FROM user_job_preferences ujp
                    WHERE ujp.user_id = {$this->userId}
                ), 0) +

                -- Match with User's Question Tags (15%)
                IFNULL((
                    SELECT 15 * SUM(
                        CASE
                            WHEN rs.name LIKE CONCAT('%', t.tags, '%')
                                OR rs.description LIKE CONCAT('%', t.tags, '%') THEN 1
                            WHEN SOUNDEX(rs.name) = SOUNDEX(t.tags)
                                OR SOUNDEX(rs.description) = SOUNDEX(t.tags) THEN 0.8
                            WHEN rs.name REGEXP CONCAT('[[:<:]]', t.tags, '[[:>:]]')
                                OR rs.description REGEXP CONCAT('[[:<:]]', t.tags, '[[:>:]]') THEN 0.6
                            ELSE 0
                        END
                    ) / NULLIF((
                        SELECT COUNT(DISTINCT tag_id)
                        FROM question_tags
                        JOIN questions q ON q.id = question_tags.question_id
                        WHERE q.user_id = {$this->userId}
                    ), 0)
                    FROM questions q
                    JOIN question_tags qt ON q.id = qt.question_id
                    JOIN tags t ON t.id = qt.tag_id
                    WHERE q.user_id = {$this->userId}
                ), 0) +

                -- Match with Work Experience (15%)
                IFNULL((
                    SELECT 15 * SUM(
                        CASE
                            WHEN rs.name LIKE CONCAT('%', uwe.job_title, '%')
                                OR rs.description LIKE CONCAT('%', uwe.job_title, '%') THEN 1
                            WHEN SOUNDEX(rs.name) = SOUNDEX(uwe.job_title)
                                OR SOUNDEX(rs.description) = SOUNDEX(uwe.job_title) THEN 0.8
                            WHEN rs.name REGEXP CONCAT('[[:<:]]', uwe.job_title, '[[:>:]]')
                                OR rs.description REGEXP CONCAT('[[:<:]]', uwe.job_title, '[[:>:]]') THEN 0.6
                            ELSE 0
                        END
                    ) / NULLIF((
                        SELECT COUNT(*) FROM user_work_experiences WHERE user_id = {$this->userId}
                    ), 0)
                    FROM user_work_experiences uwe
                    WHERE uwe.user_id = {$this->userId}
                ), 0) +

                -- Resource Space Activity Level (15%)
                CASE
                    WHEN (
                        SELECT COUNT(*) FROM resource_space_posts
                        WHERE resource_space_id = rs.id
                        AND created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                    ) > 10 THEN 15
                    WHEN (
                        SELECT COUNT(*) FROM resource_space_posts
                        WHERE resource_space_id = rs.id
                        AND created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                    ) > 5 THEN 10
                    ELSE 5
                END
            ) as score")
            ])
            ->join('users', 'users.id', '=', 'rs.user_id')
            ->where('rs.status', 1)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('resource_space_users')
                    ->whereRaw('resource_space_users.resource_space_id = rs.id')
                    ->where('resource_space_users.user_id', '=', $this->userId);
            })
            ->having('score', '>', 0)
            ->orderBy('score', 'desc')
            ->limit(5);
    }


}
