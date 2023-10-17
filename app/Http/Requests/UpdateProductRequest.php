<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_ar' => ['required', 'string', 'max:255', 'unique_translation:products,name,' . $this->product->id],
            'name_en' => ['required', 'string', 'max:255', 'unique_translation:products,name,' . $this->product->id],
            'desc_ar' => ['required', 'string'],
            'desc_en' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'warehouse_id' => ['required', 'exists:warehouses,id'],
            'image' => ['image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'purchase_price' => ['required'],
            'sale_price' => ['required'],
            'stock' => ['required']
        ];
    }
}
