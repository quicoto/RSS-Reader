<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home- RSS Reader</title>
  <link rel="stylesheet" href="app/dist/app.css">
</head>
<body class="bg-dark">
    <script>
        window.rss_reader = {
            apiUrl: '<?=$_SERVER['REQUEST_URI']?>'
        }
    </script>
    <main id="app"></main>
    <script src="app/dist/app.js" defer></script>
</body>
</html>
