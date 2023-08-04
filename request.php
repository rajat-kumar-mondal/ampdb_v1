<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMBDB - Create Report</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
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
    <br><br><br>
    <div class="container" style="color:#192734;">
        <div class="row">
            <div class="col-sm text-center" style="margin-top: 2%;">
                <h4 style="font-weight: 500;">Create Report</h4>
            </div>
        </div>
    </div>

    <?php
        $myIds = '';
        $selectedids = $_POST['ids'] ?? '';
        $allids =  $_POST['allids'] ?? '';
        $usrWant = $_POST['ui'] ?? '';
        
        if ($usrWant == 'Download Selected') {
            $myIds = $selectedids;
        } else {
            $myIds = $allids;
        }        if (strlen($myIds) == 0){
            echo '<script>alert("Warning: No entries may have been selected.")</script>
            <div class="text-center"><button class="btn btn-info" onclick="history.back()">Go Back</button> to select some entries OR click on "Download All"</div>
            
            ';
        }
        else{
        echo '<p id="myIds" style="display:none">' . $myIds . '</p>';
        ?>
    <form onsubmit="submitForm(); return false;">
        <div class="container-fluid mt-1" style="width:97%">
            <div class="row">
                <div class="col-sm">
                <b class="text-success" style="font-size: smaller; font-weight: 500; font-size:larger"> Select a format</b>
                <button type="button" class="btn btn-sm float-end btn-info me-1" data-bs-toggle="modal" data-bs-target="#myModal">
                        Help
                    </button>    
                    
                    <button type="reset" class="btn btn-sm float-end btn-danger me-1">Reset</button>
                <button type="submit" class="btn btn-sm float-end btn-success me-1">Run Report</button>

                    <div class="modal" id="myModal">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <p style="font-size: x-large; font-weight: 500;" class="modal-title">AMBDB Create Report Help</p>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div style="text-align: justify;">
                                        In this section all data attributes are enlisted. By
                                        select single or multiple checkbox(s) as per interest, a fully customized report can be downloaded for TSV, JSON, XML. No customization is allowed for FASTA, TEXT, LIST format.
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" style="border-radius: 0px;" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-1" style="color: #192734; width:97%">
            <div class="row p-2">
                <div class="col-sm-3 border border-3" style="padding-top: 1%; padding-bottom: 1%;">
                    <b style="font-weight: 500;">Available Report Type: </b>
                    <div class="form-check mt-2" style="padding-left: 16%;"><input type="radio" class="form-check-input" id="tsv" name="fmt" value="tsv" onclick="toggleDiv2 ()" checked><label class="form-check-label" for="tsv">TSV</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="radio" class="form-check-input" id="json" name="fmt" value="json" onclick="toggleDiv2 ()"><label class="form-check-label" for="json">JSON</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="radio" class="form-check-input" id="xml" name="fmt" value="xml" onclick="toggleDiv2 ()"><label class="form-check-label" for="xml">XML</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="radio" class="form-check-input" id="fasta" name="fmt" value="fasta" onclick="toggleDiv ()"><label class="form-check-label" for="fasta">FASTA</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="radio" class="form-check-input" id="txt" name="fmt" value="txt" onclick="toggleDiv ()"><label class="form-check-label" for="txt">TEXT</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="radio" class="form-check-input" id="list" name="fmt" value="list" onclick="toggleDiv ()"><label class="form-check-label" for="list">LIST</label></div>
                </div>
            </div>
        </div>

        <div id="myDiv" class="container-fluid " style="color: #192734; width:97%">
        <div class="row">
            <div class="col-sm">
            <b class="text-success" style="font-size: smaller; font-weight: 500;"> Note: All of the option will checked automatically if none of the option checked and click on "Run Report".</b>
            </div>
        </div>
            <div class="row p-2 ">
                <div class="col-sm-3 border border-3" style="padding-top: 1%; padding-bottom: 1%;">
                    <div style="font-weight: 500;">General Description</div>
                    <div class="form-check mt-3" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`AMPDB_No_`" name="datareq" value="`AMPDB_No_`"><label class="form-check-label" for="`AMPDB_No_`">AMPDB_No_</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Protein names`" name="datareq" value="`Protein names`"><label class="form-check-label" for="`Protein names`">Protein names</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Protein families`" name="datareq" value="`Protein families`"><label class="form-check-label" for="`Protein families`">Protein families</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Gene Names`" name="datareq" value="`Gene Names`"><label class="form-check-label" for="`Gene Names`">Gene names</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Organism`" name="datareq" value="`Organism`"><label class="form-check-label" for="`Organism`">Source organism</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Length`" name="datareq" value="`Length`"><label class="form-check-label" for="`Length`">Length</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Protein existence`" name="datareq" value="`Protein existence`"><label class="form-check-label" for="`Protein existence`">Protein existence</label></div>
                </div>
                <div class="col-sm-3 border border-3" style="padding-top: 1%; padding-bottom: 1%;">
                    <div style="font-weight: 500;">Protein Sequence, Composition & Physicochemical Properties</div>
                    <div class="form-check mt-3" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Sequence`" name="datareq" value="`Sequence`"><label class="form-check-label" for="`Sequence`">Sequence</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Counts`" name="datareq" value="`Counts`"><label class="form-check-label" for="`Counts`">Counts</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Frequencies`" name="datareq" value="`Frequencies`"><label class="form-check-label" for="`Frequencies`">Frequencies</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`missRes`" name="datareq" value="`missRes`"><label class="form-check-label" for="`missRes`">Missing Amino Acid(s)</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`commonRes`" name="datareq" value="`commonRes`"><label class="form-check-label" for="`commonRes`">Most Occurring Amino Acid(s)</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`leastOccRes`" name="datareq" value="`leastOccRes`"><label class="form-check-label" for="`leastOccRes`">Less Occurring Amino Acid(s)</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`phoAA`" name="datareq" value="`phoAA`"><label class="form-check-label" for="`phoAA`">Hydrophobic Amino Acid(s) Count</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`phiAA`" name="datareq" value="`phiAA`"><label class="form-check-label" for="`phiAA`">Hydrophilic Amino Acid(s) Count</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`basicAACount`" name="datareq" value="`basicAACount`"><label class="form-check-label" for="`basicAACount`">Basic Amino Acid(s) Count</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`acidicAACount`" name="datareq" value="`acidicAACount`"><label class="form-check-label" for="`acidicAACount`">Acidic Amino Acid(s) Count</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`modifiedAA`" name="datareq" value="`modifiedAA`"><label class="form-check-label" for="`modifiedAA`">Modified Amino Acid(s) Count</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`modifiedAAfreq`" name="datareq" value="`modifiedAAfreq`"><label class="form-check-label" for="`modifiedAAfreq`">Modified Amino Acid(s) Frequencies</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Molecular Weight`" name="datareq" value="`Molecular Weight`"><label class="form-check-label" for="`Molecular Weight`">Molecular Mass</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Aliphatic Index`" name="datareq" value="`Aliphatic Index`"><label class="form-check-label" for="`Aliphatic Index`">Aliphatic Index</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Instability Index`" name="datareq" value="`Instability Index`"><label class="form-check-label" for="`Instability Index`">Instability Index</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Hydrophobicity (GRAVY)`" name="datareq" value="`Hydrophobicity (GRAVY)`"><label class="form-check-label" for="`Hydrophobicity (GRAVY)`">Hydrophobicity (GRAVY)</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Hydrophobic Moment`" name="datareq" value="`Hydrophobic Moment`"><label class="form-check-label" for="`Hydrophobic Moment`">Hydrophobic Moment</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Isoelectric Point`" name="datareq" value="`Isoelectric Point`"><label class="form-check-label" for="`Isoelectric Point`">Isoelectric Point</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Charge (at pH 7)`" name="datareq" value="`Charge (at pH 7)`"><label class="form-check-label" for="`Charge (at pH 7)`">Charge (at pH 7)</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Secondary Structure Fraction`" name="datareq" value="`Secondary Structure Fraction`"><label class="form-check-label" for="`Secondary Structure Fraction`">Secondary Structure Fraction</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Aromaticity`" name="datareq" value="`Aromaticity`"><label class="form-check-label" for="`Aromaticity`">Aromaticity</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Molar Extinction Coefficient (cysteine|cystine)`" name="datareq" value="`Molar Extinction Coefficient (cysteine|cystine)`"><label class="form-check-label" for="`Molar Extinction Coefficient (cysteine|cystine)`">Molar Extinction Coefficient (cysteine|cystine)</label></div>
                </div>
                <div class="col-sm-3 border border-3" style="padding-top: 1%; padding-bottom: 1%;">
                    <div style="font-weight: 500;">Class Details</div>
                    <div class="form-check mt-3" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`target organism`" name="datareq" value="`target organism`"><label class="form-check-label" for="`target organism`">Target Organism</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`peptide activity`" name="datareq" value="`peptide activity`"><label class="form-check-label" for="`peptide activity`">Antimicrobial Activity</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`enzyme`" name="datareq" value="`enzyme`"><label class="form-check-label" for="`enzyme`">Enzymatic Activity</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`inhibition`" name="datareq" value="`inhibition`"><label class="form-check-label" for="`inhibition`">Inhibitory Effect</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`other`" name="datareq" value="`other`"><label class="form-check-label" for="`other`">Other Biological Activity</label></div>
                </div>
                <div class="col-sm-3 border border-3" style="padding-top: 1%; padding-bottom: 1%;">
                    <div style="font-weight: 500;">Database Cross-reference(s)</div>
                    <div class="form-check mt-3" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`PubMed ID`" name="datareq" value="`PubMed ID`"><label class="form-check-label" for="`PubMed ID`">PubMed</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`PubMed ID`" name="datareq" value="`PubMed ID`"><label class="form-check-label" for="`PubMed ID`">PubMed ID</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Entry`" name="datareq" value="`Entry`"><label class="form-check-label" for="`Entry`">UniProt ID</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`PDB`" name="datareq" value="`PDB`"><label class="form-check-label" for="`PDB`">PDB</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`EMBL`" name="datareq" value="`EMBL`"><label class="form-check-label" for="`EMBL`">EMBL</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`CCDS`" name="datareq" value="`CCDS`"><label class="form-check-label" for="`CCDS`">CCDS</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`RefSeq`" name="datareq" value="`RefSeq`"><label class="form-check-label" for="`RefSeq`">RefSeq</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`STRING`" name="datareq" value="`STRING`"><label class="form-check-label" for="`STRING`">STRING ID</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`IntAct`" name="datareq" value="`IntAct`"><label class="form-check-label" for="`IntAct`">IntAct ID</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`MINT`" name="datareq" value="`MINT`"><label class="form-check-label" for="`MINT`">MINT ID</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`DIP`" name="datareq" value="`DIP`"><label class="form-check-label" for="`DIP`">DIP ID</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`BioGRID`" name="datareq" value="`BioGRID`"><label class="form-check-label" for="`BioGRID`">BioGRID ID</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`BindingDB`" name="datareq" value="`BindingDB`"><label class="form-check-label" for="`BindingDB`">BindingDB ID</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`DrugBank`" name="datareq" value="`DrugBank`"><label class="form-check-label" for="`DrugBank`">DrugBank ID</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`ChEMBL`" name="datareq" value="`ChEMBL`"><label class="form-check-label" for="`ChEMBL`">ChEMBL ID</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`InterPro`" name="datareq" value="`InterPro`"><label class="form-check-label" for="`InterPro`">InterPro ID</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`PANTHER`" name="datareq" value="`PANTHER`"><label class="form-check-label" for="`PANTHER`">PANTHER ID</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`PROSITE`" name="datareq" value="`PROSITE`"><label class="form-check-label" for="`PROSITE`">PROSITE ID</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`Ensembl`" name="datareq" value="`Ensembl`"><label class="form-check-label" for="`Ensembl`">Ensembl ID</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`KEGG`" name="datareq" value="`KEGG`"><label class="form-check-label" for="`KEGG`">KEGG ID</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`GeneTree`" name="datareq" value="`GeneTree`"><label class="form-check-label" for="`GeneTree`">GeneTree ID</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`BRENDA`" name="datareq" value="`BRENDA`"><label class="form-check-label" for="`BRENDA`">BRENDA ID</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`BioCyc`" name="datareq" value="`BioCyc`"><label class="form-check-label" for="`BioCyc`">BioCyc ID</label></div>
                    <div class="form-check" style="padding-left: 16%;"><input type="checkbox" class="form-check-input" id="`RNAct`" name="datareq" value="`RNAct`"><label class="form-check-label" for="`RNAct`">RNAct ID</label></div>
                </div>
            </div>
        </div>
    </form>
    <form id="AmarForm" action="custom-report" method='POST' style='display: none'>
        <input id='ids' name='ids' type='text' value="">Input Here</input>
        <input id='myDataset' name='myDataset' type='text' value="">Input Here</input>
        <input id='myFormat' name='myFormat' type='text' value="">Input Here</input>
        <input type="text" value="<?php echo $_POST['file']; ?>" name="file">
    </form>
    <?php } ?>
    <script>
        function disableCheckboxes() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var radio = document.getElementById('radioButton');

            if (radio.checked) {
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].disabled = true;
                }
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].disabled = false;
                }
            }
        }

        function toggleDiv() {
            var div = document.getElementById("myDiv");
            div.style.display = "none";
        }

        function toggleDiv2() {
            var div = document.getElementById("myDiv");
            if (div.style.display === "none") {
                div.style.display = "block";
            }
        }

        function submitForm() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"][name="datareq"]:checked');
            const values = [];
            checkboxes.forEach((checkbox) => {
                values.push(checkbox.value);
            });
            const checkboxes2 = document.querySelectorAll('input[type="radio"][name="fmt"]:checked');
            const values2 = [];
            checkboxes2.forEach((checkbox2) => {
                values2.push(checkbox2.value);
            });
            const urlParams = new URLSearchParams(window.location.search);
            const urlParams2 = new URLSearchParams(window.location.search);
            urlParams.set('datareq', values.join(','));
            urlParams2.set('fmt', values2.join(','));
            const the_Ids = document.getElementById('myIds').innerHTML;
            const myDataset = urlParams.toString()
            const myFormat = urlParams2.toString();
            document.getElementById("ids").value = the_Ids;
            document.getElementById("myDataset").value = myDataset;
            document.getElementById("myFormat").value = myFormat;
            document.getElementById("AmarForm").submit();
        }
    </script>
    <br><br><br>
    <footer class="mt-3 text-center p-2 text-white" style="position: fixed; background-color: #5A6F80; font-size: small; left: 0; bottom: 0; width: 100%;">
        © 2023 B&BL, DoAS, IIIT-A, UP-211015, India
    </footer>
</body>

</html>