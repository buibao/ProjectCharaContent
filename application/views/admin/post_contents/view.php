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
                         
                           <tr>
                              <td class="bold"><?php echo _l('assign_to'); ?></td>
                              <td><?php echo $content->assign_to; ?></td>
                           </tr>
                           <tr>
                              <td class="bold"><?php echo _l('content_description'); ?></td>
                               <td id="output"></td>
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
<script src='<?php echo base_url('assets/plugins/editor/vendor/emoji-picker/lib/js/config.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/editor/vendor/emoji-picker/lib/js/util.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/editor/vendor/emoji-picker/lib/js/jquery.emojiarea.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/editor/vendor/emoji-picker/lib/js/emoji-picker.js'); ?>'></script>
<script>

            $(document).ready(function () {
                listComment();
            });

            function listComment() {
                $.post("",
                        function (data) {
                          var datarecieve = '<?php echo $jsonData ?>';
                          console.log(JSON.stringify(datarecieve));
                          // console.log(datarecieve);
                          datarecieve = datarecieve.replace(/\n/g, "<br\>")  
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

                            for (var i = 0; (i < data.length); i++)
                            {
                                
                                    comments = data[i]['description'] ;
                                   
                            }
                           
                            $("#output").html(comments);
                        });
            }

      

         

        </script>
<script type="text/javascript">
  var data = {};
  data.id = "<?php echo $content->id; ?>";
  data.id_page = "<?php echo $fanpage_id; ?>";
  data.user_access_token = "EAAJGSplFaE0BAIb2ZCCrT7bjiqgTV31k0twL1amMqa0kNWez0RLWF7xgdo360tFod5cddm8f8WPF0y5SGn9uT9mfZBJ99ZCbdVbVT3TvbFTINi5C7vCalbadUbiM7PneyV9EXNzsfeZAxUYs6OJzahYStOILNNh9U8AkWnB0PamL2ZBljnm5bowwAVBMv9FoZD";

                var datarecieve1 = '<?php echo $jsonData ?>';
                datarecieve1 = datarecieve1.replace(/\n/g, "\\n")  
               .replace(/\r/g, "\\r")
               .replace(/\t/g, "\\t")
               .replace(/\f/g, "\\f");          

            var data1 = JSON.parse(datarecieve1);

  data.description = data1[0]['description'];
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