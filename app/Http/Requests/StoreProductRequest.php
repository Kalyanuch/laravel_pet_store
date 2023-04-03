<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validates product entity data.
 */
class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:250'],
            'description' => ['required', 'max:3000'],
            'status' => ['in:0,1', 'required'],
            'sort_order' => ['regex:/^[0-9]*$/', 'nullable'],
            'category_id' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'image' => ['image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'is_remove_image' => ['in:0,1'],
        ];
    }
}
