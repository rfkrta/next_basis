<div id="confirmationTambahAnggota" style="display:none;">
    <div class="form1">
        <div class="form-1">
            <label for="id_anggota3">Anggota 3</label>
            <select name="id_anggota3" id="id_anggota3">
                <option value="">
                    Pilih anggota 3
                </option>
            @foreach ($user2 as $users)
                <option value="{{ $users->id }}">{{ $users->name }}</option>
            @endforeach
            </select>
        </div>
        <div class="form-1">
            <label for="id_anggota4">Anggota 4</label>
            <select name="id_anggota4" id="id_anggota4">
                <option value="">
                    Pilih anggota 4
                </option>
            @foreach ($user3 as $users)
                <option value="{{ $users->id }}">{{ $users->name }}</option>
            @endforeach
            </select>
        </div>
    </div>
</div>