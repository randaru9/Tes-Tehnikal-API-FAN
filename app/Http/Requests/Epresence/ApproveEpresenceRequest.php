<?php

namespace App\Http\Requests\Epresence;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestErrorMessage;

class ApproveEpresenceRequest extends FormRequest
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
            'epresence_id' => 'required|exists:epresences,id',
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
            'epresence_id' => 'Presensi',
        ];
    }

}
