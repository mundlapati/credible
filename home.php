<!DOCTYPE html>
<head> 

<link type="text/css" rel="stylesheet" href="t.css" />
<link rel="icon" type="image/ico" href="http://www.nagaiah.com/favicon.ico">

<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">
<meta name="description" content="100 trillion web addresses">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="keywords" content="nagaiah, nagaiah.com, 100 trillion, web addresses, credible, search index, open source">
<meta name="mobile-web-app-capable" content="yes">
		
<title>100 Trillion Credible Web Addresses</title>

<center><b>
<code style="font:24px Calibri, Verdana, Arial;color:#222222">100 </code> 
<code style="font:24px Calibri, Verdana, Arial;color:#545454">Trillion </code>
<code style="font:24px Calibri, Verdana, Arial;color:#222222">Credible </code> 
<code style="font:24px Calibri, Verdana, Arial;color:#545454">Web </code> 
<code style="font:24px Calibri, Verdana, Arial;color:#222222">Addresses </code>
</b></center>
<center><b>
<code style="font:13px Calibri, Verdana, Arial;color:#545454">Last Modified: May 23, 2015 11:35:40 AM UTC</code> 
</b></center>

<center> 
<form accept-charset="UTF-8" method="GET" action="home.php"> 
<p class="inp"> 
<input name="q" type="text" maxlength="255" autofocus required autocapitalize="off" autocorrect="off" placeholder="site:nagaiah.com iphone"> 
</p>
<input type="submit" value="Search"> 
</form> 
</center>

<?php
/**
 * 
 * @filename home.php 
 * @author Jawahar Mundlapati mundlapati@gmail.com
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

#$strr="<ul style=list-style-type:none;margin-top:4px;margin-bottom:3px;padding-left:1px;padding-right:10px;style=font-size:12px;font-family:Calibri, Verdana, Arial;color:#000000;><li><a href=\"".$req."\">".$req."</a> <a href=\"mailto:admin@nagaiah.com?subject=VERIFY&body=I have paid $1 via http://www.nagaiah.com/paypal.php to VERIFY THE AUTHENTICITY of the opening advertised in $req\" target=\"_blank\"><img style=\"border:0;\" src=\"red_favicon.png\" alt=\"Verify\" width=\"5\" height=\"5\"></a></li></ul>";
#$r = "<li>".$reqq."</li></ul>";
#echo $r;
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

        $fd = fopen("OUTPUT.txt.5","r");  fseek($fd,$s);
        $cnt=0; $tags = array();


	while (!feof($fd))
	{
	           $mem = fgets($fd); 
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
                                                if ($cnt <= 10) 
                                                {
                                                        ret_url($tags[1],$tags[2]); 
                                                }
                                                else 
                                                {
                                                        return (round(ftell($fd)));
                                                }
                                        }
                                       
                                        if (findwords(trim($mem),trim($qp)))
                                        {
                                                $cnt++;
                                                if ($cnt <= 10) 
                                                {
                                                        ret_url($tags[1],$tags[2]); 
                                                }
                                                else 
                                                {
                                                        return (round(ftell($fd)));
                                                }
                                        }
                                }
                        }

                        if (($tags[2] != null) && ($k == 0)) 
                        {
                                        if (findwords(trim($tags[2]),trim($qq)))
                                        {
                                                $cnt++;
                                                if ($cnt <= 10) 
                                                {
                                                        ret_url($tags[1],$tags[2]); 
                                                }
                                                else 
                                                {
                                                        return (round(ftell($fd)));
                                                }
                                        }
                        }
	}
	echo "</ol>";
}

error_reporting(E_ALL | E_NOTICE);
ini_set('display_errors', 0);
ini_set('memory_limit','-1');
ini_set('max_execution_time',0);
setlocale(LC_ALL, 'en_US.UTF8');

if(!isset($_GET['q'])) {exit();} else {$q=rawurlencode($_GET['q']);}
if(!isset($_GET['p'])) {$p=1;} else {$p=rawurldecode($_GET['p']);}
if(!isset($_GET['s'])) {$s=1;} else {$s=rawurldecode($_GET['s']);}
if ($p==1) 
{
  $p=$p;
  $wiki_tag = "https://en.wikipedia.org/wiki?search=".$q;
  $fb_tag = "https://facebook.com/search/str/%23".$q."/keywords_top";
  $twit_tag = "https://twitter.com/search?q=%23".$q;
  $str="<ol style=list-style-type:square;margin-top:4px;style=font-size:10px;font-family:Calibri, Verdana, Arial;color:#222222;>";echo $str;
  $wiki_hash="<div align=left><ul style=list-style-type:square;margin-top:4px;margin-bottom:3px;padding-left:1px;padding-right:10px;style=font-size:10px;font-family:Calibri, Verdana, Arial;color:#000000;><li><a href=\"".$wiki_tag."\">".$wiki_tag."</a></li></ul></div>";
  $fb_hash="<div align=left><ul style=list-style-type:square;margin-top:4px;margin-bottom:3px;padding-left:1px;padding-right:10px;style=font-size:10px;font-family:Calibri, Verdana, Arial;color:#000000;><li><a href=\"".$fb_tag."\">".$fb_tag."</a></li></ul></div>";
  $twit_hash="<div align=left><ul style=list-style-type:square;margin-top:4px;margin-bottom:3px;padding-left:1px;padding-right:10px;style=font-size:10px;font-family:Calibri, Verdana, Arial;color:#000000;><li><a href=\"".$twit_tag."\">".$twit_tag."</a></li></ul></div>";
  echo $twit_hash;echo $wiki_hash;echo $fb_hash;
  echo "</ol>";
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
echo "<hr>"; echo "<center>";echo "<br>"; echo "</center>";
?>

<center>
<a href="index.php" target="_top">Credible</a> .
<a href="http://www.gnu.org/copyleft/gpl.html" target="_top">GPL</a> .
<a href="contributors.html" target="_top">Contributors</a> .
<a href="http://www.bbc.co.uk/news/technology-23866614" target="_top">Goal</a>
<div align="center"><a href="mailto:admin@nagaiah.com?Subject=100%20Trillion%20Web%20Addresses" target="_top">Submit Feedback</a><br>
<div align="center">&copy;2015 nagaiah.com. All rights reserved.
<div align="center"><?php echo gmdate("Y-m-d H:i:s A");?> UTC
</center>

</body></html> 
