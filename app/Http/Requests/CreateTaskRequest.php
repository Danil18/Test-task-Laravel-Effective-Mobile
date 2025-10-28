<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CreateTaskRequest extends FormRequest
{
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
            'title' => [
                'required',
                'string',
                'max:191',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'status' => [
                'required',
                'string',
                'max:191',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Название должно быть заполнено',
            'title.string' => 'Название должно быть строкой',
            'title.max' => 'Название должно быть короче или равно: 255 символов',
            'description.string' => 'Описание должно быть строкой',
            'status.required' => 'Статус должен быть заполнен',
            'status.string' => 'Статус должен быть строкой',
            'status.max' => 'Статус должен быть короче или равно: 255 символов',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json(
                [
                    'result' => false,
                    'message' => $validator->errors()->all()
                ],
                422,
                ['Content-type' => 'application/json;charset=utf-8'],
                JSON_UNESCAPED_UNICODE
            );

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
