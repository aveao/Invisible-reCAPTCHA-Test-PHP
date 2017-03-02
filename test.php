<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Invisible reCAPTCHA Test">
  <meta name="author" content="Ardao">

  <title>Invisible reCAPTCHA Test</title>
  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>

  <!-- Custom styles for this template -->
  <link href="narrow-jumbotron.css" rel="stylesheet">
  <script>
   function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }
 </script>
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
  <div class="container">
    <div class="header clearfix">
      <nav>
        <ul class="nav nav-pills float-xs-right">
          <li class="nav-item">
            <a class="nav-link active" href="test.php">Test <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </nav>
      <h3 class="text-muted">Invisible reCAPTCHA Test</h3>
    </div>

    <?php
    if (isset($_GET["action"]))
    {
      $url = 'https://www.google.com/recaptcha/api/siteverify';
      $data = array('secret' => "your-secretkey-here", 'response' => $_POST["g-recaptcha-response"]);

      $options = array(
        'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query($data)
          )
        );
      $context  = stream_context_create($options);
      $result = file_get_contents($url, false, $context);
      if ($result === FALSE) { 
        echo '<div class="alert alert-warning alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error... I guess?</strong> Recaptcha didn\'t return anything!</div>';
      }
      else
      {
        $decodedresult = json_decode($result, true);

        if($decodedresult['success'] == true)
        {
          echo '<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Recaptcha verification passed!</div>';
        }
        else
        {
          echo '<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Recaptcha verification didn\'t pass!</div>';
        }  
      }
    }
    ?>
    <div>Invisible Captcha is a new type of captcha by Google. <a href=https://www.google.com/recaptcha/intro/comingsoon/invisible.html>See here</a> for more info.</div><br>
    <noscript>Both recaptcha and bootstrap relies on javascript, and you have it disabled. You know what to do :)</noscript>
    <form action="?action=captchasent" id="demo-form" method="post">
      <button class="g-recaptcha" data-sitekey="-Your-own-sitekey-here-" data-callback='onSubmit'>Test</button>
    </form>

    <footer class="footer">
      <p>&copy; aozkal <?php echo date("Y"); ?></p>
      <p>gloriously ripped off from bootstrap</p>
      <p><a href=https://github.com/ardaozkal/Invisible-reCAPTCHA-Test-PHP>Source available on github</a></p>
    </footer>

  </div>
</body>
</html>
