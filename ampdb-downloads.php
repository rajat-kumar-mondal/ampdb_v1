<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Downloads</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="ss.css">
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
                        <a class="nav-link active" href="ampdb-downloads">Downloads</a>
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
    <div class='container' style='margin-top: 1.5%;'>
        <div class='row'>
            <div class='col-sm text-center'>
                <h4>AMPDB Downloads</h4>
            </div>
        </div>
    </div>
    <br>
    <div class='container' style='margin-top: 1.5%; display: none;'>
        <div class='row border border-2' style='background-color: #fff4e6;'>
            <div class='col-sm p-2' style='font-weight: 500;'>
                Download The AMPDB Master Dataset in
                <a href='./downloads/AMPDB_Master_Dataset.xlsx' style='text-decoration: none;' class='bb' download=''>XLSX</a>,
                <a href='./downloads/AMPDB_Master_Dataset.csv' style='text-decoration: none;' class='bb' download=''>CSV</a>,
                <a href='./downloads/AMPDB_Master_Dataset.tsv' style='text-decoration: none;' class='bb' download=''>TSV</a>,
                <a href='./downloads/AMPDB_Master_Dataset.txt' style='text-decoration: none;' class='bb' download=''>TEXT</a>,
                <a href='./downloads/AMPDB_Master_Dataset.fasta' style='text-decoration: none;' class='bb' download=''>FASTA</a>, &
                <a href='./downloads/AMPDB_Master_Dataset.list' style='text-decoration: none;' class='bb' download=''>LIST</a> Format.
            </div>
        </div>
    </div>
    <div class="table-responsive text-center" style="width: 90%; margin-left: auto; margin-right: auto;">
        <table class="table table-striped border border-3 table-hover">
            <thead>
                <tr>
                    <th style="font-weight: 500;">Sl. no.</th>
                    <th style="font-weight: 500;">Dataset</th>
                    <th style="font-weight: 500;">Dataset size</th>
                    <th style="font-weight: 500;">Download format</th>
                    <th style="font-weight: 500;">Download format</th>
                    <th style="font-weight: 500;">Download format</th>
                    <th style="font-weight: 500;">Download format</th>
                    <th style="font-weight: 500;">Download format</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td>AMPDB Master Dataset</td>
                    <td>59122</td>
                    <td><a href='./downloads/AMPDB Master Dataset.tsv' style='text-decoration: none;' class='bb' download=''>TSV</a></td>
                    <td><a href='./downloads/AMPDB Master Dataset.txt' style='text-decoration: none;' class='bb' download=''>TEXT</a></td>
                    <td><a href='./downloads/AMPDB Master Dataset.fasta' style='text-decoration: none;' class='bb' download=''>FASTA</a></td>
                    <td><a href='./downloads/AMPDB Master Dataset.list' style='text-decoration: none;' class='bb' download=''>LIST</a></td>
                    <td><a href='./downloads/AMPDB Master Dataset.json' style='text-decoration: none;' class='bb' download=''>JSON</a></td>
                </tr>
                <?php
                require 'dbcon.php';
                $sql = "SELECT * FROM class_details";
                $result = $con->query($sql);
                $c = 2;
                while ($row = $result->fetch_assoc()) {
                    if ($row['class'] != 'Kinase' and $row['class'] != 'Non-ribosomal protein'  and $row['class'] != 'Non-hemolytic protein') {
                ?>
                        <tr>
                            <td><?php echo $c . ".";
                                $c += 1; ?></td>
                            <td><?= $row['class']; ?> Dataset</td>
                            <td><?= $row['totentry']; ?></td>
                            <td><a style='text-decoration: none;' class='bb' download='' href="./downloads/<?= $row['class']; ?> dataset.tsv">TSV</a></td>
                            <td><a style='text-decoration: none;' class='bb' download='' href="./downloads/<?= $row['class']; ?> dataset.txt">TEXT</a></td>
                            <td><a style='text-decoration: none;' class='bb' download='' href="./downloads/<?= $row['class']; ?> dataset.fasta">FASTA</a></td>
                            <td><a style='text-decoration: none;' class='bb' download='' href="./downloads/<?= $row['class']; ?> dataset.list">LIST</a></td>
                            <td><a style='text-decoration: none;' class='bb' download='' href="./downloads/<?= $row['class']; ?> dataset.json">JSON</a></td>
                        </tr>
                <?php
                    }
                }
                $con->close();
                ?>
            </tbody>
        </table>
    </div>
    <div class="container-fluid" style="width: 90%;">
        <div class="row">
            <div class="col-sm border border-3 p-2">
                <b style="font-weight: 500;">Website Code Availability (Except Tools): <a href="https://github.com/rajat-kumar-mondal/ampdb_v1" style="text-decoration: none;" class="bb">GitHub</a></b>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-2" style="width: 90%;">
        <div class="row">
            <div class="col-sm border border-3 p-2">
                <b style="font-weight: 500;">Code Availability (Tools Only): <a href="https://github.com/Debarup-Sen/repoOneAMPDB" style="text-decoration: none;" class="bb">GitHub</a></b>
            </div>
        </div>
    </div>
    <br><br><br>
    <footer class="mt-3 text-center p-2 text-white" style="position: fixed; background-color: #5A6F80; font-size: small; left: 0; bottom: 0; width: 100%;">
        © 2023 B&BL, DoAS, IIIT-A, UP-211015, India
    </footer>

</body>

</html>