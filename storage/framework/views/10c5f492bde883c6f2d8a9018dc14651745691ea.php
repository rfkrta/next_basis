<div class="tim" id="confirmationTambahAnggota" style="display:none;">
    <div class="form-group1">
        <select name="id_anggota3" id="id_anggota3" class="form-control1">
            <option value="">
                Pilih anggota 3
            </option>
        <?php $__currentLoopData = $user2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($users->name); ?>"><?php echo e($users->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="form-group1">
        <select name="id_anggota4" id="id_anggota4" class="form-control1">
            <option value="">
                Pilih anggota 4
            </option>
        <?php $__currentLoopData = $user3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($users->name); ?>"><?php echo e($users->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    
</div><?php /**PATH D:\Project\next_basis\resources\views/admin/perjalanandinas/tambah-anggota.blade.php ENDPATH**/ ?>