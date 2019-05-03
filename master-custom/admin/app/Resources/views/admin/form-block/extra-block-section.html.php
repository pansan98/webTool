<div>
	<select>
		<?php foreach($manager->getExtraBlocks() as $block): ?>
			<option value="<?php $view->escape($block->getId()); ?>"><?php echo $view->escape($block->getDisplayName()); ?></option>
		<?php endforeach; ?>
	</select>

	<button type="button">Add</button>
</div>