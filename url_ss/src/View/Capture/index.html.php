<body>
<input class="captureUrl" type="text" name="url" placeholder="https://exsample.com">

<p onclick="setSendCapture(); return false;">キャプる</p>
</body>

<script type="text/javascript">

    function setSendCapture() {
        var url = document.getElementsByClassName('captureUrl').values();

        sendCapture(url);
    }

    function sendCapture(url) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'ajax/Capture/ajax.php');
        xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded;charset=UTF-8');
        xhr.send('url='+url);

        xhr.onreadystatechange = function() {
            if(xhr.readyState === 4) {
                alert(url+'のキャプチャーに成功しました。');
            }
        }
    }
</script>