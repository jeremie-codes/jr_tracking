<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'shop_id' => 'required|exists:shops,id',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'available' => 'required|in:0,1',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'L\'image du produit est obligatoire.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format jpeg, png, jpg, gif, ou svg.',
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
            // 'shop_id.required' => 'La boutique est obligatoire.',
            // 'shop_id.exists' => 'La boutique sélectionnée n\'existe pas.',
            'name.required' => 'Le nom du produit est obligatoire.',
            'name.string' => 'Le nom du produit doit être une chaîne de caractères.',
            'name.max' => 'Le nom du produit ne doit pas dépasser 255 caractères.',
            'category_id.required' => 'La catégorie est obligatoire.',
            'category_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
            'available.required' => 'La disponibilité est obligatoire.',
            'available.in' => 'La disponibilité doit être soit 0 (Inactif), soit 1 (Actif).',
            'price.required' => 'Le prix est obligatoire.',
            'price.numeric' => 'Le prix doit être un nombre.',
            'price.min' => 'Le prix doit être supérieur ou égal à 0.',
            'description.required' => 'La description est obligatoire.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.max' => 'La description ne doit pas dépasser 1000 caractères.',
        ];
    }
}
