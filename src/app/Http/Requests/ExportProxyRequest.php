<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportProxyRequest extends FormRequest
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
        return [
            'format' => ['required', 'regex:/^(25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}($|(?:\:\d+\@\w+\:\w+){1}|(?:\@\w+\:\w+)|(?:\:\d+){1})?/im']
        ];
    }
}
