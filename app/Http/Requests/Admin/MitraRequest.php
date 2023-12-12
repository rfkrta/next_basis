<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MitraRequest extends FormRequest
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
            'nama_mitra' => 'required|max:255',
            'provinsi' => 'required|max:255',
            'kota' => 'required|max:255',
            'kecamatan' => 'required|max:255',
            'kelurahan' => 'required|max:255',
            'kode_pos' => 'required|max:255',
            'alamat_lengkap' => 'required',
            'nama_PIC_perusahaan' => 'required|max:255',
            'jabatan_PIC' => 'required|max:255',
            'nomer_telepon_PIC' => 'required|max:255',
            'komisi_dinas' => 'required|max:255',
            'status' => 'max:255'
        ];
    }
}
