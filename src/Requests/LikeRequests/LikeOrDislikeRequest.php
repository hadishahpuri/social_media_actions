<?php

namespace Hadishahpuri\SocialMediaActions\Requests\LikeRequests;

use Illuminate\Foundation\Http\FormRequest;

class LikeOrDislikeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'likeable_type' => 'required|in:forums,products,articles',
            'likeable_id' => 'required|exists:' . $this->get('likeable_type') . ',id',
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
