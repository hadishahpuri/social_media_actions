<?php

namespace Hadishahpuri\SocialMediaActions\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class View extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'sma_views';
}
