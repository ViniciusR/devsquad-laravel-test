<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //TODO
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $required_on_update = 'nullable';

        if ($this->method() == 'POST') {
            $required_on_update = 'required';
        }

        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'image' => $required_on_update.'|max:10000|mimes:jpeg,jpg,png,gif', //required, max 10000kb, image file',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The product name is required',
            'description.required'  => 'The product description is required',
            'description.price'  => 'The product price is required',
            'description.category_id'  => 'The product category is required',
            'image.mimes'  => 'The file extension is not allowed',
        ];
    }
}
