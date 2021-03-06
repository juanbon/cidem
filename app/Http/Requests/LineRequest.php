<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LineRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'name' => 'required|min:5|max:255',
                'institucion' => 'required|min:5|max:255',
                'modality_id' => 'required',
                'dead_line' => 'required',
                'recipients[]' => 'required',
                'description' => 'required',
                'areas[]' => 'required',
                'financing_type_id' => 'required',
                'info' => 'required',
                'web' => 'required'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
