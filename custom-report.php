<?php
$format = ".".str_replace("fmt=", "", $_POST['myFormat']);
$filename = $_POST['file']??'';
if (strlen($filename)==0){
    $filename="AMPDB Report";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="ss.css" rel="stylesheet">
    <link href="ampdbTextSearch.css" rel="stylesheet">
    <link href="midilizer.css" rel="stylesheet">
    <title>AMPDB - Report</title>
    <script>
        function startDownload() {
            setTimeout(function() {
                var link = document.createElement('a');
                link.href = '<?php if ($format == 'xml'){
                echo $filename.'.xml';
            } else{
                echo "$filename$format";
            }?>';
                link.download = '<?php if ($format == 'xml'){
                echo $filename.'.xml';
            } else{
                echo "$filename$format";
            }
            ?>';
                link.click();
            }, 500);
        }
    </script>
</head>

<body onload="startDownload()">
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
    <?php
    ini_set('max_execution_time', 1500);
    require 'dbcon.php';
    $ids = explode(",", $_POST["ids"]);
    $colHeader = str_replace("%7C", "|", str_replace("%29", ")", str_replace("%28", "(", str_replace("+", " ", str_replace("%60", "`", str_replace("%2C", ",", str_replace("datareq=", "", $_POST["myDataset"])))))));
    $format = str_replace("fmt=", "", $_POST["myFormat"]);
    $tsvHeader = '';
    if (strlen($colHeader) == 0) {
        $colHeader = "`AMPDB_No_`, `Protein names`, `Protein families`, `Gene Names`, `Organism`, `Length`, `Protein existence`, `Sequence`, `Counts`, `Frequencies`, `missRes`, `commonRes`, `leastOccRes`, `phoAA`, `phiAA`, `basicAACount`, `acidicAACount`, `modifiedAA`, `modifiedAAfreq`, `Molecular Weight`, `Aliphatic Index`, `Instability Index`, `Hydrophobicity (GRAVY)`, `Hydrophobic Moment`, `Isoelectric Point`, `Charge (at pH 7)`, `Secondary Structure Fraction`, `Aromaticity`, `Molar Extinction Coefficient (cysteine|cystine)`, `target organism`, `peptide activity`, `enzyme`, `inhibition`, `other`, `PubMed ID`, `Entry`, `PDB`, `EMBL`, `CCDS`, `RefSeq`, `STRING`, `IntAct`, `MINT`, `DIP`, `BioGRID`, `BindingDB`, `DrugBank`, `ChEMBL`, `InterPro`, `PANTHER`, `PROSITE`, `Ensembl`, `KEGG`, `GeneTree`, `BRENDA`, `BioCyc`, `RNAct`";
        $tsvHeader = $colHeader;
    } else {
        $tsvHeader = $colHeader;
    }
    $idArrLen = count($ids);
    if ($format == 'tsv') {
        $cc = 0;
        $tsvFile = fopen("$filename.$format", "w") or die("UtO");
        fwrite($tsvFile, str_replace("AMPDB_No_", "AMPDB_No_", (str_replace("Protein names", "Protein names", (str_replace("Protein families", "Protein families", (str_replace("Gene Names", "Gene names", (str_replace("Gene Names (synonym)", "Synonymous gene names", (str_replace("Organism", "Source organism", (str_replace("Length", "Length", (str_replace("Protein existence", "Protein existence", (str_replace("Proteomes", "Chromosomes & proteomes information", (str_replace("Sequence", "Sequence", (str_replace("Counts", "Counts", (str_replace("Frequencies", "Frequencies", (str_replace("missRes", "Missing Amino Acid(s)", (str_replace("commonRes", "Most Occurring Amino Acid(s)", (str_replace("leastOccRes", "Less Occurring Amino Acid(s)", (str_replace("phoAA", "Hydrophobic Amino Acid(s) Count", (str_replace("phiAA", "Hydrophilic Amino Acid(s) Count", (str_replace("basicAACount", "Basic Amino Acid(s) Count", (str_replace("acidicAACount", "Acidic Amino Acid(s) Count", (str_replace("modifiedAA", "Modified Amino Acid(s) Count", (str_replace("modifiedAAfreq", "Modified Amino Acid(s) Frequencies", (str_replace("Molecular Weight", "Molecular Mass", (str_replace("Aliphatic Index", "Aliphatic Index", (str_replace("Instability Index", "Instability Index", (str_replace("Hydrophobicity (GRAVY)", "Hydrophobicity (GRAVY)", (str_replace("Hydrophobic Moment", "Hydrophobic Moment", (str_replace("Isoelectric Point", "Isoelectric Point", (str_replace("Charge (at pH 7)", "Charge (at pH 7)", (str_replace("Secondary Structure Fraction", "Secondary Structure Fraction", (str_replace("Aromaticity", "Aromaticity", (str_replace("Molar Extinction Coefficient (cysteine|cystine)", "Molar Extinction Coefficient (cysteine|cystine)", (str_replace("target organism", "target organism", (str_replace("peptide activity", "Antimicrobial Activity", (str_replace("enzyme", "Enzymatic Activity", (str_replace("inhibition", "Inhibitory Effect", (str_replace("other", "Other Biological Activity", (str_replace("PubMed ID", "PubMed ID", (str_replace("Entry", "UniProt ID", (str_replace("PDB", "PDB", (str_replace("EMBL", "EMBL", (str_replace("CCDS", "CCDS", (str_replace("RefSeq", "RefSeq", (str_replace("STRING", "STRING ID", (str_replace("IntAct", "IntAct ID", (str_replace("MINT", "MINT ID", (str_replace("DIP", "DIP ID", (str_replace("BioGRID", "BioGRID ID", (str_replace("BindingDB", "BindingDB ID", (str_replace("DrugBank", "DrugBank ID", (str_replace("ChEMBL", "ChEMBL ID", (str_replace("InterPro", "InterPro ID", (str_replace("PANTHER", "PANTHER ID", (str_replace("PROSITE", "PROSITE ID", (str_replace("Ensembl", "Ensembl ID", (str_replace("KEGG", "KEGG ID", (str_replace("GeneTree", "GeneTree ID", (str_replace("BRENDA", "BRENDA ID", (str_replace("BioCyc", "BioCyc ID", (str_replace("RNAct", "RNAct ID", (str_replace("`", "", str_replace(",", "\t", $tsvHeader . "\n")))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))));
        $arr = array();
        for ($ia = 0; $ia < $idArrLen; $ia++) {
            array_push($arr, $ids[$ia]);
            if (($ia + 1) % 500 == 0) {
                $sql = "SELECT $colHeader FROM `master` WHERE AMPDB_No_ IN ('" . implode("','", $arr) . "')";
                $result = $con->query($sql);
                while ($row = $result->fetch_assoc()) {
                    fwrite($tsvFile, str_replace("Nil", "Not found", str_replace("Nil ", "Not found", str_replace(" Nil", "Not found", str_replace(" Nil ", "Not found", implode("\t", $row)) . "\n"))));
                }
                $arr = array();
            }
            if ($ia + 1 == $idArrLen) {
                if (($ia + 1) % 500 != 0) {
                    $sql = "SELECT $colHeader FROM `master` WHERE AMPDB_No_ IN ('','" . implode("','", $arr) . "')";
                    $result = $con->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        fwrite($tsvFile, str_replace("Nil", "Not found", str_replace("Nil ", "Not found", str_replace(" Nil", "Not found", str_replace(" Nil ", "Not found", implode("\t", $row)) . "\n"))));
                    }
                    $arr = array();
                }
            }
        }
        fclose($tsvFile);
    }
    if ($format == 'json') {
        $cc = 0;
        $tsvFile = fopen("$filename.$format", "w") or die("UtO");
        $arr = array();
        $data = array();
        for ($ia = 0; $ia < $idArrLen; $ia++) {
            array_push($arr, $ids[$ia]);
            if (($ia + 1) % 500 == 0) {
                $sql = "SELECT $colHeader FROM `master` WHERE AMPDB_No_ IN ('" . implode("','", $arr) . "')";
                $result = $con->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $myAssArr = array();
                    foreach ($row as $key => $val) {
                        $myAssArr[str_replace("AMPDB_No_", "AMPDB_No_", (str_replace("Protein names", "Protein names", (str_replace("Protein families", "Protein families", (str_replace("Gene Names", "Gene names", (str_replace("Gene Names (synonym)", "Synonymous gene names", (str_replace("Organism", "Source organism", (str_replace("Length", "Length", (str_replace("Protein existence", "Protein existence", (str_replace("Proteomes", "Chromosomes & proteomes information", (str_replace("Sequence", "Sequence", (str_replace("Counts", "Counts", (str_replace("Frequencies", "Frequencies", (str_replace("missRes", "Missing Amino Acid(s)", (str_replace("commonRes", "Most Occurring Amino Acid(s)", (str_replace("leastOccRes", "Less Occurring Amino Acid(s)", (str_replace("phoAA", "Hydrophobic Amino Acid(s) Count", (str_replace("phiAA", "Hydrophilic Amino Acid(s) Count", (str_replace("basicAACount", "Basic Amino Acid(s) Count", (str_replace("acidicAACount", "Acidic Amino Acid(s) Count", (str_replace("modifiedAA", "Modified Amino Acid(s) Count", (str_replace("modifiedAAfreq", "Modified Amino Acid(s) Frequencies", (str_replace("Molecular Weight", "Molecular Mass", (str_replace("Aliphatic Index", "Aliphatic Index", (str_replace("Instability Index", "Instability Index", (str_replace("Hydrophobicity (GRAVY)", "Hydrophobicity (GRAVY)", (str_replace("Hydrophobic Moment", "Hydrophobic Moment", (str_replace("Isoelectric Point", "Isoelectric Point", (str_replace("Charge (at pH 7)", "Charge (at pH 7)", (str_replace("Secondary Structure Fraction", "Secondary Structure Fraction", (str_replace("Aromaticity", "Aromaticity", (str_replace("Molar Extinction Coefficient (cysteine|cystine)", "Molar Extinction Coefficient (cysteine|cystine)", (str_replace("target organism", "target organism", (str_replace("peptide activity", "Antimicrobial Activity", (str_replace("enzyme", "Enzymatic Activity", (str_replace("inhibition", "Inhibitory Effect", (str_replace("other", "Other Biological Activity", (str_replace("PubMed ID", "PubMed ID", (str_replace("Entry", "UniProt ID", (str_replace("PDB", "PDB", (str_replace("EMBL", "EMBL", (str_replace("CCDS", "CCDS", (str_replace("RefSeq", "RefSeq", (str_replace("STRING", "STRING ID", (str_replace("IntAct", "IntAct ID", (str_replace("MINT", "MINT ID", (str_replace("DIP", "DIP ID", (str_replace("BioGRID", "BioGRID ID", (str_replace("BindingDB", "BindingDB ID", (str_replace("DrugBank", "DrugBank ID", (str_replace("ChEMBL", "ChEMBL ID", (str_replace("InterPro", "InterPro ID", (str_replace("PANTHER", "PANTHER ID", (str_replace("PROSITE", "PROSITE ID", (str_replace("Ensembl", "Ensembl ID", (str_replace("KEGG", "KEGG ID", (str_replace("GeneTree", "GeneTree ID", (str_replace("BRENDA", "BRENDA ID", (str_replace("BioCyc", "BioCyc ID", (str_replace("RNAct", "RNAct ID", (str_replace("`", "", str_replace(",", "\t", $key))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))] = str_replace("Nil", "Not found", str_replace("Nil ", "Not found", str_replace(" Nil", "Not found", str_replace(" Nil ", "Not found", $val))));
                    }
                    $data[] = $myAssArr;
                    $arr = array();
                }
            }
            if ($ia + 1 == $idArrLen) {
                if (($ia + 1) % 500 != 0) {
                    $sql = "SELECT $colHeader FROM `master` WHERE AMPDB_No_ IN ('','" . implode("','", $arr) . "')";
                    $result = $con->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $myAssArr = array();
                        foreach ($row as $key => $val) {
                            $myAssArr[str_replace("AMPDB_No_", "AMPDB_No_", (str_replace("Protein names", "Protein names", (str_replace("Protein families", "Protein families", (str_replace("Gene Names", "Gene names", (str_replace("Gene Names (synonym)", "Synonymous gene names", (str_replace("Organism", "Source organism", (str_replace("Length", "Length", (str_replace("Protein existence", "Protein existence", (str_replace("Proteomes", "Chromosomes & proteomes information", (str_replace("Sequence", "Sequence", (str_replace("Counts", "Counts", (str_replace("Frequencies", "Frequencies", (str_replace("missRes", "Missing Amino Acid(s)", (str_replace("commonRes", "Most Occurring Amino Acid(s)", (str_replace("leastOccRes", "Less Occurring Amino Acid(s)", (str_replace("phoAA", "Hydrophobic Amino Acid(s) Count", (str_replace("phiAA", "Hydrophilic Amino Acid(s) Count", (str_replace("basicAACount", "Basic Amino Acid(s) Count", (str_replace("acidicAACount", "Acidic Amino Acid(s) Count", (str_replace("modifiedAA", "Modified Amino Acid(s) Count", (str_replace("modifiedAAfreq", "Modified Amino Acid(s) Frequencies", (str_replace("Molecular Weight", "Molecular Mass", (str_replace("Aliphatic Index", "Aliphatic Index", (str_replace("Instability Index", "Instability Index", (str_replace("Hydrophobicity (GRAVY)", "Hydrophobicity (GRAVY)", (str_replace("Hydrophobic Moment", "Hydrophobic Moment", (str_replace("Isoelectric Point", "Isoelectric Point", (str_replace("Charge (at pH 7)", "Charge (at pH 7)", (str_replace("Secondary Structure Fraction", "Secondary Structure Fraction", (str_replace("Aromaticity", "Aromaticity", (str_replace("Molar Extinction Coefficient (cysteine|cystine)", "Molar Extinction Coefficient (cysteine|cystine)", (str_replace("target organism", "target organism", (str_replace("peptide activity", "Antimicrobial Activity", (str_replace("enzyme", "Enzymatic Activity", (str_replace("inhibition", "Inhibitory Effect", (str_replace("other", "Other Biological Activity", (str_replace("PubMed ID", "PubMed ID", (str_replace("Entry", "UniProt ID", (str_replace("PDB", "PDB", (str_replace("EMBL", "EMBL", (str_replace("CCDS", "CCDS", (str_replace("RefSeq", "RefSeq", (str_replace("STRING", "STRING ID", (str_replace("IntAct", "IntAct ID", (str_replace("MINT", "MINT ID", (str_replace("DIP", "DIP ID", (str_replace("BioGRID", "BioGRID ID", (str_replace("BindingDB", "BindingDB ID", (str_replace("DrugBank", "DrugBank ID", (str_replace("ChEMBL", "ChEMBL ID", (str_replace("InterPro", "InterPro ID", (str_replace("PANTHER", "PANTHER ID", (str_replace("PROSITE", "PROSITE ID", (str_replace("Ensembl", "Ensembl ID", (str_replace("KEGG", "KEGG ID", (str_replace("GeneTree", "GeneTree ID", (str_replace("BRENDA", "BRENDA ID", (str_replace("BioCyc", "BioCyc ID", (str_replace("RNAct", "RNAct ID", (str_replace("`", "", str_replace(",", "\t", $key))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))] = str_replace("Nil", "Not found", str_replace("Nil ", "Not found", str_replace(" Nil", "Not found", str_replace(" Nil ", "Not found", $val))));
                        }
                         $data[] = $myAssArr;
                    $arr = array();
                    }
                }
            }
        }
        fwrite($tsvFile, json_encode(array("data" => $data), JSON_PRETTY_PRINT));
        fclose($tsvFile);
    }
    if ($format == 'xml') {
        function arrayToXml($data, &$xml)
        {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    if (!is_numeric(str_replace("", "", str_replace("|", "by", str_replace("{", "", str_replace("}", "", str_replace("(", "", str_replace(")", "", str_replace(" ", "_", $key))))))))) {
                        $subnode = $xml->addChild(str_replace("", "", str_replace("|", "by", str_replace("{", "", str_replace("}", "", str_replace("(", "", str_replace(")", "", str_replace(" ", "_", $key))))))));
                        arrayToXml($value, $subnode);
                    } else {
                        arrayToXml($value, $xml);
                    }
                } else {
                    $xml->addChild(str_replace("", "", str_replace("|", "by", str_replace("{", "", str_replace("}", "", str_replace("(", "", str_replace(")", "", str_replace(" ", "_", $key))))))), htmlspecialchars($value));
                }
            }
        }
        $xml = new SimpleXMLElement('<root></root>');
        $xmlFilePath = $filename.'.xml';
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $cc = 1;
        $arr = array();
        for ($ia = 0; $ia < $idArrLen; $ia++) {
            array_push($arr, $ids[$ia]);
            if (($ia + 1) % 500 == 0) {
                $sql = "SELECT $colHeader FROM `master` WHERE AMPDB_No_ IN ('" . implode("','", $arr) . "') LIMIT 300";
                $result = $con->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $myAssArr = array();
                    foreach ($row as $key => $val) {
                        if ($key == 'missRes' and $val == '') {
                            $myAssArr[(str_replace("missRes", "Missing Amino Acid(s)", str_replace("`", "", str_replace(",", "\t", str_replace(" ", "_", $key)))))] = ' ';
                        } else {
                            $myAssArr[(str_replace("Gene Names", "Gene names", (str_replace("Organism", "Source organism", (str_replace("missRes", "Missing Amino Acid(s)", (str_replace("commonRes", "Most Occurring Amino Acid(s)", (str_replace("leastOccRes", "Less Occurring Amino Acid(s)", (str_replace("phoAA", "Hydrophobic Amino Acid(s) Count", (str_replace("phiAA", "Hydrophilic Amino Acid(s) Count", (str_replace("basicAACount", "Basic Amino Acid(s) Count", (str_replace("acidicAACount", "Acidic Amino Acid(s) Count", (str_replace("modifiedAA", "Modified Amino Acid(s) Count", (str_replace("modifiedAAfreq", "Modified Amino Acid(s) Frequencies", (str_replace("Molecular Weight", "Molecular Mass", (str_replace("peptide activity", "Antimicrobial Activity", (str_replace("enzyme", "Enzymatic Activity", (str_replace("inhibition", "Inhibitory Effect", (str_replace("other", "Other Biological Activity", (str_replace("Entry", "UniProt ID", (str_replace("PDB", "PDB", (str_replace("EMBL", "EMBL", (str_replace("CCDS", "CCDS", (str_replace("RefSeq", "RefSeq", (str_replace("STRING", "STRING ID", (str_replace("IntAct", "IntAct ID", (str_replace("MINT", "MINT ID", (str_replace("DIP", "DIP ID", (str_replace("BioGRID", "BioGRID ID", (str_replace("BindingDB", "BindingDB ID", (str_replace("DrugBank", "DrugBank ID", (str_replace("ChEMBL", "ChEMBL ID", (str_replace("InterPro", "InterPro ID", (str_replace("PANTHER", "PANTHER ID", (str_replace("PROSITE", "PROSITE ID", (str_replace("Ensembl", "Ensembl ID", (str_replace("KEGG", "KEGG ID", (str_replace("GeneTree", "GeneTree ID", (str_replace("BRENDA", "BRENDA ID", (str_replace("BioCyc", "BioCyc ID", (str_replace("RNAct", "RNAct ID", (str_replace("`", "", str_replace(",", "\t", str_replace(" ", "_", $key))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))] = str_replace("Nil", "Not found", str_replace("Nil ", "Not found", str_replace(" Nil", "Not found", str_replace(" Nil ", "Not found", str_replace("'", '', $val)))));
                        }
                    }
                    arrayToXml($myAssArr, $xml);
                    $dom->loadXML($xml->asXML());
                }
            }
            if ($ia + 1 == $idArrLen) {
                if (($ia + 1) % 500 != 0) {
                    $sql = "SELECT $colHeader FROM `master` WHERE AMPDB_No_ IN ('','" . implode("','", $arr) . "') LIMIT 300";
                    $result = $con->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $myAssArr = array();
                        foreach ($row as $key => $val) {
                            if ($key == 'missRes' and $val == '') {
                                $myAssArr[(str_replace("missRes", "Missing Amino Acid(s)", str_replace("`", "", str_replace(",", "\t", str_replace(" ", "_", $key)))))] = ' ';
                            } else {
                                $myAssArr[(str_replace("Gene Names", "Gene names", (str_replace("Organism", "Source organism", (str_replace("missRes", "Missing Amino Acid(s)", (str_replace("commonRes", "Most Occurring Amino Acid(s)", (str_replace("leastOccRes", "Less Occurring Amino Acid(s)", (str_replace("phoAA", "Hydrophobic Amino Acid(s) Count", (str_replace("phiAA", "Hydrophilic Amino Acid(s) Count", (str_replace("basicAACount", "Basic Amino Acid(s) Count", (str_replace("acidicAACount", "Acidic Amino Acid(s) Count", (str_replace("modifiedAA", "Modified Amino Acid(s) Count", (str_replace("modifiedAAfreq", "Modified Amino Acid(s) Frequencies", (str_replace("Molecular Weight", "Molecular Mass", (str_replace("peptide activity", "Antimicrobial Activity", (str_replace("enzyme", "Enzymatic Activity", (str_replace("inhibition", "Inhibitory Effect", (str_replace("other", "Other Biological Activity", (str_replace("Entry", "UniProt ID", (str_replace("PDB", "PDB", (str_replace("EMBL", "EMBL", (str_replace("CCDS", "CCDS", (str_replace("RefSeq", "RefSeq", (str_replace("STRING", "STRING ID", (str_replace("IntAct", "IntAct ID", (str_replace("MINT", "MINT ID", (str_replace("DIP", "DIP ID", (str_replace("BioGRID", "BioGRID ID", (str_replace("BindingDB", "BindingDB ID", (str_replace("DrugBank", "DrugBank ID", (str_replace("ChEMBL", "ChEMBL ID", (str_replace("InterPro", "InterPro ID", (str_replace("PANTHER", "PANTHER ID", (str_replace("PROSITE", "PROSITE ID", (str_replace("Ensembl", "Ensembl ID", (str_replace("KEGG", "KEGG ID", (str_replace("GeneTree", "GeneTree ID", (str_replace("BRENDA", "BRENDA ID", (str_replace("BioCyc", "BioCyc ID", (str_replace("RNAct", "RNAct ID", (str_replace("`", "", str_replace(",", "\t", str_replace(" ", "_", $key))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))] = str_replace("Nil", "Not found", str_replace("Nil ", "Not found", str_replace(" Nil", "Not found", str_replace(" Nil ", "Not found", str_replace("'", '', $val)))));
                            }
                        }
                        arrayToXml($myAssArr, $xml);
                        $dom->loadXML($xml->asXML());
                    }
                }
            }
        }
        $dom->save($xmlFilePath);
    }
    if ($format == 'tsv') {
        $cc = 0;
        $tsvFile = fopen("$filename.$format", "w") or die("UtO");
        fwrite($tsvFile, str_replace("AMPDB_No_", "AMPDB_No_", (str_replace("Protein names", "Protein names", (str_replace("Protein families", "Protein families", (str_replace("Gene Names", "Gene names", (str_replace("Gene Names (synonym)", "Synonymous gene names", (str_replace("Organism", "Source organism", (str_replace("Length", "Length", (str_replace("Protein existence", "Protein existence", (str_replace("Proteomes", "Chromosomes & proteomes information", (str_replace("Sequence", "Sequence", (str_replace("Counts", "Counts", (str_replace("Frequencies", "Frequencies", (str_replace("missRes", "Missing Amino Acid(s)", (str_replace("commonRes", "Most Occurring Amino Acid(s)", (str_replace("leastOccRes", "Less Occurring Amino Acid(s)", (str_replace("phoAA", "Hydrophobic Amino Acid(s) Count", (str_replace("phiAA", "Hydrophilic Amino Acid(s) Count", (str_replace("basicAACount", "Basic Amino Acid(s) Count", (str_replace("acidicAACount", "Acidic Amino Acid(s) Count", (str_replace("modifiedAA", "Modified Amino Acid(s) Count", (str_replace("modifiedAAfreq", "Modified Amino Acid(s) Frequencies", (str_replace("Molecular Weight", "Molecular Mass", (str_replace("Aliphatic Index", "Aliphatic Index", (str_replace("Instability Index", "Instability Index", (str_replace("Hydrophobicity (GRAVY)", "Hydrophobicity (GRAVY)", (str_replace("Hydrophobic Moment", "Hydrophobic Moment", (str_replace("Isoelectric Point", "Isoelectric Point", (str_replace("Charge (at pH 7)", "Charge (at pH 7)", (str_replace("Secondary Structure Fraction", "Secondary Structure Fraction", (str_replace("Aromaticity", "Aromaticity", (str_replace("Molar Extinction Coefficient (cysteine|cystine)", "Molar Extinction Coefficient (cysteine|cystine)", (str_replace("target organism", "target organism", (str_replace("peptide activity", "Antimicrobial Activity", (str_replace("enzyme", "Enzymatic Activity", (str_replace("inhibition", "Inhibitory Effect", (str_replace("other", "Other Biological Activity", (str_replace("PubMed ID", "PubMed ID", (str_replace("Entry", "UniProt ID", (str_replace("PDB", "PDB", (str_replace("EMBL", "EMBL", (str_replace("CCDS", "CCDS", (str_replace("RefSeq", "RefSeq", (str_replace("STRING", "STRING ID", (str_replace("IntAct", "IntAct ID", (str_replace("MINT", "MINT ID", (str_replace("DIP", "DIP ID", (str_replace("BioGRID", "BioGRID ID", (str_replace("BindingDB", "BindingDB ID", (str_replace("DrugBank", "DrugBank ID", (str_replace("ChEMBL", "ChEMBL ID", (str_replace("InterPro", "InterPro ID", (str_replace("PANTHER", "PANTHER ID", (str_replace("PROSITE", "PROSITE ID", (str_replace("Ensembl", "Ensembl ID", (str_replace("KEGG", "KEGG ID", (str_replace("GeneTree", "GeneTree ID", (str_replace("BRENDA", "BRENDA ID", (str_replace("BioCyc", "BioCyc ID", (str_replace("RNAct", "RNAct ID", (str_replace("`", "", str_replace(",", "\t", $tsvHeader . "\n")))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))));
        $arr = array();
        for ($ia = 0; $ia < $idArrLen; $ia++) {
            array_push($arr, $ids[$ia]);
            if (($ia + 1) % 500 == 0) {
                $sql = "SELECT $colHeader FROM `master` WHERE AMPDB_No_ IN ('" . implode("','", $arr) . "')";
                $result = $con->query($sql);
                while ($row = $result->fetch_assoc()) {
                    fwrite($tsvFile, str_replace("Nil", "Not found", str_replace("Nil ", "Not found", str_replace(" Nil", "Not found", str_replace(" Nil ", "Not found", implode("\t", $row)) . "\n"))));
                }
                $arr = array();
            }
            if ($ia + 1 == $idArrLen) {
                if (($ia + 1) % 500 != 0) {
                    $sql = "SELECT $colHeader FROM `master` WHERE AMPDB_No_ IN ('','" . implode("','", $arr) . "')";
                    $result = $con->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        fwrite($tsvFile, str_replace("Nil", "Not found", str_replace("Nil ", "Not found", str_replace(" Nil", "Not found", str_replace(" Nil ", "Not found", implode("\t", $row)) . "\n"))));
                    }
                    $arr = array();
                }
            }
        }
        fclose($tsvFile);
    }
    if ($format == 'fasta') {
        $cc = 0;
        $tsvFile = fopen("$filename.$format", "w") or die("UtO");
        $arr = array();
        for ($ia = 0; $ia < $idArrLen; $ia++) {
            array_push($arr, $ids[$ia]);
            if (($ia + 1) % 500 == 0) {
                $sql = "SELECT fasta FROM fmt WHERE id IN ('" . str_replace("AMPDB_", "", implode("','", $arr)) . "')";
                $arr = array();
                $result = $con->query($sql);
                while ($row = $result->fetch_assoc()) {
                    array_push($arr, $row['fasta']);
                }
                fwrite($tsvFile, implode("\n", $arr));
                $arr = array();
            }
            if ($ia + 1 == $idArrLen) {
                if (($ia + 1) % 500 != 0) {
                    $sql = "SELECT fasta FROM fmt WHERE id IN ('" . str_replace("AMPDB_", "", implode("','", $arr)) . "')";
                    $arr = array();
                    $result = $con->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        array_push($arr, $row['fasta']);
                    }
                    fwrite($tsvFile, implode("\n", $arr));
                    $arr = array();
                }
            }
        }
        fclose($tsvFile);
    }
    if ($format == 'txt') {
        $cc = 0;
        $tsvFile = fopen("$filename.$format", "w") or die("UtO");
        $arr = array();
        for ($ia = 0; $ia < $idArrLen; $ia++) {
            array_push($arr, $ids[$ia]);
            if (($ia + 1) % 500 == 0) {
                $sql = "SELECT txt FROM fmt WHERE id IN ('" . str_replace("AMPDB_", "", implode("','", $arr)) . "')";
                $arr = array();
                $result = $con->query($sql);
                while ($row = $result->fetch_assoc()) {
                    array_push($arr, $row['txt']);
                }
                fwrite($tsvFile, implode("\n", $arr));
                $arr = array();
            }
            if ($ia + 1 == $idArrLen) {
                if (($ia + 1) % 500 != 0) {
                    $sql = "SELECT txt FROM fmt WHERE id IN ('" . str_replace("AMPDB_", "", implode("','", $arr)) . "')";
                    $arr = array();
                    $result = $con->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        array_push($arr, $row['txt']);
                    }
                    fwrite($tsvFile, implode("\n", $arr));
                    $arr = array();
                }
            }
        }
        fclose($tsvFile);
    }
    if ($format == 'list') {
        $cc = 0;
        $tsvFile = fopen("$filename.$format", "w") or die("UtO");
        fwrite($tsvFile, implode("\n", $ids));
        fclose($tsvFile);
    }
    ?>
    <div class="container-c text-center">
        <div style="font-size: x-large; font-weight: 500; width: 90%; margin-left: auto; margin-right: auto;">Report Created Successfully
            <br>
            <div class="text-success" style="font-size: large; margin-top: 0.5%">Report will start to download in a few seconds...</div>
            <div style="font-size: medium; margin-top: 1%; padding-left: 1%; padding-right: 1%;"><span style="color: brown;">Download not starting??</span> <span class="text-success"> Try this </span><a class="bb" style="text-decoration: none;" href="<?php if ($format == 'xml'){
                echo $filename.'.xml';
            } else{
                echo $filename.".".$format;
            } ?>" download>direct download link</a></div>
            <div style="font-size: medium; margin-top: 0.1%">Click on <a target="_blank" href="<?php if ($format == 'xml'){
                echo $filename.'.xml';
            } else{
                echo 'display-report?fmt='.$format.'&file='.$filename;
            } ?>" class="bb" style="text-decoration: none;">view report</a> to view</div>
        </div>
    </div>
    <?php
    $con->close();
    ?>
    <br><br><br>
    <footer class="mt-3 text-center p-2 text-white" style="position: fixed; background-color: #5A6F80; font-size: small; left: 0; bottom: 0; width: 100%;">
        © 2023 B&BL, DoAS, IIIT-A, UP-211015, India
    </footer>
</body>

</html>