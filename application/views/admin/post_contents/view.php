<?php init_head(); ?>

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

               <div class="visible-xs">

                 <div class="clearfix"></div>

               </div>
               <?php $status = get_content_status_by_id($content->status);?>
               <div class="label pull-left mleft15 mtop5 p8 project-status-label-2" style="background:#03a9f4"><?php echo  $status['name']?></div>
             </div>

             <div class="col-md-5 text-right">
            </div>
        </div>
    </div>
      </div>
               <br/>
               
            <div class="clearfix">
            <div id="interaction">
            <?php $this->load->view('admin/post_contents/interaction'); ?>
            </div>
            <div id="content_infor">
            <?php $this->load->view('admin/post_contents/content_infor'); ?>
            </div>
            
            </div>
            </div>
            
</div>
            <hr class="hr-panel-heading">

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
   data.id = "<?php echo $content->id; ?>";
   data.id_page = "<?php echo $fanpage_id; ?>";
   data.user_access_token = "EAAJGSplFaE0BAN3frGMqZBZAu96mdKxhHESKykf4RSnkLKJvEoXjGcIoLzZCZAvJP34uod9lymPrHkgvgVqOV0d5ZB3auMSd1Onbf2R4f65pvY4ZAUXHvNeJZCDf6zcycNHBeFTw9NmXDC7NC3R2pZBrOqGcgmW93r3M0UGuZA6u1QgZDZD";
   data.description = "<?php echo $content->description; ?>";
   data.urlPhoto = "https://i.ibb.co/HCw9xBp/chien-luoc-crm-cac-cap-do-phat-trien-khach-hang.jpg";
   $("#sendtocustomer").click(function() {
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