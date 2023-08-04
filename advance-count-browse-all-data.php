<?php
error_reporting(0);
require 'dbcon.php';
$sort = $_POST['sort'] ?? '';
$ad = $_POST['ad'] ?? '';
$activity = $_POST['activity'] ?? '';
$target = $_POST['target'] ?? '';
$organism = $_POST['organism'] ?? '';
$exist = $_POST['exist'] ?? '';
$length = $_POST['length'] ?? '';
$dataset = explode("[", strtolower($_POST['ds']))[0] ?? '';
$tarorg = $_POST['tarorg'] ?? '';
$antim = $_POST['antim'] ?? '';
$q1 = $_POST['q1'] ?? '';
$q3 = $_POST['q3'] ?? '';
$q2 = $_POST['q2'] ?? '';
$o9 = $_POST['o9'] ?? '';
$selDs = '';
if ($dataset != 'master') {
    $mdataset = ucfirst(str_replace("`", "", str_replace(" dataset.tsv", "", $dataset)));
    if ($mdataset == "Hemolytic" or $mdataset == "Metalloprotease" or $mdataset == "Protease" or $mdataset == "Ribosomal" or $mdataset == "Serine protease" or $mdataset == "Thiol protease" or $mdataset == "Toxin") {
        $selDs = "AND `activity` LIKE '%" . strrev($mdataset) . "%'";
    } else {
        $selDs = "AND `activity` LIKE '%" . str_replace("`", "", str_replace(" dataset.tsv", "", $dataset)) . "%'";
    }
}
$tarorgSearch = '';
if (strlen($tarorg) > 0) {
    foreach (explode(",", $tarorg) as $aa) {
        $tarorgSearch .= "`target organism` LIKE '%$aa%' AND ";
    }
}
$tarorgSearch = substr($tarorgSearch, 0, -5);
$antimSearch = '';
if (strlen($antim) > 0) {
    foreach (explode(",", $antim) as $aa) {
        if ($aa == "Hemolytic" or $aa == "Metalloprotease" or $aa == "Protease" or $aa == "Ribosomal" or $aa == "Serine protease" or $aa == "Thiol protease" or $aa == "Toxin") {
            $antimSearch .= "`activity` LIKE '%" . strrev($aa) . "%' AND ";
        } else {
            $antimSearch .= "`activity` LIKE '%$aa%' AND ";
        }
    }
}
$antimSearch = substr($antimSearch, 0, -5);
$advanceQuery = str_replace("(         )", "(AMPDB_No_ LIKE '%A%')", str_replace("(       )", "(AMPDB_No_ LIKE '%A%')", str_replace("(     )", "(AMPDB_No_ LIKE '%A%')", str_replace("(               )", "(AMPDB_No_ LIKE '%A%')",  "(" . str_replace("LIKE '%%' ", "", str_replace("undefined ", "", "$q1 $q3 " . str_replace("TO", "AND", $q2) . " $tarorgSearch $o9 $antimSearch")) . ")"))));
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
$sql = str_replace(" LIKE '%undefined%'", "", str_replace(" undefined", "", "SELECT COUNT(Serial_No) FROM `master2` WHERE $advanceQuery $selDs $filterQuery $sortFilter"));
$result = $con->query($sql);
$data = $result->fetch_all();
echo $data[0][0];
$con->close();
?>