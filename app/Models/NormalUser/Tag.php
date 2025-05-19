<?php

namespace App\Models\NormalUser;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['tags'];


    public static function newTag($tags)
    {
        if (is_string($tags)) {
            $tags = explode(',', $tags);
        }
        $tagIds = [];
        foreach ($tags as $tagName) {
            $tagName = trim(strtolower($tagName));
            $tag = self::firstOrCreate(['tags' => $tagName]);
            $tagIds[] = $tag->id;
        }
        return $tagIds;
    }

    // Define the many-to-many relationship with questions
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_tags', 'tag_id', 'question_id')
            ->withTimestamps();
    }
}
