<?php
	// $url = "assets/css/custom.css";
	// $url = "http://osas.com/assets/css/custom.css";

	// $explode_url = explode("://", $url);

	// var_dump(array_key_exists(1,$explode_url));

 //  if( array_key_exists(1,$explode_url) )
 //      $url = $explode_url[1];
 //  else
 //  	$url = $url;

 //  echo $url;

 //  echo "<br>";
 //  $email = "ivan_amigue@osas.osas";
 //  echo validateEmail($email);
 //  echo "<br>".ping("osas.osas", 80, 10);

 //  $text = '<p>"Disclaimer statement: We are not legally liable for any losses or damages that you may incur due to the expiration of <a href="http://fabricadesoluciones.com" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://fabricadesoluciones.com&amp;source=gmail&amp;ust=1546958358373000&amp;usg=AFQjCNEX3qP71PRtvwjlfMfogFKdtKkrpA">fabricadesoluciones.com</a>. Such losses may include but are not limited to: financial loss, deleted data, downgrade of search rankings, missed customers, undelivered email and any other technical or business damages that you may incur. For more information please refer section 14.a.1.e of our Terms of Service. This is your final renewal notification for <a href="http://fabricadesoluciones.com" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://fabricadesoluciones.com&amp;source=gmail&amp;ust=1546958358373000&amp;usg=AFQjCNEX3qP71PRtvwjlfMfogFKdtKkrpA">fabricadesoluciones.com</a>: <a href="https://domainwebstation.com/?n=fabricadesoluciones.com&amp;r=a" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://domainwebstation.com/?n%3Dfabricadesoluciones.com%26r%3Da&amp;source=gmail&amp;ust=1546958358373000&amp;usg=AFQjCNHXqjnYawCTC4TyoCleZtwDqNZPHQ">https://domainwebstation.com/?<wbr>n=fabricadesoluciones.com&amp;r=a</a> If <a href="http://fabricadesoluciones.com" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://fabricadesoluciones.com&amp;source=gmail&amp;ust=1546958358373000&amp;usg=AFQjCNEX3qP71PRtvwjlfMfogFKdtKkrpA">fabricadesoluciones.com</a> is allowed to expire, the listing will be automatically deleted from our servers within 3 business days. Upon expiration, we reserve the right to offer your website listing to competitors or interested parties in the same business category and location (state/city) after 3 business days on an auction-bidding basis. This is the final renewal notice that we are required to send out in regards to the expiration of <a href="http://fabricadesoluciones.com" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://fabricadesoluciones.com&amp;source=gmail&amp;ust=1546958358373000&amp;usg=AFQjCNEX3qP71PRtvwjlfMfogFKdtKkrpA">fabricadesoluciones.com</a> Secure Online Payment: <a href="https://domainwebstation.com/?n=fabricadesoluciones.com&amp;r=a" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://domainwebstation.com/?n%3Dfabricadesoluciones.com%26r%3Da&amp;source=gmail&amp;ust=1546958358373000&amp;usg=AFQjCNHXqjnYawCTC4TyoCleZtwDqNZPHQ">https://domainwebstation.com/?<wbr>n=fabricadesoluciones.com&amp;r=a</a> All services will be restored automatically on <a href="http://fabricadesoluciones.com" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://fabricadesoluciones.com&amp;source=gmail&amp;ust=1546958358373000&amp;usg=AFQjCNEX3qP71PRtvwjlfMfogFKdtKkrpA">fabricadesoluciones.com</a> if payment is received in full on time before expiration. We thank you for your attention and business."</p>';
 //  echo htmlspecialchars(addslashes(stripslashes(strip_tags(trim($text)))));

  function validateEmail($mail) {
  	return filter_var($mail, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $mail);
  }

  function ping($host, $port, $timeout) {
    $tB = microtime(true);
    $fP = fSockOpen($host, $port, $errno, $errstr, $timeout);
    if (!$fP) { return "down"; }
    $tA = microtime(true);
    return round((($tA - $tB) * 1000), 0)." ms";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pruebas</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src='https://www.google.com/recaptcha/api.js?render=6Ler-IcUAAAAAG8nVTAg_6d_Vz2mG5rM6-wtwckU'></script>
  <style type="text/css">
    .grecaptcha-badge { display: none; visibility: 0; opacity: 0; position: absolute; z-index: -10000; }
  </style>
</head>
<body>
  <form action="./index.php" method="POST">
    <input type="submit" name="submit_btn" value="Enviar">
  </form>

  <?php
    if( isset($_REQUEST) && !empty($_REQUEST) ) {
      $token = $_POST['token'];
      //web site secret key
      $secret = "6Ler-IcUAAAAAHgVw8PfMlwWG-k3VmB364CWUYue";
      $action = $_POST['action'];

      var_dump($token);
      var_dump($secret);

      //get verify response data
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $params = array( "secret"=>$secret, "response"=>$token );
      curl_setopt( $ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify" );
      curl_setopt( $ch, CURLOPT_POST, true );
      curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query($params) );
      $result = curl_exec( $ch );
      $response_data = json_decode( $result );

      var_dump( $response_data->success );
    }
  ?>

  <script>
    $('form').submit(function(event) {
      // we stoped it
      event.preventDefault();
      // needs for recaptacha ready
      grecaptcha.ready(function() {
        // do request for recaptcha token
        // response is promise with passed token
        grecaptcha.execute('6Ler-IcUAAAAAG8nVTAg_6d_Vz2mG5rM6-wtwckU', {action: 'create_comment'}).then(function(token) {
            // add token to form
            $('form').prepend('<input type="hidden" name="token" value="' + token + '">');
            $('form').prepend('<input type="hidden" name="action" value="create_comment">');
            // return false;
            // submit form now
            $('form').unbind('submit').submit();
        });
      });
    });
  </script>
</body>
</html>
