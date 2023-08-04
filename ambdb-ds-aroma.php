<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMPDB Data Stat by Aromaticity</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        <a class="nav-link active" href="ampdb-data-stat">Statistics</a>
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
    <div class="container mt-3">
        <div class="row" style="padding-left: 0rem;">
            <div class="col-sm text-start" style="font-weight: 400; font-size:xx-large">
                AMPDB Statistics: AMPDB Data Distribution by Aromaticity
            </div>
        </div>
    </div>
    <div class="container mt-2">
        <div class="row p-2 border border-2">
            <div class="col-sm">
                <div id="chartContainer">
                    <canvas id="lenChart"></canvas>
                </div>
                <div class="text-end">
                    <button style="padding: 0.2% 0.5% 0.2% 0.5%; border: 1px solid #0071BC; background-color: #F1F1F1; color: #0071BC; border-radius: 0px;" onclick="rescaleXAxis()">Rescale X Axis</button>
                    <button style="padding: 0.2% 0.5% 0.2% 0.5%; border: 1px solid #0071BC; background-color: #F1F1F1; color: #0071BC; border-radius: 0px;" onclick="rescaleYAxis()">Rescale Y Axis</button>

                </div>
            </div>
            <div style="margin-top: 0.3%; font-size: small;">
                <b style="font-weight: 500;">Note: </b><i>The initial scale is set to 10 of Y axis. Because the difference between lowest number of records and highest
                    number of records is very high. The graph is designed this way for better visualizations.
                    Click on the <b style="font-weight: 500;">"Rescale X Axis"</b> or <b style="font-weight: 500;">"Rescale Y Axis"</b> button to rescale the plot.</i>
            </div>
        </div>
    </div>
    <div class="container ">
        <div class="row justify-content-center border border-2">
            <div class="col-lg-19 bg-light rounded my-2 py-2">
                <div class="row">
                    <div class="col-sm text-center" style="margin-top: 0.8%;">
                        <h5>Data in Table</h5>
                    </div>
                </div>
                <?php
                require 'dbcon.php';
                $sql = "SELECT * FROM `aroma_stat`";
                $res = $con->query($sql);
                ?>
                <hr>
                <div class="table-responsive">
                    <table class="table border border-2 table-striped table-hover">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th style="font-weight: 500;">Sl. no.</th>
                                <th style="font-weight: 500;">Range of Aromaticity</th>
                                <th style="font-weight: 500;">Total entries</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $res->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?= $row['sl'], "." ?></td>
                                    <td><?= $row['reslen'] ?></td>
                                    <td><?= $row['rec'] ?></td>
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
    <script>
        var myChart;

        function getRandomRGB() {
            var r = Math.floor(Math.random() * 256);
            var g = Math.floor(Math.random() * 256);
            var b = Math.floor(Math.random() * 256);
            return `rgba(${ r }, ${ g }, ${ b }, 0.2)`;
        }

        function getRandomBorderColor() {
            var r = Math.floor(Math.random() * 256);
            var g = Math.floor(Math.random() * 256);
            var b = Math.floor(Math.random() * 256);
            return `rgba(${ r }, ${ g }, ${ b }, 1)`;
        }

        function rescaleYAxis() {
            var newMax = Math.floor(Math.random() * 17000) + 1000;
            myChart.options.scales.y.max = newMax;
            myChart.update();
        }

        function rescaleXAxis() {
            var newMax = Math.floor(Math.random() * 32);
            myChart.options.scales.x.max = newMax;
            myChart.update();
        }


        var bgColors = [];
        var borderColors = [];
        for (var i = 0; i < 91; i++) {
            bgColors.push(getRandomRGB());
            borderColors.push(getRandomBorderColor());
        }

        var ctx = document.getElementById('lenChart').getContext('2d');
        myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['0.0 >= to < 0.01', '0.01 >= to < 0.02', '0.02 >= to < 0.03', '0.03 >= to < 0.04', '0.04 >= to < 0.05', '0.05 >= to < 0.06', '0.06 >= to < 0.07', '0.07 >= to < 0.08', '0.08 >= to < 0.09', '0.09 >= to < 0.1', '0.1 >= to < 0.11', '0.11 >= to < 0.12', '0.12 >= to < 0.13', '0.13 >= to < 0.14', '0.14 >= to < 0.15', '0.15 >= to < 0.16', '0.16 >= to < 0.17', '0.17 >= to < 0.18', '0.18 >= to < 0.19', '0.19 >= to < 0.2', '0.2 >= to < 0.21', '0.21 >= to < 0.22', '0.22 >= to < 0.23', '0.23 >= to < 0.24', '0.24 >= to < 0.25', '0.25 >= to < 0.26', '0.26 >= to < 0.27', '0.27 >= to < 0.28', '0.28 >= to < 0.29', '0.29 >= to < 0.3', '0.3 >= to < 0.31', '0.31 >= to < 0.32'],
                datasets: [{
                    label: '# of Record(s)',
                    data: [222, 159, 279, 712, 1671, 3747, 6250, 10983, 11413, 8351, 6564, 4085, 2254, 1088, 637, 331, 165, 73, 35, 24, 36, 8, 7, 12, 2, 5, 0, 4, 1, 0, 4, 0],
                    backgroundColor: bgColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 10,
                        title: {
                            display: true,
                            text: 'Number of Records',
                            font: {
                                size: 14
                            }
                        }
                    },
                    x: {
                        beginAtZero: true,
                        max: 40,
                        title: {
                            display: true,
                            text: 'Aromaticity',
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });
    </script>
    <footer class="mt-3 text-center p-2 text-white" style="position: fixed; background-color: #5A6F80; font-size: small; left: 0; bottom: 0; width: 100%;">
        © 2023 B&BL, DoAS, IIIT-A, UP-211015, India
    </footer>

</body>

</html>