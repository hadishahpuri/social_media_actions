<?php

namespace Hadishahpuri\SocialMediaActions\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;
    protected $table = 'sma_likes';

    protected $guarded = [];
}
