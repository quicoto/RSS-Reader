<?php
$version = "1.0.5";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home- RSS Reader</title>
  <link rel="stylesheet" href="app/dist/app.css?ver=<?=$version?>">

    <link rel="apple-touch-icon" sizes="180x180" href="./icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./icons/favicon-16x16.png">
    <link rel="manifest" href="./icons/site.webmanifest">
    <link rel="mask-icon" href="./icons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#343a40">
</head>
<body class="bg-dark">
    <script>
        window.rss_reader = {
            apiUrl: '<?=$_SERVER['REQUEST_URI']?>'
        }
    </script>
    <main id="app"></main>
    <script src="app/dist/app.js?ver=<?=$version?>" defer></script>
</body>
</html>
