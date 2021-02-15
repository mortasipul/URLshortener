<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <title>URL Shortener</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Shorten an URL</h1>

        <form id="form_url" name="form_url" action="shorten.php" method="post">
            <label for="url">Shorten a URL</label>
            <input type="url" id="url" name="link" value="" size="50" />
            <input type="submit" name="submit" value="Do the magic" />
        </form>
    </div>
</body>
</html>