<?php

namespace App\Http\Requests;

use App\Http\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class ScanOrderRequest extends FormRequest
{
    use FailedValidation;
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
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
            'orders'              => 'required|min:1',
            'orders.*.sku'        => 'required|min:5|max:50',
            'orders.*.unit_price' => 'required|numeric|min:1'
        ];
    }
}
