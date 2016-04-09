<!DOCTYPE html>

<?php
$file = fopen("counts.txt", "r");

if(!$file){
  echo "ei saanud faili avada";
} else {
  $counter = (int)fread($file, 20);
  fclose($file);
  $counter++;

  $handle = fopen("counts.txt", "w");
  fwrite($handle, $counter);
  fclose($handle);
}
if (!empty($_SERVER["HTTP_CLIENT_IP"]))
{
 //check for ip from share internet
 $ip = $_SERVER["HTTP_CLIENT_IP"];
}
elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
{
 // Check for the Proxy User
 $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
else
{
 $ip = $_SERVER["REMOTE_ADDR"];
 // VIGA SIIN $ips = (string)$ip;
}


    $host = "localhost";
    $user = "test";
    $pass = "t3st3r123";
    $db = "test";

    $l = mysqli_connect($host, $user, $pass, $db);
    mysqli_query($l, "SET CHARACTER SET UTF8") or
            die("Error, ei saa andmebaasi charsetti seatud");
            
         $sql="INSERT INTO kkilgi_ssulev(IP_aadress) VALUES ($ips)";
         
         if ($l->query($sql) === TRUE) {
   		 echo "New record created successfully";
		} else {
    		echo "Error: " . $sql . "<br>" . $l->error;
		}
            
    mysqli_close($l);
    //Praktikum 2 Karit Kilgi ja Steve Sulev
?>

<html>
   <head>
      <meta charset="utf-8" />
      <title>Võrgurakenduste 1. praktikum</title>
      <link rel="stylesheet" type="text/css" href="stiil.css">
      <script src="script.js"></script>
   </head>
   <body onload="startTime()">
      <div id="container">
         <p>
         <h1 class="pealkiri">Võrgurakendused I esimene HTML lehekülg</h1>
         <br/>
         <div class="div-keskel">
            <a class="viide" href="https://github.com/skelegon/I244"> Tööd on üleval siin</a> <br />
            <img src="http://www.thedomesticheart.com/wp-content/uploads/2014/06/welcome-sign-1024x791.jpg" width="400" height="300" alt="Welcome"/>
         </div>
         <h1>Pealkiri1</h1>
         kuni
         <h6>Pealkiri6</h6>
         <b>See on Bold text</b>, <u>See on allajoonitud text</u>, <em>See on kaldkiri</em>
         <ul>
            <li>Nimekirja element 1</li>
            <li>Nimekirja element 2</li>
            <li>Nimekirja element 3</li>
         </ul>
         <ol>
            <li>Nummerdatud listi element 1</li>
            <li>Nummerdatud listi element 2</li>
            <li>Nummerdatud listi element 3</li>
         </ol>
         <pre>
				pre element
				kuvatakse kindla laiusega fondis
				ja see säilitab     tühikud ja
				reavahetused
			</pre>
         <div class="div-keskel">
            <a href="http://validator.w3.org/check?uri=referer">
            <img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" />
            </a>
            <br />
            <div class="inlinediv">
            <div id="txt"></div><div><?=", Visitors: " . $counter;?></div>
          </div>
         </div>
      </div>
   </body>
</html>
