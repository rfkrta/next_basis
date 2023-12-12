

<?php $__env->startSection('content'); ?>
    <div class="main">
        <div class="main-top">
            <h1>Dinas</h1>
        </div>
        <div class="view">
            <div class="search">
                <i class="fa fa-search"></i>
                <input type="text" name="" class="input1" placeholder="Search">
            </div>
            <div class="plus">
                <i class="fa fa-plus"></i>
                <a href="<?php echo e(route('admin.perjalanandinas.create')); ?>">Perjalanan Dinas</a>
            </div>
        </div>

        <div class="filter">
            <ul class="filterx">
                <li class="activev">
                    <a href="#">Semua</a>
                </li>
            </ul>
            <ul class="filterx">
                <li>
                    <a href="#">Selesai</a>
                </li>
            </ul>
            <ul class="filterx">
                <li>
                    <a href="#">Berjalan</a>
                </li>
            </ul>
            <ul class="filterx">
                <li>
                    <a href="#">Ditolak</a>
                </li>
            </ul>
        </div>
        <div class="line1"></div>
        <div class="cong-box">
            <div>
                <table class="box" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="lebarTabel">No</th>
                            <th>Perusahaan</th>
                            <th>Kota Keberangkatan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Berakhir</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $dinas_mitra; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($item->id); ?></td>
                                <td><?php echo e($item->mitra->nama_mitra); ?></td>
                                <td><?php echo e($item->regency->name); ?></td>
                                <td><?php echo e($item->tanggal_mulai); ?></td>
                                <td><?php echo e($item->tanggal_selesai); ?></td>
                                <td><?php echo e($item->status); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo e(route('admin.perjalanandinas.show', $item->id)); ?>" class="btn btn-danger">
                                            <i class="btn1 fa fa-eye"></i>
                                        </a>
                                        <a href="<?php echo e(route('admin.perjalanandinas.edit', $item->id)); ?>" class="btn btn-danger">
                                            <i class="btn3 fa fa-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger">
                                            <i class="btn2 fa fa-print"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger">
                                            <i class="btn1 fa fa-check"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger">
                                            <i class="btn2 fa fa-times"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="text-center">
                                    <img src="<?php echo e(asset('img/1.png')); ?>" alt="none">
                                    <p>Tidak ada perjalanan dinas</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project\next_basis\resources\views/admin/perjalanandinas/index.blade.php ENDPATH**/ ?>