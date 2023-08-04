<?php
error_reporting(0);
require 'dbcon.php';
$page = $_POST['page'] ?? 1;
$term = str_replace("TO", "AND",  $_POST['term'])??'';
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
$limit = 10;
$row = ($page - 1) * $limit;
$sql = str_replace(" undefined", "", "SELECT `AMPDB_No_`, `Gene Names`, `Organism`, `Protein names`, `Length`, `peptide activity`, `target organism` FROM `master2` WHERE ($term) $selDs $filterQuery $sortFilter LIMIT $row,$limit");
$result = $con->query($sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
foreach ($data as $sub) {
?>
    <div class="container-fluid mt-4 border border-start-4  pt-2 pb-2" style="background-color: #F0F8FF;">
        <div class="row">
            <div class="col-sm">
                <div>
                    <input class="form-check-input" type="checkbox" id="<?= $sub['AMPDB_No_'] ?>" name="ampdbid" value="<?= $sub['AMPDB_No_'] ?>" onclick="updateTextbox(this); countCheckboxes()"><label for="<?= $sub['AMPDB_No_'] ?>" class="form-check-label"></label>
                    <b style="font-weight: 500; overflow-wrap:anywhere; padding-left: 0.2%">AMPDB Acc.: </b> <a class="bb" style="text-decoration: none;" href="entry?id=<?= $sub['AMPDB_No_'] ?>"><?= $sub['AMPDB_No_'] ?></a> 
                </div>
                <div><b style="font-weight: 500; overflow-wrap:anywhere;">Protein Name: </b><?= explode("[", explode("(", $sub['Protein names'])[0])[0] ?></div>
                <div><b style="font-weight: 500; overflow-wrap:anywhere;">Length: </b><?= $sub['Length'] ?></div>
                <div><b style="font-weight: 500; overflow-wrap:anywhere;">Gene Names: </b><?= str_replace(" Nil ", "Not found", $sub['Gene Names']) ?></div>
                <div><b style="font-weight: 500; overflow-wrap:anywhere;">Source Organism: </b><?= explode("[", explode("(", $sub['Organism'])[0])[0] ?></div>
                <div><b style="font-weight: 500; overflow-wrap:anywhere;">Antimicrobial Activities: </b><?= str_replace(";", ", ", $sub['peptide activity']) ?></div>
                <div><b style="font-weight: 500; overflow-wrap:anywhere;">Target Organisms: </b><?= str_replace(";", ", ", $sub['target organism']) ?></div>
            </div>
        </div>
    </div>
<?php
}
$con->close();
?>