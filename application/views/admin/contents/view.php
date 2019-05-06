<?php init_head();?>
<link href='<?php echo base_url('assets/plugins/editor/vendor/emoji-picker/lib/css/emoji.css'); ?>' rel='stylesheet' />
<link href='<?php echo base_url('assets/plugins/editor/style2.css'); ?>' rel="stylesheet">
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
                              <td class="bold"><?php echo _l('content_description'); ?></td>
                              <!-- <td><?php //echo $content->description; ?></td> -->
							                
                           </tr>
                        </tbody>
                     </table>
                      <div id="output"></div>
                        <?php if ($content->status == 1) {?>

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
                        <?php } else {?>
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


                       <?php }?>
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

                            for (var i = 0; (i < data.length); i++)
                            {
                                
                                    comments = data[i]['description'] ;
                                   
                            }
                           
                            $("#output").html(comments);
                        });
            }

      

         

        </script>
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