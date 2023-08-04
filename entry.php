<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="ss.css">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">

    <style>
        .scr {
            margin: 4px, 4px;
            padding: 4px;
            width: 100%;
            height: 380px;
            overflow-x: hidden;
            overflow-y: auto;
            text-align: justify;
        }

        body {
            background-color: white;
            color: black;
        }

        .dark-mode {
            background-color: black;
            color: white;
        }

        table-header {
            position: sticky;
            top: 0;
        }

        .container-h {
            width: 100%;
            height: 350px;
            overflow: auto;
        }
    </style>
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
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">Search</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="ampdb-text-search">Text Search</a></li>
                            <li><a class="dropdown-item" href="ampdb-specific-search">Specific Text Search</a></li>
                            <li><a class="dropdown-item" href="ampdb-target-organism-search">Search by Target
                                    Organism</a></li>
                            <li><a class="dropdown-item" href="ampdb-pp-search">Search by Physicochemical Properties</a>
                            </li>
                            <li><a class="dropdown-item" href="ampdb-composition-search">Search by Protein
                                    Composition</a>
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
    <br>
    <br>
    <br>
    <?php
    require 'dbcon.php';
    $name = $_GET['id'];
    $sql = "SELECT * FROM `master` WHERE master.AMPDB_No_='$name'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ampdbid = $row['AMPDB_No_'];
            $proteinName = $row['Protein names'];
            $gene = $row['Gene Names'];
            $length = $row['Length'];
            $org = $row['Organism'];
            $pubmed = $row['PubMed ID'];
            $pe = $row['Protein existence'];
            $orgid = $row['Organism (ID)'];
            $seq = $row['Sequence'];
            $protFam = $row['Protein families'];
            $aaCou = str_replace("}", "", (str_replace("{", "", $row['Counts'])));
            $aafreq = explode(",", str_replace("}", "", (str_replace("{", "", $row['Frequencies']))));
            $pub = explode(";", $pubmed);
            $mass = round($row['Molecular Weight'], 3);
            $ali = round($row['Aliphatic Index'], 3);
            $isi = round($row['Instability Index'], 3);
            $gravy = round($row['Hydrophobicity (GRAVY)'], 3);
            $hydro_mom = round($row['Hydrophobic Moment'], 3);
            $ip = round($row['Isoelectric Point'], 3);
            $charge = round($row['Charge (at pH 7)'], 3);
            $ssf = explode(",", str_replace(")", "", str_replace("(", "", $row['Secondary Structure Fraction'])));
            $ar = round($row['Aromaticity'], 3);
            $mec = str_replace(")", "", str_replace("(", "", $row['Molar Extinction Coefficient (cysteine|cystine)']));
            $missRes = $row['missRes'];
            $commonRes = $row['commonRes'];
            $uncommonRes = $row['leastOccRes'];
            $phoAA = $row['phoAA'];
            $phiAA = $row['phiAA'];
            $basicAACount = $row['basicAACount'];
            $acidicAACount = $row['acidicAACount'];
            $modifiedAA = $row['modifiedAA'];
            $modifiedAAfreq = $row['modifiedAAfreq'];
            $targetOrg = $row['target organism'];
            $targetOrgRef = $row['ref'];
            $antimicrobial = $row['peptide activity'];
            $enzyme = $row['enzyme'];
            $inhibition = $row['inhibition'];
            $other = $row['other'];
            $pubmed = $row['PubMed ID'];
            $uniprot = $row['Entry'];
            $pdb = $row['PDB'];
            $pdbsum = $row['PDBsum'];
            $string = $row['STRING'];
            $intact = $row['IntAct'];
            $mint = $row['MINT'];
            $DIP = $row['DIP'];
            $biogrid = $row['BioGRID'];
            $bindingdb = $row['BindingDB'];
            $chembl = $row['ChEMBL'];
            $drugbank = $row['DrugBank'];
            $imgt = $row['IMGT_GENE-DB'];
            $dbsnp = $row['dbSNP'];
            $geneid = $row['GeneID'];
            $kegg = $row['KEGG'];
            $ensembl = $row['Ensembl'];
            $genetree = $row['GeneTree'];
            $brenda = $row['BRENDA'];
            $biocyc = $row['BioCyc'];
            $rnact = $row['RNAct'];
            $expressionAtlas = $row['ExpressionAtlas'];
            $panther = $row['PANTHER'];
            $prosite = $row['PROSITE'];
            $interpro = $row['InterPro'];
            $embl = $row['EMBL'];
            $ccds = $row['CCDS'];
            $refseq = $row['RefSeq'];
    ?>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <div class="text-end">
                            <button type="button" class="btn btn-info rounded-0" style="background-color: #F1F1F1; color: #5B616B; border: 1px solid #F1F1F1; border-radius: 0px;" data-bs-toggle="modal" data-bs-target="#myModal">
                                Download
                            </button>
                        </div>
                        <div class="modal" id="myModal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Download</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm" style="font-weight: 500;">FASTA Format
                                                    <hr style="margin: 0">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-sm" style="padding-left: 4%;">
                                                    <a href='files/<?= $ampdbid ?>.fasta' style='text-decoration: none; color: #0071BC; border: 1px solid #0071BC; --bs-btn-padding-y: 0.230rem;' class="btn btn-secondary rounded-0 bg-light">Display</a>
                                                    <a href='files/<?= $ampdbid ?>.fasta' style='text-decoration: none; color: #0071BC; border: 1px solid #0071BC; --bs-btn-padding-y: 0.230rem;' class="btn btn-secondary bg-light rounded-0 ms-2" download="">Download</a>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-sm" style="font-weight: 500;">Text Format
                                                    <hr style="margin: 0">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-sm" style="padding-left: 4%;">
                                                    <a href='files/<?= $ampdbid ?>.txt' style='text-decoration: none; color: #0071BC; border: 1px solid #0071BC; --bs-btn-padding-y: 0.230rem;' class="btn btn-secondary bg-light rounded-0">Display</a>
                                                    <a href='files/<?= $ampdbid ?>.txt' style='text-decoration: none; color: #0071BC; border: 1px solid #0071BC; --bs-btn-padding-y: 0.230rem;' class="btn btn-secondary bg-light rounded-0 ms-2" download="">Download</a>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-sm" style="font-weight: 500;">Looking to Download a PDF of This Page?
                                                    <hr style="margin: 0">
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-sm mb-4" style="padding-left: 4%; font-size:small">
                                                    <i> Please use print functionality available in your browser and look for a save as PDF option.</i>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            chdir('./files');
            $fastaFile = fopen("$ampdbid.fasta", "w") or die("UtW");
            fwrite($fastaFile, ">$ampdbid|$proteinName|$org\n");
            for ($i = 0; $i < strlen($seq); $i += 60) {
                $slSeq = substr($seq, $i, 60);
                fwrite($fastaFile, $slSeq . "\n");
            }
            fclose($fastaFile);
            $entrywrite = fopen("$ampdbid.txt", "w") or die("UtW");
            fwrite($entrywrite, "ID    $ampdbid\n");
            $protN = explode("(", str_replace("[", "(", $proteinName))[0];
            fwrite($entrywrite, "PN    $protN\n");
            echo "<title>$ampdbid | $protN</title>";
            if ($protFam == ' Nil' or $protFam == ' Nil ' or $protFam == 'Nil ') {
                fwrite($entrywrite, "PF    Not found\n");
            } else {
                $mypf = explode("(", str_replace("[", "(", $proteinName))[0];
                fwrite($entrywrite, "PF    $mypf\n");
            }
            if ($gene == ' Nil' or $gene == ' Nil ' or $gene == 'Nil ') {
                fwrite($entrywrite, "GN    Not found\n");
            } else {
                fwrite($entrywrite, "GN    $gene\n");
            }
            fwrite($entrywrite, "SO    $org\n");
            fwrite($entrywrite, "PL    $length\n");
            fwrite($entrywrite, "PE    $pe\n");
            fwrite($entrywrite, "XX\n");
            fwrite($entrywrite, "AC    ");
            $countnaa = 1;
            foreach (array_slice(explode(",", $aaCou), 0, 20) as $normalaa) {
                fwrite($entrywrite, $normalaa);
                if ($countnaa != count(array_slice(explode(",", $aaCou), 0, 20))) {
                    fwrite($entrywrite, ",");
                }
                if ($countnaa == 10) {
                    fwrite($entrywrite, "\nAC   ");
                }
                $countnaa += 1;
            }
            fwrite($entrywrite, "\n");
            fwrite($entrywrite, "AF    ");
            $couaafreq = 1;
            foreach (array_slice($aafreq, 0, 10) as $freq) {
                $aafr = explode(":", $freq)[0] . ": " . round(explode(":", $freq)[1] * 100, 2);
                fwrite($entrywrite, "$aafr%");
                if ($couaafreq != count(array_slice($aafreq, 0, 20))) {
                    fwrite($entrywrite, ",");
                }
                $couaafreq += 1;
            }
            fwrite($entrywrite, "\n");
            fwrite($entrywrite, "AF   ");
            foreach (array_slice($aafreq, 10, 10) as $freq) {
                $aafr = explode(":", $freq)[0] . ": " . round(explode(":", $freq)[1] * 100, 2);
                fwrite($entrywrite, "$aafr%");
                if ($couaafreq != count(array_slice($aafreq, 0, 20))) {
                    fwrite($entrywrite, ",");
                }
                $couaafreq += 1;
            }
            fwrite($entrywrite, "\n");
            $mr = str_replace("; ", ", ", $missRes);
            fwrite($entrywrite, "MA    $mr\n");
            $mo = str_replace("; ", ", ", $commonRes);
            fwrite($entrywrite, "MO    $commonRes\n");
            $lo = str_replace("; ", ", ", $uncommonRes);
            fwrite($entrywrite, "LO    $lo\n");
            fwrite($entrywrite, "BA    $phoAA\n");
            fwrite($entrywrite, "LA    $phiAA\n");
            fwrite($entrywrite, "AA    $acidicAACount\n");
            fwrite($entrywrite, "BC    $basicAACount\n");
            fwrite($entrywrite, "MC    $modifiedAA\n");
            fwrite($entrywrite, "MF    $modifiedAAfreq\n");
            fwrite($entrywrite, "XX\n");
            fwrite($entrywrite, "MM    $mass\n");
            fwrite($entrywrite, "AI    $ali\n");
            fwrite($entrywrite, "II    $isi\n");
            fwrite($entrywrite, "HP    $gravy\n");
            fwrite($entrywrite, "HM    $hydro_mom\n");
            fwrite($entrywrite, "IP    $ip\n");
            fwrite($entrywrite, "C7    $charge\n");
            fwrite($entrywrite, "SF    ");
            $cr = 1;
            foreach ($ssf as $as) {
                fwrite($entrywrite, round($as, 3));
                if ($cr != count($ssf)) {
                    fwrite($entrywrite, ", ");
                }
                $cr += 1;
            }
            fwrite($entrywrite, " [Helix, Turn, Sheet]\n");
            fwrite($entrywrite, "AR    $ar\n");
            fwrite($entrywrite, "ME    $mec\n");
            fwrite($entrywrite, "XX\n");
            $to = str_replace(";", ", ", (str_replace("Transcription", "", (str_replace("Transcription;", "", (str_replace("Snake", "", (str_replace("Snake;", "", (str_replace("Putative", "", (str_replace("Plant", "", (str_replace("Plant;", "", (str_replace("Peptide", "", (str_replace("Peptide;", "", (str_replace("Microbial", "", (str_replace("Microbial;", "", (str_replace("Insertion", "", (str_replace("Insertion;", "", (str_replace("High", "", (str_replace("High;", "", (str_replace("Gut", "", (str_replace("Gut;", "", (str_replace("E;", "", (str_replace("Core", "", (str_replace("Core;", "", (str_replace("Chinese", "", (str_replace("Chinese;", "", (str_replace("Broad", "", (str_replace("Broad;", "", (str_replace("Alpha (Gram-positive/Gram-negative)", "", (str_replace(
                "Alpha (Gram-positive/Gram-negative);",
                "",
                (str_replace("C;", "", (str_replace("Major", "", (str_replace("Major;", "", (str_replace("Main", "", (str_replace("Main;", "", (str_replace("Other", "", (str_replace("Other;", "", (str_replace(
                    "This",
                    "",
                    (str_replace(
                        "This;",
                        "",
                        $targetOrg
                    ))
                ))))))))))))))))
            )))))))))))))))))))))))))))))))))))))))))))))))))))));
            foreach (explode(", ", $to) as $tarO) {
                fwrite($entrywrite, "TO    $tarO\n");
            }
            foreach (explode(";", $antimicrobial) as $am) {
                fwrite($entrywrite, "AM    $am\n");
            }
            foreach (explode(";", $enzyme) as $ea) {
                fwrite($entrywrite, "EA    $ea\n");
            }
            foreach (explode(";", $inhibition) as $ie) {
                fwrite($entrywrite, "IE    $ie\n");
            }
            foreach (explode(";", $other) as $oe) {
                fwrite($entrywrite, "OE    $oe\n");
            }
            fwrite($entrywrite, "XX\n");
            echo "
            <div class='container' >PEPTIDE SUMMARY</div>
            <div class='container' style='font-size: xxx-large; font-weight: 400; overflow-wrap: anywhere;'>";
            echo explode("(", str_replace("[", "(", $proteinName))[0];
            echo "</div>
            <div class='container' style='margin-top: 1%;'>
        <div class='row'>
            <div class='col-sm '>
                <table class='' style='width: 100%;'>
                    <tr style='border-bottom: 5px solid #E85A4F;'>
                        <td style='font-size: xx-large;  color: #5B616B'>
                            1 General Description
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class='container mt-2 ' >
    <div class='row border border-2 pt-2 pb-2' style='width: 99%; margin-left: auto; margin-right: auto;'>
      <div class='col-sm'>
      <div><b style='font-weight: 500'>AMPDB ID:</b> $ampdbid</div>
      <div class='pt-1'><b style='font-weight: 500'>Protein Names:</b> ";
            echo $row['Protein names'];
            echo "</div>
      <div class='pt-1'><b style='font-weight: 500'>Protein Family:</b> $protFam</div> 
      <div class='pt-1'><b style='font-weight: 500'>Gene Name:</b> $gene</div>      
      
      <div class='pt-1'><b style='font-weight: 500'>Source Organism:</b> <a style='text-decoration: none;' class='bb' href='https://www.uniprot.org/taxonomy/$orgid'><i>$org</i></a></div>
      <div class='pt-1'><b style='font-weight: 500'>Protein Length:</b> $length AA</div>
      <div class='pt-1'><b style='font-weight: 500'>Protein Existence:</b> $pe</div>";

            echo "</div>
      </div>
    </div>
  </div>
  
  <div class='container' style='margin-top: 2.7%;'>
        <div class='row'>
            <div class='col-sm '>
                <table class='' style='width: 100%;'>
                    <tr style='border-bottom: 5px solid #E85A4F;'>
                        <td style='font-size: xx-large; color: #5B616B'>
                            2 Protein Sequence & Composition
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class='container' style='margin-top: 0.6%;'>
        <div class='row'>
            <div class='col-sm '>
                <table class='' style='width: 100%;'>
                    <tr style='border-bottom: 3px solid #E85A4F;'>
                        <td style='font-size: x-large; color: #5B616B'>
                            2.1 Sequence
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class='container mt-2 ' >
    <div class='row border border-2 pt-2 pb-2' style='width: 99%; margin-left: auto; margin-right: auto;'>
      <div class='col-sm'>
      <div style='overflow-wrap: anywhere;'>";
            for ($i = 0; $i < strlen($seq); $i += 10) {
                $slSeq = substr($seq, $i, 10);
                $increase = $i + 10;
                echo "<span style='font-family: Consolas;'>$slSeq</span>";
            }
            echo "
      <div><a href='files/$ampdbid.fasta' style='text-decoration: none;' class='bb'>FASTA format</a></div>
      </div>
      </div>
    </div>
  </div>
  <div class='container' style='margin-top: 1.7%;'>
        <div class='row'>
            <div class='col-sm '>
                <table class='' style='width: 100%;'>
                    <tr style='border-bottom: 3px solid #E85A4F;'>
                        <td style='font-size: x-large; color: #5B616B'>
                            2.2 Composition
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div> 
    <div class='container mt-2' >
        <div class='row border border-2' style='width: 99%; margin-left: auto; margin-right: auto;  padding-top: 0.5%; padding-bottom: 0.5%; '>
            <div class='col-sm-3' style='text-align: left; font-weight: 500'>
            Counts of Amino Acids
            </div>
            <div class='col-sm-9'>
            ";
            $countnaa = 1;
            foreach (array_slice(explode(",", $aaCou), 0, 20) as $normalaa) {
                echo $normalaa;
                if ($countnaa != count(array_slice(explode(",", $aaCou), 0, 20))) {
                    echo ", ";
                }
                $countnaa += 1;
            }
            echo "
            </div>
        </div>
        <div class='row  border-end border-bottom border-start border-2' style='width: 99%; margin-left: auto; margin-right: auto;  padding-top: 0.5%; padding-bottom: 0.5%; '>
            <div class='col-sm-3' style='text-align: left; font-weight: 500;'>
            Frequencies of Amino Acids
            </div>
            <div class='col-sm-9'>
            ";
            $couaafreq = 1;
            foreach (array_slice($aafreq, 0, 20) as $freq) {
                echo explode(":", $freq)[0], ": ", round(explode(":", $freq)[1] * 100, 2), "%";
                if ($couaafreq != count(array_slice($aafreq, 0, 20))) {
                    echo ", ";
                }
                $couaafreq += 1;
            }
            echo "
            </div>
        </div>
        <div class='row border-end border-bottom border-start border-2' style='width: 99%; margin-left: auto; margin-right: auto;  padding-top: 0.5%; padding-bottom: 0.5%; '>
            <div class='col-sm-3' style='text-align: left; font-weight: 500'>
            Missing Amino Acid(s)
            </div>
            <div class='col-sm-9'>
            ";
            if ($missRes == '') {
                echo "No Amino Acid(s) are missing in this protein";
            } else {
                echo str_replace("; ", ", ", $missRes);
            }
            echo "
            </div>
        </div>
        <div class='row border-end border-bottom border-start border-2' style='width: 99%; margin-left: auto; margin-right: auto;  padding-top: 0.5%; padding-bottom: 0.5%; '>
            <div class='col-sm-3' style='text-align: left; font-weight: 500'>
            Most Occurring Amino Acid(s)
            </div>
            <div class='col-sm-9'>
            ";
            echo str_replace("; ", ", ", $commonRes);
            echo "
            </div>
        </div>
        <div class='row border-end border-bottom border-start border-2' style='width: 99%; margin-left: auto; margin-right: auto;  padding-top: 0.5%; padding-bottom: 0.5%; '>
            <div class='col-sm-3' style='text-align: left; font-weight: 500'>
            Less Occurring Amino Acid(s)
            </div>
            <div class='col-sm-9'>
            ";
            echo str_replace("; ", ", ", $uncommonRes);
            echo "
            </div>
        </div>
        <div class='row border-end border-bottom border-start border-2' style='width: 99%; margin-left: auto; margin-right: auto;  padding-top: 0.5%; padding-bottom: 0.5%; '>
            <div class='col-sm-3' style='text-align: left; font-weight: 500'>
            Hydrophobic Amino Acid(s) Count
            </div>
            <div class='col-sm-9'>
            ";
            echo $phoAA;
            echo "
            </div>
        </div>
        <div class='row border-end border-bottom border-start border-2' style='width: 99%; margin-left: auto; margin-right: auto;  padding-top: 0.5%; padding-bottom: 0.5%; '>
            <div class='col-sm-3' style='text-align: left; font-weight: 500'>
            Hydrophilic Amino Acid(s) Count
            </div>
            <div class='col-sm-9'>
            ";
            echo $phiAA;
            echo "
            </div>
        </div>
        <div class='row border-end border-bottom border-start border-2' style='width: 99%; margin-left: auto; margin-right: auto;  padding-top: 0.5%; padding-bottom: 0.5%; '>
            <div class='col-sm-3' style='text-align: left; font-weight: 500'>
            Basic Amino Acid(s) Count
            </div>
            <div class='col-sm-9'>
            ";
            echo $basicAACount;
            echo "
            </div>
        </div>
        <div class='row border-end border-bottom border-start border-2' style='width: 99%; margin-left: auto; margin-right: auto;  padding-top: 0.5%; padding-bottom: 0.5%; '>
            <div class='col-sm-3' style='text-align: left; font-weight: 500'>
            Acidic Amino Acid(s) Count
            </div>
            <div class='col-sm-9'>
            ";
            echo $acidicAACount;
            echo "
            </div>
        </div>
        <div class='row border-end border-bottom border-start border-2' style='width: 99%; margin-left: auto; margin-right: auto;  padding-top: 0.5%; padding-bottom: 0.5%; '>
            <div class='col-sm-3' style='text-align: left; font-weight: 500'>
            Modified Amino Acid(s) Count
            </div>
            <div class='col-sm-9'>
            ";
            echo $modifiedAA;
            echo "
            </div>
        </div>
        <div class='row border-end border-bottom border-start border-2' style='width: 99%; margin-left: auto; margin-right: auto;  padding-top: 0.5%; padding-bottom: 0.5%; '>
            <div class='col-sm-3' style='text-align: left; font-weight: 500'>
            Modified Amino Acid(s) Frequencies
            </div>
            <div class='col-sm-9'>
            ";
            echo $modifiedAAfreq;
            echo "
            </div>
        </div>
        
        
    </div>

    <div class='container mt-1' >
<div class='row' style='width: 99%; margin-left: auto; margin-right: auto;'>
<div class='col-sm mt-1' style='font-size: smaller'>
<i>Computed by biopython (version 1.79) & proteinAnalysis (version 1)</i>
</div>
</div>
</div>

    <div class='container' style='margin-top: 2.7%;'>
        <div class='row'>
            <div class='col-sm '>
                <table class='' style='width: 100%;'>
                    <tr style='border-bottom: 5px solid #E85A4F;'>
                        <td style='font-size: xx-large; color: #5B616B'>
                            3 Physicochemical Properties
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class='container mt-2'>
    <div class='table-responsive'>
    <table class='table border border-2 table-striped' style='width: 99%; margin-left: auto; margin-right: auto;'>
      <thead>
        <tr >
          <th style='font-weight: 500; width: 5%'>Sl. No.</th>
          <th style='font-weight: 500'>Properties</th>
          <th style='font-weight: 500'>Values</th>
          <th style='font-weight: 500; width: 30%'>Reference</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1.</td>
          <td>Molecular Mass</td>
          <td>$mass Da</td>
          <td>Computed by ProtParam module (biopython 1.79)</td>
        </tr>
        <tr>
          <td>2.</td>
          <td>Aliphatic Index</td>
          <td>$ali</td>
          <td>Computed by ProtParam module (biopython 1.79)</td>
        </tr>
        <tr>
          <td>3.</td>
          <td>Instability Index (Half Life)</td>
          <td>$isi</td>
          <td>Computed by ProtParam module (biopython 1.79)</td>
        </tr>
        <tr>
          <td>4.</td>
          <td>Hydrophobicity (GRAVY)</td>
          <td>$gravy</td>
          <td>Computed by ProtParam module (biopython 1.79)</td>
        </tr>
        <tr>
          <td>5.</td>
          <td>Hydrophobic Moment</td>
          <td>$hydro_mom</td>
          <td>Computed by ProtParam module (biopython 1.79)</td>
        </tr>
        <tr>
          <td>6.</td>
          <td>Isoelectric Point</td>
          <td>$ip</td>
          <td>Computed by ProtParam module (biopython 1.79)</td>
        </tr>
        <tr>
          <td>7.</td>
          <td>Charge (at pH 7)</td>
          <td>$charge</td>
          <td>Computed by ProtParam module (biopython 1.79)</td>
        </tr>
        <tr>
          <td>8.</td>
          <td>Secondary Structure Fraction</td>
          <td>";
            $cr = 1;
            foreach ($ssf as $as) {
                echo round($as, 3);
                if ($cr != count($ssf)) {
                    echo ", ";
                }
                $cr += 1;
            }

            echo " <i>[Helix, Turn, Sheet]</i></td>
          <td>Computed by ProtParam module (biopython 1.79)</td>
        </tr>
        <tr>
          <td>9.</td>
          <td>Aromaticity</td>
          <td>$ar</td>
          <td>Computed by ProtParam module (biopython 1.79)</td>
        </tr> 
        <tr>
          <td>10.</td>
          <td>Molar Extinction Coefficient (cysteine|cystine)</td>
          <td>$mec</td>
          <td>Computed by ProtParam module (biopython 1.79)</td>
        </tr>        
      </tbody>
    </table>
    </div>
</div>


    

  <div class='container' style='margin-top: 2.7%;'>
        <div class='row'>
            <div class='col-sm '>
                <table class='' style='width: 100%;'>
                    <tr style='border-bottom: 5px solid #E85A4F;'>
                        <td style='font-size: xx-large; color: #5B616B'>
                            4 Activity Details
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    
  <div class='container' style='margin-top: 1%;'>
  <div class='row'>
      <div class='col-sm '>
          <table class='' style='width: 100%;'>
              <tr style='border-bottom: 2px solid #E85A4F;'>
                  <td style='font-size: larger; color: #5B616B'>
                      4.1 Target Organism(s)
                  </td>
              </tr>
          </table>
      </div>
  </div>
</div>

<div class='container mt-2 ' >
<div class='row' style='width: 99%; margin-left: auto; margin-right: auto;'>
<div class='col-sm'>";
            $tarorgLen = str_replace(";", ", ", (str_replace("Transcription", "", (str_replace("Transcription;", "", (str_replace("Snake", "", (str_replace("Snake;", "", (str_replace("Putative", "", (str_replace("Plant", "", (str_replace("Plant;", "", (str_replace("Peptide", "", (str_replace("Peptide;", "", (str_replace("Microbial", "", (str_replace("Microbial;", "", (str_replace("Insertion", "", (str_replace("Insertion;", "", (str_replace("High", "", (str_replace("High;", "", (str_replace("Gut", "", (str_replace("Gut;", "", (str_replace("E;", "", (str_replace("Core", "", (str_replace("Core;", "", (str_replace("Chinese", "", (str_replace("Chinese;", "", (str_replace("Broad", "", (str_replace("Broad;", "", (str_replace("Alpha (Gram-positive/Gram-negative)", "", (str_replace(
                "Alpha (Gram-positive/Gram-negative);",
                "",
                (str_replace("C;", "", (str_replace("Major", "", (str_replace("Major;", "", (str_replace("Main", "", (str_replace("Main;", "", (str_replace("Other", "", (str_replace("Other;", "", (str_replace(
                    "This",
                    "",
                    (str_replace(
                        "This;",
                        "",
                        $targetOrg
                    ))
                ))))))))))))))))
            )))))))))))))))))))))))))))))))))))))))))))))))))))));
            if (strlen($tarorgLen) == 0) {
                echo "No Target Organism Found";
            } else {
                echo $tarorgLen;
            }
            echo "</div>
<div class='row' style='width: 99%; margin-left: auto; margin-right: auto;'>
</div>
</div>
</div>


<div class='container' style='margin-top: 1%;'>
<div class='row'>
    <div class='col-sm '>
        <table class='' style='width: 100%;'>
            <tr style='border-bottom: 2px solid #E85A4F;'>
                <td style='font-size: larger; color: #5B616B'>
                    4.2 Antimicrobial Activity
                </td>
            </tr>
        </table>
    </div>
</div>
</div>

<div class='container mt-2 ' >
<div class='row' style='width: 99%; margin-left: auto; margin-right: auto;'>
<div class='col-sm'>";
            echo str_replace(";", ", ", $antimicrobial);
            echo "</div>
<div class='row' style='width: 99%; margin-left: auto; margin-right: auto;'>
</div>
</div>
</div>


<div class='container' style='margin-top: 1%;'>
<div class='row'>
    <div class='col-sm '>
        <table class='' style='width: 100%;'>
            <tr style='border-bottom: 2px solid #E85A4F;'>
                <td style='font-size: larger; color: #5B616B'>
                    4.3 Enzymatic Activity
                </td>
            </tr>
        </table>
    </div>
</div>
</div>

<div class='container mt-2 ' >
<div class='row' style='width: 99%; margin-left: auto; margin-right: auto;'>
<div class='col-sm'>";
            echo str_replace(";", ", ", $enzyme);
            echo "</div>
<div class='row' style='width: 99%; margin-left: auto; margin-right: auto;'>
</div>
</div>
</div>


<div class='container' style='margin-top: 1%;'>
<div class='row'>
    <div class='col-sm '>
        <table class='' style='width: 100%;'>
            <tr style='border-bottom: 2px solid #E85A4F;'>
                <td style='font-size: larger; color: #5B616B'>
                    4.4 Inhibitory Effect
                </td>
            </tr>
        </table>
    </div>
</div>
</div>

<div class='container mt-2 ' >
<div class='row' style='width: 99%; margin-left: auto; margin-right: auto;'>
<div class='col-sm'>";
            echo str_replace(";", ", ", $inhibition);
            echo " </div>
<div class='row' style='width: 99%; margin-left: auto; margin-right: auto;'>
</div>
</div>
</div>


<div class='container' style='margin-top: 1%;'>
<div class='row'>
    <div class='col-sm '>
        <table class='' style='width: 100%;'>
            <tr style='border-bottom: 2px solid #E85A4F;'>
                <td style='font-size: larger; color: #5B616B'>
                    4.5 Other Biological Activity
                </td>
            </tr>
        </table>
    </div>
</div>
</div>

<div class='container mt-2 ' >
<div class='row' style='width: 99%; margin-left: auto; margin-right: auto;'>
<div class='col-sm'>";
            echo str_replace(";", ", ", $other);
            echo "</div>
<div class='row' style='width: 99%; margin-left: auto; margin-right: auto;'>
</div>
</div>
</div>

<div class='container mt-1' >
<div class='row' style='width: 100%; margin-left: auto; margin-right: auto;'>
<div class='col-sm mt-1' style='font-size: smaller'>
<i>Activity data manually curated from Literature and UniProt</i>
</div>
</div>
</div>


  
  <div class='container' style='margin-top: 2.7%;'>
        <div class='row'>
            <div class='col-sm '>
                <table class='' style='width: 100%;'>
                    <tr style='border-bottom: 5px solid #E85A4F;'>
                        <td style='font-size: xx-large; color: #5B616B'>
                            5 Database Cross-references
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

<div class='container' style='margin-top: 0.6%;'>
<div class='row'>
    <div class='col-sm '>
        <table class='' style='width: 100%;'>
            <tr style='border-bottom: 3px solid #E85A4F;'>
                <td style='font-size: x-large; color: #5B616B'>
                    5.1 Literature Database
                </td>
            </tr>
        </table>
    </div>
</div>
</div>
<div class='container' style='margin-top: 1%;'>
<div class='row'>
    <div class='col-sm '>
        <table class='' style='width: 100%;'>
            <tr style='border-bottom: 2px solid #E85A4F;'>
                <td style='font-size: larger; color: #5B616B'>
                    5.1.1 PubMed
                </td>
            </tr>
        </table>
    </div>
</div>
</div>


<div class='container mt-2 ' >
<div class='row' style='width: 99%; margin-left: auto; margin-right: auto;'>";
            if ($pubmed == ' Nil ') {
                fwrite($entrywrite, "XR    PubMed: \n");
                echo "<div class='col-sm' style='padding: 0.8% 0% 0.8% 0.8%; background-color: #F0F8FF; border-left: 5px solid red'>";
                echo "No PMID found";
                echo "</div>";
            } else {
                if (count(explode("; ", $pubmed)) <= 4) {
                    echo "<div class='col-sm border border-2' style='padding: 0% 0.7% 0.8% 0.7%;'>";
                    $c = 1;
                    foreach (explode(";", str_replace(" ", "", $pubmed)) as $p) {
                        $sqll = "SELECT * FROM `paper_citation` WHERE pmid='$p'";
                        $resultt = $con->query($sqll);
                        if ($resultt->num_rows > 0) {
                            while ($roww = $resultt->fetch_assoc()) {
                                $pid = $roww['pmid'];
                                $ref = utf8_encode($roww['citation']);
                                fwrite($entrywrite, "XR    PubMed: $pid\n");
                                if (count(explode("; ", $pubmed)) != $c) {
                                    echo "
                    <div style='padding-top: 0.8%;'><b style='font-weight: 500'>Citation $c: </b>$ref</div>
                    <div class='border-bottom border-2' ><b style='font-weight: 500; '>PMID: </b>
                    <a href='https://pubmed.ncbi.nlm.nih.gov/$pid/' style='text-decoration: none;' class='bb' target='_blank'>$pid</a>
                    </div>
                    ";
                                } else {
                                    echo "
                    <div style='padding-top: 0.8%;'><b style='font-weight: 500'>Citation $c: </b>$ref</div>
                    <div ><b style='font-weight: 500; '>PMID: </b>
                    <a href='https://pubmed.ncbi.nlm.nih.gov/$pid/' style='text-decoration: none;' class='bb' target='_blank'>$pid</a>
                    </div>
                    ";
                                }
                                $c += 1;
                                break;
                            }
                            continue;
                        }
                    }
                    echo "</div>";
                }
                if (count(explode("; ", $pubmed)) > 4) {
                    echo "<div class='col-sm border border-2 scr' style='padding: 0% 0.7% 0.8% 0.7%;'>";
                    $c = 1;
                    foreach (explode(";", str_replace(" ", "", $pubmed)) as $p) {
                        $sqll = "SELECT * FROM `paper_citation` WHERE pmid='$p'";
                        $resultt = $con->query($sqll);
                        if ($resultt->num_rows > 0) {
                            while ($roww = $resultt->fetch_assoc()) {
                                $pid = $roww['pmid'];
                                $ref = utf8_encode($roww['citation']);
                                fwrite($entrywrite, "XR    PubMed: $pid\n");
                                if (count(explode("; ", $pubmed)) != $c) {
                                    echo "
                    <div style='padding-top: 0.8%;'><b style='font-weight: 500'>Citation $c: </b>$ref</div>
                    <div class='border-bottom border-2' ><b style='font-weight: 500; '>PMID: </b>
                    <a href='https://pubmed.ncbi.nlm.nih.gov/$pid/' style='text-decoration: none;' class='bb' target='_blank'>$pid</a>
                    </div>
                    ";
                                } else {
                                    echo "
                    <div style='padding-top: 0.8%;'><b style='font-weight: 500'>Citation $c: </b>$ref</div>
                    <div ><b style='font-weight: 500; '>PMID: </b>
                    <a href='https://pubmed.ncbi.nlm.nih.gov/$pid/' style='text-decoration: none;' class='bb' target='_blank'>$pid</a>
                    </div>
                    ";
                                }
                                $c += 1;
                                break;
                            }
                            continue;
                        }
                        $c += 1;
                    }
                    echo "</div>";
                }
            }
            echo " 
</div>
</div>

<div class='container' style='margin-top: 2%;'>
<div class='row'>
    <div class='col-sm '>
        <table class='' style='width: 100%;'>
            <tr style='border-bottom: 3px solid #E85A4F;'>
                <td style='font-size: x-large; color: #5B616B'>
                5.2 Protein Sequence Databases
                </td>
            </tr>
        </table>
    </div>
</div>
</div>

<div class='container mt-2'>
<div class='row pt-2 pb-2' style='
background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto; border-left: 5px solid #e60073'>
    <div class='col-sm '><b style='font-weight: 500'>UniProt:</b>
    <a href='https://www.uniprot.org/uniprotkb/$uniprot/entry' style='text-decoration: none;' class='bb' target='_blank'>$uniprot</a>";
            fwrite($entrywrite, "XR    UniProt: $uniprot\n");
            echo "</div>
</div>
</div>

<div class='container' style='margin-top: 2%;'>
<div class='row'>
    <div class='col-sm '>
        <table class='' style='width: 100%;'>
            <tr style='border-bottom: 3px solid #E85A4F;'>
                <td style='font-size: x-large; color: #5B616B'>
                5.3 3D Structure Databases
                </td>
            </tr>
        </table>
    </div>
</div>
</div>";
            if ($pdb == ' Nil ') {
                fwrite($entrywrite, "XR    RCSB PDB;PDBsum;PDBe;PDBj;PDBe-KB;MMDB: | Method:  | Resolution: \n");
                echo "
                <div class='container mt-2' style='margin-top: 0%;'>
            <div class='row pt-2 pb-2' style='
            background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto; border-left: 5px solid red'>
                <div class='col-sm '>
                No PDB Ids found
                </div>
            </div>
            </div>
                ";
            } else {
            ?>
                <div id="pdb_ids" style="display: none;">
                    <?php echo $pdb; ?>
                </div>
                <div class="container mt-2">
                    <div class="row">
                        <div class="col-sm">
                            <div class="table-responsive" style="width: 99%; margin-left: auto; margin-right: auto;">
                                <table id="myDataTable" class="table border border-2 table-striped table-hover">
                                    <thead class="text-white bg-dark">
                                        <th>
                                        <td style="font-weight: 500;">Sl. no.</td>
                                        <td style="font-weight: 500;">PDB ID</td>
                                        <td style="font-weight: 500; width: 15%;">Method</td>
                                        <td style="font-weight: 500;">Resolution</td>
                                        <td style="font-weight: 500; width: 40%;">Access Links</td>
                                        <td style="font-weight: 500;">3D View</td>
                                        </th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


    <?php
            }

            echo "
            <div class='container mt-2' style='margin-top: 0%;'>
            <div class='row pt-2 pb-2' style='
            background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto; border-left: 5px solid #141259'>
                <div class='col-sm '><b style='font-weight: 500'>AlphaFoldDB:</b> 
                <a href='https://alphafold.ebi.ac.uk/entry/$uniprot' style='text-decoration: none;' class='bb' target='_blank'>$uniprot</a>";
            fwrite($entrywrite, "XR    AlphaFoldDB: $uniprot\n");
            echo "</div>
            </div>
            </div>


<div class='container' style='margin-top: 2%;'>
<div class='row'>
    <div class='col-sm '>
        <table class='' style='width: 100%;'>
            <tr style='border-bottom: 3px solid #E85A4F;'>
                <td style='font-size: x-large; color: #5B616B'>
                5.4 Nucleotide Sequence Databases
                </td>
            </tr>
        </table>
    </div>
</div>
</div>
";
            if ($embl == ' Nil ') {
                echo "
                <div class='container mt-2' style='margin-top: 0%;'>
            <div class='row pt-2 pb-2' style='
            background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto; border-left: 5px solid red'>
                <div class='col-sm '>
                No entries found in GenBank or EMBL";
                fwrite($entrywrite, "XR    GenBank;EMBL: \n");
                echo "</div>
            </div>
            </div>
                ";
            } else {
                if (count(explode(";", str_replace(" ", "", $embl))) <= 5) {
                    echo "
                <div class='container mt-2'>
                  <table class='table table-striped' style='width: 99%; margin-left: auto; margin-right: auto; margin-bottom: 0rem;'>
                    <thead class='bg-dark text-white' style='position: sticky;top: 0'>
                      <tr>
                        <th class='table-header' style='font-weight: 500;'>Sl. no.</th>
                        <th class='table-header' style='font-weight: 500;'>Accession(s)</th>
                        <th class='table-header' style='font-weight: 500;'>Access Link(s)</th>
                      </tr>
                    </thead>               
                    <tbody>";
                    $c = 1;
                    $arr = explode(";", str_replace(" ", "", $embl));
                    unset($arr[count($arr) - 1]);
                    foreach ($arr as $p) {
                        fwrite($entrywrite, "XR    Genbank;EMBL: $p\n");
                        echo "

                    <tr class= ''>
                        <td>$c.</td>
                        <td>$p</td>
                        <td>
                        <span>
                        <a href='https://www.ncbi.nlm.nih.gov/nuccore/$p' style='all: unset; cursor:pointer; color: #0D6EFD;' a.hover='red' class='bb' target='_blank'>GenBank</a> || 
                        <a href='https://www.ebi.ac.uk/ena/browser/view/$p' style='all: unset; cursor:pointer; color: #0D6EFD;' class='bb' target='_blank'>EMBL</a><span>
                        </td>                        
                      </tr>
        ";
                        $c += 1;
                    }
                    echo "
                </tbody>
                  </table>
                </div>
                ";
                }
                if (count(explode(";", str_replace(" ", "", $embl))) > 5) {
                    echo "
                <div class='container mt-2'>
                <div class='container-h' style='width: 99%; margin-left: auto; margin-right: auto;'>
                  <table class='table table-striped' style='margin-bottom: 0rem;'>
                    <thead class='bg-dark text-white' style='position: sticky;top: 0'>
                      <tr>
                        <th class='table-header' style='font-weight: 500;'>Sl. no.</th>
                        <th class='table-header' style='font-weight: 500;'>Accession(s)</th>
                        <th class='table-header' style='font-weight: 500;'>Access Link(s)</th>
                      </tr>
                    </thead>               
                    <tbody>";
                    $c = 1;
                    $arr = explode(";", str_replace(" ", "", $embl));
                    unset($arr[count($arr) - 1]);
                    foreach ($arr as $p) {
                        fwrite($entrywrite, "XR    GemBank;EMBL: $p\n");
                        echo "

                    <tr class= ''>
                        <td>$c.</td>
                        <td>$p</td>
                        <td>
                        <span>
                        <a href='https://www.ncbi.nlm.nih.gov/nuccore/$p' style='all: unset; cursor:pointer; color: #0D6EFD;' a.hover='red' class='bb' target='_blank'>GenBank</a> || 
                        <a href='https://www.ebi.ac.uk/ena/browser/view/$p' style='all: unset; cursor:pointer; color: #0D6EFD;' class='bb' target='_blank'>EMBL</a><span>
                        </td>                        
                      </tr>
        ";
                        $c += 1;
                    }
                    echo "
                </tbody>
                  </table>
                </div>
              </div>
                ";
                }
            }

            echo "
            <div class='container mt-2' style='margin-top: 0%;'>
            <div class='row pt-2 pb-2 border border-5 border-top-0 border-bottom-0 border-end-0 border-dark' style='
            background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto;'>
                <div class='col-sm '><b style='font-weight: 500'>CCDS:</b> ";
            if ($ccds == ' Nil' or $ccds == ' Nil ' or $ccds == 'Nil ') {
                fwrite($entrywrite, "XR    CCDS: \n");
                echo "Not found";
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $ccds));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    CCDS: $p\n");
                    echo "<a href='https://www.ncbi.nlm.nih.gov/CCDS/CcdsBrowse.cgi?REQUEST=CCDS&GO=MainBrowse&DATA=$p' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }
            echo "</div>
            </div>
            </div>

            <div class='container mt-2' style='margin-top: 0%;'>
            <div class='row pt-2 pb-2 border border-5 border-top-0 border-bottom-0 border-end-0 border-dark' style='
            background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto;'>
                <div class='col-sm '><b style='font-weight: 500'>RefSeq:</b> ";
            if ($refseq == ' Nil' or $refseq == ' Nil ' or $refseq == 'Nil ') {
                echo "Not found";
                fwrite($entrywrite, "XR    RefSeq: \n");
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $refseq));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    RefSeq: $p\n");
                    echo "<a href='https://www.ncbi.nlm.nih.gov/protein/$p' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }
            echo "</div>
            </div>
            </div>
<div class='container' style='margin-top: 2%;'>
<div class='row'>
    <div class='col-sm '>
        <table class='' style='width: 100%;'>
            <tr style='border-bottom: 3px solid #E85A4F;'>
                <td style='font-size: x-large; color: #5B616B'>
                5.5 Protein-Protein Interaction Databases
                </td>
            </tr>
        </table>
    </div>
</div>
</div>

<div class='container mt-2' style='margin-top: 0%;'>
<div class='row pt-2 pb-2 border border-5 border-top-0 border-bottom-0 border-end-0 border-primary' style='
background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto;'>
    <div class='col-sm '><b style='font-weight: 500'>STRING:</b> ";
            if ($string == ' Nil ') {
                echo "Not found";
                fwrite($entrywrite, "XR    STRING: \n");
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $string));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    STRING: $p\n");
                    echo "<a href='https://string-db.org/network/$p' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }

            echo "</div>
</div>
</div>

<div class='container mt-2' style='margin-top: 0%;'>
<div class='row pt-2 pb-2 border border-5 border-top-0 border-bottom-0 border-end-0 border-primary' style='
background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto;'>
    <div class='col-sm '><b style='font-weight: 500'>IntAct:</b> ";
            if ($intact == ' Nil ') {
                echo "Not found";
                fwrite($entrywrite, "XR    IntAct: \n");
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $intact));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    IntAct: $p\n");
                    echo "<a href='https://www.ebi.ac.uk/intact/search?query=id:$p*#interactor' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }

            echo "</div>
</div>
</div>

<div class='container mt-2' style='margin-top: 0%;'>
<div class='row pt-2 pb-2 border border-5 border-top-0 border-bottom-0 border-end-0 border-primary' style='
background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto;'>
    <div class='col-sm '><b style='font-weight: 500'>MINT:</b> ";
            if ($mint == ' Nil ') {
                echo "Not found";
                fwrite($entrywrite, "XR    MINT: \n");
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $mint));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    MINT: $p\n");
                    echo "<a href='https://mint.bio.uniroma2.it/index.php/results-interactions/?id=$p' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }

            echo "</div>
</div>
</div>

<div class='container mt-2' style='margin-top: 0%;'>
<div class='row pt-2 pb-2 border border-5 border-top-0 border-bottom-0 border-end-0 border-primary' style='
background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto;'>
    <div class='col-sm '><b style='font-weight: 500'>DIP:</b> ";
            if ($DIP == ' Nil ') {
                echo "Not found";
                fwrite($entrywrite, "XR    DIP: \n");
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $DIP));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    DIP: $p\n");
                    echo "<a href='https://dip.doe-mbi.ucla.edu/dip/Browse.cgi?ID=$p' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }
            echo "</div>
</div>
</div>

<div class='container mt-2' style='margin-top: 0%;'>
<div class='row pt-2 pb-2 border border-5 border-top-0 border-bottom-0 border-end-0 border-primary' style='
background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto;'>
    <div class='col-sm '><b style='font-weight: 500'>BioGRID:</b> ";
            if ($biogrid == ' Nil ') {
                echo "Not found";
                fwrite($entrywrite, "XR    BioGRID: \n");
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $biogrid));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    BioGRID: $p\n");
                    echo "<a href='https://thebiogrid.org/$p' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }
            echo "</div>
</div>
</div>

<div class='container' style='margin-top: 2%;'>
<div class='row'>
    <div class='col-sm '>
        <table class='' style='width: 100%;'>
            <tr style='border-bottom: 3px solid #E85A4F;'>
                <td style='font-size: x-large; color: #5B616B'>
                5.6 Ligand Databases
                </td>
            </tr>
        </table>
    </div>
</div>
</div>

<div class='container mt-2' style='margin-top: 0%;'>
<div class='row pt-2 pb-2 border border-5 border-top-0 border-bottom-0 border-end-0 border-success' style='
background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto;'>
    <div class='col-sm '><b style='font-weight: 500'>BindingDB:</b> ";
            if ($bindingdb == ' Nil ') {
                fwrite($entrywrite, "XR    BindingDB: \n");
                echo "Not found";
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $bindingdb));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    BindingDB: $p\n");
                    echo "<a href='https://www.bindingdb.org/rwd/jsp/dbsearch/PrimarySearch_ki.jsp?polymerid=858&tag=pol&target=UNIPROT:$p&accession_number=$p&submit=Search' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }
            echo "</div>
</div>
</div>

<div class='container mt-2' style='margin-top: 0%;'>
<div class='row pt-2 pb-2 border border-5 border-top-0 border-bottom-0 border-end-0 border-success' style='
background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto'>
    <div class='col-sm '><b style='font-weight: 500'>DrugBank:</b> ";
            if ($drugbank == ' Nil ') {
                fwrite($entrywrite, "XR    DrugBank: \n");
                echo "Not found";
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $drugbank));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    DrugBank: $p\n");
                    echo "<a href='https://go.drugbank.com/drugs/$p' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }
            echo "</div>
</div>
</div>

<div class='container mt-2' style='margin-top: 0%;'>
<div class='row pt-2 pb-2 border border-5 border-top-0 border-bottom-0 border-end-0 border-success' style='background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto;'>
    <div class='col-sm '><b style='font-weight: 500'>ChEMBL:</b> ";
            if ($chembl == ' Nil ') {
                fwrite($entrywrite, "XR    ChEMBL: \n");
                echo "Not found";
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $chembl));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    ChEMBL: $p\n");
                    echo "<a href='https://www.ebi.ac.uk/chembl/target_report_card/$p/' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }
            echo "</div>
</div>
</div>

<div class='container' style='margin-top: 2%;'>
<div class='row'>
    <div class='col-sm '>
        <table class='' style='width: 100%;'>
            <tr style='border-bottom: 3px solid #E85A4F;'>
                <td style='font-size: x-large; color: #5B616B'>
                5.7 Family & Domain Databases
                </td>
            </tr>
        </table>
    </div>
</div>
</div>


<div class='container mt-2' style='margin-top: 0%;'>
<div class='row pt-2 pb-2 border border-5 border-top-0 border-bottom-0 border-end-0 border-secondary' style=' width: 99%; margin-left: auto; margin-right: auto; background-color: #F0F8FF;'>
    <div class='col-sm '><b style='font-weight: 500'>InterPro:</b> ";
            if ($interpro == ' Nil ') {
                fwrite($entrywrite, "XR    InterPro: \n");
                echo "Not found";
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $interpro));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    InterPro: $p\n");
                    echo "<a href='https://www.ebi.ac.uk/interpro/entry/InterPro/$p/' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }
            echo "</div>
</div>
</div>

<div class='container mt-2' style='margin-top: 0%;'>
<div class='row pt-2 pb-2 border border-5 border-top-0 border-bottom-0 border-end-0 border-secondary' style='
background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto;'>
    <div class='col-sm '><b style='font-weight: 500'>PANTHER:</b> ";
            if ($panther == ' Nil ') {
                fwrite($entrywrite, "XR    PANTHER: \n");
                echo "Not found";
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $panther));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    PANTHER: $p\n");
                    echo "<a href='http://www.pantherdb.org/panther/family.do?clsAccession=$p' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }
            echo "</div>
</div>
</div>

<div class='container mt-2' style='margin-top: 0%;'>
<div class='row pt-2 pb-2 border border-5 border-top-0 border-bottom-0 border-end-0 border-secondary' style='
background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto;'>
    <div class='col-sm '><b style='font-weight: 500'>PROSITE:</b> ";
            if ($prosite == ' Nil ') {
                fwrite($entrywrite, "XR    PROSITE: \n");
                echo "Not found";
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $prosite));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    PROSITE: $p\n");
                    echo "<a href='https://prosite.expasy.org/doc/$p' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }
            echo "</div>
</div>
</div>


<div class='container' style='margin-top: 2%;'>
<div class='row'>
    <div class='col-sm '>
        <table class='' style='width: 100%;'>
            <tr style='border-bottom: 3px solid #E85A4F;'>
                <td style='font-size: x-large; color: #5B616B'>
                5.8 Genome Annotation Databases
                </td>
            </tr>
        </table>
    </div>
</div>
</div>

<div class='container mt-2' style='margin-top: 0%;'>
<div class='row pt-2 pb-2' style='
background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto; border-left: 5px solid #845007'>
    <div class='col-sm '><b style='font-weight: 500'>Ensembl:</b> ";
            if ($genetree == ' Nil ') {
                fwrite($entrywrite, "XR    Ensembl: \n");
                echo "Not found";
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $genetree));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    Ensembl: $p\n");
                    echo "<a href='https://asia.ensembl.org/Multi/GeneTree/Image?gt=$p' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }
            echo "</div>
</div>
</div>

<div class='container mt-2' style='margin-top: 0%;'>
<div class='row pt-2 pb-2' style='
background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto; border-left: 5px solid #845007'>
    <div class='col-sm '><b style='font-weight: 500'>KEGG:</b> ";
            if ($kegg == ' Nil ') {
                fwrite($entrywrite, "XR    KEGG: \n");
                echo "Not found";
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $kegg));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    KEGG: $p\n");
                    echo "<a href='https://www.genome.jp/dbget-bin/www_bget?$p' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }
            echo "</div>
</div>
</div>

<div class='container' style='margin-top: 2%;'>
<div class='row'>
    <div class='col-sm '>
        <table class='' style='width: 100%;'>
            <tr style='border-bottom: 3px solid #E85A4F;'>
                <td style='font-size: x-large; color: #5B616B'>
                5.9 Phylogenomic Databases
                </td>
            </tr>
        </table>
    </div>
</div>
</div>

<div class='container mt-2' style='margin-top: 0%;'>
<div class='row pt-2 pb-2' style='
background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto; border-left: 5px solid #51e2f5'>
    <div class='col-sm '><b style='font-weight: 500'>GeneTree:</b> ";
            if ($genetree == ' Nil ') {
                fwrite($entrywrite, "XR    GeneTree: \n");
                echo "Not found";
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $genetree));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    GeneTree: $p\n");
                    echo "<a href='https://asia.ensembl.org/Multi/GeneTree/Image?gt=$p' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }
            echo "</div>
</div>
</div>

<div class='container' style='margin-top: 2%;'>
<div class='row'>
    <div class='col-sm '>
        <table class='' style='width: 100%;'>
            <tr style='border-bottom: 3px solid #E85A4F;'>
                <td style='font-size: x-large; color: #5B616B'>
                5.10 Enzyme & Pathway Databases
                </td>
            </tr>
        </table>
    </div>
</div>
</div>

<div class='container mt-2' style='margin-top: 0%;'>
<div class='row pt-2 pb-2' style='
background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto; border-left: 5px solid tomato'>
    <div class='col-sm '><b style='font-weight: 500'>BRENDA:</b> ";
            if ($brenda == ' Nil ') {
                fwrite($entrywrite, "XR    BRENDA: \n");
                echo "Not found";
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $brenda));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    BRENDA: $p\n");
                    echo "<a href='https://www.brenda-enzymes.org/enzyme.php?ecno=$p&UniProtAcc=$uniprot&OrganismID=$orgid' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }
            echo "</div>
</div>
</div>

<div class='container mt-2' style='margin-top: 0%;'>
<div class='row pt-2 pb-2' style='
background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto; border-left: 5px solid tomato'>
    <div class='col-sm '><b style='font-weight: 500'>BioCyc:</b> ";
            if ($biocyc == ' Nil ') {
                fwrite($entrywrite, "XR    BioCyc: \n");
                echo "Not found";
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $biocyc));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    BioCyc: $p\n");
                    $break = explode(":", $p)[1];
                    $orgI = explode(":", $p)[0];
                    $omer = "OMER";
                    echo "<a href='https://biocyc.org/gene?orgid=$orgI&id=$break$omer' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }
            echo "</div>
</div>
</div>

<div class='container' style='margin-top: 2%;'>
<div class='row'>
    <div class='col-sm '>
        <table class='' style='width: 100%;'>
            <tr style='border-bottom: 3px solid #E85A4F;'>
                <td style='font-size: x-large; color: #5B616B'>
                5.11 Protein-RNA Interaction Databases
                </td>
            </tr>
        </table>
    </div>
</div>
</div>

<div class='container mt-2' style='margin-top: 0%;'>
<div class='row pt-2 pb-2' style='
background-color: #F0F8FF; width: 99%; margin-left: auto; margin-right: auto; border-left: 5px solid #8458B3'>
    <div class='col-sm '><b style='font-weight: 500'>RNAct:</b> ";
            if ($rnact == ' Nil ') {
                fwrite($entrywrite, "XR    RNAct: \n");
                echo "Not found";
            } else {
                $c = 1;
                $arr = explode(";", str_replace(" ", "", $rnact));
                unset($arr[count($arr) - 1]);
                foreach ($arr as $p) {
                    fwrite($entrywrite, "XR    RNAct: $p\n");
                    echo "<a href='https://rnact.crg.eu/protein?query=$p' style='text-decoration: none;' class='bb' target='_blank'>$p</a>";
                    if (count($arr) != $c) {
                        echo ", ";
                    }
                    $c += 1;
                }
            }
            echo "</div>
</div>
</div>           
";
        }
    }
    fwrite($entrywrite, "SQ    SEQUENCE  $mass" . " DA MW  " . "$length" . "AA\n");
    fwrite($entrywrite, "      ");
    $seccou = 10;
    for ($i = 0; $i < strlen($seq); $i += 10) {
        $slSeq = substr($seq, $i, 10);
        fwrite($entrywrite, "$slSeq ");
        if ($i > 0 and $seccou % 60 == 0) {
            fwrite($entrywrite, "\n");
            fwrite($entrywrite, "      ");
        }
        $seccou += 10;
    }
    fwrite($entrywrite, "\n//");
    fwrite($entrywrite, "\n\n");
    fclose($entrywrite);
    ?>
    <br>
    <br>
    <br>
    <br>
    <div class="container-fluid mt-2 fixed-bottom">
        <div class="row">
            <div class="col-sm text-center text-white p-2" style="background-color: #5A6F80; font-size: small;">
                © 2023 B&BL, DoAS, IIIT-A, UP-211015, India
            </div>
        </div>
    </div>
    <?php
    $con->close();
    ?>
    <script>
        const pdb_id_div = document.getElementById('pdb_ids');
        const pdb_ids = pdb_id_div.textContent;
        console.log(pdb_ids);


        $.ajax({
            url: "data-pdb-info.php",
            type: "POST",
            data: {
                "ids": pdb_ids
            },
            success: function(result) {
                console.log(result);
            }
        });
        var table;
        var selectedData = [];
        $.fn.dataTable.ext.errMode = 'none';
        $(document).ready(function() {
            var selectedData = [];
            table = $('#myDataTable').on('error.dt', function(e, settings, techNote, message) {
                    $("#error").html("");
                })
                .DataTable({
                    "ajax": {
                        "url": "data-pdb-info.php",
                        "type": "POST",
                        "data": {
                            "ids": pdb_ids
                        }
                    },
                    "columns": [
                        {
                            "data": "null"
                        },
                        {
                            "data": "sl",
                        },
                        {
                            "data": "id",
                            "render": function(data, type, row) {
                                return '<div style="vertical-align: middle;"><a style="text-decoration: none;" class="bb" href="https://www.rcsb.org/structure/' + data + '">' + data + '</a></div>';
                            },
                        },
                        {
                            "data": "method",
                            "render": function(data, type, row) {
                                return '<div style="overflow-wrap: anywhere">' + data + '</data>';
                            }
                        },
                        {
                            "data": "res",
                            "render": function(data, type, row) {
                                if (data == 'NA') {
                                    return ''
                                } else {
                                    return data
                                }
                            }
                        },
                        {
                            "data": "id",
                            "render": function(data, row, type) {
                                return "<a href='https://www.rcsb.org/structure/" + data + "' class='bb' target='_blank'>RCSB PDB</a> || <a href='https://www.ebi.ac.uk/thornton-srv/databases/cgi-bin/pdbsum/GetPage.pl?pdbcode=" + data + "' class='bb' target='_blank'>PDBsum</a><span> || <a href='https://www.ebi.ac.uk/pdbe/entry/pdb/" + data + "' class='bb' target='_blank'>PDBe</a> || <a href='https://pdbj.org/mine/summary/" + data + "'  class='bb' target='_blank'>PDBj</a> || <a href='https://www.ebi.ac.uk/pdbe/pdbe-kb/proteins/" + data + "' class='bb' target='_blank'>PDBe-KB</a> || <a href='https://www.ncbi.nlm.nih.gov/Structure/pdb/" + data + "' class='bb' target='_blank'>MMDB</a>";
                            },
                            "orderable": false,
                            "searchable": false
                        },
                        {
                            "data": "id",
                            "render": function(data, type, row) {
                                return "<a style='text-decoration: none' class='bb' target='_blank' href='https://3dmol.csb.pitt.edu/viewer.html?pdb=" + data + "&select=chain:A&style=cartoon;stick:radius~0.1&select=chain:B&style=cartoon;line&select=resi:19,23,26;chain:B&style=cartoon;stick&select=resi:19,23,26;chain:B&labelres=backgroundOpacity:0.8;fontSize:14'>View</a>";
                            },
                            "orderable": false,
                            "searchable": false

                        }
                    ],
                    "columnDefs": [{
                            "targets": 0,
                            "className": "dt-head-blue"
                        },
                        {
                            "orderable": false,
                            "targets": [0]
                        }
                    ],
                    "order": [],
                    "pageLength": 10,
                    "rowCallback": function(row, data) {
                        var checked = selectedData.includes(data['sl']) ? true : false;
                        $(row).find('.select-row').prop('checked', checked);
                    }
                });
            const recordsInfo = document.getElementById("records-info");
            table.on("draw.dt", function() {
                const pageInfo = table.page.info();
                const totalRecords = pageInfo.recordsTotal;
                const displayedRecords = pageInfo.recordsDisplay;
                recordsInfo.textContent = `${ totalRecords }`;
            });
            $('#select-all').on('click', function() {
                if ($(this).is(':checked')) {
                    $('.select-row').prop('checked', true);
                    var data = table.rows().data().toArray();
                    selectedData = data.map(function(item) {
                        return item['sl'];
                    });
                    table.rows().select();
                } else {
                    $('.select-row').prop('checked', false);
                    selectedData = [];
                    table.rows().deselect();
                }
            });
            $(document).on('click', '.select-row', function() {
                var rowData = $(this).val();
                if ($(this).is(':checked')) {
                    selectedData.push(rowData);
                    table.rows({
                        search: 'applied'
                    }).select();
                } else {
                    var index = selectedData.indexOf(rowData);
                    if (index > -1) {
                        selectedData.splice(index, 1);
                    }
                    table.rows({
                        search: 'applied'
                    }).deselect();
                }
            });
        });
    </script>
</body>

</html>