<?php

namespace Hadishahpuri\SocialMediaActions\Requests\CommentRequests;

use Illuminate\Foundation\Http\FormRequest;

class CommentsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'commentable_type' => 'required|in:forums,products,articles',
            'commentable_id' => 'required|exists:' . $this->get('commentable_type') . ',id',
            'paginate' => 'nullable|integer|between:1,50'
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
