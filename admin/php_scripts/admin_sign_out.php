<?php
$result=false;
if(isset($_POST['flag'])){
    session_start();
    session_unset();
    $result=true;
}
echo json_encode($result)
?>