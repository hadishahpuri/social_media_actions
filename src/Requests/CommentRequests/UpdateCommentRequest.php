<?php

namespace Hadishahpuri\SocialMediaActions\Requests\CommentRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['required', Rule::exists('comments')->where('user_id', auth()->id())],
            'content' => 'string|min:' . config('social_media_actions.min_comment_length', '5') .
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
