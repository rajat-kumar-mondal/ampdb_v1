<?php
require "dbcon.php";
$ids = str_replace("\n", "", str_replace(" ", "", str_replace(";", "','", $_POST['ids'])));
$sql = "SELECT * FROM pdb_det WHERE id IN ('$ids')";
$result = $con->query($sql);
$c = 1;
$data = array();
while ($row = $result->fetch_assoc()) {
    $row['sl'] = $c.".";
    $data[] = $row;
    $c+=1;
}
echo json_encode(array("data" => $data));
$con->close();
?>   