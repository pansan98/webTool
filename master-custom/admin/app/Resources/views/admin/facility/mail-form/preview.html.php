
<section class="content">
<div>
	<h2><?php echo e($detail->title); ?></h2>

	<?php foreach($blocks as $group): ?>
		<?php foreach($group as $blockType => $values): ?>
		<div class="form-group">
			<div>
				<label>
					<?php echo e($values['label']); ?>
					<?php if(isset($values['is_required'] ) && $values['is_required'] == 1): ?>
						<span class="text-danger">※必須</span>
					<?php endif;?>
				</label>
			</div>
			<?php
			if($blockType === 'text'):
			?>
				<div>
					<input class="form-control" type="text" name="<?php echo $view->escape($values['name']); ?>" value="">
				</div>
				<?php if('' != $values['help_text']): ?>
				<div class="help-block"><?php echo nl2br(e($values['help_text'])); ?></div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if($blockType === 'textarea'):?>
				<div>
					<textarea class="form-control" name="<?php echo $view->escape($values['name']); ?>"></textarea>
				</div>
				<?php if('' != $values['help_text']): ?>
					<div class="help-block"><?php echo nl2br(e($values['help_text'])); ?></div>
				<?php endif; ?>
			<?php endif; ?>

            <?php
            if($blockType === 'radio'):
                $choices = isset($values['choices']) ? preg_split('/\R/', $values['choices'], -1, \PREG_SPLIT_NO_EMPTY) : [];
            ?>
                <div>
                    <?php foreach($choices as $choice): ?>
                    <label>
                        <input type="radio" name="<?php echo $view->escape($values['name']); ?>" value="<?php echo $view->escape($choice) ?>">
                        <?php echo $view->escape($choice); ?>
                    </label>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

			<?php
			if($blockType === 'checkbox'):
				$choices = isset($values['choices']) ? preg_split('/\R/', $values['choices'], -1, \PREG_SPLIT_NO_EMPTY) : [];
				?>
                <div>
					<?php foreach($choices as $choice): ?>
                        <label>
                            <input type="checkbox" name="<?php echo $view->escape($values['name']); ?>[]" value="<?php echo $view->escape($choice) ?>">
							<?php echo $view->escape($choice); ?>
                        </label>
					<?php endforeach; ?>
                </div>
			<?php endif; ?>
		</div>
		<?php endforeach; ?>
	<?php endforeach; ?>
</div>
</section>