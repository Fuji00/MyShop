<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>['required','max:50'],
            'description'=>['required','max:255'],
            'category_id'=>['required','exists:categories,id'],//category_idがcategoriesのidと紐付き、定義されているか
            'price'=>['required','min:0','integer'],
          /*  'image' => [
              'required',
              'file', // ファイルがアップロードされている
              'image', // 画像ファイルである
              'mimes:jpg,jpeg,jpe,jfif,png', // 形式はjpegかpng
              'dimensions:min_width=50,min_height=50,max_width=1000,max_height=1000', // 50*50 ~ 1000*1000 まで
            ],*/
        ];
    }
}
