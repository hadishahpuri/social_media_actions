<?php

namespace Hadishahpuri\SocialMediaActions\Requests\BookmarkRequests;

use Illuminate\Foundation\Http\FormRequest;

class BookmarkRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bookmarkable_type' => 'required|in:' . config('social_media_actions.morphs', ''),
            'bookmarkable_id' => 'required|exists:' . $this->get('bookmarkable_type') . ',id',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
