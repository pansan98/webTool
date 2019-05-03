<?php foreach($view['session']->getFlash('info') as $message): ?>
	<div class="alert alert-info" role="alert""><?php echo e($message); ?></div>
<?php endforeach; ?>

<?php foreach($view['session']->getFlash('success') as $message): ?>
	<div class="alert alert-success" role="alert""><?php echo e($message); ?></div>
<?php endforeach; ?>

<?php foreach($view['session']->getFlash('error') as $message): ?>
	<div class="alert alert-danger" role="alert""><?php echo e($message); ?></div>
<?php endforeach; ?>