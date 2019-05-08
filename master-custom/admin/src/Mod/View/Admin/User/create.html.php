 <div id="register" class="animate login_form">
     <?php if(isset($formError['error'])):?>
        <p>入力にエラーがあります。</p>
     <?php endif; ?>
          <section class="login_content">
            <form name="create_form">
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" name="user_id" placeholder="User id" required="" value="<?php echo isset($formError['user_id'])?$formError['user_id']:'' ; ?>" />
                  <?php if(isset($formError['error']['user_id'])): ?>
                  <p><?php echo $formError['error']['user_id']; ?></p>
                  <?php endif;?>
              </div>
                <div>
                    <input type="text" name="user_password" class="form-control" placeholder="User Password" required="" value="<?php echo isset($formError['user_password'])?$formError['user_password']:'' ; ?>" />
                    <?php if(isset($formError['error']['user_password'])): ?>
                        <p><?php echo $formError['error']['user_password']; ?></p>
                    <?php endif;?>
                </div>
              <div>
                <input type="email" name="user_name" class="form-control" placeholder="User Name" required="" value="<?php echo isset($formError['user_name'])?$formError['user_name']:'' ; ?>" />
                  <?php if(isset($formError['error']['user_name'])): ?>
                      <p><?php echo $formError['error']['user_name']; ?></p>
                  <?php endif;?>
              </div>
              <div>
                <a class="btn btn-default submit" href="javascript:void(0);" onclick="sendForm('create');">Create</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="javascript:void(0);" class="to_register" onclick="changeDisplay('login')"> Log in </a>
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
      </div>

 <script type="text/javascript">
     function changeDisplay(display) {
         setLoading();
         sendChangeDisplay(display);

         function sendChangeDisplay(display) {
             $.ajax({
                 "url":"app/ajax/User/ajax-display.php",
                 "type":"post",
                 "data":{"display":display}
             }).done(function(response) {
                 removeLoading();
                 $('.login_wrapper').html(response);
             }).fail(function(xhr, errorThrow, textStatus) {
                 removeLoading();
             });
         }
     }

     function sendForm(display) {
         var userId = document.create_form.user_id.value;
         var userPass = document.create_form.user_password.value;
         var userName = document.create_form.user_name.value;

         setLoading();

         $.ajax({
             "url":"app/ajax/User/ajax-form.php",
             "type":"post",
             "data":{"user_id":userId, "user_password":userPass, "user_name":userName, "user_form_status":true, "display":display}
         }).done(function(response) {
             removeLoading();
             $('.login_wrapper').html(response);
         }).fail(function(xhr, errorThrow, textStatus) {
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