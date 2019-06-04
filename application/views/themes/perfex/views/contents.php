<div class="panel_s">
    <div class="panel-body">
        <h4 class="no-margin"><?php echo _l('clients_contents'); ?></h4>
    </div>
</div>
<div class="panel_s">
    <div class="panel-body">

        <div class="clearfix"></div>
        <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Library</li>
  </ol>
</nav>
        <table class="table dt-table table-contracts" data-order-col="4" data-order-type="asc">
            <thead>
                <tr>
                    <th><?php echo _l('clients_contracts_dt_subject'); ?></th>
                    <th><?php echo _l('content_status'); ?></th>
                    <th><?php echo _l('clients_contracts_dt_start_date'); ?></th>
                    <th><?php echo _l('clients_contracts_dt_end_date'); ?></th>
                    <?php
                    $custom_fields = get_custom_fields('contents',array('show_on_client_portal'=>1));
                    foreach($custom_fields as $field){ ?>
                    <th><?php echo $field['name']; ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($contents as $content){
                   if (($content['status'] == 3 || $content['status'] == 4 || $content['status'] == 5) && $content['clientid'] == get_client_user_id()) {
                    $expiry_class = '';
                    if (!empty($content['dateend'])) {
                        $_date_end = date('Y-m-d', strtotime($content['dateend']));
                        if ($_date_end < date('Y-m-d')) {
                            $expiry_class = 'alert-danger';
                        }
                    }
                    ?>
                    <tr class="<?php echo $expiry_class; ?>">
                        <td>
                            <?php
                            echo '<a href="'.site_url('content/'.$content['id'].'/'.$content['hash']).'">'.$content['subject'].'</a>';
                            ?>
                        </td>
                       
                        <td>
                         
                             <?php
                            if($content['status'] ==4) {
                               echo '<span class="text-success" style="border:1px solid;border-radius: 4px 4px 4px 4px">' . _l('approvecontent') . '</span>';
                           } else if ($content['status'] ==3) {
                               echo '<span class="bold" style="color:#FFA500;border:1px solid;border-radius: 4px 4px 4px 4px" >' . _l('waiting_for_customer') . '</span>';
                           }else if ($content['status'] ==5) {
                               echo '<span class="bold" style="color:#FFA500;border:1px solid;border-radius: 4px 4px 4px 4px" >' . _l('approvedcontent') . '</span>';
                           }
                           ?>                        </td>
                       <td data-order="<?php echo $content['datestart']; ?>"><?php echo _d($content['datestart']); ?></td>
                       <td data-order="<?php echo $content['dateend']; ?>"><?php echo _d($content['dateend']); ?></td>
                       <?php foreach($custom_fields as $field){ ?>
                       <td><?php echo get_custom_field_value($content['id'],$field['id'],'contents'); ?></td>
                       <?php } ?>
                   </tr>
                   <?php } ?>
                <?php } ?>  
                    
               </tbody>
           </table>
       </div>
   </div>
