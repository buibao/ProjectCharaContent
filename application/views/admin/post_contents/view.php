<?php init_head(); ?>
<link href='<?php echo base_url('assets/plugins/editor/vendor/emoji-picker/lib/css/emoji.css'); ?>' rel='stylesheet' />
<link href='<?php echo base_url('assets/plugins/editor/style2.css'); ?>' rel="stylesheet">

<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- breadcrumb -->
                <div class="panel_s project-top-panel panel-full">
                    <div class="panel-body _buttons">

                        <div class="row">
                            <div class="col-md-7 project-heading">
                                <div id="project_view_name" class="pull-left">

                                    <div class="dropdown bootstrap-select fit-width">
                                        <h4><?php echo $content->subject; ?></h4>
                                    </div>

                                </div>
                                <?php $status = get_content_status_by_id($content->status); ?>
                                <div class="label pull-left mleft15 mtop5 p8 project-status-label-2" style="background:#03a9f4"><?php echo  $status['name'] ?></div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel_s">
                        <div class="panel-body" style="background-color: none;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="newsfeed_data">
                                        <div class="col-md-12">
                                            <div class="panel_s newsfeed_post" data-main-postid="1">
                                                <div class="panel-body post-content">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="<?php echo $link_fanpage ?>">
                                                                <?php if (!$fanpage_id) { ?>
                                                                    <img src="<?php echo APP_BASE_URL . '/assets/images/user-placeholder.jpg' ?>" class="staff-profile-image-small" style="width:75px; height:75px">
                                                                <?php } else {
                                                                echo '<img class="staff-profile-image-small" src="https://graph.facebook.com/v3.2/' . $fanpage_id . '/picture?type=large" style="width:65px; height:65px"/>';
                                                            }
                                                            ?>
                                                            </a>
                                                        </div>
                                                        <div class="media-body" style="font-size:20px;">
                                                            <p class="media-heading no-mbot">
                                                                <a href="<?php echo $link_fanpage ?>"><?php echo $fanpage_name ?></a>
                                                                <?php if ($content->status == 5) { ?>
                                                                </p><small class="post-time-ago" style="font-size:15px;">7 days ago</small>
                                                                <div class="dropdown pull-right btn-post-options-wrapper">
                                                                </div>
                                                                <small class="text-muted" style="font-size:15px;">Published: 2019-04-25 21:28:48</small>&nbsp
                                                                <img data-toggle="tooltip" data-placement="top" data-original-title="Pulbic" src="<?php echo APP_BASE_URL . '/assets/images/public.png' ?>" class="staff-profile-image-small no-radius" style="width:15px; height:15px">
                                                            <?php } else { ?>
                                                                <div>
                                                                    <small class="text-muted" style="font-size:15px;">Waiting for post</small>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="post-content mtop20 display-block" style="font-size:15px;">
                                                        <div id="description"></div>
                                                        <div class="clearfix mbot10">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="newsfeed_data" style="position:relative; top:-27px;">
                                        <div class="col-md-12">
                                            <?php $urlImage = APP_BASE_URL . '/uploads/content/' . $content->id . '/' . $file_name; ?>
                                            <img src="<?php echo $urlImage ?>" class="img img-responsive" style="width:700px;" />
                                        </div>

                                    </div>
                                    <div id="newsfeed_data">
                                        <div class="col-md-12" style="position: relative; top:-27px;">
                                            <div class="post_likes_wrapper" data-likes-postid="1">
                                                <div class="panel-footer user-post-like">
                                                    <div class="row">
                                                        <div class="col-md-6" style="vertical-align: middle;">
                                                            <img data-toggle="tooltip" data-placement="top" data-original-title="Like" class="icon1" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/like.jpg' ?>" style="height:38px;width:38px; background-color:white" />
                                                            <img data-toggle="tooltip" data-placement="top" data-original-title="Love" class="icon1" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/love.jpg' ?>" style="height:40px;width:40px; position:relative; left:-10px; background-color:white" />
                                                            <img data-toggle="tooltip" data-placement="top" data-original-title="Haha" class="icon1" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/wow.jpg' ?>" style="height:37px;width:37px; position:relative; left:-20px; background-color:white" />
                                                            <span style="position: relative; left:-20px; font-size:13px; vertical-align: middle;"><?php echo $total_reaction?></span>
                                                        </div>
                                                        <div class="col-md-6" style="margin-top:10px; font-size:13px;">
                                                            <span><?php echo $comments?> Comments</span> &nbsp &nbsp <span> <?php echo $shares?> Shares</span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="post_comments_wrapper" data-comments-postid="1">
                                            </div>
                                            <div class="panel-footer user-comment">
                                                <div class="pull-left comment-image">
                                                <a href="<?php echo $link_fanpage ?>">
                                                                <?php if (!$fanpage_id) { ?>
                                                                    <img src="<?php echo APP_BASE_URL . '/assets/images/user-placeholder.jpg' ?>" class="staff-profile-image-small no-radius">
                                                                <?php } else {
                                                                echo '<img class="staff-profile-image-small no-radius" src="https://graph.facebook.com/v3.2/' . $fanpage_id . '/picture?type=large" style="margin-right:5px;"/>';
                                                            }
                                                            ?>
                                                </a>
                                            
                                                </div>
                                                <div class="media-body comment-input">
                                                    <input type="text" class="form-control input-sm" placeholder="Comment this post.." data-postid="1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="btn-bottom-toolbar text-right">
                        <?php echo form_open(); ?>
                        <?php if ($content->status != 5) { ?>
                           <button class="btn btn-primary" id="post_content">
                              <?php echo _l('post'); ?>
                           </button>
                        <?php } else { ?>
                           <button class="btn-tr btn btn-default" disabled>
                              <?php echo _l('posted'); ?>
                           </button>
                        <?php } ?>
                        <?php echo form_close(); ?>
                     </div>


                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-6">
                        <div class="panel_s">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="bold no-margin" style="color:#1E48AB;"><?php echo _l('contentoverview') ?></h4>
                                    </div>

                                    <div class="col-md-12">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="bold" style="width:150px; color:#1E48AB;"><?php echo _l('subject'); ?></td>
                                                    <td><?php echo $content->subject; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="bold" style="color:#1E48AB;"><?php echo _l('task_title'); ?></td>
                                                    <td><?php
                                                        foreach ($staffTask as $value) {
                                                            if ($content->task_title == $value['id']) {
                                                                echo $value['name'];
                                                            }
                                                        } ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="bold" style="color:#1E48AB;"><?php echo _l('content_start_date'); ?></td>
                                                    <td><?php echo $content->datestart; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="bold" style="color:#1E48AB;"><?php echo _l('content_end_date'); ?></td>
                                                    <td><?php echo $content->dateend; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="bold" style="color:#1E48AB;"><?php echo _l('assign_to'); ?></td>
                                                    <td><?php
                                                        foreach ($staffInfo as $value) {
                                                            if ($content->assignto == $value['staffid']) {
                                                                echo $value['firstname'] . " " . $value['lastname'];
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="bold" style="color:#1E48AB;">
                                                        <?php echo _l('project_id'); ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        foreach ($projectid as $value) {
                                                            if ($content->project_id == $value['id']) {
                                                                echo $value['name'];
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <!-- <td><?php echo $content->assignto; ?></td> -->
                                                </tr>
                                                <tr>
                                                    <td class="bold" style="color:#1E48AB;">
                                                        <?php echo _l('project_link_page'); ?>
                                                    </td>
                                                    <td><a href="<?php echo $link_fanpage; ?>">
                                                            <?php
                                                            echo $link_fanpage;
                                                            ?>
                                                    </td>
                                                    <!-- <td><?php echo $content->assignto; ?></td> -->
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel_s">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="bold no-margin">EFFECT OF THE ARTICLE</h4>
                                    </div>
                                    <br/>
                                    <hr/>
                                </div>
                                <div class="row">
                                <div class="col-md-12">
                                        <h4 class="bold no-margin"><?php echo $total?> Likes, Comments & Share</h4>
                                        <hr/>
                                        </div>
                                </div>
                                <div class="col-md-12">
                                       
                                        
                                        <div class="row" >
                                            <div class="col-md-4 border-right">
                                            <h4 class="bold"><?php echo $like?></h4>
                                            <span class="bold text-primary">Like <img data-toggle="tooltip" data-placement="top" data-original-title="Like" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/likeg.gif' ?>" style="width:40px; height:40px"> </span>
                                            
                                        </div>
                                        <div class="col-md-4  border-right">
                                        <h4 class="bold"><?php echo $love?></h4>
                                        <span class="bold text-info">Love<img data-toggle="tooltip" data-placement="top" data-original-title="Love" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/loveg.gif' ?>" style="width:40px; height:40px"> </span>
                                        </div>
                                        <div class="col-md-4">
                                        <h4 class="bold"><?php echo $haha?></h4>
                                        <span class="bold text-success">Haha<img data-toggle="tooltip" data-placement="top" data-original-title="Haha" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/hahag.gif' ?>" style="width:40px; height:40px">  </span>
                                        </div>
                                        </div>

                                        <div class="row" >
                                            <hr/>
                                            <div class="col-md-4  border-right">
                                            <h4 class="bold"><?php echo $wow?></h4>
                                            <span class="bold text-primary">Wow<img data-toggle="tooltip" data-placement="top" data-original-title="Wow" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/wowg.gif' ?>" style="width:40px; height:40px"> </span>
                                        </div>
                                        <div class="col-md-4  border-right">
                                        <h4 class="bold"><?php echo $sad?></h4>
                                        <span class="bold text-info">Sad<img data-toggle="tooltip" data-placement="top" data-original-title="Cry" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/cryg.gif' ?>" style="width:40px; height:40px"></span>
                                        
                                        </div>
                                        <div class="col-md-4">
                                        <h4 class="bold"><?php echo $angry?></h4>
                                        <span class="bold text-success">  Angry <img data-toggle="tooltip" data-placement="top" data-original-title="Angry" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/angryg.gif' ?>" style="width:40px; height:40px"></span>
                                        
                                        </div>
                                        </div>
                                        <hr/>
                                        <div class="row" >
                                            <div class="col-md-4  border-right">
                                            <h4 class="bold"><?php echo $comments?></h4>
                                            <span class="bold text-primary"> Comments </span>
                                        </div>
                                        <div class="col-md-4">
                                        <h4 class="bold"><?php echo $shares?></h4>
                                        <span class="bold text-info">Shares</span>
                                        
                                        </div>
                                        <br/>
                                    </div>
                                    
                        </div>
                            </div>
                            
                        
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
</div>

</div>
<?php init_tail(); ?>
</body>
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


<script src='<?php echo base_url('assets/plugins/editor/vendor/emoji-picker/lib/js/config.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/editor/vendor/emoji-picker/lib/js/util.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/editor/vendor/emoji-picker/lib/js/jquery.emojiarea.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/editor/vendor/emoji-picker/lib/js/emoji-picker.js'); ?>'></script>
<style>
   .icon1 {

      padding: 1px;
      border: 2px solid white;
      border-radius: 50%;
      -webkit-border-radius: 500px;
      -moz-border-radius: 500px;
   }


</style>

<script>
   $(document).ready(function() {
      listComment();
   });

   function listComment() {
      $.post("",
         function(data) {
            var datarecieve = '<?php echo $jsonData ?>';
            console.log(JSON.stringify(datarecieve));
            // console.log(datarecieve);
            datarecieve = datarecieve.replace(/\n/g, "<br\>")
               // .replace(/\'/g, "\\'")
               // .replace(/\"/g, '\\"')
               // .replace(/\&/g, "\\&")
               .replace(/\r/g, "\\r")
               .replace(/\t/g, "\\t")
               .replace(/\f/g, "\\f");

            // .replace(/\n/g, "\\n")
            //  .replace(/\r/g, "\\r")
            //  .replace(/\t/g, "\\t")
            //  .replace(/\f/g, "\\f");

            // remove non-printable and other non-valid JSON chars
            //datarecieve = datarecieve.replace(/[\u0000-\u001F]+/g,""); 

            var data = JSON.parse(datarecieve);
            console.log(data);
            var comments = "";

            var results = new Array();

            // var list = $("<ul class='outer-comment'>");
            // var item = $("<li>").html(comments);

            for (var i = 0;
               (i < data.length); i++) {

               comments = data[i]['description'];

            }

            $("#description").html(comments);
         });
   }
</script>
<script type="text/javascript">
   $("#submitButton").click(function() {
      var str = $("#content-form").serialize();
      $.ajax({
         url: '<?php echo base_url('assets/plugins/editor/comment-add.php'); ?>',
         data: str,
         type: 'post',
         success: function(response) {
            $("#comment-message").css('display', 'inline-block');
            $("#name").val("");
            $("#description").val("");
            $("#commentId").val("");
            // listComment(); 
         }
      });
   });


   $(function() {
      // Initializes and creates emoji set from sprite sheet
      window.emojiPicker = new EmojiPicker({
         emojiable_selector: '[data-emojiable=true]',
         assetsPath: '<?php echo base_url('assets/plugins/editor/vendor/emoji-picker/lib/img/'); ?>',
         popupButtonClasses: 'icon-smile'
      });
      // '<?php 
            ?>'

      window.emojiPicker.discover();
   });
</script>
</html>