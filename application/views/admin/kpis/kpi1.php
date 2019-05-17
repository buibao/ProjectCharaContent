<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="_filters _hidden_inputs hidden">
                    <?php
                    echo form_hidden('my_customers');
                    echo form_hidden('requires_registration_confirmation');
                    foreach($groups as $group){
                       echo form_hidden('customer_group_'.$group['id']);
                   }
                   foreach($contract_types as $type){
                       echo form_hidden('contract_type_'.$type['id']);
                   }
                   foreach($invoice_statuses as $status){
                       echo form_hidden('invoices_'.$status);
                   }
                   foreach($estimate_statuses as $status){
                       echo form_hidden('estimates_'.$status);
                   }
                   foreach($project_statuses as $status){
                    echo form_hidden('projects_'.$status['id']);
                }
                foreach($proposal_statuses as $status){
                    echo form_hidden('proposals_'.$status);
                }
                foreach($customer_admins as $cadmin){
                    echo form_hidden('responsible_admin_'.$cadmin['staff_id']);
                }
                foreach($countries as $country){
                    echo form_hidden('country_'.$country['country_id']);
                }
                ?>
            </div>
            <div class="panel_s">
                <div class="panel-body">
                  
                                    <hr class="hr-panel-heading" />
                                    <div class="row mbot15">
                                        <div class="col-md-12">
                                                 <h4 class="no-margin"><?php echo 'KPI Reports'; ?></h4> 
                                        </div>

                                         <div class="col-md-2 col-xs-6 border-right">
                                            <h3 class="bold"><?php echo $GLOBALS['LeaderFullname']; ?></h3>
                                            <span   ><?php echo 'Name'; ?></span>
                                        </div>
                                        <div class="col-md-2 col-xs-6 border-right">
                                            <h3 class="bold"><?php echo  $GLOBALS['totalMembers']; ?></h3>
                                            <span class="text-success"><?php echo 'Total Members'; ?></span>
                                        </div>
                                        <div class="col-md-2 col-xs-6 border-right">
                                            <h3 class="bold"><?php echo       $GLOBALS['LeaderContents']; ?></h3>
                                            <span class="text-success"><?php echo 'Personal Contents'; ?></span>
                                        </div>
                                        <div class="col-md-2 col-xs-6 border-right">
                                            <h3 class="bold"><?php echo  $GLOBALS['memberTeamContent']; ?></h3>
                                            <span class="text-success"><?php echo 'Team Contents'; ?></span>
                                        </div>
                                        <div class="col-md-2 col-xs-6 border-right">
                                            <h3 class="bold"><?php echo  $GLOBALS['LeaderKPI']; ?></h3>
                                            <span class="text-success"><?php echo 'Personal KPI'; ?></span>
                                        </div>
                                        <div class="col-md-2 col-xs-6 ">
                                            <h3 class="bold"><?php echo   $GLOBALS['LeaderTeamKPI']; ?></h3>
                                            <span class="text-success"><?php echo ('Team KPI'); ?></span>
                                        </div>
                                        </div>
                                       
                    </div>
                </div>

                <div class="panel_s">
          <div class="panel-body">
           <?php if(has_permission('kpi','','edit')){ ?>
           <?php echo form_open("admin/KPI/",['class'=>'form-horizontal']);?>
<div class="dataTables_length" id="DataTables_Table_0_length">
<?php echo form_input(['name'=>'Target','placeholder'=>'Change Target KPI','class'=>'form-control input','aria-controls'=>'DataTables_Table_0','value'=>set_value('Target',''),'style'=>'
    height: inherit;']);?>
</div>
<?php echo form_close();?>
            <?php } ?>

            <div class="clearfix"></div>
            <?php
            $table_data = array(
              'Leader',
                         
                           'Name',
                          'Total Member',
                         'Personal Contents',
                          'Team Contents',
                         'Personal KPI',
                         'Team KPI',
                         // 'Due Date'
              );
           
            render_datatable($table_data,'staff');
            ?>


          </div>
        </div>


            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>
<script>
  $(function(){

    initDataTable('.table-staff', window.location.href);
     document.getElementsByClassName("dataTables_info")[0].remove();
     document.getElementsByClassName("dataTables_length")[1].remove();
     document.getElementsByClassName("dataTables_paginate paging_simple_numbers")[0].remove();
  });
  function delete_staff_member(id){
    $('#delete_staff').modal('show');
    $('#transfer_data_to').find('option').prop('disabled',false);
    $('#transfer_data_to').find('option[value="'+id+'"]').prop('disabled',true);
    $('#delete_staff .delete_id input').val(id);
    $('#transfer_data_to').selectpicker('refresh');

  }
</script>
<script>
document.getElementsByClassName("dataTables_info")[0].remove();
</script>
</body>
</html>
