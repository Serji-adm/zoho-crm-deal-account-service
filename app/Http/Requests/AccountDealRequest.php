<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountDealRequest extends FormRequest
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
            'account.account_name'    => 'required|string|max:255',
            'account.website' => 'nullable|url',
            'account.phone'   => 'nullable|string|max:30',
            'deal.deal_name'       => 'required|string|max:255',
            'deal.stage'      => 'required|string',
        ];
    }
}
