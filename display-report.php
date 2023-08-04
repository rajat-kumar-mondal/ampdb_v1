<html>

<head>
    <link rel="short icon" href="logo.png">
</head>
<title>
    VIEW: AMPDB Report
</title>

<body>
    <?php
    $fmt = ".".$_GET['fmt'];
    $file = $_GET['file'];
    if (filesize($file.$fmt) < 3630376) {
        $fp = fopen($file.$fmt, "r") or die("Unable to open file!");
        $tsv_content = @fread($fp, filesize($file.$fmt));
        $content = "<pre>$tsv_content</pre>";
        echo "$content";
        fclose($fp);
    } else {
        echo "UNABLE TO LOAD DATA IN BROWSER! <br>The report may contain large amount of text.<br>This message is shown to avoid the unresponsiveness of the browser. Please go back and download the report to view it.";
    }

    ?>
</body>

</html>