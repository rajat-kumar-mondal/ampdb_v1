<?php
error_reporting(0);
require 'dbcon.php';
$term = $_POST['term']??'';
$sort = $_POST['sort']??'';
$ad = $_POST['ad'] ?? '';
$activity = $_POST['activity']??'';
$target = $_POST['target']??'';
$organism = $_POST['organism']??'';
$exist = $_POST['exist']??'';
$length = $_POST['length']??'';
$dataset = explode("[", strtolower($_POST['ds']))[0]??'';
$lowerf = strtolower($term);
$upperf = strtoupper($term);
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
$sql = "SELECT AMPDB_No_ FROM `master2` WHERE (AMPDB_No_ LIKE '$term'
OR Reviewed LIKE '$term'
OR `Entry` LIKE '$term'
OR Organism LIKE '$term'
OR `Taxonomic lineage` LIKE '%$term%'
OR `Organism (ID)` LIKE '$term'
OR `Gene Names` LIKE '$term'
OR `Protein names` LIKE '$term'
OR `Sequence` LIKE '$term'
OR `Protein existence` LIKE '%$term%'
OR `PubMed ID` LIKE '$term'
OR `PDB` LIKE '$term'
OR `IntAct` LIKE '$term'
OR `STRING` LIKE '$term'
OR `MINT` LIKE '$term'
OR `DIP` LIKE '$term'
OR `BioGRID` LIKE '$term'
OR `BindingDB` LIKE '$term'
OR `ChEMBL` LIKE '$term'
OR `DrugBank` LIKE '$term'
OR `GeneID` LIKE '$term'
OR `KEGG` LIKE '$term'
OR `Ensembl` LIKE '$term'
OR `GeneTree` LIKE '$term'
OR `BRENDA` LIKE '$term'
OR `BioCyc` LIKE '$term'
OR `RNAct` LIKE '$term'
OR `PANTHER` LIKE '$term'
OR `PROSITE` LIKE '$term'
OR `InterPro` LIKE '$term'
OR `PANTHER` LIKE '$term'
OR `EMBL` LIKE '$term'
OR `CCDS` LIKE '$term'
OR `RefSeq` LIKE '$term'
OR `peptide activity` LIKE '$term'
OR `enzyme` LIKE '$term'
OR `inhibition` LIKE '$term'
OR `other` LIKE '$term'
OR `target organism` LIKE '$term') $selDs $filterQuery $sortFilter";
$result = $con->query($sql);
$myArr = array();
while($row=$result->fetch_assoc()){
    array_push($myArr, $row['AMPDB_No_']);
}
echo implode(",", $myArr);
$con->close();
?>