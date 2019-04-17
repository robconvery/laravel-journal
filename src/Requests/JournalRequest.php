<?php

namespace Robconvery\LaravelJournal\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JournalRequest extends FormRequest
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
            'entry' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'entry.required' => 'A journal entry is required.'
        ];
    }

}
