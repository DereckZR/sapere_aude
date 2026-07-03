<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class BaseUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'member_id' => [
                'required',
                'integer',
                'exists:members,id',
                'unique:users,member_id'
            ],
            'role_id' => [
                'required',
                'integer',
                'exists:roles,id'
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->max(128)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                // ->uncompromised() //para verificar que la contraseña introducida no fue encontrada en BD de contraseñas vulneradas
            ],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Este campo es obligatorio.',
            '*.string' => 'Este campo debe ser una cadena de texto.',
            '*.integer' => 'Este campo debe ser un número entero.',

            'member_id.unique' => 'Ya se tiene registrado un usuario para este miembro',

            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña puede tener como máximo 128 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.letters' => 'La contraseña debe tener al menos una letra.',
            'password.mixed' => 'La contraseña debe contener mayúsculas y minúsculas.',
            'password.numbers' => 'La contraseña debe tener al menos un número.',
            'password.symbols' => 'La contraseña debe tener al menos un símbolo.',
            // 'password.uncompromised' => 'La contraseña ha sido encontrada en una filtración de datos. Elige otra diferente.',
            //TODO: consultar si deberiamos usar esto

            '*.exists' =>
            'El registro seleccionado no existe.',
        ];
    }
}
