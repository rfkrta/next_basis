@foreach ($ajax_position as $item)
<div class="tgl1">
    <label for="gaji_posisi">Gaji</label>
    <input type="number" class="date" name="gaji_posisi" id="gaji_posisi" value="{{ $item->position->gaji_posisi }}" readonly>
</div>
@endforeach