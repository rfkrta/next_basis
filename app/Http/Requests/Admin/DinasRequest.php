<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DinasRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id_mitras' => 'required|max:255',
            'kota' => 'required|max:255',
            'komisi' => 'required|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'id_anggota1' => 'required|max:255',
            'id_anggota2' => 'required|max:255',
            'pic_perusahaan' => 'required|max:255',
            'jabatan_pic' => 'required|max:255'
        ];
    }
}
