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
            'id' => ['required', Rule::exists('comments')->where('id', $this->get('id'))->where('user_id', auth()->id())],
            'content' => 'string|max:3000',
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
