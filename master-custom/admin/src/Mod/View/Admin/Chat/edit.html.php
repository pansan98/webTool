<div class="x_content">


    <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                <tr class="headings">
                    <th>
                        <input type="text" class="capture-form" name="capture" style="width: 100%; color: #2A3F54;" placeholder="input capture URL">
                    </th>
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

        var value = $('.capture-form').val();

        var loadingStyle = {
            'capture-elem': {
                'position': 'absolute',
                'top': '0',
                'left': '0',
                'z-index': '99999',
                'width': '100%',
                'height': '100%',
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
        sendCapture(value);

        function sendCapture(url) {
            $.ajax({
                "url":"../../../app/ajax/Capture/ajax.php",
                "type":"post",
                "data":{"capture_url":url}
            }).done(function(response){
                removeLoading();
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