
<?php init_head(); ?>
<?php $CI = & get_instance();?>

<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<div id="wrapper" >
    <div id="main-newsletter" class="content">
        <div class="row">
            <div class="col-md-12">
<h4><?php echo _l('call_statistics').": " . $results->total; ?> </h5>
	<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <?php 
if($idPage > 1){
	  echo "<a class='page-link' href='".base_url()."admin/callcenter/calllog/".($idPage-1)."''>Next</a>";
}else{
	echo "<a class='page-link' href='".base_url()."admin/callcenter/calllog/".($idPage)."''>Next</a>";
}
 ?>

    </li>
    <?php 
   
    for($i =($idPage-10); $i <= ($idPage+10); $i++){
    	if($i >= 1){
    		if($i == $idPage){
echo "<li class='page-item'><a class='page-link' style='
    background-color: #919191;' href='".base_url()."admin/callcenter/calllog/".$i."''>".$i."</a></li>";
    	}else{
    		echo "<li class='page-item'><a class='page-link' href='".base_url()."admin/callcenter/calllog/".$i."''>".$i."</a></li>";
    	}
    	}
    	

    }
    ?>
    <li class="page-item">

     <?php echo "<a class='page-link' href='".base_url()."admin/callcenter/calllog/".($idPage+1)."''>Next</a>" ?>
      
    </li>
  </ul>
</nav>
 
<div style="float: left; width: 80% ; ">
<?php echo form_open("admin/callcenter/searchCall",['class'=>'form-horizontal']);?>

	<label><?php echo _l('time_start');?></label>
<div class="input-group date" style="width: 16%" ><input type="text" id="startdate" name="startdate"  class="form-control datepicker" value='<?php 
if( strlen($_SESSION['keyStartTime']) < 5 ){
echo "ALL";
}else
echo date('Y/m/d',$_SESSION['keyStartTime']); ?>' aria-invalid="false">
	<div class="input-group-addon">
    <i style="" class="fa fa-calendar calendar-icon" ></i>
</div>
</div>
<br>
	<label><?php echo _l('time_end');?></label>
<div class="input-group date" style="width: 16%" ><input type="text" id="enddate" name="enddate" class="form-control datepicker" value='<?php 
if( strlen($_SESSION['keyEndTime']) < 5 ){
	echo "ALL";
}else
echo date('Y/m/d',$_SESSION['keyEndTime']) ?>' aria-invalid="false">
	<div class="input-group-addon">
    <i class="fa fa-calendar calendar-icon" ></i>
</div>
</div>
<br>

<?php 
$options = array(
''    => 'All',
'200' => 'OK',
'204' => 'No Notification',
'486' => 'Busy Here',
'487' => 'Request Terminated',
'201' => 'Accepted',
'480' => 'Temporarily Unavailable',
'404' => 'Not Found',
'484' => 'Address Incomplete',
'500' =>'Server Internal Error'
);

echo form_dropdown('Status', $options,set_value('Status', $_SESSION['keyState'] )   , 'class="form-control" style="width: 16%"');
echo form_error('Status','<div class="text-danger',
'</div>');
?>
<br>

<?php echo form_input(['name'=>'FromNumber','placeholder'=>'FromNumber','class'=>'form-control','value'=>$_SESSION['keyFromNumber'],'style'=>'width:16%']);?>
<?php echo form_error('FromNumber','<div class="text-danger',
'</div>');?>
<br>



<?php echo form_input(['name'=>'ToNumber','placeholder'=>'ToNumber','class'=>'form-control','value'=>$_SESSION['keyToNumber'],'style'=>'width:16%']);?>
<?php echo form_error('ToNumber','<div class="text-danger',
'</div>');?>
<br>


<?php echo form_submit(['name'=>'submit','value'=>'Search','class'=>'btn btn-info mright5 test pull-left display-block']);?>
<?php echo form_close();?>
          
     </div>

<div style="float: right;width: 80%;margin-top: -18.5%">
<table>
	<tr>

		<td>ID</td>
        <td>Porject</td>
        <td>User ID</td>
		<td><?php echo _l('from_number');?></td>
		<td><?php echo _l('to_number');?></td>
		<td><?php echo _l('direction');?></td>
        <td><?php echo _l('time_duration');?></td>
		<td><?php echo _l('Video call ');?></td>
        <td><?php echo _l('Amount ');?></td>
        <td><?php echo _l('recording');?></td>
		<td>Start time</td>
        <td>Answer time</td>
        <td>Stop time</td>

	</tr>
	<?php 
for ($i=0; $i < 50 ; $i++) { 
	if($dt[$i]->id != ""){
		$directions = "";
if ($dt[$i]->to_internal == 1) {
    if(load_admin_language() == "english"){
        $directions = "IncomingCall";
    }else{
        $directions = "Gọi đến";
    }
	
}else if($dt[$i]->from_internal == 3){
	if(load_admin_language() == "vietnamese"){
        $directions = "Gọi đi";
    }else{
        $directions = "CallAway";
    }
    
}
echo "<tr>
<td>" . $dt[$i]->id. "</td>
<td>" . $dt[$i]->project_id. "</td>
<td>" . $dt[$i]->from_user_id. "</td>
<td>" . $dt[$i]->from_number. "</td>
<td>" . $dt[$i]->to_number. "</td>
<td>" . $directions. "</td>
<td>" . $dt[$i]->duration. "</td>";
if($dt[$i]->duration > 0){
echo "<td> <a href='".$dt[$i]->recording_url."' target='_blank' >Mở file</a></td>";
}else if($dt[$i]->cdr_id != ""){
echo "<td></td>";
}
$stt = $dt[$i]->cause;
if($stt === "200"){
echo "<td style='color:#00af50'>OK</td>";
}else if ($stt === "204") {
	echo "<td style='color:#ff00de'>No Notification</td>";
}
else if ($stt === "486") {
	echo "<td style='color:#db2828'>Busy Here</td>";
}
else if ($stt === "487") {
	echo "<td style='color:#5f2c81'>Request Terminated</td>";
}else if($stt ==="201"){
	echo "<td style='color:#00af50'>Accepted</td>";
}else if($stt === "480"){
	echo "<td style='color:#db2828'>Temporarily Unavailable</td>";
}else if($stt === "404"){
	echo "<td style='color:#db2828'>Not Found</td>";
}
else if($stt === "484"){
	echo "<td style='color:#db2828'>Address Incomplete</td>";
}
else if($stt === "500"){
    echo "<td style='color:#7c00ff'>Server Internal Error</td>";
}
else{
	echo "<td>Update Info Cause: ".$stt."</td>";
}
echo "<td>".date('D m/d/Y H:i:s', $dt[$i]->time_started)."</td>";
echo "</tr>";
	
	}
}
	?>
</table>
</div>
<?php echo form_close();?>
          
            </div>
        </div>
    </div>
</div>
<div id="new_version"></div>
        
<?php init_tail(); ?>