<?php init_head();?>
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
                     <?php echo form_open($this->uri->uri_string(), array('id' => 'content-form')); ?>
                        <h3 class="no-margin">
                            <?php echo $title; ?>
                           </h3>

                        <hr class="hr-panel-heading" />
                         <div class="checkbox checkbox-primary checkbox-inline">
                        <input type="checkbox" name="status" id="status" <?php if (isset($content)) {if ($content->status == 2) {echo 'checked';}}
;?>>

                     </div>

                        <?php $value = (isset($content) ? $content->subject : '');?>

                  <?php echo render_input('subject', 'content_title', $value); ?>

                  <?php $value = (isset($content) ? $content->task_title : '');?>
                         <?php
echo render_select('task_title', $tasksCustom, array('id', 'name'), 'task_title', $value);
?>

                      <!-- fix save id -->
                    <div style="display: none;">
                       <?php $value = (isset($content) ? $content->assignto : '');?>
                       <?php echo render_input('assignto', 'assignto', $value); ?>
                    </div>
                      <!-- end fix save id -->


                    <!-- fix save id project -->
                    <div style="display: none;">
                       <?php $value = (isset($content) ? $content->project_id : '');?>
                       <?php echo render_input('project_id', 'project_id', $value); ?>
                    </div>
                      <!-- end fix save id project -->
                     <div class="row">
                        <div style="pointer-events: none;" class="col-md-6">
                           <?php $value = (isset($content) ? _d($content->datestart) : _d(date('Y-m-d')));?>
                           <?php echo render_date_input('datestart', 'contract_start_date', $value); ?>
                        </div>
                        <div style="pointer-events: none;" class="col-md-6">
                           <?php $value = (isset($content) ? _d($content->dateend) : '');?>
                           <?php echo render_date_input('dateend', 'contract_end_date', $value); ?>
                        </div>
                     </div>
                     <?php $value = (isset($content) ? $content->description : '');?>

                     <?php echo render_textarea('description', 'content_description', $value, array(), array(), '', 'tinymce'); ?>
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
<?php init_tail();?>


<script type="text/javascript">
$("#submitdraft").click(function() {
    var inputs = document.querySelector('#status');
    inputs.checked = true;
});
    _validate_form($('#content-form'), {
       task_title: 'required',
       subject:'required'
    });


  $( "#task_title" )
  .change(function () {
    var str = "";
    var task_id = $( "#task_title option:selected" ).val();
    console.log(task_id);

    $.getJSON("get_task_json", {task_id: task_id}, function(resp){
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
  body.content{
    padding-left: 0;
    padding-top: 0;
  }
</style>
</body>
</html>
