<?php $__env->startSection('content'); ?>
    <div>
        <h2 ><?php echo e($data['user']->name); ?></h2>
    </div>
    <div>
        <ul class="list-group">
            <li class="list-group-item">
                Joined on <?php echo e($data['user']->created_at->format('M d,Y \a\t h:i a')); ?>

            </li>
            <li class="list-group-item panel-body">
                <table class="table-padding">
                    <style>
                        .table-padding td{
                            padding: 3px 8px;
                        }
                    </style>
                    <tr>
                        <td>Total Posts</td>
                        <td> <?php echo e($data['posts_count']); ?></td>
                        <?php if($data['author'] && $data['posts_count']): ?>
                            <td><a href="<?php echo e(url('/my-all-posts')); ?>">Show All</a></td>
                        <?php endif; ?>
                    </tr>


                </table>
            </li>
            <li class="list-group-item">
                Total Comments <?php echo e($data['comments_count']); ?>

            </li>
        </ul>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h3>Latest Posts</h3></div>
        <div class="panel-body">
            <?php if(!empty($data['latest_posts'])): ?>
                <?php $__currentLoopData = $data['latest_posts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latest_post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p>
                        <strong><a href="<?php echo e(url('/'.$latest_post->slug)); ?>"><?php echo e($latest_post->title); ?></a></strong>
                        <span class="well-sm">On <?php echo e($latest_post->created_at->format('M d,Y \a\t h:i a')); ?></span>
                    </p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <p>You have not written any post till now.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h3>Latest Comments</h3></div>
        <div class="list-group">
            <?php if(!empty($data['latest_comments'])): ?>
                <?php $__currentLoopData = $data['latest_comments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latest_comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="list-group-item">
                        <p><?php echo e(mb_substr($latest_comment->body,0,180)); ?></p>
                        <p>On <?php echo e($latest_comment->created_at->format('M d,Y \a\t h:i a')); ?></p>
                        <p>On post <a href="<?php echo e(url('/'.$latest_comment->post->slug)); ?>"><?php echo e($latest_comment->post->title); ?></a></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="list-group-item">
                    <p>You have not commented till now. Your latest 5 comments will be displayed here</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>