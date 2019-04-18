<div class="mtop30">
   <div class="mbot30">
      <?php echo get_dark_company_logo(); ?>
   </div>
   <h4 class="pull-left no-mtop"><?php echo $content->subject; ?><br />
     
   </h4>
   <div class="visible-xs">
      <div class="clearfix"></div>
   </div>
      <!-- <button onclick="press(this)" class="btn btn-success pull-right"><?php echo _l('approvecontent'); ?></button> -->
<?php if($content->status == 3) { ?>
   <?php echo form_open($this->uri->uri_string()); ?>
     <button  class="btn btn-success pull-right"><?php echo _l('approvecontent'); ?></button>
     <?php echo form_hidden('action','approval4'); ?>
        <?php echo form_close(); ?>
   <?php echo form_open($this->uri->uri_string()); ?>
     <button style="margin-right: 5px; background-color: #03a9f4;"  class="btn btn-success pull-right"><?php echo _l('rewrite'); ?></button>
     <?php echo form_hidden('action','approval1'); ?>
        <?php echo form_close(); ?>
        <?php } else { ?>
            <span class="success-bg content-view-status"><?php echo _l('approvedcontent'); ?></span>
         <?php } ?>
   <div class="clearfix"></div>
   <div class="row">
      <div class="col-md-8">
         <div class="panel_s mtop20">
            <div class="panel-body tc-content padding-30">
               <?php echo $content->description; ?>
            </div>
         </div>
      </div>
      <div class="col-md-4">
         <div class="mtop20">
            <ul class="nav nav-tabs nav-tabs-flat mbot15" role="tablist">
               <li role="presentation" class="<?php if(!$this->input->get('tab') || $this->input->get('tab') === 'summary'){echo 'active';} ?>">
                  <a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">
                  <i class="fa fa-file-text-o" aria-hidden="true"></i> <?php echo _l('summary'); ?></a>
               </li>
               <li role="presentation" class="<?php if($this->input->get('tab') === 'discussion'){echo 'active';} ?>">
                  <a href="#discussion" aria-controls="discussion" role="tab" data-toggle="tab">
                   <i class="fa fa-commenting-o" aria-hidden="true"></i> <?php echo _l('discussion'); ?>
                  </a>
               </li>
            </ul>
            <div class="tab-content">
               <div role="tabpanel" class="tab-pane<?php if(!$this->input->get('tab') || $this->input->get('tab') === 'summary'){echo ' active';} ?>" id="summary">
                  <address>
                     <?php echo format_organization_info(); ?>
                  </address>
                  <div class="row mtop20">
                     <?php if($contract->contract_value != 0){ ?>
                     <div class="col-md-12 contract-value">
                        <h4 class="bold mbot30">
                           <?php echo _l('contract_value'); ?>:
                           <?php echo format_money($contract->contract_value,$this->currencies_model->get_base_currency()->symbol); ?>
                        </h4>
                     </div>
                     <?php } ?>
                     <div class="col-md-4 text-muted contract-number">
                        #
                     </div>
                     <div class="col-md-8 contract-number">
                        <?php echo $content->id; ?>
                     </div>
                     <div class="col-md-4 text-muted contract-start-date">
                        <?php echo _l('contract_start_date'); ?>
                     </div>
                     <div class="col-md-8 contract-start-date">
                        <?php echo _d($content->datestart); ?>
                     </div>
                     <?php if(!empty($content->dateend)){ ?>
                     <div class="col-md-4 text-muted contract-end-date">
                        <?php echo _l('contract_end_date'); ?>
                     </div>
                     <div class="col-md-8 contract-end-date">
                        <?php echo _d($content->dateend); ?>
                     </div>
                     <?php } ?>
                     <?php if(!empty($contract->type_name)){ ?>
                     <div class="col-md-4 text-muted contract-type">
                        <?php echo _l('contract_type'); ?>
                     </div>
                     <div class="col-md-8 contract-type">
                        <?php echo $contract->type_name; ?>
                     </div>
                     <?php } ?>
                     <?php if($contract->signed == 1){ ?>
                     <div class="col-md-4 text-muted contract-type">
                        <?php echo _l('date_signed'); ?>
                     </div>
                     <div class="col-md-8 contract-type">
                        <?php echo _d(explode(' ', $contract->acceptance_date)[0]); ?>
                     </div>
                     <?php } ?>
                  </div>
                  <?php if(count($contract->attachments) > 0){ ?>
                  <div class="contract-attachments">
                     <div class="clearfix"></div>
                     <hr />
                     <p class="bold mbot15"><?php echo _l('contract_files'); ?></p>
                     <?php foreach($contract->attachments as $attachment){
                        $attachment_url = site_url('download/file/contract/'.$attachment['attachment_key']);
                        if(!empty($attachment['external'])){
                           $attachment_url = $attachment['external_link'];
                        }
                        ?>
                     <div class="col-md-12 row mbot15">
                        <div class="pull-left"><i class="<?php echo get_mime_class($attachment['filetype']); ?>"></i></div>
                        <a href="<?php echo $attachment_url; ?>"><?php echo $attachment['file_name']; ?></a>
                     </div>
                     <?php } ?>
                  </div>
                  <?php } ?>
               </div>
              
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   get_template_part('identity_confirmation_form',array('formData'=>form_hidden('action','sign_contract')));
?>
<script>
function press(obj) {
  obj.style.backgroundColor = "#ff0000";
  obj.innerHTML = <?php echo _l('approvecontent'); ?>;
}

</script>

