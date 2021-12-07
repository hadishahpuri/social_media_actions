<?php

namespace Hadishahpuri\SocialMediaActions\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'sma_comments';

    protected $guarded = [];
    // uncomment the line below if you always want the comments with their replies
    //    protected $appends = ['replies'];

    /**
     * get the related object
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    /**
     * returns the replies of a comment with user who commented
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class, 'reply_id', 'id')->where('approval', true)->with('user');
    }

    /**
     * retrieves all the comments replies and their child replies
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childReplies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->replies()->with('childReplies');
    }

    /**
     * this function is used for appending the replies property to each comment
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getRepliesAttribute(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->replies();
    }

    /**
     * get owner of the comment
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(config('social_media_actions.users_model_path', 'App\\Models\\User'));
    }
}
