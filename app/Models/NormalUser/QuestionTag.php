<?php

namespace App\Models\NormalUser;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTag extends Model
{
    use HasFactory;
    protected $fillable = ['question_id', 'tag_id'];
    private static $tagIds;

    public static function QuestionTagsInfo($questionTag, $questionId, $tagId)
    {
        $questionTag->question_id = $questionId;
        $questionTag->tag_id = $tagId;
        $questionTag->save();

        return $questionTag;
    }

    public static function newQuestionTags($questionId, $tags)
    {
        foreach ($tags as $tag) {
            if (is_numeric($tag)) {
                // Directly use the tag if it's a number (tag ID)
                self::QuestionTagsInfo(new QuestionTag(), $questionId, $tag);
            } elseif (is_string($tag)) {
                // If it's a string, first create or find the tag, then use its ID
                $tagRecord = Tag::firstOrCreate(['tags' => trim(strtolower($tag))]);
                self::QuestionTagsInfo(new QuestionTag(), $questionId, $tagRecord->id);
            } elseif (is_array($tag)) {
                // If it's an array, assume it contains an 'id' key
                self::QuestionTagsInfo(new QuestionTag(), $questionId, $tag['id']);
            } elseif (is_object($tag)) {
                // If it's an object, use its id property
                self::QuestionTagsInfo(new QuestionTag(), $questionId, $tag->id);
            } else {
                // Handle unexpected cases if necessary
                throw new \Exception('Unexpected tag format');
            }
        }
    }

    public static function updateTags($blogId, $tags)
    {
        // Handle existing and new tags
        foreach ($tags as $tag) {
            if (is_numeric($tag)) {
                // Handle case when $tag is already an ID
                self::updateOrCreate([
                    'question_id'   => $blogId,
                    'tag_id'        => $tag
                ]);
            } elseif (is_string($tag)) {
                // Handle case when $tag is a string (e.g., a tag name)
                $tagRecord = Tag::firstOrCreate(['tags' => trim(strtolower($tag))]);
                self::updateOrCreate([
                    'question_id'   => $blogId,
                    'tag_id'        => $tagRecord->id
                ]);
            } elseif (is_array($tag) && isset($tag['id'])) {
                // Handle case when $tag is an array of IDs
                self::updateOrCreate([
                    'question_id'   => $blogId,
                    'tag_id'        => $tag['id']
                ]);
            } elseif (is_object($tag)) {
                // Handle case when $tag is an object
                self::updateOrCreate([
                    'question_id'   => $blogId,
                    'tag_id'        => $tag->id
                ]);
            }
        }
    }
}
