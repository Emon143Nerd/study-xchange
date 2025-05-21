<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Job\CompanyController;
use App\Http\Controllers\Job\JobCircularController;
use App\Http\Controllers\NormalUser\AdmissionApplicationController;
use App\Http\Controllers\NormalUser\AdmissionController;
use App\Http\Controllers\NormalUser\EditProfileController;
use App\Http\Controllers\NormalUser\JobController;
use App\Http\Controllers\NormalUser\QuestionCommentController;
use App\Http\Controllers\NormalUser\QuestionController;
use App\Http\Controllers\NormalUser\ResearchProjectController;
use App\Http\Controllers\NormalUser\ResearchTaskController;
use App\Http\Controllers\NormalUser\ResourceSpace\ResourceSpaceController;
use App\Http\Controllers\NormalUser\ResourceSpace\ResourceSpacePostCommentController;
use App\Http\Controllers\NormalUser\ResourceSpace\ResourceSpacePostController;
use App\Http\Controllers\NormalUser\UserEducationController;
use App\Http\Controllers\NormalUser\UserJobPreferenceController;
use App\Http\Controllers\NormalUser\UserSkillController;
use App\Http\Controllers\NormalUser\UserWorkExperienceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\University\AdmissionCircularController;
use App\Http\Controllers\University\SubjectCategoryController;
use App\Http\Controllers\University\UniversityController;
use App\Http\Controllers\University\UniversityFAQController;
use App\Http\Controllers\NormalUser\UserCertificationController;
use App\Http\Controllers\University\CourseController;
use App\Http\Controllers\University\CourseQuestionController;
use App\Http\Controllers\NormalUser\SkillAssessmentController;
use App\Http\Controllers\NormalUser\ResearchProjectMeetingController;
use App\Http\Controllers\University\QuizController;
use App\Http\Controllers\University\DescriptiveController;
use App\Http\Controllers\NormalUser\ResourceSpace\ResourceSpaceBlogController;
use App\Http\Controllers\NormalUser\CareerRecommendationController;




// Super Admin
Route::get('/super-admin/dashboard', function () {
    return view('super-admin.dashboard.index');
})->middleware(['auth', 'verified', 'super-admin'])->name('super-admin.dashboard');



// Company User
Route::middleware(['auth', 'verified', 'company-user'])->group(function () {
    Route::get('/company-user/dashboard', function () {
        return view('company-user.dashboard.index');
    })->name('company-user.dashboard');

    // Company
    Route::get('/jobs/company/list',[CompanyController::class,'index'])->name('company-user.company.index');
    Route::get('/jobs/company/create',[CompanyController::class,'create'])->name('company-user.company.create');
    Route::post('/jobs/company/store',[CompanyController::class,'store'])->name('company-user.company.store');
    Route::get('/jobs/company/edit/{id}',[CompanyController::class,'edit'])->name('company-user.company.edit');
    Route::put('/jobs/company/update/{id}',[CompanyController::class,'update'])->name('company-user.company.update');
    Route::get('/jobs/company/delete/{id}',[CompanyController::class,'delete'])->name('company-user.company.delete');

    // Job Circular
    Route::get('/jobs/job-circular/list',[JobCircularController::class,'index'])->name('company-user.job-circular.index');
    Route::get('/jobs/job-circular/create',[JobCircularController::class,'create'])->name('company-user.job-circular.create');
    Route::post('/jobs/job-circular/store',[JobCircularController::class,'store'])->name('company-user.job-circular.store');
    Route::get('/jobs/job-circular/edit/{id}',[JobCircularController::class,'edit'])->name('company-user.job-circular.edit');
    Route::put('/jobs/job-circular/update/{id}',[JobCircularController::class,'update'])->name('company-user.job-circular.update');
    Route::get('/jobs/job-circular/delete/{id}',[JobCircularController::class,'delete'])->name('company-user.job-circular.delete');
    Route::get('Jobs/applicants', [JobCircularController::class, 'jobApplicant'])->name('company-user.job-circular.applicants');
    Route::get('Jobs/applicants/{id}', [JobCircularController::class, 'applicantDetail'])->name('company-user.job-circular.applicants.detail');

});



// University User
Route::middleware(['auth', 'verified', 'university-user'])->group(function () {
    Route::get('/university-user/dashboard', function () {
        return view('university-user.dashboard.index');
    })->name('university-user.dashboard');

    // University
    Route::get('/university/list',[UniversityController::class,'index'])->name('university-user.university.index');
    Route::get('/university/add',[UniversityController::class,'create'])->name('university-user.university.create');
    Route::post('/university/store',[UniversityController::class,'store'])->name('university-user.university.store');
    Route::get('/university/edit/{slug}',[UniversityController::class,'edit'])->name('university-user.university.edit');
    Route::post('/university/update/{slug}',[UniversityController::class,'update'])->name('university-user.university.update');
    Route::get('/university/delete/{slug}',[UniversityController::class,'delete'])->name('university-user.university.delete');

    // Subject Category
    Route::get('/subject/category/list',[SubjectCategoryController::class,'index'])->name('university-user.subject-category.index');
    Route::get('/subject/category/add',[SubjectCategoryController::class,'create'])->name('university-user.subject-category.create');
    Route::post('/subject/category/store',[SubjectCategoryController::class,'store'])->name('university-user.subject-category.store');
    Route::get('/subject/category/edit/{slug}',[SubjectCategoryController::class,'edit'])->name('university-user.subject-category.edit');
    Route::post('/subject/category/update/{slug}',[SubjectCategoryController::class,'update'])->name('university-user.subject-category.update');
    Route::get('/subject/category/delete/{slug}',[SubjectCategoryController::class,'delete'])->name('university-user.subject-category.delete');

    // Admission Circular
    Route::get('/circular/list',[AdmissionCircularController::class,'index'])->name('university-user.admission-circular.index');
    Route::get('/circular/add',[AdmissionCircularController::class,'create'])->name('university-user.admission-circular.create');
    Route::post('/circular/store',[AdmissionCircularController::class,'store'])->name('university-user.admission-circular.store');
    Route::get('/circular/edit/{slug}',[AdmissionCircularController::class,'edit'])->name('university-user.admission-circular.edit');
    Route::post('/circular/update/{slug}',[AdmissionCircularController::class,'update'])->name('university-user.admission-circular.update');
    Route::get('/circular/delete/{slug}',[AdmissionCircularController::class,'delete'])->name('university-user.admission-circular.delete');

    // University FAQ
    Route::get('/FAQ/list',[UniversityFAQController::class,'index'])->name('university-user.FAQ.index');
    Route::get('/FAQ/add',[UniversityFAQController::class,'create'])->name('university-user.FAQ.create');
    Route::post('/FAQ/store',[UniversityFAQController::class,'store'])->name('university-user.FAQ.store');
    Route::get('/FAQ/edit/{id}',[UniversityFAQController::class,'edit'])->name('university-user.FAQ.edit');
    Route::post('/FAQ/update/{id}',[UniversityFAQController::class,'update'])->name('university-user.FAQ.update');
    Route::get('/FAQ/delete/{id}',[UniversityFAQController::class,'delete'])->name('university-user.FAQ.delete');

    //Admission Applicants
    Route::get('/applicants/list',[AdmissionCircularController::class,'applicant'])->name('university-user.applicants.index');
    Route::get('/applicants/edit/{id}',[AdmissionCircularController::class,'applicantDetail'])->name('university-user.applicants.detail');
    Route::post('/applicants/edit/{id}',[AdmissionCircularController::class,'updateApplicant'])->name('university-user.applicants.update');

    // University Course
    Route::get('/course/list',[CourseController::class,'index'])->name('university-user.course.index');
    Route::get('/course/add',[CourseController::class,'create'])->name('university-user.course.create');
    Route::post('/course/store',[CourseController::class,'store'])->name('university-user.course.store');
    Route::get('/course/edit/{id}',[CourseController::class,'edit'])->name('university-user.course.edit');
    Route::post('/course/update/{id}',[CourseController::class,'update'])->name('university-user.course.update');
    Route::get('/course/delete/{id}',[CourseController::class,'delete'])->name('university-user.course.delete');


    // University Course Question
    Route::get('/course-question-type/list',[CourseQuestionController::class,'index'])->name('university-user.course-question.index');
    Route::get('/course-question-type/add',[CourseQuestionController::class,'create'])->name('university-user.course-question.create');
    Route::post('/course-question-type/store',[CourseQuestionController::class,'store'])->name('university-user.course-question.store');
    Route::get('/course-question-type/edit/{id}',[CourseQuestionController::class,'edit'])->name('university-user.course-question.edit');
    Route::post('/course-question-type/update/{id}',[CourseQuestionController::class,'update'])->name('university-user.course-question.update');
    Route::get('/course-question-type/delete/{id}',[CourseQuestionController::class,'delete'])->name('university-user.course-question.delete');

    // University Course Quiz Question
    Route::get('/course-quiz-question/list',[QuizController::class,'index'])->name('university-user.course-quiz-question.index');
    Route::get('/course-quiz-question-type/add',[QuizController::class,'create'])->name('university-user.course-quiz-question.create');
    Route::post('/course-quiz-question-type/store', [QuizController::class, 'store'])->name('university-user.course-quiz-question.store');
    Route::get('/course-quiz-question-type/edit/{id}',[QuizController::class,'edit'])->name('university-user.course-quiz-question.edit');
    Route::post('/course-quiz-question-type/update/{id}',[QuizController::class,'update'])->name('university-user.course-quiz-question.update');
    Route::get('/course-quiz-question-type/delete/{id}',[QuizController::class,'delete'])->name('university-user.course-quiz-question.delete');
    Route::get('/course-quiz-question/response/list',[QuizController::class,'studentQuizResponses'])->name('university-user.quizResponse');
    Route::get('/course-quiz-question/{assessmentResultId}/edit', [QuizController::class, 'studentQuizResponseEdit'])->name('university-user.quiz.response.edit');
    Route::put('/course-quiz-question/{assessmentResultId}', [QuizController::class, 'studentQuizResponseUpdate'])->name('university-user.quiz.response.update');

    // University Course Descriptive Question
    Route::get('/course-descriptive-question/list',[DescriptiveController::class,'index'])->name('university-user.course-descriptive-question.index');
    Route::get('/course-descriptive-question/add',[DescriptiveController::class,'create'])->name('university-user.course-descriptive-question.create');
    Route::post('/course-descriptive-question/store', [DescriptiveController::class, 'store'])->name('university-user.course-descriptive-question.store');
    Route::get('/course-descriptive-question/edit/{id}',[DescriptiveController::class,'edit'])->name('university-user.course-descriptive-question.edit');
    Route::post('/course-descriptive-question/update/{id}',[DescriptiveController::class,'update'])->name('university-user.course-descriptive-question.update');
    Route::get('/course-descriptive-question/delete/{id}',[DescriptiveController::class,'delete'])->name('university-user.course-descriptive-question.delete');
    Route::get('/course-descriptive-question/response/list',[DescriptiveController::class,'studentDescriptiveResponses'])->name('university-user.descriptiveResponse');
    Route::get('/course-descriptive-question/{assessmentResultId}/edit', [DescriptiveController::class, 'studentDescriptiveResponseEdit'])->name('university-user.descriptive.response.edit');
    Route::put('/course-descriptive-question/{assessmentResultId}', [DescriptiveController::class, 'studentDescriptiveResponseUpdate'])->name('university-user.descriptive.response.update');



});



// Normal User
Route::middleware(['auth', 'verified', 'normal-user'])->group(function () {
//    Route::get('/', function () {
//        return view('normal-user.home.index');
//    })->name('normal-user.dashboard');

    // Dashboard
    Route::get('/',[DashboardController::class,'dashboard'])->name('normal-user.dashboard');

    // Edit Profile
    Route::get('/edit/profile/{id}',[EditProfileController::class,'index'])->name('normal-user.edit-profile.index');
    Route::put('/edit/profile/update/{id}', [EditProfileController::class, 'update'])->name('normal-user.edit-profile.update');
    Route::get('/edit/profile/activity/{id}', [EditProfileController::class, 'activity'])->name('normal-user.edit-profile.activity');

    // Education
    Route::post('/edit/profile/education/store',[UserEducationController::class,'store'])->name('normal-user.education.store');
    // Skill
    Route::post('/edit/profile/skill/store',[UserSkillController::class,'store'])->name('normal-user.skill.store');
    // Work Experience
    Route::post('/edit/profile/workExperience/store',[UserWorkExperienceController::class,'store'])->name('normal-user.workExperience.store');
    // Certification
    Route::post('/edit/profile/certification/store',[UserCertificationController::class,'store'])->name('normal-user.certification.store');
    // Job Preference
    Route::post('/edit/profile/jobPreference/store',[UserJobPreferenceController::class,'store'])->name('normal-user.jobPreference.store');

    // Admission
    Route::get('/admission/list',[AdmissionController::class,'index'])->name('normal-user.admission.index');
    Route::get('/admission/detail/{slug}', [AdmissionController::class, 'detail'])->name('normal-user.admission.detail');
    Route::post('/university/compare/add', [AdmissionController::class, 'addToCompare'])->name('university.compare.add');
    Route::post('/university/compare/remove', [AdmissionController::class, 'removeFromCompare'])->name('university.compare.remove');
    Route::get('/university/compare', [AdmissionController::class, 'viewCompare'])->name('normal-user.admission.compare-university');
    Route::get('/admission/search', [AdmissionController::class, 'search'])->name('normal-user.admission.search');

    // Admission Application
    Route::post('/application/store',[AdmissionApplicationController::class,'store'])->name('normal-user.admission.application.store');

    // Research Collaboration Project
    Route::get('/research/project/list',[ResearchProjectController::class,'index'])->name('normal-user.research-project.index');
    Route::get('/research/project/detail/{id}',[ResearchProjectController::class,'detail'])->name('normal-user.research-project.detail');
    Route::get('/research/project/create',[ResearchProjectController::class,'create'])->name('normal-user.research-project.create');
    Route::post('/research/project/store',[ResearchProjectController::class,'store'])->name('normal-user.research-project.store');
    Route::post('/research/project/request/respond/{id}', [ResearchProjectController::class, 'respondToRequest'])->name('normal-user.research-project.request.respond');
    Route::get('/research/project/edit/{id}', [ResearchProjectController::class, 'edit'])->name('normal-user.research-project.edit');
    Route::put('/research/project/update/{id}', [ResearchProjectController::class, 'update'])->name('normal-user.research-project.update');
    Route::delete('/research-project/delete/{id}', [ResearchProjectController::class, 'delete'])->name('normal-user.research-project.delete');

    // Research Collaboration Project Meeting
    Route::post('/research/project-meeting/create/{id}',[ResearchProjectMeetingController::class,'createMeeting'])->name('normal-user.research-project-meeting.create');
    Route::post('/research/project-meeting/{meetingId}/respond', [ResearchProjectMeetingController::class, 'respondToMeeting'])->name('normal-user.research-project-meeting.respondToMeeting');
    Route::post('/research/project-meeting/{meetingId}/finalize', [ResearchProjectMeetingController::class, 'finalizeMeeting'])->name('normal-user.research-project-meeting.finalizeMeeting');
    Route::delete('/research/project-meeting/{id}', [ResearchProjectMeetingController::class, 'deleteMeeting'])->name('normal-user.meeting.delete');


    // Research Collaboration Task
    Route::get('/research/task/{researchProjectId}/create',[ResearchTaskController::class,'create'])->name('normal-user.research-task.create');
    Route::post('/research/task/{researchProjectId}/store',[ResearchTaskController::class,'store'])->name('normal-user.research-task.store');
    Route::get('/research/task/detail/{id}',[ResearchTaskController::class,'detail'])->name('normal-user.research-task.detail');
    Route::get('/research/task/edit/{id}',[ResearchTaskController::class,'edit'])->name('normal-user.research-task.edit');
    Route::post('/research/task/update/{id}',[ResearchTaskController::class,'update'])->name('normal-user.research-task.update');
    Route::get('/research/task/delete/{id}',[ResearchTaskController::class,'delete'])->name('normal-user.research-task.delete');

    // Notification
    Route::get('/notification/',[DashboardController::class,'getUserNotifications'])->name('normal-user.notification');

    // Ask Question
    Route::get('/question/list',[QuestionController::class,'index'])->name('normal-user.question.index');
    Route::post('/question/store',[QuestionController::class,'store'])->name('normal-user.question.store');
    Route::get('/question/detail/{id}',[QuestionController::class,'detail'])->name('normal-user.question.detail');
    Route::get('/question/edit/{id}',[QuestionController::class,'edit'])->name('normal-user.question.edit');
    Route::PUT('/question/update/{id}',[QuestionController::class,'update'])->name('normal-user.question.update');
    Route::get('/question/delete/{id}',[QuestionController::class,'delete'])->name('normal-user.question.delete');
    Route::get('/question/search',[QuestionController::class,'search'])->name('normal-user.question.search');
    Route::get('/questions/filter/{type}', [QuestionController::class, 'filter'])->name('normal-user.question.filter');


    //like
    Route::post('/question/vote/{id}', [QuestionController::class, 'vote'])->name('question.vote');

    //comments
    Route::post('/question/comment/store',[QuestionCommentController::class,'store'])->name('normal-user.question.comment.store');
    Route::get('/question/comment/{id}/edit', [QuestionCommentController::class, 'edit'])->name('normal-user.question.comment.edit');
    Route::put('/question/comment/update/{id}', [QuestionCommentController::class, 'update'])->name('normal-user.question.comment.update');
    Route::get('/question/comment/delete/{id}',[QuestionCommentController::class,'delete'])->name('normal-user.question.comment.delete');
    Route::get('/question/comment/{id}/report-spam', [QuestionCommentController::class, 'reportSpam'])
        ->name('normal-user.question.comment.reportSpam');


    // Resource Space
    Route::get('/resource-space/list',[ResourceSpaceController::class,'index'])->name('normal-user.resource-space.index');
    Route::post('/resource-space/store',[ResourceSpaceController::class,'store'])->name('normal-user.resource-space.store');
    Route::get('/resource-space/detail/{id}',[ResourceSpaceController::class,'detail'])->name('normal-user.resource-space.detail');
    Route::delete('/resource-space/delete/{id}', [ResourceSpaceController::class, 'delete'])->name('normal-user.resource-space.delete');
    Route::get('/resource-space/privateJoinForm/{id}',[ResourceSpaceController::class,'privateJoinForm'])->name('normal-user.resource-space.privateJoinForm');
    Route::post('/resource-space/sendJoinRequest/{id}', [ResourceSpaceController::class, 'sendJoinRequest'])->name('normal-user.resource-space.sendJoinRequest');
    Route::get('/resource-space/resourceQuestion/{id}', [ResourceSpaceController::class, 'storeResourceQuestion'])->name('normal-user.resource-space.storeResourceQuestion');
    Route::post('/resource-space/{id}/save-questions', [ResourceSpaceController::class, 'saveQuestions'])->name('normal-user.resource-space.saveQuestions');
    Route::get('resource-space/{id}/edit-questions', [ResourceSpaceController::class, 'editResourceQuestion'])->name('normal-user.resource-space.editResourceQuestion');
    Route::post('resource-space/{id}/update-questions', [ResourceSpaceController::class, 'updateQuestions'])->name('normal-user.resource-space.updateQuestions');
    Route::post('resource-space/{id}/toggle-membership', [ResourceSpaceController::class, 'toggleMembership'])->name('normal-user.resource-space.toggleMembership');
    Route::post('resource-space/{id}/save-request', [ResourceSpaceController::class, 'saveJoinRequest'])->name('normal-user.resource-space.saveRequest');
    Route::post('/resource-space/join-request/{requestId}/respond', [ResourceSpaceController::class, 'handleJoinRequest'])->name('normal-user.resource-space.join-request.respond');
    Route::get('resource-space/{id}/responses', [ResourceSpaceController::class, 'showResponses'])->name('normal-user.resource-space.responses');

    // Resource Space Post
    Route::post('/resource-space-post/store',[ResourceSpacePostController::class,'store'])->name('normal-user.resource-space-post.store');
    Route::get('/resource-space/detail/{id}/edit', [ResourceSpacePostController::class, 'editResourceSpacePost'])->name('normal-user.resource-space-post.edit');
    Route::put('/resource-space-post/update/{id}',[ResourceSpacePostController::class,'update'])->name('normal-user.resource-space-post.update');
    Route::delete('/resource-space-post/delete/{id}',[ResourceSpacePostController::class,'delete'])->name('normal-user.resource-space-post.delete');

    // Resource Space Blog
    Route::get('//resource-space-blog/detail/{id}', [ResourceSpaceBlogController::class, 'detail'])->name('normal-user.resource-space-blog.detail');
    Route::post('/resource-space-blog/store',[ResourceSpaceBlogController::class,'store'])->name('normal-user.resource-space-blog.store');
    Route::get('/resource-space/detail/{id}/edit', [ResourceSpaceBlogController::class, 'editResourceSpacePost'])->name('normal-user.resource-space-blog.edit');
    Route::put('/resource-space-blog/update/{id}',[ResourceSpaceBlogController::class,'update'])->name('normal-user.resource-space-blog.update');
    Route::delete('/resource-space-blog/delete/{id}',[ResourceSpaceBlogController::class,'delete'])->name('normal-user.resource-space-blog.delete');

    // Route for upvoting a post
    Route::post('/resource-space-post/upvote/{id}', [ResourceSpacePostController::class, 'upvote'])->name('normal-user.resource-space-post.upvote');
    // Route for downvoting a post
    Route::post('/resource-space-post/downvote/{id}', [ResourceSpacePostController::class, 'downvote'])->name('normal-user.resource-space-post.downvote');
    // Resource Space Comment
    Route::post('/resource-space-post/{post}/comment', [ResourceSpacePostCommentController::class, 'store'])->name('normal-user.resource-space-post.comment');
    Route::get('/resource-space-post/comment/{id}/edit', [ResourceSpacePostCommentController::class, 'edit'])->name('normal-user.resource-space-post.comment.edit');
    Route::delete('/resource-space-post/comment/{id}/delete', [ResourceSpacePostCommentController::class, 'destroy'])->name('normal-user.resource-space-post.comment.delete');
    // Dashboard
    Route::get('resource-space/{resourceSpaceId}/engagement', [ResourceSpaceController::class, 'dashboard'])->name('normal-user.resource-space-post.dashboard');

    // Jobs
    Route::get('/Jobs/list', [JobController::class, 'index'])->name('normal-user.job.index');
    Route::get('/jobs/search', [JobController::class, 'search'])->name('normal-user.job.search');
    Route::get('/Jobs/detail/{id}', [JobController::class, 'detail'])->name('normal-user.job.detail');
    Route::post('/Jobs/application/store', [JobController::class, 'jobApplication'])->name('normal-user.application.store');
    Route::get('/Jobs/company/{id}', [JobController::class, 'company'])->name('normal-user.job.company');

    // Skill Assessment
    Route::get('/skill-assessment/list', [SkillAssessmentController::class, 'index'])->name('normal-user.skill-assessment.index');
    Route::get('/skill-assessment/descriptive/{id}', [SkillAssessmentController::class, 'showDescriptive'])->name('normal-user.descriptive.detail');
    Route::post('/descriptive/assessment/submit', [SkillAssessmentController::class, 'submitDescriptive'])->name('normal-user.descriptive.assessment.submit');
    Route::get('/skill-assessment/quiz/{id}', [SkillAssessmentController::class, 'showQuiz'])->name('normal-user.quiz.detail');
    Route::post('/quiz/assessment/submit/{id}', [SkillAssessmentController::class, 'submitQuiz'])->name('normal-user.quiz.assessment.submit');
    Route::get('/assessment/descriptive/result/{id}', [SkillAssessmentController::class, 'descriptiveResult'])->name('normal-user.assessment.descriptive.result');
    Route::get('/assessment/quiz/result/{id}', [SkillAssessmentController::class, 'quizResult'])->name('normal-user.assessment.quiz.result');
    Route::get('/assessment/quiz/detail/{id}', [SkillAssessmentController::class, 'assessmentDetail'])->name('normal-user.assessment.detail');

    // Recommendations
    Route::get('/career-recommendations', [CareerRecommendationController::class, 'index'])->name('normal-user.career_recommendations.index');
    Route::get('/resource-space/{resourceSpace}', [CareerRecommendationController::class, 'show'])
        ->name('normal-user.resource-space.show');

});

// hi there


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
