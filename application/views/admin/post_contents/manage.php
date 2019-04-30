<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="panel_s">
          <!-- add breadcrumb -->
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page"><?php echo _l('post_content'); ?></li>
            </ol>
          </nav>
          
          <div class="panel-body">
            <div class="_buttons">
            <?php echo form_open(); ?>
            <div class="col-md-1 ">
            <button id="popoverId" class="btn btn-primary">Add Token</button>
            </div>
            <div class="col-md-10 ">
            <?php echo render_input('tokenAccess','',$value); ?>
            </div>

            
            <?php echo form_close(); ?>  
            </div>
            <div class="clearfix"></div>
            <hr class="hr-panel-heading" />
            <?php $where_own = array();
            if (!has_permission('contents', '', 'view')) {
              $where_own = array('addedfrom' => get_staff_user_id());
            }
            ?>
            <div class="row" id="content_summary">
              <div class="col-md-12">
                <h4 class="no-margin text-success"><?php echo _l('summary_heading'); ?></h4>
              </div>
              <br />
              <br />
              <div class="col-md-2 col-xs-4 border-right">
                <h3 class="bold"><?php echo total_rows('tblcontents', array_merge(array('status' => 4), $where_own)) + total_rows('tblcontents', array_merge(array('status' => 5), $where_own)); ?></h3>
                <span class="bold text-primary"><?php echo _l('total_content'); ?></span>
              </div>
              <div class="col-md-2 col-xs-4 border-right">
                <h3 class="bold"><?php echo total_rows('tblcontents', array_merge(array('status' => 4), $where_own)); ?></h3>
                <span class="bold text-info"><?php echo _l('waiting_for_posting'); ?></span>
                <div class="clearfix"></div>

              </div>
              <div class="col-md-2 col-xs-4 border-right">
                <h3 class="bold"><?php echo total_rows('tblcontents', array_merge(array('status' => 5), $where_own)); ?></h3>
                <span class="bold text-success"><?php echo _l('posted'); ?></span>
                <div class="clearfix"></div>

              </div>
              
             
              <div class="clearfix"></div>
              <hr class="hr-panel-heading" />
              <!-- end fix -->

              <?php echo form_hidden('custom_view'); ?>
              <?php $this->load->view('admin/post_contents/table_html'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php init_tail(); ?>
  <script>
    $(function() {

      var ContentsServerParams = {};

      initDataTable('.table-post_contents', admin_url + 'post_contents/table', undefined, undefined, ContentsServerParams, <?php echo do_action('post_contents_table_default_order', json_encode(array(5, 'asc'))); ?>);
    });
  </script>

  </body>

  </html>
  <script>
    $('#popoverId').click(function(e) {
        var data = {};
        data.token = $("#tokenAccess").val();
        $.post(admin_url + 'post_contents/update_token', data).done(function(response) {
         response = JSON.parse(response);
         if (response.success == true) {
            alert_float('success', response.message);
         } else {
            alert_float('danger', response.message);
         }
      });
    });
  </script>