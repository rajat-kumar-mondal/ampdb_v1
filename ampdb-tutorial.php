<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <title>AMPDB Tutorial</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
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
                        <a class="nav-link active" href="ampdb-tutorial">Tutorial</a>
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
    <div class="container">
        <div class="row">
            <div class="col-sm text-center" style="margin-top: 2%;">
                <h4 style="font-weight: 500; color: #9A3863;">AMPDB Tutorial</h4>
            </div>
        </div>
    </div>
    <div class="container-fluid border border-4 mt-4 pt-2 pb-2" style="width: 85%;">
        <div class="row">
            <div class="col-sm">
                <div style="text-align: left;">
                    <div style="text-align: left;"><b style="font-weight: 500; font-size: larger;">1. Use AMPDB Quick
                            Search
                            Facility</b></div>
                    <div style="text-align: justify;">
                        This is also a generelized search facility like text search. This
                        search facility is case insensitive. A user can search any search term (shown in example of SelBioDB Text Search). No search restriction is allowed here.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid border border-4 mt-4 pt-2 pb-2" style="width: 85%;">
        <div class="row">
            <div class="col-sm">
                <div style="text-align: left;"><b style="font-weight: 500; font-size: larger;">2. Use AMPDB Text Search
                        Facility</b></div>
                <div style="text-align: justify;">This is a generelized search facility (the
                    search can also be restricted by clicking on 'Choose
                    a Dataset' option). This
                    search facility is case insensitive.
                    Here one can search with followings.
                </div>
                <div class="text-start" style="font-size: small;">1. AMPDB ID (e.g., AMPDB_101)
                </div>
                <div class="text-start" style="font-size: small;">2. AMP from a Organism (e.g.,
                    Papio anubis)</div>
                <div class="text-start" style="font-size: small;">3. AMP name (e.g., Defensin)
                </div>
                <div class="text-start" style="font-size: small;">4. Gene name of any AMP (e.g.,
                    LBP)</div>
                <div class="text-start" style="font-size: small;">5. AMP Sequence (e.g.,
                    'MKLSTSLLAIVAVA') <br><span style="font-size: smaller; color: #121259; font-weight: 500;"><i>Note:
                            This is not BLAST search</i></span></div>
                <div class="text-start" style="font-size: small;">6. Existence level of a
                    protein (e.g., Inferred from homology)</div>
                <div class="text-start" style="font-size: small;">7. Target-organism (e.g.,
                    E.coli) <br><span style="font-size: smaller; color: #121259; font-weight: 500;"><i>Note:
                            For more specific target-organism search "Search by Target Organism"
                            search facility is recomended.</i></span></div>
                <div class="text-start" style="font-size: small;">8. Antimicrobial activity of
                    an AMP (e.g., Fungicide)</div>
                <div class="text-start" style="font-size: small;">9. Enzymatic activity of an
                    AMP (e.g., Protease)</div>
                <div class="text-start" style="font-size: small;">10. Inhibitory activity of an
                    AMP (e.g., Protease inhibitor)</div>
                <div class="text-start" style="font-size: small;">11. Other biological activity
                    (e.g., Cytokine) <br><span style="font-size: smaller; color: #121259; font-weight: 500;"><i>Note:
                            For perform more specific 8 to 11 related search "Search by
                            Activity" search facility is recomended.</i></span></div>
                <div class="text-start" style="font-size: small;">12. PubMed ID (e.g., 25342741)
                </div>
                <div class="text-start" style="font-size: small;">13. PDB ID (e.g., 2MN5)</div>
                <div class="text-start" style="font-size: small;">14. IntAct ID (e.g., O16829)
                </div>
                <div class="text-start" style="font-size: small;">15. STRING ID (e.g.,
                    9606.ENSP00000249330)</div>
                <div class="text-start" style="font-size: small;">16. MINT ID (e.g., O60814)
                </div>
                <div class="text-start" style="font-size: small;">17. DIP ID (e.g., DIP-26293N)
                </div>
                <div class="text-start" style="font-size: small;">18. BioGRID ID (e.g., 124439)
                </div>
                <div class="text-start" style="font-size: small;">19. BindingDB ID (e.g.,
                    P00697)</div>
                <div class="text-start" style="font-size: small;">20. ChEMBL ID (e.g.,
                    CHEMBL2297)</div>
                <div class="text-start" style="font-size: small;">21. DrugBank ID(e.g., DB06934)
                </div>
                <div class="text-start" style="font-size: small;">22. GeneID (e.g., 1258585)
                </div>
                <div class="text-start" style="font-size: small;">23. KEGG ID (e.g., vg:1258585)
                </div>
                <div class="text-start" style="font-size: small;">24. Ensembl (e.g.,
                    ENSMGAT00000011853)</div>
                <div class="text-start" style="font-size: small;">25. GeneTree ID (e.g.,
                    ENSGT00940000153832)</div>
                <div class="text-start" style="font-size: small;">26. BRENDA ID (e.g., 3.2.1.17)
                </div>
                <div class="text-start" style="font-size: small;">27. BioCyc ID (e.g.,
                    ARA:AT3G12500-MON)</div>
                <div class="text-start" style="font-size: small;">28. RNAct ID (e.g., P20160)
                </div>
                <div class="text-start" style="font-size: small;">29. PANTHER ID (e.g.,
                    PTHR10206)</div>
                <div class="text-start" style="font-size: small;">30. PROSITE ID (e.g., PS00946)
                </div>
                <div class="text-start" style="font-size: small;">31. InterPro ID (e.g.,
                    IPR018216)</div>
                <div class="text-start" style="font-size: small;">32. EMBL ID (e.g., Y09471)
                </div>
                <div class="text-start" style="font-size: small;">33. GenBank ID (e.g.,
                    BC142014)</div>
                <div class="text-start" style="font-size: small;">34. CCDS ID (e.g.,
                    CCDS12044.1)</div>
                <div class="text-start" style="font-size: small;">35. RefSeq ID (e.g.,
                    NP_001691.1)</div>
                <div class="text-start" style="font-size: small;">36. UniProt ID (e.g., P19171)
                    <br><span style="font-size: smaller; color: #121259; font-weight: 500;"><i>Note:
                            For perform more specific 12 to 36 related search "Advanced Search"
                            facility is recomended.</i></span>
                </div>
                <div class="text-start" style="font-size: small;">37. Taxonomy lineage (e.g., Plant)</div>
                <div class="text-start" style="font-size: small; display: none;"> (e.g., )</div>
            </div>
        </div>
    </div>
    <div class="container-fluid border border-4 mt-4 pt-2 pb-2" style="width: 85%;">
        <div class="row">
            <div class="col-sm">
                <div style="text-align: left;"><b style="font-weight: 500; font-size: larger;">3. AMPDB Specific Search
                        Facility</b></div>
                <div style="text-align: justify;">This is a specific search facility (the
                    search can also be restricted by clicking on 'Choose
                    a Dataset' option). This
                    search facility returns those entries which are exactly match with the
                    search term. This search facility is case insensitive.
                    Here one can search with followings.
                </div>
                <div>All the same search terms like the "AMPDB Text Search Facility" can also be search here</div>
            </div>
        </div>
    </div>
    <div class="container-fluid border border-4 mt-4 pt-2 pb-2" style="width: 85%;">
        <div class="row">
            <div class="col-sm">
                <div style="text-align: left;"><b style="font-weight: 500; font-size: larger;">4. Use AMPDB Target
                        Organism
                        Search
                        Facility</b></div>
                <div style="text-align: justify;">This search facility specifically designed
                    to
                    find one or more target organism of a AMP (the
                    search can also be restricted by clicking on 'Choose
                    a Dataset' option).
                    This search facility is case insensitive.
                    Here one can search in the following way.
                </div>
                <div class="text-start mt-3">
                    <span style="font-weight: 500;"> By single target organism name </span>
                    <hr style="margin-top: 0.5%; margin-bottom: 0.3%;">
                    <div style="padding-left: 1%; padding-right: 3%;">
                        Just type the organism name in the search box (e.g., E.coli or
                        e.coli).
                    </div>
                </div>
                <div class="text-start mt-3">
                    <span style="font-weight: 500;"> By Multiple target organism name (comma
                        separated or comma space separated) </span>
                    <hr style="margin-top: 0.5%; margin-bottom: 0.3%;">
                    <div style="padding-left: 1%; text-align: justify; padding-right: 3%;">
                        Type multiple organism name in the search box separated by comma or
                        comma space
                        (e.g., E.coli,S.typhimurium or e.coli, S.typhimurium). One can place
                        as
                        many organism as possible.
                        But this facility will return only those result which contain both
                        target organism.
                    </div>
                </div>
                <div class="mt-3" style="font-size: smaller; text-align: justify; padding-left: 1%; padding-right: 3%;">
                    <i>Note: In some case user may not find the target organism. In that
                        case we
                        suggest to do not
                        write anything on the search box, just click on "Get Organism from
                        Table" option. A table will
                        apprear. The table contain all target organism that we enlisted. You
                        need to find wheather
                        your target organism is enlisted in the table or not. You can search
                        in
                        different way (e.g.,
                        Escherichia coli can also write as it is or Escherichia sp. or
                        Escherichia spp.
                        or Escherichia species or E.coli or Escherichia). If your target
                        organism is enlisted in this table then
                        you nedd to write the same way in the "AMPDB Target Organism Search"
                        facility to find the result.
                        Do not bother about case sensitivity.</i>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid border border-4 mt-4 pt-2 pb-2" style="width: 85%;">
        <div class="row">
            <div class="col-sm">
                <div style="text-align: left;"><b style="font-weight: 500; font-size: larger;">5. Use AMPDB
                        Protein Physicochemical Properties Search Facility</b></div>
                <div style="text-align: justify;">This is protein physicochemical properties search
                    facility (the
                    search can also be restricted by clicking on 'Choose
                    a Dataset' option). Here
                    One can search by build query by just select the options(s) as need. The user need to click on the "Add Field" to make all fields and options visible.
                </div>
                <div class="text-start" style="font-size: small;">
                    In all the search field integer of float value expected.
                    A field may be kept blank to build the query.
                    A sample query is atached below in iamge form.
                </div>
                <div class="container">
                    <div class="row mt-2">
                        <div class="col-sm text-center">
                            <img src="ppquerybuild.png" alt="" srcset="" height="auto" width="98%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid border border-4 mt-4 pt-2 pb-2" style="width: 85%;">
        <div class="row">
            <div class="col-sm">
                <div style="text-align: left;"><b style="font-weight: 500; font-size: larger;">6. Use AMPDB
                        Protein Composition Search Facility</b></div>
                <div style="text-align: justify;">This is Protein Composition search facility (the
                    search can also be restricted by clicking on 'Choose
                    a Dataset' option). Here
                    One can search by build query by just select the options(s) as need.The user need to click on the "Add Field" to make all fields and options visible.
                </div>
                <div class="text-start" style="font-size: small;">
                    In all the search field integer of float value expected.
                    A field may be kept blank to build the query.
                    A sample query is atached below in iamge form.
                </div>
                <div class="container">
                    <div class="row mt-2">
                        <div class="col-sm text-center">
                            <img src="pcquerybuild.png" alt="" srcset="" height="auto" width="98%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid border border-4 mt-4 pt-2 pb-2" style="width: 85%;">
        <div class="row">
            <div class="col-sm">
                <div style="text-align: left;"><b style="font-weight: 500; font-size: larger;">7. Use AMPDB
                        Activity Search Facility</b></div>
                <div style="text-align: justify;">
                    In this section various activities are listed, which are
                    found in a AMP. A user can
                    select single or multiple checkbox(s) as per interest. The
                    search can also be restricted by clicking on 'Choose
                    a Dataset' option.
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid border border-4 mt-4 pt-2 pb-2" style="width: 85%;">
        <div class="row">
            <div class="col-sm">
                <div style="text-align: left;"><b style="font-weight: 500; font-size: larger;">8. Use AMPDB
                        Advanced Search
                        Facility</b></div>
                <div style="text-align: justify;">
                    This is the most advanced search facility of AMPDB, where a user can build the query as he/she wants and search on the database. The search can also be restricted by clicking on 'Choose a Dataset' option. We recommend users to check the demo on advanced search facility of AMPDB on tutorial page.
                    A tutorial demo will add here soon.
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid border border-4 mt-4 pt-2 pb-2" style="width: 85%;">
        <div class="row">
            <div class="col-sm">
                <div style="text-align: left;"><b style="font-weight: 500; font-size: larger;">9. Understand the Text Format of AMPDB</b></div>
                <div>The text format of AMPDB starts with two-character code followed by 4 blank space characters followed by the data. Each line is kept 80 characters long for better readability of the data. The description of the two-character code is given below.</div>
                <div class="table-responsive border border-3 mt-2">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="font-weight: 500;">2 Character Code</th>
                                <th style="font-weight: 500;">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'dbcon.php';
                            $sql = "SELECT * FROM txt_fmt";
                            $result = $con->query($sql);
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?= $row['twoChar']; ?></td>
                                    <td><?= $row['det']; ?></td>
                                </tr>
                            <?php
                            }
                            $con->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>

    <div class="container-fluid fixed-bottom">
        <div class="row">
            <div class="col-sm text-center text-white p-1" style="font-size: small; background-color: #5A6F80;">
                © 2023 B&BL, DoAS, IIIT-A, UP-211015, India
            </div>
        </div>
    </div>

</body>

</html>