

<?php $__env->startSection('content'); ?>
<div class="main">
    <div class="main-top">
        <h1>User</h1>
    </div>
    <div class="view">
        <div class="search">
            <i class="fa fa-search"></i>
            <input type="text" name="" class="input1" placeholder="Search">
        </div>
        <div class="plus">
            <i class="fa fa-plus"></i>
            <a href="<?php echo e(route('admin.user.create')); ?>">Tambah User</a>
        </div>
    </div>
    <div class="filter">
        <ul class="filterx">
            <li class="<?php echo e(request()->input('filter') === null ? 'activev' : ''); ?>">
                <a href="<?php echo e(route('admin.user.index')); ?>">Semua</a>
            </li>
        </ul>
        <ul class="filterx">
            <li class="<?php echo e(request()->input('filter') === 'Aktif' ? 'activev' : ''); ?>">
                <a href="<?php echo e(route('admin.user.index', ['filter' => 'Aktif'])); ?>">Aktif</a>
            </li>
        </ul>
        <ul class="filterx">
            <li class="<?php echo e(request()->input('filter') === 'Tidak Aktif' ? 'activev' : ''); ?>">
                <a href="<?php echo e(route('admin.user.index', ['filter' => 'Tidak Aktif'])); ?>">Tidak Aktif</a>
            </li>
        </ul>
    </div>

    <div class="line2">
    </div>
    <div class="cong-box">
        <div>
            <table class="box" cellspacing="0">
                <thead>
                    <tr>
                        <th class="lebarTabel">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Profile Img</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index + 1); ?></td>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->status); ?></td>
                        <td>
                            <!-- Display the user's profile image -->
                            <?php if($user->foto_profil): ?>
                            <img src="<?php echo e(asset($user->foto_profil)); ?>" alt="Profile Image" style="width: 32px; height: 32px;">
                            <?php else: ?>
                            No Image
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.user.edit', ['id' => $user->id])); ?>" class="btn btn-danger">
                                <i class="btn3 fa fa-pencil"></i>
                            </a>
                        </td>
                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($users->isEmpty() && $filter === 'Aktif'): ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            <img src="<?php echo e(asset('img/1.png')); ?>" alt="none">
                            <p>Tidak ada user yang active</p>
                        </td>
                    </tr>
                    <?php elseif($users->isEmpty() && $filter === 'Tidak Aktif'): ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            <img src="<?php echo e(asset('img/1.png')); ?>" alt="none">
                            <p>Tidak ada user</p>
                        </td>
                    </tr>
                    <?php else: ?>
                    
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project\next_basis\resources\views/admin/user/index.blade.php ENDPATH**/ ?>