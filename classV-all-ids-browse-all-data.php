<?php
error_reporting(0);
require 'dbcon.php';
$term = $_POST['class'] ?? '';
$sort = $_POST['sort'] ?? '';
$ad = $_POST['ad'] ?? '';
$activity = $_POST['activity'] ?? '';
$target = $_POST['target'] ?? '';
$organism = $_POST['organism'] ?? '';
$exist = $_POST['exist'] ?? '';
$length = $_POST['length'] ?? '';
$dataset = explode("[", strtolower($_POST['ds']))[0] ?? '';
$lowerf = strtolower($term);
$upperf = strtoupper($term);
$selDs = '';
if ($dataset != 'master') {
    $selDs = "AND `activity` LIKE '%" . str_replace("`", "", str_replace(" dataset.tsv", "", $dataset)) . "%'";
}
if ($term == "Hemolytic" or $term == "Metalloprotease" or $term == "Protease" or $term == "Ribosomal" or $term == "Serine protease" or $term == "Thiol protease" or $term == "Toxin") {
    $term = strrev($term);
}
$finalQuery = array();
$sortFilter = '';
if (strlen($sort) != 0) {
    $sortFilter .= ' ORDER BY `' . $sort . '` ' . $ad;
}
$preQuery = '';
$arr = explode(",", $activity);
if (strlen($arr[0]) > 0) {
    $preSQLarr = array();
    foreach ($arr as $ele) {
        array_push($preSQLarr, "`activity` LIKE '%$ele%'");
    }
    $preQuery .= implode(" AND ", $preSQLarr);
    array_push($finalQuery, $preQuery);
}
$preQuery = '';
$arr = explode(",", $target);
if (strlen($arr[0]) > 0) {
    $preSQLarr = array();
    foreach ($arr as $ele) {
        array_push($preSQLarr, "`target organism` LIKE '%$ele%'");
    }
    $preQuery .= implode(" AND ", $preSQLarr);
    array_push($finalQuery, $preQuery);
}
$preQuery = '';
$arr = explode(",", $organism);
if (strlen($arr[0]) > 0) {
    $preSQLarr = array();
    foreach ($arr as $ele) {
        array_push($preSQLarr, "`Organism` LIKE '%$ele%'");
    }
    $preQuery .= implode(" AND ", $preSQLarr);
    array_push($finalQuery, $preQuery);
}
$preQuery = '';
$arr = explode(",", $exist);
if (strlen($arr[0]) > 0) {
    $preSQLarr = array();
    foreach ($arr as $ele) {
        array_push($preSQLarr, "`Protein existence` LIKE '%$ele%'");
    }
    $preQuery .= implode(" AND ", $preSQLarr);
    array_push($finalQuery, $preQuery);
}
$preQuery = '';
$arr = explode(",", $length);
if (strlen($arr[0]) > 0) {
    $preQuery .= implode(" AND ", $arr);
    array_push($finalQuery, $preQuery);
}
$filterQuery = implode(" AND ", $finalQuery);
if (strlen($filterQuery) > 0) {
    $filterQuery = " AND " . $filterQuery;
}
$sql = "SELECT AMPDB_No_ FROM `master2` WHERE (`activity` LIKE '%$term%') $selDs $filterQuery $sortFilter";
$result = $con->query($sql);
$myArr = array();
while ($row = $result->fetch_assoc()) {
    array_push($myArr, $row['AMPDB_No_']);
}
echo implode(",", $myArr);
$con->close();
?>