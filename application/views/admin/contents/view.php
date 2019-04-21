<?php init_head(); ?>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-8">
            <!-- breadcrumb -->
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo admin_url('contents'); ?>"><?php echo _l('contents'); ?> </a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
               </ol>
            </nav>
            <div class="panel_s">
               <div class="panel-body tc-content">
                  <h4 class="bold no-margin"><?php echo _l('contentoverview') ?></h4>
                  <hr class="hr-panel-heading" />
                  <table class="table no-margin">
                     <tbody>
                        <tr>
                           <td class="bold"><?php echo _l('subject'); ?></td>
                           <td><?php echo $content->subject; ?></td>
                        </tr>
                        <tr>
                           <td class="bold"><?php echo _l('task_title'); ?></td>
                           <td><?php
                                 foreach ($staffTask as $value) {
                                    if ($content->task_title == $value['id']) {
                                       echo $value['name'];
                                    }
                                 }

                                 ?></td>

                        </tr>
                        <tr>
                           <td class="bold"><?php echo _l('content_start_date'); ?></td>
                           <td><?php echo $content->datestart; ?></td>
                        </tr>
                        <tr>
                           <td class="bold"><?php echo _l('content_end_date'); ?></td>
                           <td><?php echo $content->dateend; ?></td>
                        </tr>
                        <!--  <tr>
                              <td class="bold"><?php echo _l('content_status'); ?></td>
                              <td><?php echo $content->status; ?></td>
                           </tr> -->
                        <tr>
                           <td class="bold"><?php echo _l('assign_to'); ?></td>
                           <td><?php
                                 foreach ($staffInfo as $value) {
                                    if ($content->assignto == $value['staffid']) {
                                       echo $value['firstname'] . " " . $value['lastname'];
                                    }
                                 }

                                 ?></td>
                        </tr>
                        <tr>
                           <td class="bold">
                              <?php echo _l('Project_id'); ?>
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
                           <td class="bold"><?php echo _l('content_description'); ?></td>
                           <td><?php echo $content->description; ?></td>
                        </tr>
                     </tbody>
                  </table>
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
                  <?php if ($content->status == 1) { ?>

                     <hr class="hr-panel-heading" />
                     <div class="clearfix">
                        <div class="btn-bottom-toolbar text-right">
                           <div class=" ft 1">
                              <?php echo form_open(); ?>
                              <button class="btn-tr btn btn-default" id="sendtocustomer">
                                 <?php echo _l('draft'); ?>
                              </button>
                              <?php echo form_hidden('action', 'approval1'); ?>
                              <?php echo form_close(); ?>
                           </div>
                           <div class="ft q">
                              <?php echo form_open(); ?>
                              <button type="submit" class="btn btn-info"><?php echo _l('submit_content'); ?></button>
                              </button>
                              <?php echo form_hidden('action', 'approval2'); ?>
                              <?php echo form_close(); ?>
                           </div>
                        </div>
                     </div>
                  <?php } else { ?>
                     <hr class="hr-panel-heading" />
                     <div class="clearfix">
                        <div class="btn-bottom-toolbar text-right">
                           <div class=" ft 1">
                              <?php echo form_open(); ?>
                              <button class="btn-tr btn btn-default " id="sendtocustomer">
                                 <?php echo _l('back_to_list'); ?>
                              </button>
                              <?php echo form_hidden('action', 'approval0'); ?>
                              <?php echo form_close(); ?>
                           </div>
                        </div>
                     </div>
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php init_tail(); ?>
<style>
   .ft {
      float: right;
   }

   .q {
      margin-right: 10px;
   }
</style>
</body>

</html>