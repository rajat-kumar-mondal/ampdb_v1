<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <title>AMPDB Activity Search Result</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
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
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">Search</a>
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
                        <a class="nav-link " href="browse-all-data">Browse</a>
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
                <h4 class="text-center text-success" style="font-size: 500; margin-top: 2%;"> AMPDB Activity Search Result
                </h4>

                <div style="margin-left:5%; margin-right:5%;"><span id="search-term"></span>, <span id="num-rec"></span></div>
                <div style="margin-left:5%;"><b style="font-weight: 500;">Dataset: </b><?php echo str_replace('`', '', str_replace('.tsv', '', str_replace('master', 'AMPDB v1 Master Dataset',  explode("[", $_GET['ds'])[0]))); ?>, <b style="font-weight: 500;">Dataset Size: </b><?php echo explode("[", $_GET['ds'])[1] ?></div>
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
    <div class="container-fluid">
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
                        <input name="allids" type="text" id="allids" style="display: none;">
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
                <input type="text" name="ds" value="<?php echo $_GET['ds'];  ?>" style="display: none">
                <input style="display: none;" type="text" name="antim" value="<?php echo $_GET['antim'] ?? ''; ?>">
                <input style="display: none;" type="text" name="tarOrg" value="<?php echo $_GET['tarOrg'] ?? ''; ?>">
                <input style="display: none;" type="text" name="query1" value="<?php echo $_GET['query1'] ?? ''; ?>">
                <input style="display: none;" type="text" name="query2" value="<?php echo $_GET['query2'] ?? ''; ?>">
                <input style="display: none;" type="text" name="query3" value="<?php echo $_GET['query3'] ?? ''; ?>">
                <input style="display: none;" type="text" name="o9" value="<?php echo $_GET['o9'] ?? ''; ?>">
                <br>
                <div style="margin-top: 6.5%;" id="records-info"></div>

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

        const urlParams = new URLSearchParams(window.location.search);
        const searchTerm1 = urlParams.get('query1').replace(/undefined LIKE \'\%undefined\%\' /g, "").replace(/undefined /g, "").replace(/LIKE '%%' /g, "").replace(/undefined/g, "");
        const searchTerm2 = urlParams.get('query2').replace(/undefined LIKE \'\%undefined\%\' /g, "").replace(/undefined /g, "").replace(/              /g, "").replace(/       /g, "").replace(/undefined/g, "");
        const searchTerm3 = urlParams.get('query3').replace(/undefined LIKE \'\%undefined\%\' /g, "").replace(/undefined /g, "").replace(/LIKE '%%' /g, "").replace(/undefined/g, "");
        const targetOrganism = getAllParameterValues('tarOrg');
        const antimAct = getAllParameterValues('antim').toString();
        const op9 = getAllParameterValues('o9').toString();
        var classDet = '';
        if (targetOrganism.length > 1) {
            classDet += "Target Organism = '";
            classDet += targetOrganism;
            classDet += "' ";
        }
        if (antimAct.length > 1) {
            classDet += op9;
            classDet += "'";
            classDet += antimAct;
            classDet += "'";
        }
        const myClassDet = classDet;
        var st = searchTerm1 + ' ' + searchTerm3 + ' ' + searchTerm2 + ' ' + myClassDet;
        if (st.length == 3 || st.length == 5 || st.length == 7 || st.length == 13) {
            document.getElementById("search-term").innerHTML = "<b style='font-weight: 500'>Search Activity: *</b>";
        } else {
            document.getElementById("search-term").innerHTML = "<b style='font-weight: 500'>Search Activity: </b>" + st.replace(/\%/g, "").replace(/LIKE/g, "=").replace(/\= \'\' /, "").replace(/\+/g, " ").replace(/\`/g, "");
        }

        const antim = getAllParameterValues('antim');
        const tarorg = getAllParameterValues('tarOrg');
        const q1 = getAllParameterValues('query1');
        const q2 = getAllParameterValues('query2');
        const q3 = getAllParameterValues('query3');
        const o9 = getAllParameterValues('o9');
        const ds = getAllParameterValues('ds');
        const activity = getAllParameterValues('activity');
        const target = getAllParameterValues('target');
        const organism = getAllParameterValues('organism');
        const exist = getAllParameterValues('exist');
        const lengthA = getAllParameterValues('length');
        const sort = getAllParameterValues('sort')
        const ad = getAllParameterValues('ad');

        $.ajax({
            url: "advance-all-ids-browse-all-data.php",
            type: "POST",
            data: {
                antim: antim,
                tarorg: tarorg,
                q2: q2,
                q1: q1,
                q3: q3,
                o9: o9,
                ds: ds,
                activity: activity,
                target: target,
                organism: organism,
                exist: exist,
                length: lengthA,
                sort: sort,
                ad: ad
            },
            success: function(result) {
                document.getElementById("allids").value = result;

            }
        });

        const antim_1 = getAllParameterValues('antim');
        const tarorg_1 = getAllParameterValues('tarOrg');
        const q1_1 = getAllParameterValues('query1');
        const q2_1 = getAllParameterValues('query2');
        const q3_1 = getAllParameterValues('query3');
        const o9_1 = getAllParameterValues('o9');
        const ds1 = getAllParameterValues('ds');
        const activity1 = getAllParameterValues('activity');
        const target1 = getAllParameterValues('target');
        const organism1 = getAllParameterValues('organism');
        const exist1 = getAllParameterValues('exist');
        const length1 = getAllParameterValues('length');
        const sort1 = getAllParameterValues('sort')
        const ad1 = getAllParameterValues('ad');
        $.ajax({
            url: "advance-count-browse-all-data.php",
            type: "POST",
            data: {
                antim: antim_1,
                tarorg: tarorg_1,
                q2: q2_1,
                q1: q1_1,
                q3: q3_1,
                o9: o9_1,
                ds: ds1,
                activity: activity1,
                target: target1,
                organism: organism1,
                exist: exist1,
                length: length1,
                sort: sort1,
                ad: ad1
            },
            success: function(result) {
                if (result.length == 0) {
                    document.getElementById("num-rec").innerHTML = '<b style="font-weight: 500; color: red;">Warning: Query is not properly build. One or more condition/operator/field remain blank OR some undesired character(s) may present in the query. Unable to show result!</b>';
                } else {
                    document.getElementById("num-rec").innerHTML = '<b style="font-weight: 500;">Total Records Found: </b>' + result;
                    var myR = result;
                    $(window).scroll(function() {
                        if (myR > 0) {
                            if ($(window).scrollTop() + $(window).height() > $(document).height() - 220) {
                                if (!isrunning) {
                                    showdata();
                                    myR -= 10;
                                }
                            }
                        }
                    });
                }
            }
        });
        const antim_2 = getAllParameterValues('antim');
        const tarorg_2 = getAllParameterValues('tarOrg');
        const q1_2 = getAllParameterValues('query1');
        const q2_2 = getAllParameterValues('query2');
        const q3_2 = getAllParameterValues('query3');
        const o9_2 = getAllParameterValues('o9');
        const ds2 = getAllParameterValues('ds');
        const activity2 = getAllParameterValues('activity');
        const target2 = getAllParameterValues('target');
        const organism2 = getAllParameterValues('organism');
        const exist2 = getAllParameterValues('exist');
        const length2 = getAllParameterValues('length');
        const sort2 = getAllParameterValues('sort')
        const ad2 = getAllParameterValues('ad');
        $.ajax({
            url: "advance-option-browse-all-data.php",
            type: "POST",
            data: {
                antim: antim_2,
                tarorg: tarorg_2,
                q2: q2_2,
                q1: q1_2,
                q3: q3_2,
                o9: o9_2,
                ds: ds2,
                activity: activity2,
                target: target2,
                organism: organism2,
                exist: exist2,
                length: length2,
                sort: sort2,
                ad: ad2
            },
            success: function(result) {
                document.getElementById("records-info").innerHTML = result;
            }
        });
        const antim_3 = getAllParameterValues('antim');
        const tarorg_3 = getAllParameterValues('tarOrg');
        const q1_3 = getAllParameterValues('query1');
        const q2_3 = getAllParameterValues('query2');
        const q3_3 = getAllParameterValues('query3');
        const o9_3 = getAllParameterValues('o9');
        const ds3 = getAllParameterValues('ds');
        const activity3 = getAllParameterValues('activity');
        const target3 = getAllParameterValues('target');
        const organism3 = getAllParameterValues('organism');
        const exist3 = getAllParameterValues('exist');
        const length3 = getAllParameterValues('length');
        const sort3 = getAllParameterValues('sort');
        const ad3 = getAllParameterValues('ad');
        var page_no = 1;
        var isrunning = false;
        showdata();

        function showdata() {
            isrunning = true;
            $("#loading").show();
            $.post("advance-data-browse-all-data.php", {
                antim: antim_3,
                tarorg: tarorg_3,
                q2: q2_3,
                q1: q1_3,
                q3: q3_3,
                o9: o9_3,
                ds: ds3,
                page: page_no,
                activity: activity3,
                target: target3,
                organism: organism3,
                exist: exist3,
                length: length3,
                sort: sort3,
                ad: ad3
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

            window.location.href = new 'ampdb-activity-search-result?' + urlParams1.toString() + '&' + urlParams2.toString() + '&' + urlParams3.toString() + '&' + urlParams4.toString() + '&' + urlParams5.toString() + '&' + urlParams6.toString() + '&' + urlParams7.toString();
        }
    </script>
    <br><br><br>
    <footer class="mt-3 text-center p-2 text-white" style="position: fixed; background-color: #5A6F80; font-size: small; left: 0; bottom: 0; width: 100%;">
        © 2023 B&BL, DoAS, IIIT-A, UP-211015, India
    </footer>

</body>

</html>