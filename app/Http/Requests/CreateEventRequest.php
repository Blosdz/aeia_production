<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Event;

class CreateEventRequest extends FormRequest
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
     
        /*
        'title',
        'date',
        'description',
        'image',
        'link_meet',
        'link_recording',
        'total',
        'status'
        */
    public function rules()
    {
        $rules = [
            'title' => 'required|max:255',
            'description'=> 'required|max:255',
            'image'=> 'required',
        ];

        return $rules;
    }
    public function messages()
    {
        $messages = [
            'title.required' => 'El campo titulo es obligatorio',
            'title.max' => 'texto demasiado largo para el campo título',
            'description.required' => 'El campo descripción es obligatorio.',
            'description.max' => 'texto demasiado largo para el campo descripción.',
            'image.required' => 'El campo image es obligatorio.',

        ];

        return $messages;
    }

}
