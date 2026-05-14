<?php

namespace App\Http\Requests\cycle;

use App\Services\CycleService;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

abstract class BaseCycleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start_date' => [
                'required',
                'date',
            ],

            'end_date' => [
                'required',
                'date',
                'after:start_date'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Este campo es obligatorio.',
            '*.date' => 'Este campo debe ser una fecha válida.',

            'end_date.after' =>
            'La fecha de cierre debe ser posterior a la fecha de inicio.',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        if ($validator->errors()->isNotEmpty()) {
            return;
        }

        $validator->after(function ($validator) {

            $start = Carbon::parse($this->start_date);
            $end = Carbon::parse($this->end_date);

            $duration = $start->diffInDays($end);

            if ($duration < 7) {
                $validator->errors()->add(
                    'end_date',
                    'El ciclo debe tener una duración mínima de 7 días.'
                );
            }

            $cycleService = app(CycleService::class);

            $hasDateOverlap = $cycleService->hasDateOverlap(
                $this->start_date,
                $this->end_date,
                $this->getCycleId()
            );

            if ($hasDateOverlap) {
                $validator->errors()->add(
                    'start_date',
                    'Ya existe un ciclo en ese rango de fechas.'
                );
            }
        });
    }

    protected function getCycleId(): ?int
    {
        return null;
    }
}
