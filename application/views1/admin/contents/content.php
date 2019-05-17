<?php init_head(); ?>
<link href='<?php echo base_url('assets/plugins/editor/vendor/emoji-picker/lib/css/emoji.css'); ?>' rel='stylesheet' />
<link href='<?php echo base_url('assets/plugins/editor/style2.css'); ?>' rel="stylesheet">
<style>
</style>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-7">
            <div class="panel_s">
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-12 project-overview-left">

                        <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'content-form')); ?>
                        <h3 class="no-margin">
                           <?php echo $title; ?>
                           
                        </h3>

                        <div class="checkbox ">
                           <input type="checkbox" name="status" id="status" <?php if (isset($content)) {
                                                                                 if ($content->status == 2) {
                                                                                    echo 'checked';
                                                                                 }
                                                                              }; ?>>

                        </div>

                        <?php $value = (isset($content) ? $content->subject : ''); ?>
                        <br/>
                        <?php echo render_input('subject', 'content_title', $value, array('name' => 'subject', 'id' => 'subject')); ?>

                        <?php $value = (isset($content) ? $content->task_title : ''); ?>
                        <label for="task_title" class="control-label"> <small class="req text-danger">* </small><?php echo _l('task_title'); ?></label>
                        <?php
                        
                        echo render_select('task_title', $tasksCustom, array('id', 'name'), '', $value, array('name' => 'task_title', 'id' => 'task_title',required));
                        ?>

                        <!-- fix save id -->
                        <div style="display: none;">
                           <?php $value = (isset($content) ? $content->assignto : ''); ?>
                           <?php echo render_input('assignto', 'assignto', $value); ?>
                        </div>
                        <!-- end fix save id -->


                        <!-- fix save id project -->
                        <div style="display: none;">
                           <?php $value = (isset($content) ? $content->project_id : ''); ?>
                           <?php echo render_input('project_id', 'project_id', $value, array('name' => 'project_id', 'id' => 'project_id')); ?>
                        </div>
                        <!-- end fix save id project -->
                        <div class="row">
                           <div style="pointer-events: none;" class="col-md-6">
                              <?php $value = (isset($content) ? _d($content->datestart) : _d(date('Y-m-d'))); ?>
                              <?php echo render_date_input('datestart', 'contract_start_date', $value, array('name' => 'datestart', 'id' => 'datestart')); ?>
                           </div>
                           <div style="pointer-events: none;" class="col-md-6">
                              <?php $value = (isset($content) ? _d($content->dateend) : ''); ?>
                              <?php echo render_date_input('dateend', 'contract_end_date', $value, array('name' => 'dateend', 'id' => 'dateend')); ?>
                           </div>

                        </div>
                        <label for="task_title" class="control-label"> <small class="req text-danger">* </small><?php echo _l('photo_content'); ?></label>
                        <?php if ($attachments == null) { ?>
                           <div id="new-task-attachments">
                              <div class="row attachments">
                                 <div class="attachment">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <div class="input-group col-md-12">
                                             <input type="file" id="attachmentInput" extension="<?php echo str_replace('.', '', get_option('allowed_files')); ?>" filesize="<?php echo file_upload_max_size(); ?>" class="form-control " name="attachments[0]" required>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        <?php } else { ?>

                           <div id="attchment" class="row task_attachments_wrapper">
                              <div class="col-md-12" id="attachments">
                                 <div class="row">
                                    <?php ob_start(); ?>
                                    <div data-num="<?php echo $i; ?>" data-task-attachment-id="<?php echo $id_file; ?>" class="task-attachment-col col-md-12">
                                       <ul class="list-unstyled task-attachment-wrapper" data-toggle="tooltip" data-title="<?php echo $file_name; ?>">
                                          <li class="mbot10 task-attachment<?php if (strtotime($dateadded) >= strtotime('-16 hours')) {
                                                                              echo ' highlight-bg';
                                                                           } ?>">
                                             <div class="mbot10 pull-right task-attachment-user">
                                                <?php if ($staffid == get_staff_user_id() || is_admin()) { ?>
                                                   <a href="#" id="delete" onclick="DeleteImage(<?php echo $id_file; ?>); return false;" class="pull-right">
                                                      <i class="fa fa fa-times"></i>
                                                   </a>
                                                <?php }
                                             $externalPreview = false;
                                             $is_image = false;
                                             $path = APP_BASE_URL . '/uploads/content/' . $id_content . '/' . $file_name;
                                             $href_url = APP_BASE_URL . '/uploads/content/' . $id_content . '/' . $file_name;
                                             $isHtml5Video = is_html5_video($path);
                                             if (empty($external)) {
                                                $is_image = is_image($path);
                                                $img_url = site_url('download/preview_image?path=' . protected_file_url_by_path($path, true) . '&type=' . $filetype);
                                             } else if ((!empty($thumbnail_link) || !empty($external))
                                                && !empty($thumbnail_link)
                                             ) {
                                                $is_image = true;
                                                $img_url = optimize_dropbox_thumbnail($thumbnail_link);
                                                $externalPreview = $img_url;
                                                $href_url = $external_link;
                                             } else if (!empty($external) && empty($thumbnail_link)) {
                                                $href_url = $external_link;
                                             }
                                             if (!empty($external) && $external == 'dropbox' && $is_image) { ?>
                                                   <a href="<?php echo $href_url; ?>" target="_blank" class="" data-toggle="tooltip" data-title="<?php echo _l('open_in_dropbox'); ?>"><i class="fa fa-dropbox" aria-hidden="true"></i></a>
                                                <?php }
                                             if ($staffid != 0) {
                                                echo '<a href="' . admin_url('profile/' . $staffid) . '" target="_blank">' . get_staff_full_name($staffid) . '</a> - ';
                                             } else if ($contact_id != 0) {
                                                echo '<a href="' . admin_url('clients/client/' . get_user_id_by_contact_id($contact_id) . '?contactid=' . $contact_id) . '" target="_blank">' . get_contact_full_name($contact_id) . '</a> - ';
                                             }
                                             echo '<span class="text-has-action" data-toggle="tooltip" data-title="' . _dt($dateadded) . '">' . time_ago($dateadded) . '</span>';
                                             ?>
                                             </div>
                                             <div class="clearfix"></div>

                                             <div class="<?php if ($is_image) {
                                                            echo 'preview-image';
                                                         } else if (!$isHtml5Video) {
                                                            echo 'task-attachment-no-preview';
                                                         } ?>">

                                                <?php
                                                // Not link on video previews because on click on the video is opening new tab
                                                if (!$isHtml5Video) { ?>
                                                   <a href="<?php echo (!$externalPreview ? $href_url : $externalPreview); ?>" target="_blank" <?php if ($is_image) { ?> data-lightbox="task-attachment" <?php } ?> class="<?php if ($isHtml5Video) {
                                                                                                                                                                                                                              echo 'video-preview';
                                                                                                                                                                                                                           } ?>">
                                                   <?php } ?>
                                                   <?php if ($is_image) { ?>
                                                      <img src="<?php echo APP_BASE_URL . '/uploads/content/' . $id_content . '/' . $file_name;; ?>" class="img img-responsive">
                                                   <?php } else if ($isHtml5Video) { ?>
                                                      <video width="100%" height="100%" src="<?php echo site_url('download/preview_video?path=' . protected_file_url_by_path($path) . '&type=' . $attachment['filetype']); ?>" controls>
                                                         Your browser does not support the video tag.
                                                      </video>
                                                   <?php } else { ?>
                                                      <i class="<?php echo get_mime_class($filetype); ?>"></i>
                                                      <?php echo $file_name; ?>
                                                   <?php } ?>
                                                   <?php if (!$isHtml5Video) { ?>
                                                   </a>
                                                <?php } ?>
                                             </div>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                             

                           </div>
                        <?php } ?>
                        <br />
                     </div>
                  </div>

                  <div class="btn-bottom-toolbar text-right">
                     <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>

                     <button class="btn-tr btn btn-default " id="submitdraft">
                        <?php echo _l('submitdraft'); ?>
                     </button>

                  </div>
                  
               </div>
            </div>
         </div>
         <div class="col-md-5">
         <div class="panel_s">
               <div class="panel-body">
                           <p class="emoji-picker-container">
                              <?php
                              //  $jsonData =  str_replace('\r\n', "<br/>",$jsonData);
                              $data = json_decode($jsonData);
                              //  echo $data[0]->description;
                              $data =  $data[0]->description;
                              //  $data = str_replace('\r\n',"\\n",$data);
                              $value = (isset($content) ? $data : '');
                              
                              echo render_textarea('description', 'content_description', $value, array('rows' => 20, 'cols' => 7, 'data-emojiable' => 'true', 'data-emoji-input' => 'unicode', 'type' => 'text', 'name' => 'description', 'id' => 'description', 'class' => 'input-field', 'placeholder' => 'Description',required));
                              ?>

                           </p>
               </div>
         </div>
         </div>
                                                      
      </div>
      <?php echo form_close(); ?>
   </div>
</div>
</div>
<?php init_tail(); ?>
<script src='<?php echo base_url('assets/plugins/editor/vendor/emoji-picker/lib/js/config.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/editor/vendor/emoji-picker/lib/js/util.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/editor/vendor/emoji-picker/lib/js/jquery.emojiarea.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/editor/vendor/emoji-picker/lib/js/emoji-picker.js'); ?>'></script>
<script type="text/javascript">
   function DeleteImage(id) {
      if (confirm_delete()) {
         var data = {};
         data.id = "<?php echo $id_file; ?>";
         $.post(admin_url + 'contents/remove_content_attachment', data).done(function(response) {
            if (response.success === true || response.success == 'true') {
               $('[data-task-attachment-id="' + id + '"]').remove();
            } 
         });
         location.reload();
      }
   }
</script>
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

            $("#description").val(comments);
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

   $("#submitdraft").click(function() {
      var inputs = document.querySelector('#status');
      inputs.checked = true;
   });
   _validate_form($('#content-form'), {
      task_title: 'required',
      subject: 'required',

   });


   $("#task_title")
      .change(function() {
         var str = "";
         var task_id = $("#task_title option:selected").val();
         console.log(task_id);

         $.getJSON("get_task_json", {
            task_id: task_id
         }, function(resp) {
            console.log(resp);
            $('#datestart').val(resp[0].startdate);
            $('#dateend').val(resp[0].duedate);
            $('#assignto').val(resp[0].addedfrom);
            $('#project_id').val(resp[0].rel_id);
         });
      })
   // .change();
   // <!-- fix content date -->
   // $(document).ready(function() {
   //       $.ajaxSetup({cache: false});
   //        var winterval=setInterval(function () {

   //             $.getJSON("get_task_json", function (row) {
   //                var data=$.parseJSON(row);


   //                   if (data.startdate) {
   //                      $('#C1-Cycle').val(data.startdate);
   //                  }
   //                  if (data.duedate) {
   //                      $('#C2-Cycle-Cycle').val(data.duedate);
   //                  }

   //             });

   //        }, 1000);
   //   });
   // <!--end fix content date -->
</script>

<style>
   textarea {
      overflow: auto;
   }

   body.content {
      padding-left: 0;
      padding-top: 0;
   }

   .emoji-menu {
      position: absolute;
      right: 0;
      margin-top: -32%;
      margin-right: 2%;
      z-index: 999;
      width: 225px;
      overflow: hidden;
      border: 1px #dfdfdf solid;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
      overflow: hidden;
      -webkit-box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.1);
      -moz-box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.1);
      box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.1);
   }
</style>
</body>

</html>