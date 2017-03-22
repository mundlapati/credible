<!DOCTYPE html>
<head> 

<link type="text/css" rel="stylesheet" href="t.css" />
<link rel="icon" type="image/ico" href="http://www.nagaiah.com/favicon.ico">

<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">
<meta name="description" content="Credible sources">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="keywords" content="mjr, mjr.in, nagaiah, nagaiah.com, credible sources, people, products, services, search index, open source">
<meta name="mobile-web-app-capable" content="yes">
		
<title>Submit Your Favorite URL</title>

<center><b>
<code style="font:28px Calibri, Verdana, Arial;color:#222222">Submit Your Favorite URL</code> 
</b></center>

    <script type="text/javascript">
    var a = Math.ceil(Math.random() * 10);
    var b = Math.ceil(Math.random() * 10);       
    var c = a + b;
    function DrawBotBoot()
    {
        document.write(""+ a + " + " + b +" = ");
        document.write("<input id='BotBootInput' type='text' maxlength='2' size='2'/>");
    }    
    function ValidBotBoot()
	{
        var d = document.getElementById('BotBootInput').value;
        if (d == c)
		{
			document.getElementById('myid').style.display= "block";
		}
		else
		{
			document.getElementById('myid').style.display= "none";
		}
    }
    </script>

<center> 
<form accept-charset="UTF-8" method="GET" action="submit.php"> 
<p class="inp"> 
<input name="q" type="text" maxlength="255" autofocus required autocapitalize="off" autocorrect="off" placeholder="https://news.ycombinator.com"> 
</p>
<div id="myid" style="display: none;">
<input type="submit" value="Submit">
</div>
</form> 
</center>

<body>
<script type="text/javascript">DrawBotBoot()</script>
<input id="Button1" type="button" value="Verify" onclick="ValidBotBoot()"/>

<?php
/**
 * 
 * @filename submit.php 
 * @author Jawahar Mundlapati 
 * @contact mundlapati@gmail.com
 * @license GPL v3 
 * 
**/

// Report all errors
error_reporting(E_ALL);
ini_set('memory_limit','-1');
ini_set('max_execution_time',0);
setlocale(LC_ALL, 'en_US.UTF8');

function utf8_rawurldecode($str) 
{
    $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",rawurldecode($str));
    return html_entity_decode($str,null,'UTF-8');
}

if(!isset($_GET['q'])) {exit();} else {$q=rawurlencode($_GET['q']);if ($q == "%20") {echo  "Sorry, you entered an invalid URL. Please try again.\n";exit();}}
$fd = fopen("INPUT.TXT", "a") or die($php_errormsg);
$qq = utf8_rawurldecode($q);
fwrite($fd, $qq);
fwrite($fd, "\n");
fclose($fd) or die($php_errormsg);

print("<br>");
print("<br>");
print("<center>");
print("<code style=\"font:13px Calibri, Verdana, Arial;color:#545454\">");
echo "<center>"; echo "We will shortly include ".$qq; echo " in our search results"; echo "</center>";
echo "<hr>"; echo "<center>";echo "<br>"; echo "</center>";
print("<a href=\"home.php\">Home</a>");
print("</code>");
print("</center>");
?>

</body></html> 
