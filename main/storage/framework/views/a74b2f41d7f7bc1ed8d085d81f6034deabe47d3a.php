<?php $__env->startSection('content'); ?>
<div class="row d-flex justify-content-center">
    <div class="row row d-flex justify-content-center content ">
        <img src="/img/brr.png" alt="" style="
            width: 18rem;
            height: 13rem;
            border-radius: 50%;
            background-size: cover; 
            background-position: center center; 
            margin: 0 auto .9rem; ">
    </div>

    <div class=" w-100"></div>

    <div class=" text-center ">
        <h1 class="title text-uppercase"><?php echo e($titulo); ?></h1>
    </div>

    <div class="w-100"></div>
    <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <?php switch($key+1):
    case (1): ?>
    <div class="dropdown m-0">
        <ul class="menu bg-dark">
            <li class="text-center">
                <a class="uno" href="<?php echo e(route('categorias.index',$categoria->slug)); ?>">
                    <i class=" i my-2 fa fa-cogs" aria-hidden="true"></i>
                    <?php echo e($categoria->nombre); ?>

                </a>
                <ul class="menu">
                    <?php $__currentLoopData = $categoria->procesos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proceso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="text-center">
                        <a href="<?php echo e(route('proceso.index',[$categoria->slug, $proceso->slug])); ?>">Proceso:
                            <?php echo e($proceso->nombre); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
        </ul>
    </div>
    <?php break; ?>

    <?php case (2): ?>
    <div class="dropdown m-0">
        <ul class="menu rojo">
            <li class="text-center">
                <a class="uno" href="<?php echo e(route('categorias.index',$categoria->slug)); ?>">
                    <i class=" i fa fa-sign-language m-2" aria-hidden="true"></i>
                    <?php echo e($categoria->nombre); ?>

                </a>
                <ul class="menu">
                    <?php $__currentLoopData = $categoria->procesos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proceso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="text-center">
                        <a href="<?php echo e(route('proceso.index',[$categoria->slug, $proceso->slug])); ?>">Proceso:
                            <?php echo e($proceso->nombre); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
        </ul>
    </div>
    <?php break; ?>

    <?php case (3): ?>
    <div class="dropdown m-0">
        <ul class="menu verde">
            <li class="text-center">
                <a class="uno" href="<?php echo e(route('categorias.index',$categoria->slug)); ?>">
                    <i class=" i my-2 fa fa-balance-scale" aria-hidden="true"></i>
                    <?php echo e($categoria->nombre); ?>

                </a>
                <ul class="menu">
                    <?php $__currentLoopData = $categoria->procesos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proceso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="text-center">
                        <a href="<?php echo e(route('proceso.index',[$categoria->slug, $proceso->slug])); ?>">Proceso:
                            <?php echo e($proceso->nombre); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
        </ul>
    </div>
    <?php break; ?>

    <?php case (4): ?>
    <div class="dropdown m-0">
        <ul class="menu azul">
            <li class="text-center">
                <a class="uno" href="<?php echo e(route('categorias.index',$categoria->slug)); ?>">
                    <i class=" i fa fa-check my-2" aria-hidden="true"></i>
                    <?php echo e($categoria->nombre); ?>

                </a>
                <ul class="menu">
                    <?php $__currentLoopData = $categoria->procesos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proceso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="text-center">
                        <a href="<?php echo e(route('proceso.index',[$categoria->slug, $proceso->slug])); ?>">Proceso:
                            <?php echo e($proceso->nombre); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
        </ul>
    </div>
    <?php break; ?>
    <?php case (5): ?>
    <div class="dropdown m-0">
        <ul class="menu salmon">
            <li class="text-center">
                <a class="uno" href="<?php echo e(route('categorias.index',$categoria->slug)); ?>">
                    <i class=" i fa fa-check my-2" aria-hidden="true"></i>
                    <?php echo e($categoria->nombre); ?>

                </a>
                <ul class="menu">
                    <?php $__currentLoopData = $categoria->procesos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proceso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="text-center">
                        <a href="<?php echo e(route('proceso.index',[$categoria->slug, $proceso->slug])); ?>">Proceso:
                            <?php echo e($proceso->nombre); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
        </ul>
    </div>
    <?php break; ?>
    <?php case (6): ?>
    <div class="dropdown m-0">
        <ul class="menu orange">
            <li class="text-center">
                <a class="uno" href="<?php echo e(route('categorias.index',$categoria->slug)); ?>">
                    <i class=" i fa fa-check my-2" aria-hidden="true"></i>
                    <?php echo e($categoria->nombre); ?>

                </a>
                <ul class="menu">
                    <?php $__currentLoopData = $categoria->procesos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proceso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="text-center">
                        <a href="<?php echo e(route('proceso.index',[$categoria->slug, $proceso->slug])); ?>">Proceso:
                            <?php echo e($proceso->nombre); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
        </ul>
    </div>
    <?php break; ?>

    <?php default: ?>
    <div class="dropdown m-0">
        <ul class="menu cyan">
            <li class="text-center">
                <a class="uno" href="<?php echo e(route('categorias.index',$categoria->slug)); ?>">
                    <i class=" i my-2 fa fa-book my-1"></i>
                    <?php echo e($categoria->nombre); ?>

                </a>
                <ul class="menu">
                    <?php $__currentLoopData = $categoria->procesos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proceso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="text-center">
                        <a href="<?php echo e(route('proceso.index',[$categoria->slug, $proceso->slug])); ?>">Proceso:
                            <?php echo e($proceso->nombre); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
        </ul>
    </div>
    <?php break; ?>

    <?php endswitch; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="row w-100">
        <div class="col-md-12">
            <?php if(auth()->guard()->check()): ?>
            <?php if(Auth::user()->hasRole('admin')): ?>
            <div class="text-center m-3">

                <a href class="btn btn-primary btn-rounded mb-3" data-toggle="modal"
                    data-target="#modalArchivoCreateFormNormagrama">
                    Normograma secretaria general
                </a>

                <a href class="btn btn-primary btn-rounded mb-3" data-toggle="modal"
                    data-target="#modalArchivoCreateFormGuia">
                    Guia interactiva secretaria general
                </a>

            </div>
            <?php endif; ?>
            <?php endif; ?>
            <?php echo $__env->make('otros.guia_interactiva', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('otros.normograma', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <div class="w-100"></div>

    <div class="row mt-3">
        <div class="md-12 ">
            <?php if(isset($files)): ?>
            <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="d-flex justify-content-center">
                <a href="<?php echo e(url('/downloadotros/'.$item->file_path)); ?>" class="btn btn-success btn-rounded btn-sm m-2 ">
                    <i class="fa fa-file-excel" aria-hidden="true"></i>
                    <?php echo e($item->nombre); ?></a>
                <?php if(auth()->guard()->check()): ?>
                <?php if(Auth::user()->hasRole('admin')): ?>
                <a href="<?php echo e(route('otros.delete', $item->id)); ?>" class="btn btn-danger btn-rounded btn-sm m-2 ">X</a>
                <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mapa\main\resources\views//home.blade.php ENDPATH**/ ?>