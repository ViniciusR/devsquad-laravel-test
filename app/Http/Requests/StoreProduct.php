<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Product;

class StoreProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {   
        //Create Policies if there's more than one type of users. Currently there's admin only.
        return $this->user()->isAdmin();
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
            'name' => 'required|max:255',
            'description' => 'required|max:255',
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
            'price.required'  => 'The product price is required',
            'category_id.required'  => 'The product category is required',
            'image.mimes'  => 'The file extension is not allowed',
            'image.required'  => 'The product image is required',
        ];
    }
}
