<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <?php if(auth()->guard()->check()): ?>

            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class=" font-italic navbar-brand" title="ir a Inicio" href="<?php echo e(url('/home')); ?>">
                        <i class="fa fa-home "></i>
                        Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class=" font-italic nav-link" title="videos institucionales" href="<?php echo e(route('video.index')); ?>">
                        <i class="fa fa-play text-dark" aria-hidden="true"></i>
                        Videografia
                    </a>
                </li>
                <li class="nav-item">
                    <a class=" font-italic nav-link" title="Configuracion" href="<?php echo e(route('administrativo.index')); ?>">
                        <i class="fa fa-wrench text-dark" aria-hidden="true"></i>
                        Administración
                    </a>
                </li>
            </ul>
        <?php endif; ?>
            <!-- Right Side Of Navbar
                            -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <?php if(auth()->guard()->guest()): ?>

                

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                </li>

                <?php if(Route::has('register')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                </li>
                <?php endif; ?>
                <?php else: ?>


                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle font-italic " href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fa fa-user-circle text-dark" aria-hidden="true"></i>
                        <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            <?php echo e(__('Logout')); ?>

                        </a>

                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav><?php /**PATH C:\laragon\www\mapa\main\resources\views/layouts/nav-principal.blade.php ENDPATH**/ ?>