<?php

namespace App\Http\Requests\Epresence;

use App\Models\Epresence;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestErrorMessage;

class CreateEpresenceRequest extends FormRequest
{
    use RequestErrorMessage;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'bail|required|in:' . Epresence::IN . ',' . Epresence::OUT,
            'waktu' => 'bail|required|date_format:Y-m-d H:i:s',
        ];
    }

    /**
     * Aliases name
     * 
     * @return array
     */
    public function attributes(): array
    {
        return [
            'type' => 'Tipe Presensi',
            'waktu' => 'Waktu',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'in' => 'Tipe presensi harus IN atau OUT',
            'date_format' => 'Format waktu harus YYYY-MM-DD HH:mm:ss',
        ];
    }
}
