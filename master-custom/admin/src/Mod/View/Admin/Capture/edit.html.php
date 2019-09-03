<div class="x_content">


    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <th>
                    <input type="text" class="capture-form" name="capture" style="width: 100%; color: #2A3F54;" placeholder="input capture URL">
                </th>
                <input type="hidden" name="user_id" value="<?php echo $userController->getUser('user_id'); ?>">
            </tr>
            </thead>
        </table>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search" style="float: none !important;">
                <?php if(isset($form['error'])): ?>
                    <p><?php echo $form['error']['capture_url']; ?></p>
                <?php endif; ?>
                <div class="input-group">
                    <span class="input-group-btn" style="display: inline-block;">
                      <button onclick="setSendCapture(); return true;" class="btn btn-default" type="button">Push</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function setSendCapture() {
        const sendUrl = '<?php echo WEB_TOOL__MASTER_CUSTOM__ROOT_PATH; ?>admin/app/ajax/Capture/ajax.php';

        var value = $('.capture-form').val();
        var user_id = $('input[name="user_id"]').val();

        var loadingStyle = {
            'capture-elem': {
                'position': 'absolute',
                'top': '0',
                'left': '0',
                'z-index': '99999',
                'width': window.innerWidth+'px',
                'height': window.innerHeight+'px',
                'background': '#000',
                'opacity': '0.7'
            },
            'icon-loading-capture': {
                'position': 'relative',
                'top': '50%',
                'left': '50%',
                'z-index': '999999',
            }
        };

        setLoading();
        setStyle();
        sendCapture(value, user_id);

        function sendCapture(url, user_id) {
            $.ajax({
                "url":sendUrl,
                "type":"post",
                "data":{"capture_url":url, "user_id":user_id}
            }).done(function(response){
				removeLoading();
            	if(response === "SUCCESS") {
            		redirectBack();
				}
                $('.ajax-contents-edit').html(response);
            }).fail(function(xhr, errorThrow, textStatus){
                removeLoading();
                console.log(errorThrow);
                console.log(textStatus);
            });
        }

        function setLoading() {
            let html = '<div class="ajax-capture-elem"><p class="ajax-icon-loading-capture">処理中...<i class="fa fa-spinner fa-pulse"></i></p></div>';
            //let html = '<div class="ajax-capture-elem"><p class="ajax-icon-loading-capture">処理中...<img src="../../../docs/images/ajax-loader.gif"></p></div>';
            $('body').append(html);
        }

        function removeLoading(){
            $('.ajax-capture-elem').remove();
        }

        function setStyle() {
            for(var parentKey in loadingStyle) {
                for(var childKey in loadingStyle[parentKey]) {
                    setAddStyle(parentKey, childKey, loadingStyle[parentKey][childKey]);
                }
            }
        }

        function setAddStyle(elem, key, value) {
            $('.ajax-'+elem).css(key, value);
        }
    }
</script>