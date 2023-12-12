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
            'kota_keberangkatan' => 'required|max:255',
            'komisi_dinas' => 'required|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'id_anggota1' => 'required|max:255',
            'id_anggota2' => 'required|max:255',
            'id_anggota3' => 'max:255',
            'id_anggota4' => 'max:255',
            'nama_PIC_perusahaan' => 'required|max:255',
            'jabatan_PIC' => 'required|max:255',
            'status' => 'max:255'
        ];
    }
}
