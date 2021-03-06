<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
          <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                     <div class="_buttons">
                        <a href="#" class="btn btn-info pull-left" data-toggle="modal" data-target="#customer_field_modal"><?php echo _l('new_customer_field'); ?></a>
                    </div>
                    <div class="clearfix"></div>
                    <hr class="hr-panel-heading" />
                    <div class="clearfix"></div>
                    <?php render_datatable(array(_l('customer_field_name'),_l('options'), ),'customer-fields'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/clients/client_group'); ?>
<?php init_tail(); ?>
<script>
   $(function(){
        initDataTable('.table-customer-fields', window.location.href, [1], [1]);
   });
</script>
</body>
</html>
