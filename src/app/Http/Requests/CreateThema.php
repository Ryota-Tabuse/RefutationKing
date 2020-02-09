<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateThema extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:40',
            'option_a' => 'required|max:10',
            'option_b' => 'required|max:10',
        ];
    }

    public function attributes()
    {
        return[
            'name' => '議論テーマ名',
            'option_a' => '選択肢',
            'option_b' => '選択肢',
        ];
    }
}
