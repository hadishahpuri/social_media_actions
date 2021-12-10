<?php

namespace Hadishahpuri\SocialMediaActions\Requests\CommentRequests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'commentable_type' => 'required|in:' . config('social_media_actions.morphs', ''),
            'commentable_id' => 'required|exists:' . $this->get('commentable_type') . ',id',
            'content' => 'required|string|min:' . config('social_media_actions.min_comment_length', '5') .
                                    '|max:' . config('social_media_actions.max_comment_length', '3000'),
            'reply_id' => 'exists:comments,id'
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
