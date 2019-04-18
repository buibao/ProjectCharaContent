<?php init_head(); ?>
<?php $CI = & get_instance();?>
<div id="wrapper" >
    <div id="main-newsletter" class="content">
        <div class="row">
            <div class="col-md-12">


<?php echo form_open("admin/callcenter/changeVHT",['class'=>'form-horizontal']);?>
<h4>Ext</h4>
<?php echo form_input(['name'=>'Ext','placeholder'=>'VHT User Name','class'=>'form-control','value'=>set_value('Ext',$users->Ext),'style'=>'width:20%']);?>
<?php echo form_error('Ext','<div class="text-danger',
'</div>');?>
<h4>Pass</h4>
<?php echo form_input(['name'=>'Pass','placeholder'=>'VHT Pass','class'=>'form-control','value'=>set_value('Pass',$users->Pass),'style'=>'width:20%']);?>
<?php echo form_error('Pass','<div class="text-danger',
'</div>');?>
<h4>API Key</h4>
	<?php echo form_input(['name'=>'APIKey','placeholder'=>'API Key','class'=>'form-control','value'=>set_value('APIKey',$users->APIKey),'style'=>'width:20%']);?>
<?php echo form_error('APIKey','<div class="text-danger',
'</div>');?>
<h4>API Secret</h4>
<?php echo form_input(['name'=>'APISecret','placeholder'=>'API Secret','class'=>'form-control','value'=>set_value('APISecret',$users->APISecret),'style'=>'width:20%']);?>
<?php echo form_error('APISecret','<div class="text-danger',
'</div>');?>


	<br>
<?php echo form_submit(['name'=>'submit','value'=>'Update','class'=>'btn btn-info mright5 test pull-left display-block']);?>

<?php echo form_close();?>
          
            </div>
        </div>
    </div>
</div>
<div id="new_version"></div>
<?php init_tail(); ?>