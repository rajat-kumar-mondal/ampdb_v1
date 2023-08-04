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
$mysort = array("ASC" => "Ascending", "DESC" => "Descending");
$sortArr = array();
foreach ($mysort as $key => $val) {
    $match = preg_match_all("/" . str_replace("(", "", str_replace(")", "", str_replace("/", "", $key))) . "/", str_replace("(", "", str_replace(")", "", str_replace("/", "", $ad))));
    if ($match != 0) {
        $m = '<div class="form-check">
        <input type="radio" class="form-check-input" id="' . $key . '" name="ad" value="' . $key . '" checked>
        <label style="font-size: smaller;" class="form-check-label" for="' . $key . '">' . $val . '</label>
    </div>';
        array_push($sortArr, $m);
    } else {
        $m = '<div class="form-check">
        <input type="radio" class="form-check-input" id="' . $key . '" name="ad" value="' . $key . '">
        <label style="font-size: smaller;" class="form-check-label" for="' . $key . '">' . $val . '</label>
    </div>';
        array_push($sortArr, $m);
    }
}
?>
<div class="container" style="padding-left:3%;">
    <div class="row">
        <div class="col-sm" style="padding-left:0px;">
            <div class="mb-2" style="font-weight: 500;">Sort Type </div>
            <div style="padding-left: 1.7%;">
                <?php echo implode("", $sortArr) ?>
            </div>
        </div>
    </div>
</div>
<hr style="height: 3px;">
<?php
$mysort = array("Protein names", "Length", "Gene Names", "Organism", "peptide activity", "target organism");
$sortArr = array();
foreach ($mysort as $thisSort) {
    $match = preg_match_all("/" . str_replace("(", "", str_replace(")", "", str_replace("/", "", $thisSort))) . "/", str_replace("(", "", str_replace(")", "", str_replace("/", "", $sort))));
    if ($match != 0) {
        $m = '<div class="form-check">
        <input type="radio" class="form-check-input" id="' . $thisSort . '" name="sort" value="' . $thisSort . '" checked>
        <label style="font-size: smaller;" class="form-check-label" for="' . $thisSort . '">' . $thisSort . '</label>
    </div>';
        array_push($sortArr, $m);
    } else {
        $m = '<div class="form-check">
        <input type="radio" class="form-check-input" id="' . $thisSort . '" name="sort" value="' . $thisSort . '">
        <label style="font-size: smaller;" class="form-check-label" for="' . $thisSort . '">' . $thisSort . '</label>
    </div>';
        array_push($sortArr, $m);
    }
}
?>
<div class="container" style="padding-left: 3%;">
    <div class="row">
        <div class="col-sm" style="padding-left:0px;">
            <div class="mb-2" style="font-weight: 500;">Sort By</div>
            <div style="padding-left: 1.7%;">
                <?php echo implode("", $sortArr) ?>
            </div>
        </div>
    </div>
</div>
<hr style="height: 3px;">
<?php
$sql = "SELECT `peptide activity` FROM `master2` WHERE ($subrequery) $selDs $filterQuery $sortFilter";
$result = $con->query($sql);
$targetArr = array();
while ($row = $result->fetch_assoc()) {
    $myTarget = $row['peptide activity'];
    array_push($targetArr, $myTarget);
}
$targetArrString = implode(";", $targetArr);
$assocTarget = array();
$targetList = array('Amphibian defense peptide', 'Anti-HSV', 'Anti-MRSA', 'Anti-biofilm', 'Anti-candida', 'Anti-gram-Positive', 'Anti-gram-negative', 'Anti-hepatities', 'Anti-listeria', 'Anti-malarial', 'Anti-mollicute', 'Anti-parasitic', 'Anti-plasmodium', 'Anti-protozoal', 'Anti-tuberculosis', 'Anti-yeast', 'Antibiotic', 'Antimicrobial', 'Antioxidant', 'Antiviral protein', 'Bacteriocin', 'Bacteriolytic enzyme', 'Defensin', 'Fungicide', 'Lantibiotic', 'Plant defense');
foreach ($targetList as $trget) {
    $match = preg_match_all("/" . str_replace("(", "", str_replace(")", "", str_replace("/", "", $trget))) . "/", str_replace("(", "", str_replace(")", "", str_replace("/", "", $targetArrString))));
    if ($match != 0) {
        $assocTarget[$trget] = $match;
    }
}
arsort($assocTarget);
$mySelectedAct = array();
foreach ($assocTarget as $key => $val) {
    $match = preg_match_all("/" . str_replace("(", "", str_replace(")", "", str_replace("/", "", $key))) . "/", str_replace("(", "", str_replace(")", "", str_replace("/", "", $activity))));
    if ($match != 0) {
        $m = '<div class="form-check" style="font-size: smaller"><input type="checkbox" class="form-check-input"
                            id="' . $key . '" name="activity" value="' . $key . '" checked><label class="form-check-label"
                            for="' . $key . '" >' . $key . ' (' . $val . ')' . '</label></div>';
        array_push($mySelectedAct, $m);
    } else {
        $m = '<div class="form-check" style="font-size: smaller"><input type="checkbox" class="form-check-input"
                            id="' . $key . '" name="activity" value="' . $key . '"><label class="form-check-label"
                            for="' . $key . '" >' . $key . ' (' . $val . ')' . '</label></div>';
        array_push($mySelectedAct, $m);
    }
}
?>
<div class="continer ">
    <div class="row">
        <div class="col-sm">
            <div class="mb-2" style="font-weight: 500;">Antimicrobial Activity</div>
            <?php if (count($mySelectedAct) > 10) { ?>
                <div class="scr" style="padding-left: 1.7%; padding-top:0.5%; padding-bottom: 0.5%;">
                    <?php echo (implode("", $mySelectedAct)); ?>
                </div>
            <?php } else { ?>
                <div style="padding-left: 1.7%; padding-top:0.5%; padding-bottom: 0.5%;">
                    <?php echo (implode("", $mySelectedAct)); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<hr style="height: 3px;">
<?php
$sql = "SELECT `target organism` FROM `master2` WHERE ($subrequery) $selDs $filterQuery $sortFilter";
$result = $con->query($sql);
$targetArr = array();
while ($row = $result->fetch_assoc()) {
    $myTarget = $row['target organism'];
    if ($myTarget != 'No Target Organism Found') {
        array_push($targetArr, $myTarget);
    }
}
$AlltargetList = array();
foreach ($targetArr as $entArr){
    $explodeTarget = explode(";", $entArr);
    foreach($explodeTarget as $indTarget){
        array_push($AlltargetList, $indTarget);
    }
    
}
$targetList = array_unique($AlltargetList);
$targetArrString = implode(";", $targetArr);
$assocTarget = array();
foreach ($targetList as $trget) {
    $match = preg_match_all("/" . str_replace(")", "", str_replace("(", "", str_replace("/", "", $trget))) . "/",  str_replace("/", "", str_replace(")", "", str_replace("(", "", $targetArrString))));
    if ($match != 0) {
        $assocTarget[$trget] = $match;
    }
}
arsort($assocTarget);
$mySelectedAct = array();
foreach ($assocTarget as $key => $val) {
    $match = preg_match_all("/" . str_replace("(", "", str_replace(")", "", str_replace("/", "", $key))) . "/", str_replace("(", "", str_replace(")", "", str_replace("/", "", $target))));
    if ($match != 0) {
        $m = '<div class="form-check" style="font-size: smaller"><input type="checkbox" class="form-check-input"
                            id="' . $key . '" name="target" value="' . $key . '" checked><label class="form-check-label"
                            for="' . $key . '" >' . $key . ' (' . $val . ')' . '</label></div>';
        array_push($mySelectedAct, $m);
    } else {
        $m = '<div class="form-check" style="font-size: smaller"><input type="checkbox" class="form-check-input"
                            id="' . $key . '" name="target" value="' . $key . '"><label class="form-check-label"
                            for="' . $key . '" >' . $key . ' (' . $val . ')' . '</label></div>';
        array_push($mySelectedAct, $m);
    }
}
?>
<div class="continer ">
    <div class="row">
        <div class="col-sm">
            <div class="mb-2" style="font-weight: 500;">Target Organism</div>
            <?php if (count($mySelectedAct) > 10) { ?>
                <div class="scr" style="padding-left: 1.7%; padding-top:0.5%; padding-bottom: 0.5%;">
                    <?php echo (implode("", $mySelectedAct)); ?>
                </div>
            <?php } else { ?>
                <div style="padding-left: 1.7%; padding-top:0.5%; padding-bottom: 0.5%;">
                    <?php echo (implode("", $mySelectedAct)); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<hr style="height: 3px;">
<?php
$sql = "SELECT `Organism` FROM `master2` WHERE ($subrequery) $selDs $filterQuery $sortFilter";
$result = $con->query($sql);
$targetArr = array();
while ($row = $result->fetch_assoc()) {
    $myTarget = $row['Organism'];
    array_push($targetArr, explode("(", $myTarget)[0]);
}
$targetArrString = implode(" ", $targetArr);
$mysql = "SELECT DISTINCT(`Organism`) FROM `master2` WHERE ($subrequery) $selDs $filterQuery $sortFilter";
$targetList = array();
$myResult = $con->query($mysql);
while ($row = $myResult->fetch_assoc()) {
    array_push($targetList, explode("(", $row['Organism'])[0]);
}
$assocTarget = array();
$c = 1;
foreach ($targetList as $trget) {
    $match = preg_match_all("/" . str_replace("(", "", str_replace(")", "", str_replace("/", "", $trget))) . "/", str_replace("(", "", str_replace(")", "", str_replace("/", "", $targetArrString))));
    if ($match > 1) {
        $assocTarget[$trget] = $match;
    }
    if ($c == 50) {
        break;
    }
    $c += 1;
    $targetArrString = str_replace("$trget", "", $targetArrString);
}
arsort($assocTarget);
$mySelectedAct = array();
foreach ($assocTarget as $key => $val) {
    $match = preg_match_all("/" . str_replace("(", "", str_replace(")", "", str_replace("/", "", $key))) . "/", str_replace("(", "", str_replace(")", "", str_replace("/", "", $organism))));
    if ($match != 0) {
        $m = '<div class="form-check" style="font-size: smaller"><input type="checkbox" class="form-check-input"
                            id="' . $key . '" name="organism" value="' . $key . '" checked><label class="form-check-label"
                            for="' . $key . '" >' . $key . ' (' . $val . ')' . '</label></div>';
        array_push($mySelectedAct, $m);
    } else {
        $m = '<div class="form-check" style="font-size: smaller"><input type="checkbox" class="form-check-input"
                            id="' . $key . '" name="organism" value="' . $key . '"><label class="form-check-label"
                            for="' . $key . '" >' . $key . ' (' . $val . ')' . '</label></div>';
        array_push($mySelectedAct, $m);
    }
}
?>
<div class="continer ">
    <div class="row">
        <div class="col-sm">
            <div class="mb-2" style="font-weight: 500;">Common Source Organism</div>
            <?php if (count($mySelectedAct) > 10) { ?>
                <div class="scr" style="padding-left: 1.7%; padding-top:0.5%; padding-bottom: 0.5%;">
                    <?php echo (implode("", $mySelectedAct)); ?>
                </div>
            <?php } else { ?>
                <div style="padding-left: 1.7%; padding-top:0.5%; padding-bottom: 0.5%;">
                    <?php echo (implode("", $mySelectedAct)); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<hr style="height: 3px;">
<?php
$sql = "SELECT `Protein existence` FROM `master2` WHERE ($subrequery) $selDs $filterQuery $sortFilter";
$result = $con->query($sql);
$targetArr = array();
while ($row = $result->fetch_assoc()) {
    $myTarget = $row['Protein existence'];
    array_push($targetArr, $myTarget);
}
$targetArrString = implode(" ", $targetArr);
$assocTarget = array();
$targetList = array('Predicted', 'Homology', 'Transcript level', 'Protein level', 'Uncertain');
foreach ($targetList as $trget) {
    $match = preg_match_all("/" . str_replace("(", "", str_replace(")", "", str_replace("/", "", $trget))) . "/i", str_replace("(", "", str_replace(")", "", str_replace("/", "", $targetArrString))));
    if ($match != 0) {
        $assocTarget[$trget] = $match;
    }
}
arsort($assocTarget);
$mySelectedAct = array();
foreach ($assocTarget as $key => $val) {
    $match = preg_match_all("/" . str_replace("(", "", str_replace(")", "", str_replace("/", "", $key))) . "/", str_replace("(", "", str_replace(")", "", str_replace("/", "", $exist))));
    if ($match != 0) {
        $m = '<div class="form-check" style="font-size: smaller"><input type="checkbox" class="form-check-input"
                            id="' . $key . '" name="exist" value="' . $key . '" checked><label class="form-check-label"
                            for="' . $key . '" >' . $key . ' (' . $val . ')' . '</label></div>';
        array_push($mySelectedAct, $m);
    } else {
        $m = '<div class="form-check" style="font-size: smaller"><input type="checkbox" class="form-check-input"
                            id="' . $key . '" name="exist" value="' . $key . '"><label class="form-check-label"
                            for="' . $key . '" >' . $key . ' (' . $val . ')' . '</label></div>';
        array_push($mySelectedAct, $m);
    }
}
?>
<div class="continer ">
    <div class="row">
        <div class="col-sm">
            <div class="mb-2" style="font-weight: 500;">Protein Existence Level</div>
            <div style="padding-left: 1.7%; padding-top:0.5%; padding-bottom: 0.5%;">
                <?php echo (implode("", $mySelectedAct)); ?>
            </div>
        </div>
    </div>
</div>
<hr style="height: 3px;">
<?php
$mySelectedAct = array();
$start = 1;
$end = 100;
$assArr = array();
for ($i = 0; $i < 6; $i += 1) {
    $myval = '';
    if ($start > 500) {
        $myval = " Length > 500 ";
    } else {
        $myval = " Length BETWEEN $start AND $end ";
    }
    $mysql5 = "SELECT COUNT(Serial_No) FROM `master2` WHERE ($subrequery) $selDs $filterQuery AND $myval $sortFilter";
    $assOxx = $con->query($mysql5);
    $mydata =  $assOxx->fetch_all()[0][0];
    if ($mydata > 0){
        $assArr[$myval] = $mydata;
    }
    $start += 100;
    $end += 100;
}
foreach ($assArr as $key => $val) {
    $match = preg_match_all("/" . str_replace("(", "", str_replace(")", "", str_replace("/", "", $key))) . "/", str_replace("(", "", str_replace(")", "", str_replace("/", "", $length))));
    if ($match != 0) {
        $m = '<div class="form-check">
        <input type="radio" class="form-check-input" id="' . $key . '" name="length" value="' . $key . '" checked>
        <label style="font-size: smaller;" class="form-check-label" for="' . $key . '">' . str_replace('AND', 'TO', str_replace(' Length ', '', str_replace(' Length BETWEEN ', '', $key))) . ' (' . $val . ')' . '</label>
    </div>';
        array_push($mySelectedAct, $m);
    } else {
        $m = '<div class="form-check">
        <input type="radio" class="form-check-input" id="' . $key . '" name="length" value="' . $key . '">
        <label style="font-size: smaller;" class="form-check-label" for="' . $key . '">' . str_replace('AND', 'TO', str_replace(' Length ', '', str_replace(' Length BETWEEN ', '', $key))) . ' (' . $val . ')' . '</label>
    </div>';
        array_push($mySelectedAct, $m);
    }
}
?>
<div class="continer ">
    <div class="row">
        <div class="col-sm">
            <div class="mb-2" style="font-weight: 500;">Sequence Length</div>
            <div style="padding-left: 1.7%; padding-top:0.5%; padding-bottom: 0.5%;">
                <?php
                echo (implode("", $mySelectedAct));
                ?>
            </div>
        </div>
    </div>
</div>
<?php
$con->close();
?>