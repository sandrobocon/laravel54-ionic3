<?php

namespace CodeFlix\Http\Requests;

use CodeFlix\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CategoryCRUDRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(\Auth::user() and intval(\Auth::user()->role) === User::ROLE_ADMIN)
            return true;

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
