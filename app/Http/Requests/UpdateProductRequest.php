<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('create', Product::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "string|min:4|max:255|required|unique:categories,name,". request()->product->id . ',id',
            "category_id" => "required|integer|exists:categories,id",
            "brand_id" => "required|integer|exists:brands,id",
            "price" => "required|integer",
            "description" => "required|max:2048|string",
            "image" => "file|image|nullable|max:2048"
        ];
    }
}
