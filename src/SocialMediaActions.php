<?php

namespace Hadishahpuri\SocialMediaActions;

use Hadishahpuri\SocialMediaActions\Models\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class SocialMediaActions
{
    /**
     * use this function to update views
     * create a new record in views table if this user hasn't seen this model
     * @param $viewable|viewable model instance
     * @return bool
     */
    function incrementViews($viewable): bool
    {
        if (auth()->check() && View::query()->where('viewable_id', $viewable->getAttributeValue("id"))->where('viewable_type', $viewable->getTable())
                ->where('user_id', auth()->id())->exists())
            return false;
        elseif (!auth()->check() && View::query()->where('viewable_id', $viewable->getAttributeValue("id"))->where('viewable_type', $viewable->getTable())
                ->where('session_id', Session::getId())->exists())
            return false;
        View::query()->create([
            'user_id' => auth()->id() ?? null,
            'session_id' => Session::getId(),
            'viewable_id' => $viewable->getAttributeValue("id"),
            'viewable_type' => $viewable->getTable(),
        ]);
        return true;
    }
}