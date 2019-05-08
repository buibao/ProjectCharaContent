<?php init_head(); ?>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-8 left-column">
            <div class="panel_s">

               <!-- breadcrumb -->
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="<?php echo admin_url('contents'); ?>"><?php echo _l('content') ?></a></li>
                     <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                  </ol>
               </nav>
               <div class="panel-body">
                  <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'content-form')); ?>
                  <h3 class="no-margin">
                     <?php echo $title; ?>
                  </h3>

                  <hr class="hr-panel-heading" />
                  <div class="checkbox checkbox-primary checkbox-inline">
                     <input type="checkbox" name="status" id="status" <?php if (isset($content)) {
                                                                           if ($content->status == 2) {
                                                                              echo 'checked';
                                                                           }
                                                                        }; ?>>

                  </div>

                  <?php $value = (isset($content) ? $content->subject : ''); ?>

                  <?php echo render_input('subject', 'content_title', $value); ?>

                  <?php $value = (isset($content) ? $content->task_title : ''); ?>
                  <label for="task_title" class="control-label"> <small class="req text-danger">* </small><?php echo _l('task_title'); ?></label>
                  <?php
                  echo render_select('task_title', $tasksCustom, array('id', 'name'), '', $value);
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
                     <?php echo render_input('project_id', 'project_id', $value); ?>
                  </div>
                  <!-- end fix save id project -->
                  <div class="row">
                     <div style="pointer-events: none;" class="col-md-6">
                        <?php $value = (isset($content) ? _d($content->datestart) : _d(date('Y-m-d'))); ?>
                        <?php echo render_date_input('datestart', 'contract_start_date', $value); ?>
                     </div>
                     <div style="pointer-events: none;" class="col-md-6">
                        <?php $value = (isset($content) ? _d($content->dateend) : ''); ?>
                        <?php echo render_date_input('dateend', 'contract_end_date', $value); ?>
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
                                       <input type="file" id="attachmentInput" extension="<?php echo str_replace('.', '', get_option('allowed_files')); ?>" filesize="<?php echo file_upload_max_size(); ?>" class="form-control " name="attachments[0]" required >
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
                              <?php
                              $i = 1;
                              // Store all url related data here
                              $comments_attachments = array();
                              $attachments_data = array();
                              $show_more_link_task_attachments = do_action('show_more_link_task_attachments', 2);
                              foreach ($attachments as $attachment) { ?>
                                 <?php ob_start(); ?>
                                 <div data-num="<?php echo $i; ?>" data-commentid="<?php echo $attachment['comment_file_id']; ?>" data-comment-attachment="<?php echo $attachment['task_comment_id']; ?>" data-task-attachment-id="<?php echo $attachment['id']; ?>" class="task-attachment-col col-md-6<?php if ($i > $show_more_link_task_attachments) { echo ' hide task-attachment-col-more'; } ?>">
                                    <ul class="list-unstyled task-attachment-wrapper" data-toggle="tooltip" data-title="<?php echo $attachment['file_name']; ?>">
                                       <li class="mbot10 task-attachment<?php if (strtotime($attachment['dateadded']) >= strtotime('-16 hours')) {echo ' highlight-bg';} ?>">
                                          <div class="mbot10 pull-right task-attachment-user">
                                             <?php if ($attachment['staffid'] == get_staff_user_id() || is_admin()) { ?>
                                                <a href="#" id="close" class="pull-right" onclick="remove_content_attachment(this,<?php echo $attachment['id']; ?>); return false;">
                                                   <i class="fa fa fa-times"></i>
                                                </a>
                                             <?php }
                                          $externalPreview = false;
                                          $is_image = false;
                                          $path = APP_BASE_URL . '/uploads/content/' . $id_content . '/' . $attachment['file_name'];
                                          $href_url = APP_BASE_URL . '/uploads/content/' . $id_content . '/' . $attachment['file_name'];
                                          $isHtml5Video = is_html5_video($path);
                                          if (empty($attachment['external'])) {
                                             $is_image = is_image($path);
                                             $img_url = site_url('download/preview_image?path=' . protected_file_url_by_path($path, true) . '&type=' . $attachment['filetype']);
                                          } else if ((!empty($attachment['thumbnail_link']) || !empty($attachment['external']))
                                             && !empty($attachment['thumbnail_link'])
                                          ) {
                                             $is_image = true;
                                             $img_url = optimize_dropbox_thumbnail($attachment['thumbnail_link']);
                                             $externalPreview = $img_url;
                                             $href_url = $attachment['external_link'];
                                          } else if (!empty($attachment['external']) && empty($attachment['thumbnail_link'])) {
                                             $href_url = $attachment['external_link'];
                                          }
                                          if (!empty($attachment['external']) && $attachment['external'] == 'dropbox' && $is_image) { ?>
                                                <a href="<?php echo $href_url; ?>" target="_blank" class="" data-toggle="tooltip" data-title="<?php echo _l('open_in_dropbox'); ?>"><i class="fa fa-dropbox" aria-hidden="true"></i></a>
                                             <?php }
                                          if ($attachment['staffid'] != 0) {
                                             echo '<a href="' . admin_url('profile/' . $attachment['staffid']) . '" target="_blank">' . get_staff_full_name($attachment['staffid']) . '</a> - ';
                                          } else if ($attachment['contact_id'] != 0) {
                                             echo '<a href="' . admin_url('clients/client/' . get_user_id_by_contact_id($attachment['contact_id']) . '?contactid=' . $attachment['contact_id']) . '" target="_blank">' . get_contact_full_name($attachment['contact_id']) . '</a> - ';
                                          }
                                          echo '<span class="text-has-action" data-toggle="tooltip" data-title="' . _dt($attachment['dateadded']) . '">' . time_ago($attachment['dateadded']) . '</span>';
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
                                                <a href="<?php echo (!$externalPreview ? $href_url : $externalPreview); ?>" target="_blank" <?php if ($is_image) { ?> data-lightbox="task-attachment" <?php } ?> class="<?php if ($isHtml5Video) {echo 'video-preview';} ?>">
                                                <?php } ?>
                                                <?php if ($is_image) { ?>
                                                   <img src="<?php echo APP_BASE_URL . '/uploads/content/' . $id_content . '/' . $attachment['file_name'];; ?>" class="img img-responsive">
                                                <?php } else if ($isHtml5Video) { ?>
                                                   <video width="100%" height="100%" src="<?php echo site_url('download/preview_video?path=' . protected_file_url_by_path($path) . '&type=' . $attachment['filetype']); ?>" controls>
                                                      Your browser does not support the video tag.
                                                   </video>
                                                <?php } else { ?>
                                                   <i class="<?php echo get_mime_class($attachment['filetype']); ?>"></i>
                                                   <?php echo $attachment['file_name']; ?>
                                                <?php } ?>
                                                <?php if (!$isHtml5Video) { ?>
                                                </a>
                                             <?php } ?>
                                          </div>

                                          <div class="clearfix"></div>
                                       </li>
                                    </ul>
                                 </div>
                                 <?php
                                 $attachments_data[$attachment['id']] = ob_get_contents();
                                 if ($attachment['task_comment_id'] != 0) {
                                    $comments_attachments[$attachment['task_comment_id']][$attachment['id']] = $attachments_data[$attachment['id']];
                                 }
                                 ob_end_clean();
                                 echo $attachments_data[$attachment['id']];
                                 ?>
                                 <?php
                                 $i++;
                              } ?>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <?php if (($i - 1) > $show_more_link_task_attachments) { ?>
                           <div class="col-md-12" id="show-more-less-task-attachments-col">
                              <a href="#" class="task-attachments-more" onclick="slideToggle('.task_attachments_wrapper .task-attachment-col-more', task_attachments_toggle); return false;"><?php echo _l('show_more'); ?></a>
                              <a href="#" class="task-attachments-less hide" onclick="slideToggle('.task_attachments_wrapper .task-attachment-col-more', task_attachments_toggle); return false;"><?php echo _l('show_less'); ?></a>
                           </div>
                        <?php } ?>
                     </div>
                  <?php } ?>
                  <br />
                  <label for="task_title" class="control-label"> <small class="req text-danger">* </small><?php echo _l('content_description'); ?></label>
                  <?php $value = (isset($content) ? $content->description : ''); ?>
                  <?php echo render_textarea('description', '', $value, array(), array(), '', 'tinymce'); ?>
                  <div class="btn-bottom-toolbar text-right">
                     <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>

                     <button class="btn-tr btn btn-default " id="submitdraft">
                        <?php echo _l('submitdraft'); ?>
                     </button>

                  </div>
                  <?php echo form_close(); ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<?php init_tail(); ?>


<script type="text/javascript">
   $("#submitdraft").click(function() {
      var inputs = document.querySelector('#status');
      inputs.checked = true;
   });
   _validate_form($('#content-form'), {
      task_title: 'required',
      subject: 'required',
      attachmentInput: 'required',
      description: 'required'
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
<script type="text/javascript">
  function remove_content_attachment(link, id) {
    if (confirm_delete()) {
        requestGetJSON('contents/remove_content_attachment/' + id).done(function(response) {
            if (response.success === true || response.success == 'true') { $('[data-task-attachment-id="' + id + '"]').remove();}
            _task_attachments_more_and_less_checks();
            if (response.comment_removed) {
                $('#comment_' + response.comment_removed).remove();
                  
            }
        });
    }
    
   location.reload();
}
</script>
<style>
   body.content {
      padding-left: 0;
      padding-top: 0;
   }
</style>

</body>

</html>