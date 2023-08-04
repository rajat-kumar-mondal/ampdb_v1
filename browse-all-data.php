<?php
require 'dbcon.php';
$sort = $_GET['sort'] ?? '';
$ad = $_GET['ad'] ?? '';
$activity = $_GET['activity'] ?? '';
$target = $_GET['target'] ?? '';
$organism = $_GET['organism'] ?? '';
$exist = $_GET['exist'] ?? '';
$length = $_GET['length'] ?? '';
$finalQuery = array();
$sortFilter = '';
if (strlen($sort) != 0) {
    $sortFilter .= 'ORDER BY `' . $sort . '` ' . $ad;
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
    $filterQuery = " WHERE " . $filterQuery;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <title>Browse All Data</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="ss.css">
    <link rel="stylesheet" href="scr.css">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand fs-3" href="ampdb-home">AMPDB v1</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="ampdb-home">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Search</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="ampdb-text-search">Text
                                    Search</a></li>
                            <li><a class="dropdown-item" href="ampdb-specific-search">Specific Text
                                    Search</a></li>
                            <li><a class="dropdown-item" href="ampdb-target-organism-search">Search by
                                    Target
                                    Organism</a></li>
                            <li><a class="dropdown-item" href="ampdb-pp-search">Search by
                                    Physicochemical Properties</a>
                            </li>
                            <li><a class="dropdown-item" href="ampdb-composition-search">Search by
                                    Protein
                                    Composition</a>
                            </li>
                            <li><a class="dropdown-item" href="ampdb-activity-search">Search
                                    by Activity</a></li>
                            <li><a class="dropdown-item" href="ampdb-advanced-search">Advanced Search</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="browse-all-data">Browse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ampdb-classification">Classification</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Tools</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="https://ampdb-protein-sequence-alignment-toolbox.streamlit.app/" target="_blank">Protein Sequence Alignment
                                    Toolbox</a></li>
                            <li><a class="dropdown-item" href="https://ampdb-protein-feature-calculation-toolbox.streamlit.app/" target="_blank">Protein Feature Calculation
                                    Toolbox</a></li>
                        </ul>
                    <li class="nav-item">
                        <a class="nav-link" href="ampdb-data-stat">Statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ampdb-downloads">Downloads</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ampdb-news">News/Updates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="developers">Developers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ampdb-tutorial">Tutorial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact">Contact</a>
                    </li>
                </ul>
                <form class="d-flex" action="ampdb-quick-search-result" method="get">
                    <input name="term" class="form-control me-2" type="text" placeholder="Quick Search">
                    <input type="submit" value="Search" name="search" class="btn btn-primary">
                </form>
            </div>
        </div>
    </nav>
    <br><br>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-19 bg-light rounded my-2 py-2">
                <h4 class="text-center text-success" style="font-size: 500; margin-top: 2%;"> Browse All
                    Data of AMPDB
                    (Currently <?php
                                $sql = "SELECT Serial_No FROM `master2` $filterQuery $sortFilter";
                                $result = $con->query($sql);
                                $totRec = mysqli_num_rows($result);
                                echo $totRec;
                                ?> entries enlisted in AMPDB)
                </h4>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <span id="search-term"></span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-sm">
                <form id="myForm" method="post" action="request.php">
                    <div style="margin-left: 5%;">
                        <button class="btn btn-sm btn-primary" style="margin-top: 1%;" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
                            Filter By
                        </button>
                        <button class="btn btn-sm btn-warning " style="margin-top: 1%;" type="button" data-bs-toggle="" data-bs-target="" onclick="toggleCheckboxes(document.querySelectorAll('input[type=checkbox][name=ampdbid]'))">Select
                            All</button>
                        <input name="ids" type="text" id="result" style="display: none;">
                        <input name="allids" type="text" value="<?php
                                                                $sort = $_GET['sort'] ?? '';
                                                                $ad = $_GET['ad'] ?? '';
                                                                $activity = $_GET['activity'] ?? '';
                                                                $target = $_GET['target'] ?? '';
                                                                $organism = $_GET['organism'] ?? '';
                                                                $exist = $_GET['exist'] ?? '';
                                                                $length = $_GET['length'] ?? '';
                                                                $finalQuery = array();
                                                                $sortFilter = '';
                                                                if (strlen($sort) != 0) {
                                                                    $sortFilter .= 'ORDER BY `' . $sort . '` ' . $ad;
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
                                                                    $filterQuery = " WHERE " . $filterQuery;
                                                                }
                                                                $sql = "SELECT AMPDB_No_ FROM `master2` $filterQuery $sortFilter";
                                                                $result = $con->query($sql);
                                                                $myArr = array();
                                                                while ($row = $result->fetch_assoc()) {
                                                                    array_push($myArr, $row['AMPDB_No_']);
                                                                }
                                                                echo implode(",", $myArr);
                                                                ?>" style="display: none;">
                        <input name="ui" class="btn btn-sm btn-success" style="margin-top: 1%;" type="submit" value="Download Selected">
                        <input name="ui" class="btn btn-sm btn-success" style="margin-top: 1%;" type="submit" value="Download All">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-start" id="demo">
        <div class="offcanvas-header">
            <div style="font-weight: 500; font-size: x-large;">Filter Search result</div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <form onsubmit="submitForm(); return false;">
                <div>
                    <button type="submit" class="float-end btn btn-sm btn-success me-2">Apply</button>
                    <button class="btn btn-sm btn-danger float-end me-1" onclick="removePreChecked()">Clear</button>
                    <button onclick="uncheckRadios()" type="button" data-bs-toggle="" data-bs-target="" class="btn btn-sm border border-2 float-end me-1" style="background-color: #F0F8FF;">Uncheck
                        <input class="form-check-input" type="radio" checked></button>
                </div>
                <br>
                <div style="margin-top: 6.5%;">
                    <?php
                    $fiLsort = $_GET['sort'] ?? '';
                    $ad = $_GET['ad'] ?? '';
                    $fiLactivity = $_GET['activity'] ?? '';
                    $fiLtarget = $_GET['target'] ?? '';
                    $fiLorganism = $_GET['organism'] ?? '';
                    $fiLexist = $_GET['exist'] ?? '';
                    $fiLlength = $_GET['length'] ?? '';
                    $finalQuery = array();
                    $sortFilter = '';
                    if (strlen($fiLsort) != 0) {
                        $sortFilter .= 'ORDER BY `' . $fiLsort . '` ' . $ad;
                    }
                    $preQuery = '';
                    $arr = explode(",", $fiLactivity);
                    if (strlen($arr[0]) > 0) {
                        $preSQLarr = array();
                        foreach ($arr as $ele) {
                            array_push($preSQLarr, "`activity` LIKE '%$ele%'");
                        }
                        $preQuery .= implode(" AND ", $preSQLarr);
                        array_push($finalQuery, $preQuery);
                    }
                    $preQuery = '';
                    $arr = explode(",", $fiLtarget);
                    if (strlen($arr[0]) > 0) {
                        $preSQLarr = array();
                        foreach ($arr as $ele) {
                            array_push($preSQLarr, "`target organism` LIKE '%$ele%'");
                        }
                        $preQuery .= implode(" AND ", $preSQLarr);
                        array_push($finalQuery, $preQuery);
                    }
                    $preQuery = '';
                    $arr = explode(",", $fiLorganism);
                    if (strlen($arr[0]) > 0) {
                        $preSQLarr = array();
                        foreach ($arr as $ele) {
                            array_push($preSQLarr, "`Organism` LIKE '%$ele%'");
                        }
                        $preQuery .= implode(" AND ", $preSQLarr);
                        array_push($finalQuery, $preQuery);
                    }
                    $preQuery = '';
                    $arr = explode(",", $fiLexist);
                    if (strlen($arr[0]) > 0) {
                        $preSQLarr = array();
                        foreach ($arr as $ele) {
                            array_push($preSQLarr, "`Protein existence` LIKE '%$ele%'");
                        }
                        $preQuery .= implode(" AND ", $preSQLarr);
                        array_push($finalQuery, $preQuery);
                    }
                    $preQuery = '';
                    $arr = explode(",", $fiLlength);
                    if (strlen($arr[0]) > 0) {
                        $preQuery .= implode(" AND ", $arr);
                        array_push($finalQuery, $preQuery);
                    }
                    $filterQuery = implode(" AND ", $finalQuery);
                    $forLength = '';
                    if (strlen($filterQuery) > 0) {
                        $filterQuery = " WHERE " . $filterQuery;
                        $forLength = " AND " . implode(" AND ", $finalQuery);
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
                        $match = preg_match_all("/" . str_replace("(", "", str_replace(")", "", str_replace("/", "", $thisSort))) . "/", str_replace("(", "", str_replace(")", "", str_replace("/", "", $fiLsort))));
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
                    $sql = "SELECT `peptide activity` FROM `master2` $filterQuery";
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
                        $match = preg_match_all("/" . str_replace("(", "", str_replace(")", "", str_replace("/", "", $trget))) . "/", str_replace("/", "", str_replace("(", "", str_replace(")", "", $targetArrString))));
                        if ($match != 0) {
                            $assocTarget[$trget] = $match;
                        }
                    }
                    arsort($assocTarget);
                    $mySelectedAct = array();
                    foreach ($assocTarget as $key => $val) {
                        $match = preg_match_all("/" . str_replace("(", "", str_replace(")", "", str_replace("/", "", $key))) . "/", str_replace("(", "", str_replace(")", "", str_replace("/", "", $fiLactivity))));
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
                    $sql = "SELECT `target organism` FROM `master2` $filterQuery";
                    $result = $con->query($sql);
                    $targetArr = array();
                    while ($row = $result->fetch_assoc()) {
                        $myTarget = $row['target organism'];
                        if ($myTarget != 'No Target Organism Found') {
                            array_push($targetArr, $myTarget);
                        }
                    }
                    $targetArrString = implode(";", $targetArr);
                    $assocTarget = array();
                    $targetList = array('A.actinomycetemcomitans (Gram-negative)', 'A.alternata', 'A.baumannii (Gram-negative)', 'A.benhamiae', 'A.brassicae', 'A.brassicicola', 'A.calcoaceticus (Gram-negative)', 'A.cucumerina', 'A.domesticus', 'A.faecalis (Gram-positive)', 'A.flavus (Not characterize)', 'A.fumigatus', 'A.globiformis (Gram-positive)', 'A.hydrophila (Gram-negative)', 'A.laidlawii (Gram-positive)', 'A.lycopersici', 'A.nidulans (Gram-positive)', 'A.niger', 'A.parasiticus', 'A.pisum', 'A.salmonicida (Gram-negative)', 'A.solani', 'A.stephensi', 'A.terreus (Not characterize)', 'A.tumefaciens (Gram-negative)', 'A.viridans (Gram-positive)', 'A.viscosus (Gram-positive)', 'Acinetobacter baumannii (Gram-negative)', 'Acinetobacter spec. (Gram-negative)', 'Actinomyces (Gram-positive)', 'Acute', 'Aeropyrum pernix', 'African green', 'Alternaria solani', 'Aspergillus oryzae', 'Aspergillus terreus', 'B.adolescentis (Gram-positive)', 'B.algicola (Not characterize)', 'B.amyloliquefaciens (Gram-positive)', 'B.anthracis (Gram-positive)', 'B.bacteriovorus (Gram-negative)', 'B.bassiana', 'B.breve (Gram-positive)', 'B.brevis (Gram-positive)', 'B.cepacia (Gram-negative)', 'B.cereus (Gram-positive)', 'B.cinerea', 'B.coagulans (Gram-positive)', 'B.dendrobatidis', 'B.licheniformis (Gram-positive)', 'B.longum (Gram-positive)', 'B.magaterium (Gram-positive)', 'B.malayi', 'B.megaterium', 'B.mycoides (Gram-positive)', 'B.pertussis (Gram-negative)', 'B.pumilus (Gram-positive)', 'B.sorokiniana', 'B.subtilis (Gram-positive)', 'B.thuringiensis (Gram-positive)', 'Bacillus (Gram-positive)', 'Bacillus cereus (Gram-positive)', 'Bacillus megaterium (Gram-positive)', 'Bacillus subtilis (Gram-positive)', 'Beauveria', 'Burkholderia (Gram-negative)', 'Burkholderia cepacia (Gram-negative)', 'C.albicans', 'C.albidus', 'C.bovis (Gram-positive)', 'C.cassicola', 'C.coccodes', 'C.comatus', 'C.crenatum (Gram-positive)', 'C.diphtheriae (Gram-positive)', 'C.divergens (Gram-positive)', 'C.freundii (Gram-negative)', 'C.fructus', 'C.glabrata', 'C.globosum', 'C.gloeosporioides', 'C.glutamicum (Gram-positive)', 'C.guilliermondii', 'C.irritans', 'C.jejuni (Gram-negative)', 'C.michiganensis (Gram-positive)', 'C.neoformans', 'C.parapsilosis', 'C.perfringens (Gram-positive)', 'C.sakazakii (Gram-negative)', 'C.sphaerospermum', 'C.sporogenes (Gram-negative)', 'C.tropicalis (Gram-negative)', 'C.versicolor', 'C.wickerhamii', 'Campylobacter (Gram-negative)', 'Candida', 'Candida albicans', 'Candida species', 'Candida spp.', 'Carnobacterium (Gram-positive)', 'Chandipura', 'Clostridium (Gram-positive)', 'Clostridium difficile (Gram-positive)', 'Clostridium spp. (Gram-positive)', 'Collectotrichum', 'Coral', 'Corynebacterium (Gram-positive)', 'Cryptococcus neoformans', 'D.bryoniae', 'D.coniospora', 'D.melanogaster', 'Dengue', 'Drosophila', 'E.Coli (Gram-negative)', 'E.casseliflavus (Gram-positive)', 'E.cloacae (Gram-negative)', 'E.coli (Gram-negative)', 'E.faecalis (Gram-positive)', 'E.faecium (Gram-positive)', 'E.hirae (Gram-positive)', 'Enterobacter (Gram-negative)', 'Enterobacteriaceae (Gram-negative)', 'Enterococcus (Gram-positive)', 'Enterococcus faecalis (Gram-positive)', 'Enterococcus faecium (Gram-positive)', 'Enterococcus sp. (Gram-positive)', 'Epinephelus fario', 'Escherichia coli (Gram-negative)', 'F.avenaceum', 'F.culmorum', 'F.graminearum', 'F.oxysporum', 'F.solani (Gram-positive)', 'F.verticillioides', 'Francisella tularensis (Gram-negative)', 'Fungi', 'Fusarium', 'G.candidum', 'G.trabeum', 'G.vaginalis (Gram-positive)', 'Gram Negative Bacteria', 'Gram Negative Bacteria and Gram Positive Bacteria', 'Gram Positive Bacteria', 'H.annosum', 'H.armigera', 'H.contortus', 'H.influenzae (Gram-negative)', 'H.pylori (Gram-negative)', 'H.rufa', 'Haemophilus influenzae (Gram-negative)', 'Halobacterium', 'Hepatitis B', 'K.oxytoca (Gram-negative)', 'K.pneumonia', 'K.pneumoniae (Gram-negative)', 'K.thermotolerans', 'K.varians (Gram-positive)', 'Klebsiella (Gram-negative)', 'Klebsiella pneumonia (Gram-negative)', 'Klebsiella sp (Gram-negative)', 'Kocuria (Gram-positive)', 'L.acidophilus (Gram-positive)', 'L.amazonensis', 'L.brevis (Gram-positive)', 'L.caesar', 'L.casei (Gram-positive)', 'L.cuprina', 'L.curvatus (Gram-positive)', 'L.fermentum (Gram-positive)', 'L.garvieae (Gram-positive)', 'L.gaucho', 'L.grayi (Gram-positive)', 'L.infantum', 'L.innocua (Gram-positive)', 'L.ivanovii (Gram-positive)', 'L.jensenii (Gram-positive)', 'L.lactis (Gram-positive)', 'L.lindneri', 'L.major', 'L.mesenteroides (Gram-positive)', 'L.monocytogenes (Gram-positive)', 'L.mucor (Gram-negative)', 'L.paracasei (Gram-positive)', 'L.pentosus (Gram-positive)', 'L.plantarum (Gram-positive)', 'L.pneumophila (Gram-negative)', 'L.rhamnosus (Gram-positive)', 'L.sakei (Gram-positive)', 'L.salivarius (Gram-positive)', 'L.seeligeri (Gram-positive)', 'L.viridescens', 'L.welshimeri (Gram-positive)', 'Lactobacillus (Gram-positive)', 'Lactobacillus sakei (Gram-positive)', 'Lactococcus (Gram-positive)', 'Leishmania', 'Leishmania amazonensis', 'Leishmania infantum', 'Leishmania sp.', 'Leishmania species', 'Lepidopteran', 'Leuconostoc (Gram-positive)', 'Leuconostoc mesenteroides (Gram-positive)', 'Listeria (Gram-positive)', 'Listeria monocytogenes (Gram-positive)', 'Listeria spp. (Gram-positive)', 'M.catarrhalis (Gram-negative)', 'M.flavus (Not characterize)', 'M.fortuitum (Gram-positive)', 'M.furfur', 'M.grisea (Gram-positive)', 'M.luteus (Gram-negative)', 'M.maritypicum (Not characterize)', 'M.massiliense (Gram-positive/Gram-negative)', 'M.morganii (Gram-negative)', 'M.nematophilum (Not characterize)', 'M.phlei (Gram-positive)', 'M.rileyi', 'M.smegmatis (Gram-positive)', 'M.tuberculosis (Gram-positive)', 'Micrococcus (Gram-positive)', 'Micrococcus luteus (Gram-positive)', 'Mycobacterium (Gram-positive)', 'Mycobacterium abscessus (Gram-positive)', 'Mycobacterium bovis (Gram-positive)', 'Mycobacterium species (Gram-positive)', 'Mycobacterium tuberculosis (Gram-positive)', 'Mycoplasma (Gram-negative)', 'N.cinerea (Gram-negative)', 'N.crassa', 'N.gonorrhoeae (Gram-negative)', 'Neurospora', 'Neurospora crassa', 'P.acidilactici (Gram-positive)', 'P.acnes', 'P.aeruginosa (Gram-negative)', 'P.alginovora (Gram-negative)', 'P.berghei', 'P.beta', 'P.betae', 'P.brasiliensis (Gram-positive/Gram-negative)', 'P.capsici (Gram-negative)', 'P.chrysosporium', 'P.denitrificans (Gram-negative)', 'P.digitatum', 'P.entomophila (Gram-negative)', 'P.falciparum', 'P.fluorescens (Gram-negative)', 'P.freudenreichii (Gram-positive)', 'P.granivorans (Gram-positive)', 'P.haemolytica (Gram-negative)', 'P.immobilis (Gram-negative)', 'P.infestans', 'P.jensenii', 'P.larvae (Gram-positive)', 'P.meadii', 'P.micros', 'P.mirabilis (Gram-negative)', 'P.multocida (Gram-negative)', 'P.nicotianae (Gram-positive)', 'P.pastoris', 'P.paucidens', 'P.pentosaceus (Gram-positive)', 'P.piricola', 'P.placenta', 'P.putida (Gram-negative)', 'P.rettgeri (Gram-negative)', 'P.rhodesiae (Gram-negative)', 'P.syringae (Gram-negative)', 'P.tannophilus', 'P.ultimum', 'P.verrucosum', 'P.versicolor (Gram-negative)', 'P.vulgaris (Gram-negative)', 'P.wickerhamii', 'Pediococcus (Gram-positive)', 'Penicillium digitatum', 'Plasmodium berghei', 'Plasmodium gallinaceum', 'Propionibacterium (Gram-positive)', 'Proteus (Gram-negative)', 'Pseudomonas (Gram-negative)', 'Pseudomonas aeruginosa (Gram-negative)', 'Pseudomonas sp. (Gram-negative)', 'R.cerealis', 'R.equi', 'R.mucilaginosa (Gram-positive)', 'R.rhodochrous (Gram-positive)', 'R.solani', 'R.stolonifer', 'Rhizomucor pusillus', 'Rhodococcus sp. (Gram-positive)', 'S.agalactiae (Gram-positive)', 'S.aureus (Gram-positive)', 'S.bovis (Gram-negative)', 'S.boydii (Gram-negative)', 'S.carnaria', 'S.carnosus (Gram-positive)', 'S.cerevisiae', 'S.choleraesuis', 'S.commune', 'S.dysenteriae (Gram-negative)', 'S.dysgalactiae (Gram-positive)', 'S.enterica (Gram-negative)', 'S.enteritidis', 'S.epidermidis (Gram-positive)', 'S.epidermis', 'S.equi (Gram-positive)', 'S.faecalis (Gram-positive)', 'S.flexneri (Gram-negative)', 'S.frugiperda', 'S.gallinarum (Gram-positive)', 'S.haemolyticus (Gram-positive)', 'S.hemolyticus', 'S.hominis (Gram-negative)', 'S.iniae (Gram-positive)', 'S.lutea (Gram-negative)', 'S.mansoni', 'S.marcescens (Gram-negative)', 'S.melliferum (Gram-positive)', 'S.mutans (Gram-positive)', 'S.pneumoniae (Gram-positive)', 'S.pombe', 'S.pyogenes (Gram-positive)', 'S.saprophyticus (Gram-positive)', 'S.sclerotiorum', 'S.sonnei (Gram-negative)', 'S.suis (Gram-positive)', 'S.thermophilus (Gram-positive)', 'S.typhi', 'S.typhimurium', 'S.uberis (Gram-positive)', 'S.warneri (Gram-positive)', 'S.xylosus (Gram-positive)', 'Salmonella (Gram-negative)', 'Salmonella sp. (Gram-negative)', 'Salmonella species (Gram-negative)', 'Serratia marcescens (Gram-negative)', 'Shigella (Gram-negative)', 'Staphylococcus (Gram-positive)', 'Staphylococcus aureus (Gram-positive)', 'Staphylococcus species (Gram-positive)', 'Staphylococcus spp. (Gram-positive)', 'Streptococcus (Gram-positive)', 'Streptococcus sp. (Gram-positive)', 'Streptococcus uberis (Gram-positive)', 'T.beigelii', 'T.brucei', 'T.cruzi', 'T.delbrueckii', 'T.denticola (Gram-negative)', 'T.gondii', 'T.harzianum', 'T.reesei', 'T.viride', 'Tick', 'Toxoplasma gondii', 'Trichoderma', 'Trichoderma reesei', 'Trichoderma species', 'Trichophyton rubrum', 'Trichosporon spp.', 'Trypanosoma', 'Trypanosoma cruzi', 'V.alginolyticus (Gram-negative)', 'V.anguillarum (Gram-negative)', 'V.cholerae (Gram-negative)', 'V.dahliae', 'V.fluvialis (Gram-positive)', 'V.harveyi (Gram-negative)', 'V.parahaemolyticus (Gram-negative)', 'V.penaeicida (Gram-negative)', 'V.vulnificus (Gram-negative)', 'Vibrio (Gram-negative)', 'X.axonopodis (Gram-negative)', 'X.campestris (Gram-negative)', 'Xanthomonas axonopodis (Gram-negative)', 'Y.enterocolitica (Gram-negative)', 'Y.pseudotuberculosis (Gram-negative)', 'Yellow Fever', 'Yersinia (Gram-negative)', 's.marcescens (Gram-negative)');
                    foreach ($targetList as $trget) {
                        $match = preg_match_all("/" . str_replace(")", "", str_replace("(", "", str_replace("/", "", $trget))) . "/",  str_replace("/", "", str_replace(")", "", str_replace("(", "", $targetArrString))));
                        if ($match != 0) {
                            $assocTarget[$trget] = $match;
                        }
                    }
                    arsort($assocTarget);
                    $mySelectedAct = array();
                    foreach ($assocTarget as $key => $val) {
                        $match = preg_match_all("/" . str_replace("(", "", str_replace(")", "", str_replace("/", "", $key))) . "/", str_replace("(", "", str_replace(")", "", str_replace("/", "", $fiLtarget))));
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
                    $sql = "SELECT `Organism` FROM `master2` $filterQuery";
                    $result = $con->query($sql);
                    $targetArr = array();
                    while ($row = $result->fetch_assoc()) {
                        $myTarget = $row['Organism'];
                        array_push($targetArr, explode("(", $myTarget)[0]);
                    }
                    $targetArrString = implode(" ", $targetArr);
                    $mysql = "SELECT DISTINCT(`Organism`) FROM `master2` $filterQuery";
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
                        $match = preg_match_all("/" . str_replace("(", "", str_replace(")", "", str_replace("/", "", $key))) . "/", str_replace("(", "", str_replace(")", "", str_replace("/", "", $fiLorganism))));
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
                    $sql = "SELECT `Protein existence` FROM `master2` $filterQuery";
                    $result = $con->query($sql);
                    $targetArr = array();
                    while ($row = $result->fetch_assoc()) {
                        $myTarget = $row['Protein existence'];
                        array_push($targetArr, $myTarget);
                    }
                    $targetArrString = implode(";", $targetArr);
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
                        $match = preg_match_all("/" . str_replace("(", "", str_replace(")", "", str_replace("/", "", $key))) . "/", str_replace("(", "", str_replace(")", "", str_replace("/", "", $fiLexist))));
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

                        $mysql5 = "SELECT COUNT(Serial_No) FROM `master2` WHERE $myval $forLength";
                        $assOxx = $con->query($mysql5);
                        $mydata =  $assOxx->fetch_all()[0][0];
                        if ($mydata > 0) {
                            $assArr[$myval] = $mydata;
                        }
                        $start += 100;
                        $end += 100;
                    }
                    foreach ($assArr as $key => $val) {
                        $match = preg_match_all("/" . str_replace("(", "", str_replace(")", "", str_replace("/", "", $key))) . "/", str_replace("(", "", str_replace(")", "", str_replace("/", "", $fiLlength))));
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
                                    $con->close();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="container-fluid" id="data" style="width: 90%;">
    </div>
    <div class="container d-flex justify-content-center">
        <div class="spinner-border m-5 text-success" id="loading" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <script>
        function uncheckRadios() {
            var radioButtons = document.querySelectorAll('input[type="radio"]');
            radioButtons.forEach(function(radio) {
                radio.checked = false;
            });
        }

        function removePreChecked() {
            var radioButtons = document.querySelectorAll('input[type="radio"]');
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            radioButtons.forEach(function(radio) {
                radio.checked = false;
            });
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }

        function updateTextbox(checkbox) {
            var resultTextbox = document.getElementById("result");
            var checkboxValue = checkbox.value;
            if (checkbox.checked) {
                if (resultTextbox.value === '') {
                    resultTextbox.value += checkboxValue;
                } else {
                    resultTextbox.value += ',' + checkboxValue;
                }
            } else {
                var currentValue = resultTextbox.value;
                var newValue = currentValue
                    .replace(checkboxValue + ',', '')
                    .replace(',' + checkboxValue, '')
                    .replace(checkboxValue, '');
                resultTextbox.value = newValue;
            }
        }

        function uncheckCheckbox() {
            var checkbox = document.querySelector('input[name="sort"]');
            checkbox.checked = false;
        }

        function toggleCheckboxes() {
            const checkboxes = document.querySelectorAll('input[type=checkbox][name=ampdbid]');
            const isChecked = checkboxes[0].checked;
            const checkedValues = [];

            for (let i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = !isChecked;
                if (checkboxes[i].checked) {
                    checkedValues.push(checkboxes[i].value);
                }
            }
            const resultInput = document.getElementById('result');
            resultInput.value = checkedValues.join(',');
        }

        function getAllParameterValues(parameterName) {
            var url = window.location.href;
            var queryString = url.substring(url.indexOf('?') + 1);
            var parameterPairs = queryString.split('&');
            var parameterValues = [];
            for (var i = 0; i < parameterPairs.length; i++) {
                var pair = parameterPairs[i].split('=');
                var name = decodeURIComponent(pair[0]);
                var value = decodeURIComponent(pair[1]);
                if (name === parameterName) {
                    parameterValues.push(value);
                }
            }
            return parameterValues.join(",").replace(/\+/g, " ");
        }
        const activity = getAllParameterValues('activity');
        const target = getAllParameterValues('target');
        const organism = getAllParameterValues('organism');
        const exist = getAllParameterValues('exist');
        const len = getAllParameterValues('length');
        const sort = getAllParameterValues('sort')
        const ad = getAllParameterValues('ad');
        var myR = <?php echo $totRec; ?>;
        $(window).scroll(function() {
            if (myR > -1) {
                if ($(window).scrollTop() + $(window).height() > $(document).height() - 220) {
                    if (!isrunning) {
                        showdata();
                        myR -= 10;
                    }
                }
            }
        });
        var page_no = 1;
        var isrunning = false;
        showdata();

        function showdata() {
            isrunning = true;
            $("#loading").show();
            $.post("data-browse-all-data.php", {
                page: page_no,
                activity: activity,
                target: target,
                organism: organism,
                exist: exist,
                length: len,
                sort: sort,
                ad: ad
            }, (response) => {
                $("#data").append(response);
                $("#loading").hide();
                isrunning = false;
                page_no++;
            });
        }

        function submitForm() {
            const checkboxes1 = document.querySelectorAll('input[type="checkbox"][name="activity"]:checked');
            const values1 = [];
            checkboxes1.forEach((checkbox) => {
                values1.push(checkbox.value);
            });
            const urlParams1 = new URLSearchParams(window.location.search);
            urlParams1.set('activity', values1.join(','));
            const checkboxes2 = document.querySelectorAll('input[type="checkbox"][name="target"]:checked');
            const values2 = [];
            checkboxes2.forEach((checkbox) => {
                values2.push(checkbox.value);
            });
            const urlParams2 = new URLSearchParams(window.location.search);
            urlParams2.set('target', values2.join(','));
            const checkboxes3 = document.querySelectorAll('input[type="checkbox"][name="organism"]:checked');
            const values3 = [];
            checkboxes3.forEach((checkbox) => {
                values3.push(checkbox.value);
            });
            const urlParams3 = new URLSearchParams(window.location.search);
            urlParams3.set('organism', values3.join(','));
            const checkboxes4 = document.querySelectorAll('input[type="checkbox"][name="exist"]:checked');
            const values4 = [];
            checkboxes4.forEach((checkbox) => {
                values4.push(checkbox.value);
            });
            const urlParams4 = new URLSearchParams(window.location.search);
            urlParams4.set('exist', values4.join(','));
            const checkboxes5 = document.querySelectorAll('input[type="radio"][name="length"]:checked');
            const values5 = [];
            checkboxes5.forEach((checkbox) => {
                values5.push(checkbox.value);
            });
            const urlParams5 = new URLSearchParams(window.location.search);
            urlParams5.set('length', values5.join(','));
            const radioButton = document.querySelector('input[type="radio"][name="sort"]:checked');
            const value2 = radioButton ? radioButton.value : '';
            const urlParams6 = new URLSearchParams(window.location.search);
            urlParams6.set('sort', value2);
            const radioButton7 = document.querySelector('input[type="radio"][name="ad"]:checked');
            const value7 = radioButton7 ? radioButton7.value : '';
            const urlParams7 = new URLSearchParams(window.location.search);
            urlParams7.set('ad', value7);
            window.location.href = new 'browse-all-data?' + urlParams1.toString() + '&' + urlParams2.toString() + '&' + urlParams3.toString() + '&' + urlParams4.toString() + '&' + urlParams5.toString() + '&' + urlParams6.toString() + '&' + urlParams7.toString();
        }
    </script>
    <br><br><br>
    <footer class="mt-3 text-center p-2 text-white" style="position: fixed; background-color: #5A6F80; font-size: small; left: 0; bottom: 0; width: 100%;">
        © 2023 B&BL, DoAS, IIIT-A, UP-211015, India
    </footer>

</body>

</html>