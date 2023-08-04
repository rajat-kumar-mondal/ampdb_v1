<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMPDV Home</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="ss.css">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand fs-3" href="javascript:void(0)">AMPDB</a>
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
                            <li><a class="dropdown-item" href="#">Text Search</a></li>
                            <li><a class="dropdown-item" href="#">Specific Text Search</a></li>
                            <li><a class="dropdown-item" href="#">Advanced Search</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">Browse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">Classification</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Tools</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">BLAST</a></li>
                            <li><a class="dropdown-item" href="#">Pairwise Sequence Alignment (Local)</a></li>
                            <li><a class="dropdown-item" href="#">Pairwise Sequence Alignment (Global)</a></li>
                            <li><a class="dropdown-item" href="#">Multiple Sequence Alignment</a></li>
                        </ul>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">Statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">Downloads</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">News/Updates</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">More</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Related Databases and Prediction Tools</a></li>
                        </ul>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">Developers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">Contact</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="text" placeholder="Search">
                    <button class="btn btn-primary" type="button">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <br> <br><br><br>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-lg-19 bg-light rounded my-2 py-2">
                <h4 class="text-center text-success pt-2" style="font-size: 500;">
                    <?php
                    require 'dbcon.php';
                    $sql = "SELECT * FROM `srcorg`";

                    $res = $con->query($sql);
                    $ent = mysqli_num_rows($res);

                    if ($ent == 0) {
                        echo "Sorry no results were found!";
                    }
                    if ($ent > 0) {
                        echo "Currently $ent Source Organisms are enlisted in AMPDB";
                    }
                    ?>
                </h4>
                <hr>
                <div class="table-responsive">
                    <table class="table border border-2 table-striped table-hover">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th style="font-weight: 500;">Sl. no.</th>
                                <th style="font-weight: 500;">Source Organsim</th>
                                <th style="font-weight: 500;">Organsim ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $res->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?= $row['Sl. No.'] ?></td>
                                    <td><?= $row['srcorg'] ?></td>
                                    <td><a style='text-decoration: none;' target="_blank" class='bb' href='https://www.uniprot.org/taxonomy/<?= $row['id'] ?>'><?= $row['id'] ?></a></td>
                                </tr>
                            <?php }
                            $con->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>
    <br><br><br><br>
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
                Visited by
            </div>
        </div>
    </div>
</body>

</html>