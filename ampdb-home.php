<?php
require 'dbcon.php';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$udresult = curl_exec($ch);
$udresult = json_decode($udresult);
if (@$udresult->status == 'success') {
    if (isset($udresult->lat) && isset($udresult->lon)) {
        $sql2 = "INSERT INTO `web` (`country`, `countryCode`, `region`, `regionName`, `city`, `pin`, `lat`, `lon`, `myutz`, `isp`, `org`, `asp`, `ip`) VALUES ('$udresult->country', '$udresult->countryCode', '$udresult->region', '$udresult->regionName', '$udresult->city', '$udresult->zip', '$udresult->lat', '$udresult->lon', '$udresult->timezone', '$udresult->isp', '$udresult->org', '$udresult->as', '$udresult->query')";
        $con->query($sql2);
    } else {
        $sql2 = "INSERT INTO `web` (`country`, `countryCode`, `region`, `regionName`, `city`, `pin`, `lat`, `lon`, `myutz`, `isp`, `org`, `asp`, `ip`) VALUES ('$udresult->country', '$udresult->countryCode', '$udresult->region', '$udresult->regionName', '$udresult->city', '$udresult->zip', '', '', '$udresult->timezone', '$udresult->isp', '$udresult->org', '$udresult->as', '$udresult->query')";
        $con->query($sql2);
    }
} else {
    $sql2 = "INSERT INTO `web` (`country`, `countryCode`, `region`, `regionName`, `city`, `pin`, `lat`, `lon`, `myutz`, `isp`, `org`, `asp`, `ip`) VALUES ('', '', '', '', '', '', '', '', '', '', '', '', 'PROXY')";
    $con->query($sql2);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to AMPDB v1! It is a comprehensive and feature-rich database of anti-microbial peptides, providing an exhaustive collection of known peptides with curated information. AMPDB aims to be a valuable resource for researchers, offering high-quality data, classification, and tools in an easily accessible manner.">
    <meta name="keywords" content="AMPDB v1, AMPDB, Anti-microbial Peptide Database version 1, AMPDB Home, ampdb, ampdb@iiita, ampdb v1, ampdb at Biochemistry & Bioinformatics Lab, ampdbv1">
    <meta name="author" content="Rajat Kumar Mondal">
    <meta name="robots" content="index, follow">

    <title>AMPDB Home</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .td {
            text-decoration: none;
            color: white;
        }

        a:hover {
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand fs-3" href="javascript:void(0)">AMPDB v1</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Search</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="ampdb-text-search">Text Search</a></li>
                            <li><a class="dropdown-item" href="ampdb-specific-search">Specific Text Search</a></li>
                            <li><a class="dropdown-item" href="ampdb-target-organism-search">Search by Target
                                    Organism</a></li>
                            <li><a class="dropdown-item" href="ampdb-pp-search">Search by Physicochemical Properties</a>
                            </li>
                            <li><a class="dropdown-item" href="ampdb-composition-search">Search by Protein Composition</a>
                            </li>
                            <li><a class="dropdown-item" href="ampdb-activity-search">Search by Activity</a></li>
                            <li><a class="dropdown-item" href="ampdb-advanced-search">Advanced Search</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="browse-all-data">Browse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ampdb-classification">Classification</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Tools</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="https://ampdb-protein-sequence-alignment-toolbox.streamlit.app/" target="_blank">Protein Sequence Alignment Toolbox</a></li>
                            <li><a class="dropdown-item" href="https://ampdb-protein-feature-calculation-toolbox.streamlit.app/" target="_blank">Protein Feature Calculation Toolbox</a></li>
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
    <div class="container-fluid " style="margin-top: 1.34%;">
        <div class="row">
            <div class="col-sm-10" style="background-color: #F0F8FF; padding-top: 1%">
                <div class="" style="font-size: larger; font-weight: 500; padding: 1% 0% 0% 2%;">
                    Welcome to AMPDB v1
                </div>
                <div class="fs-6" style="text-align: justify; padding: 0% 2% 2% 2%;">
                    AMPDB v1, or Anti-microbial Peptide Database version 1, is a comprehensive database of anti-microbial peptides,
                    containing an almost exhaustive list of anti-microbial peptides known currently, and extensive
                    curated information. AMPDB is an feature rich knowledge-base.
                    <br>
                    This database tries to assimilate information from various resources. We have NCBI databases,
                    EMBL databases, UniProt, RCSB-PDB and PubMed as
                    fundamental sources. The databases is also cross-referenced with 25 other resource (like IntAct, STRING, MINT, DIP, BioGRID, BindingD and 19 more)
                    of our data and performed multiple layers of curation on that data; including
                    detailed literature survey, and have used multiple protein feature extraction libraries to extract
                    features and employed data processing scripts to ensure the user gets high quality and reliable
                    information, arranged in an intuitive and easily accessible manner. Currently this resource contain <b style="font-weight: 500;">59122 entries</b> which are classified into <b style="font-weight: 500;">88 different classes</b> (Click
                    on 'Classification' to view it).
                    <br>
                    AMPDB fulfils the need of a regularly updated and accurate resource for anti-microbial peptides;
                    which is loaded with all of the tools and technicalities that is expected by any researcher. It is
                    our humble effort to provide the scientific community with a much needed resource, and a promise of
                    continuous development. We hope it will be of great value to the entire scientific community.
                </div>
            </div>
            <div class="col-sm-2 bg-light" style="padding-top: 0.9%">
                <div class="" style="font-size: larger; font-weight: 500; padding: 5% 0% 0% 2%;">
                    Our Promise
                </div>
                <div class="fs-6" style="text-align: justify; padding: 1% 4% 4% 2%;">
                    We will keep this site online, updated and regularly maintained. <br> The database was last updated on
                    <b style="font-weight: 500;">04-04-2023</b>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
                <div class="" style="font-size: larger; font-weight: 500; padding: 1% 0% 0% 2%;">
                    Latest Updates/News
                </div>
                <?php
                $sql = "SELECT * FROM `news` ORDER BY dt DESC LIMIT 2";
                $result = $con->query($sql);
                $c = 1;
                while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="" style="text-align: justify; padding: 0% 2% 0% 2.5%; font-size: medium; font-weight: 500;">
                        <?= $c ?>. <?= $row['headline'] ?>
                    </div>
                    <div class="" style="text-align: justify; padding: 0% 2% 0% 3.5%; font-size: medium;">
                        <?= $row['news details'] ?>
                    </div>
                    <div class="mb-1" style="text-align: justify; padding: 0% 2% 0% 3.5%; font-size: small;">
                        <i>By Admin, Date & Time: <?= $row['dt'] ?>.</i>
                    </div>
                <?php $c += 1;
                } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm text-end">
                <div class="text-end" style="text-align: justify; padding: 0.5% 2% 2% 2.5%; font-size: smaller;">
                    <i>Only
                        lates 2 news are displayed in this section.<br>Click on News/Updates menu to see more/older
                        news.</i>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row" style="background-color: #44525D;">
            <div class="col-sm text-center text-white " style="font-size: larger; padding: 1% 0% 0% 0%; font-weight: 500;">
                Quick Links
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row" style="background-color: #44525D;">
            <div class="col-sm-4 text-center text-white p-3">
                <div class="p-1"><a class="td" href="https://www.ncbi.nlm.nih.gov/">NCBI</a></div>
                <div class="p-1"><a class="td" href="https://www.ebi.ac.uk/">EMBL-EBI</a></div>
                <div class="p-1"><a class="td" href="https://www.uniprot.org/">UniProt</a></div>
                <div class="p-1"><a class="td" href="https://www.rcsb.org/">PDB</a></div>
                <div class="p-1"><a class="td" href="https://www.expasy.org/">Expasy</a></div>
                <div class="p-1"><a class="td" href="https://www.lens.org/">LENS.ORG</a></div>
                <div class="p-1"><a class="td" href="http://www.camp.bicnirrh.res.in/#:~:text=CAMPR3%20(Collection%20of%20Anti,discover%20and%20design%20novel%20AMPs.">CAMPR4</a>
                </div>
            </div>
            <div class="col-sm-4 text-center text-white p-3">
                <div class="p-1"><a class="td" href="https://aps.unmc.edu/">APD3</a></div>
                <div class="p-1"><a class="td" href="http://dramp.cpu-bioinfor.org/">DRAMP</a></div>
                <div class="p-1"><a class="td" href="https://dbaasp.org/home">DBAASP(V3.0)</a></div>
                <div class="p-1"><a class="td" href="http://yadamp.unisa.it/">YADAMP</a></div>
                <div class="p-1"><a class="td" href="http://phytamp.pfba-lab-tun.org/main.php">PhytAMP</a></div>
                <div class="p-1"><a class="td" href="http://defensins.bii.a-star.edu.sg/">Defensins KnowledgeBase</a>
                </div>
                <div class="p-1"><a class="td" href="http://split4.pmfst.hr/dadp/?">DAPD</a></div>
            </div>
            <div class="col-sm-4 text-center text-white p-3">
                <div class="p-1"><a class="td" href="http://bactibase.hammamilab.org/">Bactibase</a></div>
                <div class="p-1"><a class="td" href="http://www.baamps.it/">BaAMPs</a></div>
                <div class="p-1"><a class="td" href="https://ciencias.medellin.unal.edu.co/gruposdeinvestigacion/prospeccionydisenobiomoleculas/InverPep/public/home_en">InverPep</a>
                </div>
                <div class="p-1"><a class="td" href="https://awi.cuhk.edu.cn/dbAMP/">dbAMP</a></div>
                <div class="p-1"><a class="td" href="http://faculty.ist.unomaha.edu/chen/rapd/index.php">RAPD</a>
                </div>
                <div class="p-1"><a class="td" href="http://crdd.osdd.net/servers/hipdb">HIPdb</a></div>
                <div class="p-1"><a class="td" href="https://bioinformatics.cs.ntou.edu.tw/adam/index.html">ADAM</a></div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm text-center text-white p-3" style="font-size:x-small; background-color: #5A6F80;">
                Developed and Maintained by Biochemistry & Bioinformatics Lab (B&BL)
                <br>
                Department of Applied Sciences (DoAS)
                <br>
                Indian Institute of Information Technology Allaha​bad (IIIT-A), Devghat, Jhalwa, Prayagraj-211015, U. P.
                India
                <br>
                <br>
                © 2023, B&BL, DoAS, IIIT-A, India
                <br>
                Visitor Count:
                <?php
                $query = "SELECT COUNT(`id`) FROM `web`";
                $runQ = $con->query($query);
                print_r($runQ->fetch_assoc()['COUNT(`id`)']);
                $con->close();
                ?> (Since 2023-04-03 05:48:28)
            </div>
        </div>
    </div>
</body>

</html>