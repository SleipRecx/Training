<?php
include("db_connection.php");
if($_POST["weight"]){
    $kg = floatval($_POST["weight"]);
    $arr1=array('result1'=>$kg,'result2'=>'efg');
    $stamp = time();
    $sql = "INSERT INTO stats(personid_fk,weight,height,date) VALUES(1, $kg, 197,'$stamp')";
    $result = $conn->query($sql);
    echo (json_encode($result));
}
else if($_POST["delete"]){
    $delete = floatval($_POST["delete"]);
    $sql = "delete from stats where weightid = $delete";
    $result = $conn->query($sql);
    echo (json_encode($result));
}
else{
    $sql = "Select * from stats order by date desc";
    $result = $conn->query($sql);
    $output = array("data" => array() );
    while ($row = $result->fetch_assoc()) {
        $output['data'][] = $row;
    }
    echo json_encode($output);

}