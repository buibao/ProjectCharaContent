<?php init_head();?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                                                <!-- breadcrumb -->
               
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
                              <td><?php echo $content->task_title; ?></td>
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
                              <td><?php echo $content->assign_to; ?></td>
                           </tr>
                           <tr>
                              <td class="bold"><?php echo _l('content_description'); ?></td>
                              <td><?php echo $content->description; ?></td>
                           </tr>
                            <tr>
                              <td class="bold"><?php echo _l('project_link_page'); ?></td>
                              <td><?php echo $link_fanpage; ?></td>
                           </tr>
                        </tbody>
                     </table>
                     <hr class="hr-panel-heading" />
                      <div class="clearfix">
                        <div class="btn-bottom-toolbar text-right">
                        <?php echo form_open(); ?>
                        <?php if($content->status != 5){?>
                          <button class="btn-tr btn btn-default " id="sendtocustomer">
                          <?php echo _l('post'); ?>
                          </button>
                        <?php } else { ?>
                          <button class="btn-tr btn btn-default" disabled="disabled">
                          <?php echo _l('posted'); ?>
                          </button>
                        <?php }?>
                      </div>
                     </div>
                     <?php echo form_close(); ?>
                  </div>
              </div>
          </div>
            </div>
        </div>
    </div>
    <?php init_tail();?>
<script type="text/javascript">
  var data = {};
  data.id = "<?php echo $content->id; ?>";
  data.id_page = "<?php echo $fanpage_id; ?>";
  data.user_access_token = "EAAJGSplFaE0BAN3frGMqZBZAu96mdKxhHESKykf4RSnkLKJvEoXjGcIoLzZCZAvJP34uod9lymPrHkgvgVqOV0d5ZB3auMSd1Onbf2R4f65pvY4ZAUXHvNeJZCDf6zcycNHBeFTw9NmXDC7NC3R2pZBrOqGcgmW93r3M0UGuZA6u1QgZDZD";
  data.description = "<?php echo $content->description; ?>";
  data.urlPhoto = "https://i.ibb.co/HCw9xBp/chien-luoc-crm-cac-cap-do-phat-trien-khach-hang.jpg";
  $( "#sendtocustomer" ).click(function() {
  $.post(admin_url + 'post_contents/post_content', data).done(function (response) {
       response = JSON.parse(response);
       if (response.success == true) {
          alert_float('success', response.message);
       }
       else{
         alert_float('danger', response.message);
       }
    });
});
</script>
</body>
</html>