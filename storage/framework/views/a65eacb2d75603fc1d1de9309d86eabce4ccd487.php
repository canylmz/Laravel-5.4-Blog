<?php $__env->startSection('content'); ?>

    <h1 class="page-header">
        <?php if(isset($title)): ?> <?php echo $title; ?> <?php else: ?> Posts <?php endif; ?>

    </h1>


    <!-- Blog Post -->
    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <h2>
            <a href="<?php echo e(url('/'.$post->slug)); ?>"><?php echo e($post->title); ?></a>
        </h2>
        <!-- Author -->
        <p class="lead">
            <a href="<?php echo e(url('user/'.$post->users->id.'/posts')); ?>"><?php echo e($post->users->name); ?></a> on
            <?php echo e($post->created_at->toFormattedDateString()); ?><span class="btn-xs glyphicon glyphicon-time"></span>
        </p>
        <p><?php echo e(mb_substr($post->body,0,180)); ?></p>
        <a class="btn btn-primary" href="<?php echo e(url('/'.$post->slug)); ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <!-- Pager -->
        <ul class="pager">
            <li class="previous">
                <a href="<?php echo e($posts->previousPageUrl()); ?>">&larr; Older</a>
            </li>

            <li >
                <?php echo e($posts->render()); ?>

            </li>

            <li class="next">
                <a href="<?php echo e($posts->nextPageUrl()); ?>">Newer &rarr;</a>
            </li>
        </ul>


<?php $__env->stopSection(); ?>






<?php echo $__env->make('layouts.app2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>