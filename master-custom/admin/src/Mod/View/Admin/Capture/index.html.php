<?php
$webToolItems = $actionController->getData();
?>

<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <!--<th>-->
                <!--<input type="checkbox" id="check-all" class="flat">-->
                <!--</th>-->
                <th class="column-title">Screen Shot </th>
                <th class="column-title">Copy Url </th>
                <th class="column-title">Created Date</th>
                <th class="column-title">Edit</th>
                <th class="column-title">Delete</th>
            </tr>
            </thead>

            <tbody>
            <?php
                if(isset($webToolItems)):
            ?>
            <?php
                foreach($webToolItems as $item):
            ?>
                <tr class="even pointer point">
<!--                        <td class="a-center ">-->
<!--                            <input type="checkbox" class="flat" name="table_records">-->
<!--                        </td>-->
                    <td class="center" style="width: 20%;"><img src="<?php echo WEB_TOOL__PATH.$item->getCaptureUrl(); ?>" style="width: 100%; height: 150px; object-fit: cover;"></td>
                    <td class=" "><?php echo $item->getCaptureCopy(); ?></td>
                    <td class=" "><?php echo $item->getCaptureCreated(); ?></td>
                    <td class=" ">見る</td>
                    <td class=" "><button onclick="delete(<?php echo $item->getId();?>);" class="btn btn-default" type="button" style="float: right;">削除</button></td>
                </tr>
            <?php
                endforeach;
            ?>
            <?php
                else:
            ?>
                <p>データなし</p>
            <?php
                endif;
            ?>
            </tbody>
        </table>
    </div>
</div>
<style>
    .point td {
        vertical-align: middle !important;
    }
</style>
