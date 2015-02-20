<!DOCTYPE html>
<head> 
<link type="text/css" rel="stylesheet" href="t.css" />
<link rel="icon" type="image/ico" href="http://www.nagaiah.com/favicon.ico">
		
<title>Rank</title>

<center><b>
<code style="font-size:24px;color:#dd0000">Rank </code> 
</b></center>

<center> <form method="GET" action="rank.php"> <p class="inp"> <input name="q" type="search" title="search" autofocus required> </p>

<input type="submit" title="Rank" value="Rank" accesskey="s"> </form> </center>

<?php
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
$strr="<div align=left><ul style=list-style-type:square;margin-top:4px;margin-bottom:3px;padding-left:1px;padding-right:10px;style=font-size:13px;font-family:georgia,times,serif;color:#000000;><li><a href=\"".$req."\">".$req."</a></li></ul>";
echo $strr;
}

function utf8_rawurldecode($str) {
    $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",rawurldecode($str));
    return html_entity_decode($str,null,'UTF-8');;
}

function findwords($words, $search) 
{
        $l_words = mb_strtolower($words,'UTF-8');
        $l_search = mb_strtolower($search,'UTF-8');

        $words_array = explode(" ", trim($l_words));
        $search_array = explode(" ", trim($l_search));

        if (!array_diff($search_array,$words_array))  return true; else return false;
}

function get_urls($q,$p,$s) {	
        $q=rawurldecode($q);   
        $qq = array();$site='site:';$qq=$q;$pp=$p;$r = false; $qp = null; $i = -1; $j = -1;$k = -1;
        $str="<ol style=list-style-type:none;margin-top:4px;style=font-size:13px;font-family:georgia,times,serif;color:#000000;>";echo $str;

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

        $fd = fopen("job.1.3","r");  fseek($fd,$s);
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

//ini_set('error_reporting', E_ALL);
ini_set('error_reporting', 0);
ini_set('display_errors', 0);
ini_set('memory_limit','-1');
ini_set('max_execution_time',0);

if(!isset($_GET['q'])) {exit();} else {$q=rawurlencode($_GET['q']);}
if(!isset($_GET['p'])) {$p=1;} else {$p=rawurldecode($_GET['p']);}
if(!isset($_GET['s'])) {$s=1;} else {$s=rawurldecode($_GET['s']);}
if ($p==1) {$p=$p;}
$ret_val = get_urls($q,$p,$s);
if($ret_val > 1){
$ss=$ret_val;
$p=$p+1;
$pp=rawurlencode($p);
$qq=rawurlencode($q);
$ne = "Next (". $qq . ") >>";
$hne = utf8_rawurldecode($ne);
$en="<b><a href=\"rank.php?q=$q&p=$pp&s=$ss\"style=\"font-size:13px;;letter-spacing:2px;color:#0000BB;border:0px solid #0000BB;margin:1px 1px 1px 70px;\">".$hne."</a></b>";
print("<p><div align=\"center\">$en</div></p>");
}
echo "<hr>"; echo "<center>";echo "<br>"; echo "</center>";
?>
</body></html> 
<?php session_destroy(); ?>                            

