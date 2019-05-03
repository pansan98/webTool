<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>

<section id="block-section">
<?php echo $manager->renderBlockSection(); ?>
</section>

<section id="extra-block-section"></section>

<div>
    <form>
        <select name="extra_block_type">
			<?php foreach($manager->getExtraBlocks() as $id => $block): ?>
                <option value="<?php echo $view->escape($block->getType()); ?>"><?php echo $view->escape($block->getDisplayName()); ?></option>
			<?php endforeach; ?>
        </select>

        <button type="button" class="btn-add-extra-block">Add</button>
    </form>
</div>

<script>
$(function(){
    $('.btn-add-extra-block').on('click', function(){
        var blockType = $('select[name="extra_block_type"]').val();
        var endpoint = '<?php echo $view->escape($view['router']->path('api_form_block_new')); ?>';
        var data = {
            block_type: blockType
        };
        $.ajax(endpoint, {
            type: 'get',
            data: data
        }).done(function(data){
            $('#extra-block-section').append(data.html);
            console.log(data);
        }).fail(function(error){
            console.log(error);
        });
    });
});
</script>
</body>
</html>