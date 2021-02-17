<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'postId');
    }

    public function scopeShow($query, $post)
    {
        return $query->where('id', $post);
    }

    public function setUserId($value)
    {
        $this->attributes['user_id'] = $value;
    }

    public function scopeNumberOfComments($query)
    {
        return $query->addSelect(['comment_count' => DB::table('comments')
            ->select(DB::raw('COUNT(id) AS comment_count'))
            ->whereColumn('comments.postId', 'posts.id')
        ])
        ->orderBy('comment_count')
        ->limit(3);
    }
}
