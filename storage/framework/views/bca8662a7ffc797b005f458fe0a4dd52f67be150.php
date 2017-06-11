<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Publish at Post</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url("/update")); ?>">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="post_id" value="<?php echo e($post->id); ?><?php echo e(old('post_id')); ?>">
                        <div class="form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="<?php if(!old('title')): ?><?php echo e($post->title); ?><?php endif; ?><?php echo e(old('title')); ?>" required autofocus>

                                <?php if($errors->has('title')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('title')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('body') ? ' has-error' : ''); ?>">
                            <label for="body" class="col-md-4 control-label">Body</label>

                            <div class="col-md-6">
                                <textarea id="body"  rows="5" class="form-control" name="body" required><?php if(!old('body')): ?><?php echo $post->body; ?><?php endif; ?><?php echo old('body'); ?></textarea>
                                <?php if($errors->has('body')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('body')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-1 col-md-offset-4">
                                <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
                            </div>

                            <div class="col-md-1 col-md-offset-3">
                                <a href="<?php echo e(url('delete/'.$post->id.'?_token='.csrf_token())); ?>" class="btn btn-danger">Delete</a>
                            </div>



                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>