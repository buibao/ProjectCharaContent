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
          <div>
      
          <!--Form Token-->
          <div id="myForm" class="hide">
            <form action="/echo/html/" id="popForm" method="post">
              <div>
                <div class="input-group">
                <input type="text" name="email" id="email" class="form-control input-md">
                </div>
              </div>
              <div class="pull-left" style="margin-right:5px">
                <button class="btn btn-primary" type="submit" >Save</button>
              </div>
              
              </div>
            </form>
          </div>
          <div class="panel-body">
            <div class="_buttons">
              <button class="btn btn-primary" id="btntoken">Add Token</button>
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
                <h4 class="no-margin text-success"><?php echo _l('content_summary_heading'); ?></h4>
              </div>
              <br />
              <br />
              <div class="col-md-2 col-xs-4 border-right">
                <h3 class="bold">
                  <?php echo total_rows('tblcontents') ?>
                </h3>
                <span class="bold text-primary"><?php echo _l('total_content'); ?></span>
              </div>
              <div class="col-md-2 col-xs-4 border-right">
                <h3 class="bold"><?php echo total_rows('tblcontents', array_merge(array('status' => 1), $where_own)); ?></h3>
                <span class="bold text-info"><?php echo _l('draft'); ?></span>
                <div class="clearfix"></div>

              </div>
              <div class="col-md-2 col-xs-4 border-right">
                <h3 class="bold"><?php echo total_rows('tblcontents', array_merge(array('status' => 2), $where_own)); ?></h3>
                <span class="bold text-success"><?php echo _l('waiting_for_leader'); ?></span>
                <div class="clearfix"></div>

              </div>
              <div class="col-md-2 col-xs-4 border-right">
                <h3 class="bold"><?php echo total_rows('tblcontents', array_merge(array('status' => 3), $where_own)); ?></h3>
                <span class="bold text-warning"><?php echo _l('waiting_for_customer'); ?></span>
                <div class="clearfix"></div>

              </div>
              <div class="col-md-2 col-xs-4 border-right">
                <h3 class="bold"><?php echo total_rows('tblcontents', array_merge(array('status' => 4), $where_own)); ?></h3>
                <span class="bold" style="color:#5f00bf;"><?php echo _l('approvedcontent'); ?></span>
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
    $(document).ready(function () {
    $('#example').popover();
    })
  </script>
  <script>
    $(function(){
    $('#btntoken').popover({
        placement: 'bottom',
        html:true,
        content:  $('#myForm').html()
    }).on('click', function(){
      
      $('.btn-primary').click(function(){
       $('#result').after("form submitted by " + $('#email').val())
        $.post('/echo/html/',  {
            email: $('#email').val(),
            name: $('#name').val(),
            gender: $('#gender').val()
        }, function(r){
          $('#pops').popover('hide')
          $('#result').html('resonse from server could be here' )
        })
      })
  })
})
  </script>
  </body>

  </html>