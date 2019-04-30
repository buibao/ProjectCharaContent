
<?php init_head(); ?>

<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <!-- breadcrumb -->
            <div class="panel_s project-top-panel panel-full">
               <div class="panel-body _buttons">

                  <div class="row">
                  <?php echo $tokenTest?>
                     <div class="col-md-7 project-heading">
                        <div id="project_view_name" class="pull-left">

                           <div class="dropdown bootstrap-select fit-width">
                              <h4><?php echo $content->subject; ?></h4>
                           </div>

                        </div>

                        <div class="visible-xs">

                           <div class="clearfix"></div>

                        </div>
                        <?php $status = get_content_status_by_id($content->status); ?>
                        <div class="label pull-left mleft15 mtop5 p8 project-status-label-2" style="background:#03a9f4"><?php echo  $status['name'] ?></div>
                     </div>

                     <div class="col-md-5 text-right">
                     </div>
                  </div>
               </div>
            </div>
            <div class="clearfix">
               <div class="panel_s">
                  <div class="panel-body" style="background-color:#F5F7FA;">
                     <div class="row">
                        <div class="col-md-12" style="height:130px;">
                           <h4 class="bold no-margin"><?php echo _l('content_interaction') ?></h4>
                           <div class="wrapper border-right">
                              <div class="counter col_fourth">
                                 <img data-toggle="tooltip" data-placement="top" data-original-title="Like" class="over" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/like.gif' ?>" style="height:90px;width:90px;" />
                                 <h5 class="timer count-title count-number" data-to="300" data-speed="1500">300</h5>

                              </div>
                              <div class="counter col_fourth">
                                 <img data-toggle="tooltip" data-placement="top" data-original-title="Love" class="over" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/love.gif' ?>" style="height:90px;width:90px;" />
                                 <h5 class="timer count-title count-number" data-to="300" data-speed="1500">300</h5>

                              </div>
                              <div class="counter col_fourth">
                                 <img data-toggle="tooltip" data-placement="top" data-original-title="Haha" class="over" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/haha.gif' ?>" style="height:90px;width:90px;" />
                                 <h5 class="timer count-title count-number" data-to="300" data-speed="1500">300</h5>

                              </div>
                              <div class="counter col_fourth">
                                 <img data-toggle="tooltip" data-placement="top" data-original-title="Wow" class="over" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/wow.gif' ?>" style="height:90px;width:90px;" />
                                 <h5 class="timer count-title count-number" data-to="300" data-speed="1500">300</h5>

                              </div>
                              <div class="counter col_fourth">
                                 <img data-toggle="tooltip" data-placement="top" data-original-title="Sad" class="over" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/cry.gif' ?>" style="height:90px;width:90px;" />
                                 <h5 class="timer count-title count-number" data-to="300" data-speed="1500">300</h5>

                              </div>
                              <div class="counter col_fourth">
                                 <img data-toggle="tooltip" data-placement="top" data-original-title="Angry" class="over" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/angry.gif' ?>" style="height:90px;width:90px;" />
                                 <h5 class="timer count-title count-number" data-to="300" data-speed="1500">300</h5>

                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="panel_s">
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-md-6 border-right project-overview-left">
                           <div class="row">
                              <div class="col-md-12">
                                 <h4 class="bold no-margin"><?php echo _l('contentoverview') ?></h4>
                              </div>
                              <br />
                              <br />
                              <div class="col-md-7">
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
                                                } ?></td>
                                       </tr>
                                       <tr>
                                          <td class="bold"><?php echo _l('content_start_date'); ?></td>
                                          <td><?php echo $content->datestart; ?></td>
                                       </tr>
                                       <tr>
                                          <td class="bold"><?php echo _l('content_end_date'); ?></td>
                                          <td><?php echo $content->dateend; ?></td>
                                       </tr>
                                       <tr>
                                          <td class="bold"><?php echo _l('assign_to'); ?></td>
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
                                          <td class="bold">
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
                                          <td class="bold">
                                             <?php echo _l('project_link_page'); ?>
                                          </td>
                                          <td>
                                             <?php
                                             
                                                if ($link_fanpage) {
                                                   echo $link_fanpage;
                                                }
                                             
                                             ?>
                                          </td>
                                          <!-- <td><?php echo $content->assignto; ?></td> -->
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="col-md-4 text-center project-percent-col mtop10">
                                 <?php if(!$fanpage_id){?>
                                    <img class="img img-responsive" src="<?php echo APP_BASE_URL .'\assets\images\image-not-found.png'?>" style="height:20%;width:90% " data-toggle="tooltip" data-title="Not Found"/>
                                    <?php } 
                                    else {
                                    echo '<img class="img img-responsive" src="https://graph.facebook.com/v3.2/'.$fanpage_id.'/picture?type=large" style="padding-left"/>';
                                    }
                                    ?>
                                 
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 project-overview-right">
                           <div class="row">

                              <div class='col-md-12'>
                                 <h4 class="bold no-margin"><?php echo _l('content') ?></h4>
                                 <hr />

                                 <?php echo $content->description; ?>
                                 <br />
                                 <br />
                              </div>

                              <div id="attchment" class="row task_attachments_wrapper">
                                 <div class="col-md-12" id="attachments">
                                    <div class="row" style="margin-left:5px; margin-right:1px;">
                                       <?php
                                       $i = 1;
                                       // Store all url related data here
                                       $comments_attachments = array();
                                       $attachments_data = array();
                                       $show_more_link_task_attachments = do_action('show_more_link_task_attachments', 2);
                                       $file_name_str = "";
                                       foreach ($attachments as $attachment) { ?>
                                          <?php ob_start(); ?>
                                          <div data-num="<?php echo $i; ?>" data-commentid="<?php echo $attachment['comment_file_id']; ?>" data-comment-attachment="<?php echo $attachment['task_comment_id']; ?>" data-task-attachment-id="<?php echo $attachment['id']; ?>" class="task-attachment-col-12<?php if ($i > $show_more_link_task_attachments) {
                                                                                                                                                                                                                                                                                                               echo ' hide task-attachment-col-more';
                                                                                                                                                                                                                                                                                                            } ?>">
                                             <ul class="list-unstyled task-attachment-wrapper" data-toggle="tooltip" data-title="<?php echo $attachment['file_name']; ?>" style="background-color: #E4FBFF">
                                                <li class="mbot10 task-attachment<?php if (strtotime($attachment['dateadded']) >= strtotime('-16 hours')) {
                                                                                    echo ' highlight-bg';
                                                                                 } ?>">
                                                   <div class="mbot10 pull-right task-attachment-user">
                                                      <?php if ($attachment['staffid'] == get_staff_user_id() || is_admin()) { ?>

                                                      <?php }
                                                   $externalPreview = false;
                                                   $is_image = false;
                                                   $path = APP_BASE_URL . '/uploads/content/' . $id_content . '/' . $attachment['file_name'];
                                                   $file_name_str = $path;
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
                                                         <a href="<?php echo (!$externalPreview ? $href_url : $externalPreview); ?>" target="_blank" <?php if ($is_image) { ?> data-lightbox="task-attachment" <?php } ?> class="<?php if ($isHtml5Video) {
                                                                                                                                                                                                                                    echo 'video-preview';
                                                                                                                                                                                                                                 } ?>">
                                                         <?php } ?>
                                                         <?php if ($is_image) { ?>
                                                            <img src="<?php echo APP_BASE_URL . '/uploads/content/' . $id_content . '/' . $attachment['file_name']; ?>" class="img img-responsive">
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

                                 <div class="clearfix">

                                 </div>

                                 <?php if (($i - 1) > $show_more_link_task_attachments) { ?>
                                    <div class="col-md-12" id="show-more-less-task-attachments-col">
                                       <a href="#" class="task-attachments-more" onclick="slideToggle('.task_attachments_wrapper .task-attachment-col-more', task_attachments_toggle); return false;"><?php echo _l('show_more'); ?></a>
                                       <a href="#" class="task-attachments-less hide" onclick="slideToggle('.task_attachments_wrapper .task-attachment-col-more', task_attachments_toggle); return false;"><?php echo _l('show_less'); ?></a>
                                    </div>
                                 <?php } ?>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                     <div class="btn-bottom-toolbar text-right">
                        <?php echo form_open(); ?>
                        <?php if ($content->status != 5) { ?>
                           <button class="btn-tr btn btn-default" id="post_content">
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
   data.urlPhoto = "<?php echo $file_name_str?>";
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
<style>
   /*-=-=-=-=-=-=-=-=-=-=-=- */
   /* Column Grids */
   /*-=-=-=-=-=-=-=-=-=-=-=- */
   .over {
      margin-left: auto;
      margin-right: auto;
      vertical-align: middle;
      transition: transform .3s;
      display: block;
   }


   .over:hover {
      -webkit-transform: scale(1.3, 1.3);
      -moz-transform: scale(1.3, 1.3);
      -ms-transform: scale(1.3, 1.3);
      -o-transform: scale(1.3, 1.3);

   }

   .col_half {
      width: 49%;
   }

   .col_third {
      width: 32%;

   }

   .col_fourth {
      width: 14%;

   }

   .col_fifth {
      width: 15.4%;
   }

   .col_sixth {
      width: 15%;
   }

   .col_three_fourth {
      width: 74.5%;
   }

   .col_twothird {
      width: 66%;
   }

   .col_half,
   .col_third,
   .col_twothird,
   .col_fourth,
   .col_three_fourth,
   .col_fifth {
      position: relative;
      display: inline;
      display: inline-block;
      float: left;
      margin-right: 2%;
      margin-bottom: 20px;
   }

   .end {
      margin-right: 0 !important;
   }

   /* Column Grids End */

   .wrapper {
      width: 980px;
      margin: 10px auto;
      position: relative;
   }

   .counter {
      border-right: 1px solid hsl(200, 98%, 93%);

   }

   .count-title {
      font-size: 17px;
      font-weight: normal;
      margin-top: -10px;
      text-align: center;
      font-family: 'Raleway', sans-serif;
      color: #2057AA;
      font-weight: bold;

   }

   .count-text {
      font-size: 13px;
      font-weight: normal;
      margin-top: 10px;
      margin-bottom: 40px;
      text-align: center;
   }

   .fa-2x {
      margin: 0 auto;
      float: none;
      display: table;
      color: #4ad1e5;
   }

   
</style>