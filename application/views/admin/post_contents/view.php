<style>
   .icon1 {
      
   padding: 1px;
   border:2px solid white;
   border-radius: 50%;
    -webkit-border-radius: 500px;
    -moz-border-radius: 500px;
}
</style>
<?php init_head(); ?>

<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div id="newsfeed_data">
               <div class="col-md-6">
                  <div class="panel_s newsfeed_post" data-main-postid="1">
                     <div class="panel-body post-content">
                        <div class="media">
                           <div class="media-left">
                              <a href="https://dev.characontent.com/admin/profile/15">
                                 <img src="https://dev.characontent.com/assets/images/user-placeholder.jpg" class="staff-profile-image-small no-radius" alt="DEV BA" style="width:80px; height:80px"></a>
                           </div>
                           <div class="media-body">
                              <p class="media-heading no-mbot">
                                 <a href="https://dev.characontent.com/admin/profile/15" style="font-size:30px;">DEV BA</a>
                              </p><small class="post-time-ago" style="font-size:15px;">7 days ago</small>
                              <div class="dropdown pull-right btn-post-options-wrapper">
                              </div><small class="text-muted"  style="font-size:15px;">Published: 2019-04-25 21:28:48</small>
                           </div>
                        </div>
                        <div class="post-content mtop20 display-block" style="font-size:18px;">
                           asdasdasd
                           <div class="clearfix mbot10">

                           </div>
                        </div>
                     </div>
                     <div class="post_likes_wrapper" data-likes-postid="1">
                        <div class="panel-footer user-post-like">
                        <div class="row">
                          <div class="col-md-6" style="vertical-align: middle;">
                           <img data-toggle="tooltip" data-placement="top" data-original-title="Like" class="icon1" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/like.jpg' ?>" style="height:38px;width:38px; background-color:white"  />
                           <img data-toggle="tooltip" data-placement="top" data-original-title="Love" class="icon1" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/love.jpg' ?>" style="height:40px;width:40px; position:relative; left:-10px; background-color:white"  />
                           <img data-toggle="tooltip" data-placement="top" data-original-title="Haha" class="icon1" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/wow.jpg' ?>" style="height:37px;width:37px; position:relative; left:-20px; background-color:white"  />
                           <span style="position: relative; left:-20px; font-size:15px; vertical-align: middle;">123</span>
                          </div>
                          <div class="col-md-6" style="margin-top:10px; font-size:15px;">
                           <span>123 Comments</span> &nbsp &nbsp <span> 2323 Shares</span>
                          </div>
                        </div>
                        </div>
                        <div class="panel-footer post-likes">You like this</div>
                     </div>
                     <div class="post_comments_wrapper" data-comments-postid="1">

                     </div>
                     <div class="panel-footer user-comment">
                        <div class="pull-left comment-image">
                           <a href="https://dev.characontent.com/admin/profile/15">
                              <img src="https://dev.characontent.com/assets/images/user-placeholder.jpg" class="staff-profile-image-small no-radius" alt="DEV BA">
                           </a></div>
                        <div class="media-body comment-input">
                           <input type="text" class="form-control input-sm" placeholder="Comment this post.." data-postid="1">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  adasdasdasd
               </div>

            </div>
         </div>
      </div>
   </div>
</div>
<?php init_tail(); ?>
<script type="text/javascript">
   var data = {};
   data.id = "<?php echo $id_content; ?>";
   data.id_page = "<?php echo $fanpage_id; ?>";
   data.description = "<?php echo $content->description; ?>";
   data.urlPhoto = "<?php echo $file_name_str ?>";
   $("#post_content").click(function() {
      $.post(admin_url + 'post_contents/post_content', data).done(function(response) {
         response = JSON.parse(response);
         if (response.success == true) {
            alert_float('success', response.message);
         } else {
            alert_float('danger', response.message);
         }
      });
   });
</script>

</body>

</html>
