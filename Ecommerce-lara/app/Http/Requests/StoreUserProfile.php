<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserProfile extends FormRequest
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
    //'slug' => 'required|unique:profiles,slug,'.$this->id.',id',if we cannot change default route which is id known as primary key
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:profiles,slug,'.$this->slug.',slug',
            'email' => 'required|unique|email:users,slug,'.$this->slug.',slug',
            'password' => 'required|same:password_confirm',
            'password_confirm' => 'required',
            'status' => 'required'
        ];
    }
}



