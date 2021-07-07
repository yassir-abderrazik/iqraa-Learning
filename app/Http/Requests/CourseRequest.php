<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'title' => 'required|unique:courses|max:255',
            'level' => 'required|in:Débutant,Intermédiaire,Avancé',
            'type' => 'required',
            'description'  => 'required',
            'price'  => 'required|integer',
            'picture' => 'required|image',
            'hours'=> 'required|integer',
            'tags' => 'required'
        ];
    }
}
