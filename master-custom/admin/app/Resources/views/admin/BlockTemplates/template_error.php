<?php
if ($template->hasErrorMessages()):
    ?>
    <ul class="error-messages">
	    <?php foreach($template->getErrorMessages() as $error): ?>
        <li>
            <strong style="color:red;">※<?php echo $view->escape($error) ?></strong>
        </li>
	    <?php endforeach; ?>
    </ul>
<?php endif; ?>	