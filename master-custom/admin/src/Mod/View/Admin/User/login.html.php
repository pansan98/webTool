 <div class="animate form login_form">
     <?php if(isset($form['error'])):?>
         <p>入力にエラーがあります。</p>
     <?php endif; ?>
          <section class="login_content">
            <form name="login_form">
              <h1>Login Form</h1>
              <div>
                  <?php if(isset($form['error']['user_id'])): ?>
                      <p><?php echo $form['error']['user_id']; ?></p>
                  <?php endif;?>
                <input type="text" name="user_id" class="form-control" placeholder="User id" required="" value="<?php echo isset($form['user_id'])?$form['user_id']:'' ; ?>"/>
              </div>
              <div>
                  <?php if(isset($form['error']['user_password'])): ?>
                      <p><?php echo $form['error']['user_password']; ?></p>
                  <?php endif;?>
                <input type="password" name="user_password" class="form-control" placeholder="User Password" required="" value="<?php echo isset($form['user_password'])?$form['user_password']:'' ; ?>"/>
              </div>
              <div>
                <a class="btn btn-default submit" href="javascript:void(0);" onclick="sendForm('login');">Log in</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="javascript:void(0);" class="to_register" onclick="changeDisplay('create');"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <p>©<?php echo date('Y'); ?> All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>

 <script type="text/javascript">
     const ajaxFormUrl = "app/ajax/User/ajax-form.php";
     const ajaxDisplayUrl = "app/ajax/User/ajax-display.php";

     function changeDisplay(display) {
         setLoading();
         sendChangeDisplay(display);

         function sendChangeDisplay(display) {
             $.ajax({
                 "url":ajaxDisplayUrl,
                 "type":"post",
                 "data":{"display":display}
             }).done(function(response) {
                 removeLoading();
                 $('.login_wrapper').html(response);
             }).fail(function(xhr, errorThrow, textStatus) {
                 alert(errorThrow);
                 alert(textStatus);
                 removeLoading();
             });
         }
     }

     function sendForm(display) {
         let userId = document.login_form.user_id.value;
         let userPass = document.login_form.user_password.value;

         setLoading();

         $.ajax({
             "url":ajaxFormUrl,
             "type":"post",
             "data":{"user_id":userId, "user_password":userPass, "user_form_status":true, "display":display}
         }).done(function(response) {
             removeLoading();
             if(response == true) {
                 window.location.href = './production/';
             }
             $('.login_wrapper').html(response);
         }).fail(function(xhr, errorThrow, textStatus) {
             alert(errorThrow);
             alert(textStatus);
             removeLoading();
         });
     }

     function setLoading() {
         let html = '<div class="ajax-loading"><p class="ajax-icon-loading-capture">処理中...<i class="fa fa-spinner fa-pulse"></i></p></div>';
         $('.login_wrapper').html(html);
     }

     function removeLoading() {
         $('ajax-loading').remove();
     }
 </script>