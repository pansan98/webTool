 <div id="register" class="animate login_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="User id" required="" />
              </div>
                <div>
                    <input type="password" class="form-control" placeholder="User Password" required="" />
                </div>
              <div>
                <input type="email" class="form-control" placeholder="User Name" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
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

         function setLoading() {
             let html = '<div class="ajax-loading"><p class="ajax-icon-loading-capture">処理中...<i class="fa fa-spinner fa-pulse"></i></p></div>';
             $('.login_wrapper').html(html);
         }

         function removeLoading() {
             $('ajax-loading').remove();
         }

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
 </script>