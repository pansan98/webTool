<?php if ($template->isHeader()): ?>
	<div class="box-body pad header">
		<?php if ($template->isHeaderTitle()): ?>
			<h4><?php echo $template->getHeaderTitle(); ?></h4>
		<?php endif; ?>
		<?php if ($template->isHeaderComment()): ?>
			<p><?php echo $template->getHeaderComment(); ?></p>
		<?php endif; ?>
	</div>
<?php endif;