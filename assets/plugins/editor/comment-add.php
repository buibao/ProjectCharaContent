<?php
require_once ("db.php");
$commentId = isset($_POST['comment_id']) ? $_POST['comment_id'] : "";
$comment = isset($_POST['description']) ? $_POST['description'] : "";
$commentSenderName = isset($_POST['name']) ? $_POST['name'] : "";
$subject = isset($_POST['subject']) ? $_POST['subject'] : "";
$date = date('Y-m-d H:i:s');

$query = "INSERT INTO tblcontents(description) VALUES (?)";

$sql_stmt = $conn->prepare($query);
// d = number -- s = string
$param_type = "s";
$param_value_array = array(
    $comment,
   
);
$param_value_reference[] = & $param_type;
for ($i = 0; $i < count($param_value_array); $i ++) {
    $param_value_reference[] = & $param_value_array[$i];
}
call_user_func_array(array(
    $sql_stmt,
    'bind_param'
), $param_value_reference);

$sql_stmt->execute();
?>
