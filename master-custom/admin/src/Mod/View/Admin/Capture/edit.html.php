<div class="x_content">


    <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                <tr class="headings">
                    <th>
                        <input type="text" class="capture-form" name="capture">
                    </th>
                </tr>
                </thead>
            </table>
    </div>
</div>

<script type="text/javascript">
    function setSendCapture() {
        var value = $('.capture-form').val();
        if(value == "") {
            alert('URLを入力してください。');
            return false;
        }

        sendCapture(value);

        function sendCapture(url) {
            $.ajax({
                "url":"../app/ajax/Capture/ajax.php",
                "type":"post",
                "data":{"capture_url":url}
            }).done(function(response){
                alert('キャプチャーに成功しました。');
            }).fail(function(xhr, errorThrow, textStatus){
                console.log(errorThrow);
                console.log(textStatus);
            });
        }
    }
</script>