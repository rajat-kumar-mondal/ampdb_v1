<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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
                        <a class="nav-link active" href="contact">Contact</a>
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
    <?php
    require 'dbcon.php';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $udresult = curl_exec($ch);
    $udresult = json_decode($udresult);
    @$name = $_POST['name'];
    @$org = $_POST['org'];
    @$usrCountry = $_POST['cntry'];
    @$email = $_POST['email'];
    @$phone = $_POST['phone'];
    @$messege = str_replace("'", "", str_replace( '"', '', $_POST['messege']));;
    @$sub = $_POST['sub'];
    if (strlen($name) != 0 and strlen($org) != 0 and strlen($email) != 0) {
        $sql = "";
        if (@$udresult->status == 'success') {
            $nry = '<a style="cursor: default; text-decoration: none;" class="btn-sm btn-danger rounded-0">NOT RESPONDED</a>';
            $sql .= "INSERT INTO usr_response (`name`, `organisation`, `usr_country`, `email`, `phone`, `messege`, `dt`, `sub`, `country`, `countryCode`, `region`, `regionName`, `city`, `pin`, `timeZone`, `isp`, `ip`, `status`) VALUES ('$name', '$org', '$usrCountry', '$email', '$phone', '$messege', CURRENT_TIMESTAMP, '$sub', '$udresult->country', '$udresult->countryCode', '$udresult->region', '$udresult->regionName', '$udresult->city', '$udresult->zip','$udresult->timezone', '$udresult->isp', '$udresult->query', '$nry')";
        } else {
            $nry = '<a style="cursor: default; text-decoration: none;" class="btn-sm btn-danger rounded-0">NOT RESPONDED</a>';
            $sql .= "INSERT INTO usr_response (`name`, `organisation`, `usr_country`, `email`, `phone`, `messege`, `dt`, `sub`, `country`, `countryCode`, `region`, `regionName`, `city`, `pin`, `timeZone`, `isp`, `ip`, `status`) VALUES ('$name', '$org', '$usrCountry', '$email', '$phone', '$messege', CURRENT_TIMESTAMP, '$sub', '', '', '', '', '', '','', '', 'PROXY', '$nry')";
        }
        if ($con->query($sql)) {
            echo "
        <div class='container' style='margin-top: 16%'>
        <div class='row bg-light p-2 m-2'>
            <div class='col-sm text-center p-2' style='font-family: Poppins, Arial, Helvetica, sans-serif; font-weight: 700; font-size:xx-large'>
                Thank for you for your time & valuable feedback. <br> We may contact you very soon.
                <br><span class='text-success' style='font-size: large'>Team AMPDB</span>
            </div>
            
        </div>
    </div>
        ";
        } else {
            "Failed to Submit: " . $con -> connect_error;
            exit();
        }
        $con->close();
    } else {
        echo "
        <div class='container' style='margin-top: 16%'>
        <div class='row bg-light p-2 m-2'>
            <div class='col-sm text-center p-2' style='font-family: Poppins, Arial, Helvetica, sans-serif; font-weight: 700; font-size:xx-large'>
                INTERNAL SERVER ERROR                
            </div>
            
        </div>
    </div>
        
        ";
    }
    ?>
    <br><br><br>
    <footer class="mt-3 text-center p-2 text-white" style="position: fixed; background-color: #5A6F80; font-size: small; left: 0; bottom: 0; width: 100%;">
        © 2023 B&BL, DoAS, IIIT-A, UP-211015, India
    </footer>

</body>

</html>