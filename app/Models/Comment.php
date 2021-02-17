<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';

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
     * Get the post that owns the comment.
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'id');
    }

    public function scopeId($query, $id)
    {
        return ($id !== null || !empty($id)) ? $query->whereIn('id', (array)$id) : null;
    }

    public function scopePost($query, $id)
    {
        return ($id !== null || !empty($id)) ? $query->whereIn('postId', (array)$id) : null;
    }

    public function scopeName($query, $name)
    {
        return ($name !== null || !empty($name)) ? $query->whereIn('name', (array)$name) : null;
    }

    public function scopeEmail($query, $email)
    {
        return ($email !== null || !empty($email)) ? $query->whereIn('email', (array)$email) : null;
    }

    public function scopeBody($query, $body)
    {
        return ($body !== null || !empty($body)) ? $query->whereIn('body', (array)$body) : null;
    }
}
