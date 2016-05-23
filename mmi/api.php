<?php
include("db_connect.php");
if($_POST["km"]){
    $km = $_POST["km"];
    $steps = $_POST["steps"];

    $arr1=array('result1'=>$km,'result2'=>'efg');
    $stamp = time();
    $sql = "INSERT INTO steps VALUES($steps, $km, $stamp)";
    $result = $conn->query($sql);

    echo (json_encode($arr1));
}
else{
    $sql = "Select * from steps order by date DESC";
    $result = $conn->query($sql);
    $output = array("data" => array() );
    while ($row = $result->fetch_assoc()) {
        $output['data'][] = $row;
    }
    echo json_encode($output);

}
