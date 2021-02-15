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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript"> 
    // Now, a handler for the form submission is needed so I will use jquery to do that
    $(document).ready(function(){
        $('#form_url').submit(function(e){
            // Store the url value from the form
            var url = $(#url).val();
            // Send the URL to the shorten.php script through POST
            $.post('shorten.php', {link : url}, function(data){
                if (data == 'FALSE') {
                    $("#response").html("There was a problem shortening the URL");
                } else {
                    $("#response").html("Here is the result: <a href=" + data + ">" + data + "</a>");
                }
            }, "text"); 
            //Prevent the form for actuallu submitting
            e.preventDefault();
        });
    });
</script>