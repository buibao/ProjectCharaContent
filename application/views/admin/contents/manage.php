<?php init_head();?>
<div id="wrapper">
  <div class="content">
     <div class="row">
      <div class="col-md-12">
            <div class="panel_s">
              <div class="panel-body">
              <div class="_buttons">

              <?php if (has_permission('contents', '', 'create')) {?>
                <a href="<?php echo admin_url('contents/content'); ?>" class="btn btn-info pull-left display-block">
                  <?php echo _l('new_content'); ?>
                </a>
              <?php }?>
               </div>
             <div class="clearfix"></div>
              <hr class="hr-panel-heading" />

                            <!-- fix  -->
                     <?php $where_own = array();
if (!has_permission('contents', '', 'view')) {
	$where_own = array('addedfrom' => get_staff_user_id());
}
?>
                        <div class="row" id="content_summary">
                        <div class="col-md-12">
                            <h4 class="no-margin text-success"><?php echo _l('content_summary_heading'); ?></h4>
                        </div>
                        <div class="col-md-2 col-xs-6 border-right">
                            <h3 class="bold">
                            <?php echo total_rows('tblcontents') ?>
                            </h3>
                            <span class="bold text-primary"><?php echo _l('total_content'); ?></span>
                        </div>
                         <div class="col-md-2 col-xs-6 border-right">
                             <h3 class="bold"><?php echo total_rows('tblcontents', array_merge(array('status' => 1), $where_own)); ?></h3>
                                    <span class="bold text-info"><?php echo _l('draft'); ?></span>
                                <div class="clearfix"></div>
                                <hr class="hr-panel-heading" />
                            </div>
                            <div class="col-md-2 col-xs-6 border-right">
                             <h3 class="bold"><?php echo total_rows('tblcontents', array_merge(array('status' => 2), $where_own)); ?></h3>
                                    <span class="bold text-success"><?php echo _l('waiting_for_leader'); ?></span>
                                <div class="clearfix"></div>
                                <hr class="hr-panel-heading" />
                            </div>
                            <div class="col-md-2 col-xs-6 border-right">
                             <h3 class="bold"><?php echo total_rows('tblcontents', array_merge(array('status' => 3), $where_own)); ?></h3>
                                    <span class="bold text-warning"><?php echo _l('waiting_for_customer'); ?></span>
                                <div class="clearfix"></div>
                                <hr class="hr-panel-heading" />
                            </div>
                            <div class="col-md-2 col-xs-6 border-right">
                             <h3 class="bold"><?php echo total_rows('tblcontents', array_merge(array('status' => 4), $where_own)); ?></h3>
                                    <span class="bold" style="color:#5f00bf;"><?php echo _l('approvedcontent'); ?></span>
                                <div class="clearfix"></div>
                                <hr class="hr-panel-heading" />
                            </div>
              <!-- end fix -->
             <?php echo form_hidden('custom_view'); ?>
             <?php $this->load->view('admin/contents/table_html');?>
          </div>
        </div>
      </div>
    </div>
   </div>
</div>

<?php init_tail();?>
<script>
    $(function(){
        var ContentsServerParams = {};
        initDataTable('.table-contents', admin_url+'contents/table', undefined, undefined, ContentsServerParams,<?php echo do_action('contents_table_default_order', json_encode(array(5, 'asc'))); ?>);
    });
</script>
</body>
</html>