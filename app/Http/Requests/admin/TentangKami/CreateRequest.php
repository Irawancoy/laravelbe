<?php

namespace App\Http\Requests\Admin\TentangKami;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use ProtoneMedia\LaravelMixins\Request\ConvertsBase64ToFiles;


class CreateRequest extends FormRequest

{
use ConvertsBase64ToFiles;

    public $validator = null;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    protected function base64FileKeys(): array
    {
        return [
            'gambar' => 'fotoUser.jpg',
        ];
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'judul'=>'required|max:100',
            'deskripsi'=>'required',
        ];
    }
      /**
     * Tampilkan pesan error ketika validasi gagal
     *
     * @return void
     */
    public function failedValidation(Validator $validator)
    {
       $this->validator = $validator;
    }

}
