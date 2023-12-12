<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BiayaDinasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'perjalanan_dinas_id' => 'max:255',
            'biaya_hotel' => 'required|max:255',
            'keterangan_hotel' => 'required|max:255',
            'biaya_transportasi' => 'required|max:255',
            'keterangan_transportasi' => 'required|max:255',
            'biaya_konsumsi' => 'required|max:255',
            'keterangan_konsumsi' => 'required|max:255',
            'biaya_lain' => 'required|max:255',
            'keterangan_lain' => 'required|max:255'
        ];
    }
}
