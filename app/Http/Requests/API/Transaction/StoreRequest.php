<?php

namespace App\Http\Requests\API\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'subscription_id' => 'required|exists:subscriptions,id',
            'price'           => 'required|numeric'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
