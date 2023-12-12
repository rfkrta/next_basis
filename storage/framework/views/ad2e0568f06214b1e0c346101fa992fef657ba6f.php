

<?php $__env->startSection('content'); ?>
<div class="main">
    <div class="main-top1">
        <a href="<?php echo e(route('admin.pengajuancuti.index')); ?>"><i class="fa fa-angle-left"></i></a>
        <h3>Pengajuan Cuti <?php echo e($item->user->name); ?></h3>
    </div>

    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    <div class="cong-box2">
        <form action="#" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="content">
                <div class="tglx">
                    <div class="tgl1">
                        <h5>Nama</h5>
                        <input type="text" name="nama" id="nama" class="date" placeholder="Tuliskan nama, di sini" value="<?php echo e($item->user->name); ?>">
                        <!-- <div class="form-group1">
                                <select name="status" required class="form-control1">
                                    <option value="">
                                        Pilih Nama Karyawan
                                    </option>
                                    <option value="">Budi</option>
                                    <option value="">Yanto</option>
                                </select>
                            </div> -->
                    </div>
                    <div class="tgl1">
                        <h5>Kategori Cuti</h5>
                        <input type="text" name="kategori" id="kategori" class="date" placeholder="Tuliskan kategori, di sini" value="<?php echo e($item->kategori->nama_kategori); ?>">
                        <!-- <div class="form-group1">
                                <select name="status" required class="form-control1">
                                    <option value="">
                                        Pilih Kategori Cuti
                                    </option>
                                    <option value="">Cuti Tahunan</option>
                                    <option value="">Cuti Kehamilan</option>
                                </select>
                            </div> -->
                    </div>
                </div>
                <div class="keter">
                    <h5>Keterangan</h5>
                    <textarea name="keterangan" id="keterangan" placeholder="Tuliskan Keterangan atau alasan mengambil cuti, di sini"><?php echo e($item->keterangan); ?></textarea>
                    <!-- cols="122" rows="5" -->
                </div>
                <div class="tgl">
                    <div class="tgl1">
                        <h5>Tanggal Mulai</h5>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="date" value="<?php echo e($item->tanggal_mulai); ?>">
                    </div>
                    <div class="tgl1">
                        <h5>Tanggal Selesai</h5>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="date" value="<?php echo e($item->tanggal_selesai); ?>">
                    </div>
                </div>
                <?php if($item->file_surat): ?>
                <div class="file-info">
                    <h5>File Surat</h5>
                    <a href="<?php echo e(Storage::url('public/surat/' . $item->file_surat)); ?>" target="_blank">Lihat Surat</a>
                </div>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project\next_basis\resources\views/admin/pengajuancuti/detail.blade.php ENDPATH**/ ?>