<div class="tim" id="confirmationTambahAnggota" style="display:none;">
    <div class="form-group1">
        <select name="id_anggota3" id="id_anggota3" class="form-control1">
            <option value="">
                Pilih anggota 3
            </option>
        @foreach ($karyawan2 as $karyawan)
            <option value="{{ $karyawan->nama }}">{{ $karyawan->nama }}</option>
        @endforeach
        </select>
    </div>

    <div class="form-group1">
        <select name="id_anggota4" id="id_anggota4" class="form-control1">
            <option value="">
                Pilih anggota 4
            </option>
        @foreach ($karyawan3 as $karyawan)
            <option value="{{ $karyawan->nama }}">{{ $karyawan->nama }}</option>
        @endforeach
        </select>
    </div>
    
</div>