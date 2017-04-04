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
		
<title>Credible sources</title>

<center><b>
<span class="headlogo"><a href="http://mjr.in/" class="headlogo">Credible sources</a></span
</b></center>

<center><b>
<code style="font:13px Calibri, Verdana, Arial;color:#009544"><a href="submit.php">Submit Your Favorite URL</a></code> 
</b></center>

<center> 
<form accept-charset="UTF-8" method="GET" action="home.php"> 
<p class="inp"> 
<input name="q" type="text" maxlength="255" autofocus required autocapitalize="off" autocorrect="off"> 
</p>
<input type="submit" value="Search"> 
</form> 
</center>

<?php
/*
$time_start = microtime(true); 
*/

/**
 * 
 * @filename home.php 
 * @author Jawahar Mundlapati 
 * @contact mundlapati@gmail.com
 * @license GPL v3 
 * 
**/

function get_parse_domain($url)
{
  $pieces = parse_url($url);
  $domain = isset($pieces['host']) ? $pieces['host'] : '';
  if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
    return $regs['domain'];
  }
  return false;
}

function ret_url($req,$reqq) {
mb_internal_encoding("UTF-8"); mb_http_output("UTF-8"); ob_start("mb_output_handler");
$strr="<div align=left><ul style=list-style-type:square;margin-top:4px;margin-bottom:3px;padding-left:1px;padding-right:10px;style=font-size:13px;font-family:Calibri, Verdana, Arial;color:#000000;><li><a href=\"".$req."\">".$req."</a></li></ul></div>";
echo $strr;
}

function utf8_rawurldecode($str) {
    $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",rawurldecode($str));
    return html_entity_decode($str,null,'UTF-8');
}

function findwords($words, $search) 
{
        $l_words = mb_strtolower($words,'UTF-8');
        $l_search = mb_strtolower($search,'UTF-8');

        $ll_words = preg_replace('/[^A-Za-z0-9\-]&@#%+-_~!$/', ' ', $l_words);
        $ll_search = preg_replace('/[^A-Za-z0-9\-]&@#%+-_~!$/', ' ', $l_search);

        $words_array = explode(" ", trim($ll_words));
        $search_array = explode(" ", trim($ll_search));

        if (!array_diff($search_array,$words_array))  return true; else return false;       
}

function get_urls($q,$p,$s) {	
        $q=rawurldecode($q);   
        $qq = array();$site='site:';$qq=$q;$pp=$p;$r = false; $qp = null; $i = -1; $j = -1;$k = -1;
        $str="<ol style=list-style-type:square;margin-top:4px;style=font-size:13px;font-family:Calibri, Verdana, Arial;color:#000000;>";echo $str;

        $i = substr_compare(trim($q),$site,0,5,true); 

        if ($i == 0) 
        {
                $ta=explode(' ',trim($q)); 
                if(count($ta) == 1) 
                {
                        $j = 0;
                }
                $at = array_shift($ta);
                $bodytag = str_ireplace("site:", "http://", $at);
                $q_domain = get_parse_domain($bodytag);
                $ta=explode(' ',trim($q));
                $l=count($ta);
                for($x=1;$x<$l;$x++) 
                {
                        $qp .= $ta[$x]; 
                        $qp .=' ';
                }
        }
        else
        {
                $k = 0;
        }

  //$fd = fopen("d5.txt","r") or die($php_errormsg);  
  $fd = gzopen("d.txt.gz","r") or die($php_errormsg);  
//  if (fseek($fd,$s,SEEK_SET) === -1) die($php_errormsg);
  if (gzseek($fd,$s,SEEK_SET) === -1) die($php_errormsg);
  $cnt=0; $tags = array();

	while (!feof($fd))
	{
//      $mem = fgets($fd) or die($php_errormsg);
      $mem = gzgets($fd) or die($php_errormsg);
      $tags = explode(' ',trim($mem),3);
      $tags[2] = isset($tags[2]) ? $tags[2] : null;

      if (($tags[2] != null) && ($i == 0)) 
      {
              $r_domain = get_parse_domain($tags[1]);

              if (strcasecmp($r_domain, $q_domain) == 0)
              {
                      if ($j ==0)
                      {
                              $cnt++;
                              if ($cnt <= 8) 
                              {
                                      unset($mem);
                                      ret_url($tags[1],$tags[2]); 
                              }
                              else 
                              {
                                      unset($mem);
                                      return (round(gztell($fd)));
//                                      return (round(ftell($fd)));
                              }
                      }
                     
                      if (findwords(trim($mem),trim($qp)))
                      {
                              $cnt++;
                              if ($cnt <= 8) 
                              {
                                      unset($mem);
                                      ret_url($tags[1],$tags[2]); 
                              }
                              else 
                              {
                                      unset($mem);
                                      return (round(gztell($fd)));
//                                      return (round(ftell($fd)));
                              }
                      }
              }
      }

      if (($tags[2] != null) && ($k == 0)) 
      {
          if (findwords(trim($tags[2]),trim($qq)))
          {
                  $cnt++;
                  if ($cnt <= 8) 
                  {
                          unset($mem);
                          ret_url($tags[1],$tags[2]); 
                  }
                  else 
                  {
                          unset($mem);
                          return (round(gztell($fd)));
//                          return (round(ftell($fd)));
                  }
          }
      }
	}
//  fclose($fd) or die($php_errormsg);
  gzclose($fd) or die($php_errormsg);
	echo "</ol>";
  ob_end_flush();
}

// Report all errors
error_reporting(E_ALL);
ini_set('memory_limit','-1');
ini_set('max_execution_time',0);
setlocale(LC_ALL, 'en_US.UTF8');

if(!isset($_GET['q'])) {exit();} else {$q=rawurlencode($_GET['q']);if ($q == "%20") {echo  "Sorry, you entered an invalid query. Please try your search again.\n";exit();}}
if(!isset($_GET['p'])) {$p=1;} else {$p=rawurldecode($_GET['p']);}
if(!isset($_GET['s'])) {$s=1;} else {$s=rawurldecode($_GET['s']);}
if ($p==1) 
{
  $p=$p;
 echo "<!-- filename=home.php -->\n";
 echo "<!-- author=Jawahar Mundlapati -->\n";
 echo "<!-- contact=mundlapati@gmail.com -->\n";
 echo "<!-- license=GPL v3 -->\n";
}
$ret_val = get_urls($q,$p,$s);
if($ret_val > 1){
$ss=$ret_val;
$p=$p+1;
$pp=rawurlencode($p);
$qq=rawurlencode($q);
$ne = "Next (". $qq . ") >>";
$hne = utf8_rawurldecode($ne);
$en="<b><a href=\"home.php?q=$q&p=$pp&s=$ss\"style=\"font-size:14px;;letter-spacing:2px;color:#0000BB;border:0px solid #0000BB;margin:1px 1px 1px 70px;\">".$hne."</a></b>";
print("<p><div align=\"center\">$en</div></p>");
}

print("<center>");
print("<code style=\"font:13px Calibri, Verdana, Arial;color:#545454\">"); 
print("<a href=\"https://www.google.com/#q=$q&safe=off\">Google </a> || <a href=\"https://www.bing.com/search?q=$q\">Bing</a><br>");
echo "<hr>"; echo "<center>";echo "<br>"; echo "</center>";
//print("<a href=\"mailto:admin@nagaiah.com?Subject=Credible sources\">Customer service</a>");
//print("<a href=\"home.php\">Home</a>");
print("</code>");
print("</center>");
/*
$time_end = microtime(true);
$execution_time = ($time_end - $time_start)/60;
echo '<center><b></b></center> '.$execution_time.' Mins';
*/
?>

<center>
<a href="mailto:admin@nagaiah.com">Customer service</a>
</center>
<?php
  $wiki_tag = "https://en.wikipedia.org/wiki?search=".$q;
  $fb_tag = "https://facebook.com/search/str/%23".$q."/keywords_top";
  $twit_tag = "https://twitter.com/search?q=%23".$q;
  $wiki_hash="<a href=\"".$wiki_tag."\"><img src=_Wikipedia.png></a>";
  $twit_hash="<a href=\"".$twit_tag."\"><img src=_twitter.png></a>";
  $fb_hash="<a href=\"".$fb_tag."\"><img src=_facebook.png></a>";
  echo $twit_hash;echo $wiki_hash;echo $fb_hash;
  echo "<br>Updated " . date("Y-m-d") . "<br>";
?>
</body></html> 
