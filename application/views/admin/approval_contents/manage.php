<?php init_head();?>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
            <div class="panel_s">
                                  <!-- add breadcrumb -->
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><?php echo _l('approval_content'); ?></li>
                      </ol>
                    </nav>

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
             <?php echo form_hidden('custom_view'); ?>
             <?php $this->load->view('admin/approval_contents/table_html');?>
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
        initDataTable('.table-approval_contents', admin_url+'approval_contents/table', undefined, undefined, ContentsServerParams,<?php echo do_action('approval_contents_table_default_order', json_encode(array(5, 'asc'))); ?>);
    });
</script>
</body>
</html>