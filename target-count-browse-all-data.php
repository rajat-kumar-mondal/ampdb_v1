<?php
error_reporting(0);
require 'dbcon.php';
$filtervalues = $_POST['term']??'';
$requery = '';
foreach (explode(",",str_replace(", ",",",($filtervalues))) as $uq){                    
$lowerf = strtolower($uq);
$upperf = strtoupper($uq);
$ucfirst = ucfirst($uq);
$requery .= "`target organism` LIKE '%$uq%' AND ";
$requery .= "`target organism` LIKE '%$lowerf%' AND ";
$requery .= "`target organism` LIKE '%$upperf%' AND ";
$requery .= "`target organism` LIKE '%$ucfirst%' AND ";
}
$subrequery = substr($requery, 0, -5);
$sort = $_POST['sort']??'';
$ad = $_POST['ad'] ?? '';
$activity = $_POST['activity']??'';
$target = $_POST['target']??'';
$organism = $_POST['organism']??'';
$exist = $_POST['exist']??'';
$length = $_POST['length']??'';
$dataset = explode("[", strtolower($_POST['ds']))[0]??'';
$selDs = '';
if ($dataset != 'master'){
    $mdataset = ucfirst(str_replace("`","", str_replace(" dataset.tsv", "", $dataset)));
    if ($mdataset == "Hemolytic" or $mdataset == "Metalloprotease" or $mdataset == "Protease" or $mdataset == "Ribosomal" or $mdataset == "Serine protease" or $mdataset == "Thiol protease" or $mdataset == "Toxin"){
        $selDs = "AND `activity` LIKE '%".strrev($mdataset)."%'";
    }
    else{
        $selDs = "AND `activity` LIKE '%".str_replace("`","", str_replace(" dataset.tsv", "", $dataset))."%'";
    }    
}
$finalQuery = array();
$sortFilter = '';
if (strlen($sort) != 0){
    $sortFilter .= ' ORDER BY `'.$sort.'` '.$ad;
}
$preQuery = '';
$arr = explode(",", $activity);
if (strlen($arr[0]) > 0){
    $preSQLarr = array();
    foreach ($arr as $ele){
        array_push($preSQLarr, "`activity` LIKE '%$ele%'");
    }
    $preQuery .= implode(" AND ", $preSQLarr);
    array_push($finalQuery, $preQuery);
}
$preQuery = '';
$arr = explode(",", $target);
if (strlen($arr[0]) > 0){
    $preSQLarr = array();
    foreach ($arr as $ele){
        array_push($preSQLarr, "`target organism` LIKE '%$ele%'");
    }
    $preQuery .= implode(" AND ", $preSQLarr);
    array_push($finalQuery, $preQuery);
}
$preQuery = '';
$arr = explode(",", $organism);
if (strlen($arr[0]) > 0){
    $preSQLarr = array();
    foreach ($arr as $ele){
        array_push($preSQLarr, "`Organism` LIKE '%$ele%'");
    }
    $preQuery .= implode(" AND ", $preSQLarr);
    array_push($finalQuery, $preQuery);
}
$preQuery = '';
$arr = explode(",", $exist);
if (strlen($arr[0]) > 0){
    $preSQLarr = array();
    foreach ($arr as $ele){
        array_push($preSQLarr, "`Protein existence` LIKE '%$ele%'");
    }
    $preQuery .= implode(" AND ", $preSQLarr);
    array_push($finalQuery, $preQuery);
}
$preQuery = '';
$arr = explode(",", $length);
if (strlen($arr[0]) > 0){
    $preQuery .= implode(" AND ", $arr);
    array_push($finalQuery, $preQuery);
}
$filterQuery = implode(" AND ", $finalQuery);
if (strlen($filterQuery) > 0){
    $filterQuery = " AND ".$filterQuery;
}
$sql = "SELECT COUNT(Serial_No) FROM `master2` WHERE ($subrequery) $selDs $filterQuery $sortFilter";
$result = $con->query($sql);
$data = $result->fetch_all();
echo $data[0][0];
$con->close();
?>