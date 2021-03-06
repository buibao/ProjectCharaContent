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
                     <?php echo form_open($this->uri->uri_string(),array('id'=>'content-form')); ?>
                        <h3 class="no-margin">
                            <?php echo $title; ?>
                           </h3>

                        <hr class="hr-panel-heading" />
                         <div class="checkbox checkbox-primary checkbox-inline">
                        <input type="checkbox" name="status" id="status" <?php if(isset($content)){if($content->status == 2){echo 'checked';}}; ?>>
                        
                     </div>

                        <?php $value = (isset($content) ? $content->subject : ''); ?>
                  
                  <?php echo render_input('subject','content_title',$value); ?>

                  <?php $value = (isset($content) ? $content->task_title : ''); ?>
                         <?php
                           echo render_select('task_title',$tasksCustom,array('id','name'),'task_title',$value); 
                           ?> 
                           
                     <div class="row">
                        <div class="col-md-6">
                           <?php $value = (isset($content) ? _d($content->datestart) : _d(date('Y-m-d'))); ?>
                           <?php echo render_date_input('datestart','contract_start_date',$value); ?>
                        </div>
                        <div class="col-md-6">
                           <?php $value = (isset($content) ? _d($content->dateend) : ''); ?>
                           <?php echo render_date_input('dateend','contract_end_date',$value); ?>
                        </div>
                     </div>
                     <?php $value = (isset($content) ? $content->description : ''); ?>
                     <!-- <?php echo render_textarea('description','kb_article_description',$value,array('rows'=>10,array(),'','tinymce')); ?> -->
                     <?php echo render_textarea('description','content_description',$value,array(),array(),'','tinymce'); ?>
                     <?php $rel_id = (isset($content) ? $content->id : false); ?>
                     <!-- <?php echo render_custom_fields('content',$rel_id); ?> -->
                 
                     <div class="btn-bottom-toolbar text-right">
                        <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
                         
                         <button class="btn-tr btn btn-default " id="submitdraft">
                     <?php echo _l('submitdraft'); ?>
                     </button>
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
       task_title: 'required'
       
    });
</script>
</body>
</html>
