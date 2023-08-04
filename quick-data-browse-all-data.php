<?php
error_reporting(0);
require 'dbcon.php';
$page = $_POST['page'] ?? 1;
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
    $selDs = "AND `activity` LIKE '%".str_replace("`","", str_replace(" dataset.tsv", "", $dataset))."%'";
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
$sql = "SELECT `AMPDB_No_`, `Gene Names`, `Organism`, `Protein names`, `Length`, `peptide activity`, `target organism` FROM `master` WHERE (AMPDB_No_ LIKE '$term'
OR AMPDB_No_ LIKE '$lowerf'
OR AMPDB_No_ LIKE '$upperf' 
OR Reviewed LIKE '$term'
OR Reviewed LIKE '$lowerf'
OR Reviewed LIKE '$upperf'
OR `Entry` LIKE '$term'
OR `Entry` LIKE '$lowerf' 
OR `Entry` LIKE '$upperf' 
OR Organism LIKE '$term'
OR Organism LIKE '%$term%'
OR Organism LIKE '$lowerf'
OR Organism LIKE '%$lowerf%'
OR Organism LIKE '$upperf'
OR Organism LIKE '%$upperf%'
OR `Taxonomic lineage` LIKE '%$term%'
OR `Taxonomic lineage` LIKE '%$lowerf%'
OR `Taxonomic lineage` LIKE '%$upperf%'
OR `Organism (ID)` LIKE '$term'
OR `Organism (ID)` LIKE '$upperf'
OR `Organism (ID)` LIKE '$lowerf'
OR `Gene Names` LIKE '$term'
OR `Gene Names` LIKE '%$term%'
OR `Gene Names` LIKE '$upperf'
OR `Gene Names` LIKE '%$upperf%'
OR `Gene Names` LIKE '$lowerf'
OR `Gene Names` LIKE '%$lowerf%'
OR `Protein names` LIKE '$term'
OR `Protein names` LIKE '%$term%'
OR `Protein names` LIKE '$upperf'
OR `Protein names` LIKE '%$upperf%'
OR `Protein names` LIKE '$lowerf'
OR `Protein names` LIKE '%$lowerf%'
OR `Sequence` LIKE '$term'
OR `Sequence` LIKE '%$term%'
OR `Sequence` LIKE '$lowerf'
OR `Sequence` LIKE '%$lowerf%'
OR `Sequence` LIKE '$upperf'
OR `Sequence` LIKE '%$upperf%'
OR `Protein existence` LIKE '$term'
OR `Protein existence` LIKE '%$term%'
OR `Protein existence` LIKE '$lowerf'
OR `Protein existence` LIKE '%$lowerf%'
OR `Protein existence` LIKE '$upperf'
OR `Protein existence` LIKE '%$upperf%'
OR `PubMed ID` LIKE '%$term%'
OR `PubMed ID` LIKE '$term'
OR `PDB` LIKE '%$term%'
OR `PDB` LIKE '$term'
OR `IntAct` LIKE '%$term%'
OR `IntAct` LIKE '$term'
OR `STRING` LIKE '%$term%'
OR `STRING` LIKE '$term'
OR `MINT` LIKE '%$term%'
OR `MINT` LIKE '$term'
OR `DIP` LIKE '%$term%'
OR `DIP` LIKE '$term'
OR `BioGRID` LIKE '%$term%'
OR `BioGRID` LIKE '$term'
OR `BindingDB` LIKE '%$term%'
OR `BindingDB` LIKE '$term'
OR `ChEMBL` LIKE '%$term%'
OR `ChEMBL` LIKE '$term'
OR `DrugBank` LIKE '%$term%'
OR `DrugBank` LIKE '$term'
OR `GeneID` LIKE '%$term%'
OR `GeneID` LIKE '$term'
OR `KEGG` LIKE '%$term%'
OR `KEGG` LIKE '$term'
OR `Ensembl` LIKE '%$term%'
OR `Ensembl` LIKE '$term'
OR `GeneTree` LIKE '%$term%'
OR `GeneTree` LIKE '$term'
OR `BRENDA` LIKE '%$term%'
OR `BRENDA` LIKE '$term'
OR `BioCyc` LIKE '%$term%'
OR `BioCyc` LIKE '$term'
OR `RNAct` LIKE '%$term%'
OR `RNAct` LIKE '$term'
OR `PANTHER` LIKE '%$term%'
OR `PANTHER` LIKE '$term'
OR `PROSITE` LIKE '%$term%'
OR `PROSITE` LIKE '$term'
OR `InterPro` LIKE '%$term%'
OR `InterPro` LIKE '$term'
OR `PANTHER` LIKE '%$term%'
OR `PANTHER` LIKE '$term'
OR `EMBL` LIKE '%$term%'
OR `EMBL` LIKE '$term'
OR `CCDS` LIKE '%$term%'
OR `CCDS` LIKE '$term'
OR `RefSeq` LIKE '%$term%'
OR `RefSeq` LIKE '$term'
OR `peptide activity` LIKE '$term'
OR `peptide activity` LIKE '%$term%'
OR `peptide activity` LIKE '$lowerf'
OR `peptide activity` LIKE '%$lowerf%'
OR `peptide activity` LIKE '$upperf'
OR `peptide activity` LIKE '%$upperf%'
OR `Protein existence` LIKE '$term'
OR `Protein existence` LIKE '%$term%'
OR `Protein existence` LIKE '$lowerf'
OR `Protein existence` LIKE '%$lowerf%'
OR `Protein existence` LIKE '$upperf'
OR `Protein existence` LIKE '%$upperf%'
OR `enzyme` LIKE '$term'
OR `enzyme` LIKE '%$term%'
OR `enzyme` LIKE '$lowerf'
OR `enzyme` LIKE '%$lowerf%'
OR `enzyme` LIKE '$upperf'
OR `enzyme` LIKE '%$upperf%'
OR `inhibition` LIKE '$term'
OR `inhibition` LIKE '%$term%'
OR `inhibition` LIKE '$lowerf'
OR `inhibition` LIKE '%$lowerf%'
OR `inhibition` LIKE '$upperf'
OR `inhibition` LIKE '%$upperf%'
OR `other` LIKE '$term'
OR `other` LIKE '%$term%'
OR `other` LIKE '$lowerf'
OR `other` LIKE '%$lowerf%'
OR `other` LIKE '$upperf'
OR `other` LIKE '%$upperf%'
OR `target organism` LIKE '$term'
OR `target organism` LIKE '%$term%'
OR `target organism` LIKE '$lowerf'
OR `target organism` LIKE '%$lowerf%'
OR `target organism` LIKE '$upperf'
OR `target organism` LIKE '%$upperf%') $selDs $filterQuery $sortFilter LIMIT $row,$limit";
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