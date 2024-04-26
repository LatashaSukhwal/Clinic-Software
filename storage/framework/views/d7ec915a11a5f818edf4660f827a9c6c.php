<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if($message=Session::get('success')): ?>
    <span style="color:green"><?php echo e($message); ?></span>
    <?php endif; ?>
    <?php if($message=Session::get('danger')): ?>
    <span style="color:green"><?php echo e($danger); ?></span>
    <?php endif; ?>
    <?php if(auth()->check()): ?>
    <?php echo e(auth()->user()->name); ?></br>
    <form method="post" action="<?php echo e(url('signout')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit">Signout</button>
</form>
<?php endif; ?>
    <!-- <?php if(!empty($sucess)): ?>
    <span style="color:green"><?php echo e($sucess); ?></span>
    <?php endif; ?>
    <?php if(!empty($danger)): ?>
    <span style="color:red"><?php echo e($danger); ?></span>
    <?php endif; ?> -->
    <table>
            <thead>
                <tr>
                <th>
      4              name
                </th>
                <th>
                    email
                </th>
                <th>
                    mobile
                </th>
                <th>
                    address
                </th>
                <th>
                    action
                </th>
</tr>    
            </thead>
<tbody>
    <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td>
            <?php echo e($client->name); ?>

        </td>
        <td>
            <?php echo e($client->email); ?>

        </td>
        <td>
            <?php echo e($client->mobile); ?>

        </td>
        <td>
            <?php echo e($client->client_address ? 
            $client->client_address->address : ''); ?>

        </td>
        <td>
            <?php if(!empty($client->image)): ?>
            <img src="<?php echo e(asset('storage/images/'.$client->image)); ?>"
            alt="">
            <?php else: ?>   
                <span>N/A</span>
            <?php endif; ?>
            </td>
            <td>
            <a href="<?php echo e(url('/edit/client/' .$client->id)); ?>">Edit</a>
            <form method="post" action="<?php echo e(url('/delete/client/' .$client->id)); ?>">
               <?php echo csrf_field(); ?>
               <?php echo method_field('DELETE'); ?>
                <button type="submit"> Delete </button>
            </form>
        </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</body>
</html><?php /**PATH C:\xampp\htdocs\laravel\example-app\resources\views/client/index.blade.php ENDPATH**/ ?>