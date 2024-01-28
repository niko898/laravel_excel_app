<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ImportStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        // dd($this->file->getClientOriginalExtension());

        if(!in_array($this->file->getClientOriginalExtension(), ['xlsx'])){
            throw ValidationException::withMessages(["Incorrect file extension"]);
        }

        return [
            'file' => 'required|file',
            'type' => 'required|integer|in:1,2',
        ];
    }
}
