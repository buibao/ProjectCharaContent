
<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
            <div class="panel_s">
                                    <!-- add breadcrumb -->
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><?php echo _l('content'); ?></li>
                      </ol>
                    </nav>

              <div class="panel-body">
              <div class="_buttons">
              <?php if(has_permission('contents','','create')){ ?>
                <a href="<?php echo admin_url('contents/content'); ?>" class="btn btn-info pull-left display-block">
                  <?php echo _l('new_content'); ?>
                </a>
              <?php } ?>
               <div class="clearfix"></div>
                    <hr class="hr-panel-heading" />
                    <div class="row" id="contract_summary">

                        <?php $minus_7_days = date('Y-m-d', strtotime("-7 days")); ?>
                        <?php $plus_7_days = date('Y-m-d', strtotime("+7 days"));
                        $where_own = array();
                        if(!has_permission('contents','','view')){
                            $where_own = array('addedfrom'=>get_staff_user_id());
                        }
                        ?>
                        <div class="col-md-12">
                            <h4 class="no-margin text-success"><?php echo _l('content_summary_heading'); ?></h4>
                        </div>
                        <div class="col-md-2 col-xs-6 border-right">
                            <h3 class="bold">
                            <?php echo total_rows('tblcontents'); ?>
                            </h3>
                            <span class="text-info"><?php echo _l('contract_summary_active'); ?></span>
                        </div>
                      <div class="clearfix"></div>
               </div>
             <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="panel_s">
          <div class="panel-body">
              <hr class="hr-panel-heading" />
             <?php echo form_hidden('custom_view'); ?>
             <?php $this->load->view('admin/contents/table_html'); ?>
          </div>
      </div>
    </div>
  </div>
</div>

<?php init_tail(); ?>
<script>
    $(function(){

        var ContentsServerParams = {};
        
        initDataTable('.table-contents', admin_url+'contents/table', undefined, undefined, ContentsServerParams,<?php echo do_action('contents_table_default_order',json_encode(array(5,'asc'))); ?>);

        
       
    });
</script>
</body>
</html>
