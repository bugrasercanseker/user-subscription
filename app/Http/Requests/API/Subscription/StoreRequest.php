<?php

namespace App\Http\Requests\API\Subscription;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'renewal_at' => 'required|date'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
