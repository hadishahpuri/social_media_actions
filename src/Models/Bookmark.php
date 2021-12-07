<?php

namespace Hadishahpuri\SocialMediaActions\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bookmark extends Model
{
    use HasFactory;
    protected $table = 'sma_bookmarks';

    protected $guarded = [];
    /**
     * get the related object
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function bookmarkable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
}
