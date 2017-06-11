<?php $__env->startSection('content'); ?>


        <!-- Blog Post Content Column -->

        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <!-- Blog Post -->

            <!-- Title -->
            <h1 ><?php echo e($post->title); ?></h1>
            <?php if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->isAdmin())): ?>
                <button class="btn" style="float: right"><a href="<?php echo e(url('edit/'.$post->slug)); ?>">Edit Post</a></button>
                <?php endif; ?>
            <!-- Author -->
                <p class="lead">
                     <a href="<?php echo e(url('user/'.$post->users->id.'/posts')); ?>"><?php echo e($post->users->name); ?></a> on
                    <?php echo e($post->created_at->toFormattedDateString()); ?><span class="btn-xs glyphicon glyphicon-time"></span>
                </p>
            <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo e($post->body); ?></p>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
        <form role="form" method="POST" action="<?php echo e(url('/posts/'.$post->id.'/comments')); ?>">
            <?php echo e(csrf_field()); ?>

            <div class="form-group<?php echo e($errors->has('body') ? ' has-error' : ''); ?>">

                    <textarea id="body" rows="3" class="form-control" name="body" required autofocus placeholder="Comment here."><?php echo e(old('body')); ?></textarea>

                    <?php if($errors->has('body')): ?>
                        <span class="help-block">
                                        <strong><?php echo e($errors->first('body')); ?></strong>
                                    </span>
                    <?php endif; ?>

            </div>
            <div class="form-group">

            <button type="submit" class="btn btn-primary">Submit</button>

            </div>
        </form>
    </div>

    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->
        <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="media">
                <a class="pull-left" href="<?php echo e(url('user/'.$comment->users->id.'/posts')); ?>">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo e($comment->users->name); ?>

                        <small><?php echo e($comment->created_at->diffForHumans()); ?></small>
                    </h4>
                <?php echo e($comment->body); ?>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    <?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>