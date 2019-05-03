<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
	<div class="modal-dialog" role="document">
		<?php echo $view['form']->start($delete_form) ?>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="deleteModalLabel">削除の確認</h4>
			</div>
			<div class="modal-body">
				項目を削除します。よろしいですか？

				<?php echo $view['form']->widget($delete_form) ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
				<button type="submit" class="btn btn-danger">削除</button>
			</div>
		</div>
		<?php echo $view['form']->end($delete_form) ?>
	</div>
</div>