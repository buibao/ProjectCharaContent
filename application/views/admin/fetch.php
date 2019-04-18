<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "devnew");
$query = "
 SELECT * FROM tblstaff
";
$result = $data;
//$output = array();
while($row = mysqli_fetch_array($result))
{
 $sub_data["staffid"] = $row["staffid"];
 $sub_data["firstname"] = $row["firstname"];
 $sub_data["leader_id"] = $row["leader_id"];
 $data[] = $sub_data;
}
foreach($data as $key => &$value)
{
 $output[$value["staffid"]] = &$value;
}
foreach($data as $key => &$value)
{
 if($value["leader_id"] && isset($output[$value["leader_id"]]))
 {
  $output[$value["leader_id"]]["nodes"][] = &$value;
 }
}
foreach($data as $key => &$value)
{
 if($value["leader_id"] && isset($output[$value["leader_id"]]))
 {
  unset($data[$key]);
 }
}
echo json_encode($data);
/*echo '<pre>';
print_r($data);
echo '</pre>';*/

?>
