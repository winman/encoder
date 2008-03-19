<?php
/**
 *  index file
 * 
 *  @author mario
 *  @package Encoder
 *  @license http://www.gnu.org/licenses/lgpl.html LGPL
 *  @changelog	
 * 
 *  [2008-03-19 by .mario]
 *      - Added GET interface for the Hackvertor
 * 
 *  [2008-03-14 by d0ubl3_h3lix@yehg.co.nr]
 *      - Major change in I/O encoding list
 *      - I/O encoding list dynamically grapped from native mb_list_encodings array
 *      - PHP Version 5.2.5 supports 64 kinds of to-and-from encoding; Prior PCE supported 53
 *      - Added HackVertor Button
 *      - Added from %0a to %0d%a function	
 * 
 *  [2008-02-15 by d0ubl3_h3lix@yehg.co.nr] 
 * 		- Integrated DeanEdwards' Packer as Base62,Minify in Enc/Dec dropdown 
 *      - Hexcoded your email to hide from spammers :)
 *      - Re-arrange folder structures for well organizations:js,css,php according to your sugguestions
 *      - Fixed CSS 'px' to '%' to be viewed by all lower screen resolutions monitors
 *    
 *  [2008-02-13 by d0ubl3_h3lix@yehg.co.nr] 
 * 		- added PunyCode in I/O encoding dropdown
 *      - added base64 JS  Enc/Dec dropdown;comment base64 in I/O encoding dropdown 'coz it's redundant
 */
            

# include needed files
require 'XML/Feed/Parser.php';
require 'assets/php/_me/Feed.php';
require 'assets/php/_me/Request.php';


# fetch the vectors from the xssDB
$Feed = new Encoder_Feed;
$FeedURL = (eregi($_SERVER["HTTP_HOST"],"localhost"))?'assets/misc/xssdb.rss':'http://xssdb.dabbledb.com/publish/attackdb/dc23ad51-25ef-4fdc-92be-4a7cb606387e/xssdb.rss';
$Feed->setFeedUrl(
		$FeedURL
    );
$options = $Feed->createHTMLOptions(); 

# handle incoming requests
$Request = new Encoder_Request;
$Request->handleRequest();
$Request->response['inputenc'];
$Request->response['inputtext'];
$Request->response['outputenc'];
$Request->response['outputtext'];

$encoding_list =mb_list_encodings();
array_push($encoding_list,'PUNYCODE');
#generate the HTML
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="keywords" content="packer,javascript,compressor,obfuscator" />
		<title>PHP Charset Encoder</title>
		
        <link rel="Stylesheet" type="text/css" href="/encoding/assets/css/style.css" />		
		<script type="text/javascript" src="/encoding/assets/js/deanedwards/my.js"></script>
		<script src="/encoding/assets/js/deanedwards/base2-load.js" type="text/javascript"></script>
		<script src="/encoding/assets/js/deanedwards/Packer.js" type="text/javascript"></script>
		<script src="/encoding/assets/js/deanedwards/Words.js" type="text/javascript"></script>
		<script src="/encoding/assets/js/_me/encode.js" type="text/javascript"></script> 		
	</head>
	<body>
		<div>
			<h1><span class="red">PHP</span><span class="small">Charset Encoder</span></h1>
		</div>
		<div id="info">
			This tool helps you encoding arbitrary texts to and from <span class="underline"> <?=count($encoding_list)?> kinds</span> of charsets. Also some encoding functions featured by 
			JavaScript are provided. The tool accepts rawurlencoded input via the GET parameter <strong>hv</strong>. Feel free to give <a href="mailto:&#109;&#97;&#114;&#105;&#111;&#46;&#104;&#101;&#105;&#100;&#101;&#114;&#105;&#99;&#104;&#64;&#103;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;">feedback</a> if you are missing something or if you found a bug.
		</div>
		<div>
			<form method="post" action="index.php">
				<fieldset>
					<label for="input-encoding">input encoding</label>
					<select name="input-encoding" id="input-encoding">
					<?
					$selected_input = $Request->response['inputenc'];					


					for($i=0;$i<=count($encoding_list)-1;$i++)
					{
						$is_input_selected = '';
						if ($Request->response['inputenc']==$encoding_list[$i])
						{
							$is_input_selected=' selected="selected"';
						}
						echo '<option value="'.$encoding_list[$i].'"'. $is_input_selected.'>'.$encoding_list[$i].'</option>'."\n";
					}					
					
					?>	
					</select>
					<label for="output-encoding">output encoding</label>
					<select name="output-encoding" id="output-encoding">
					<?php
					for($i=0;$i<=count($encoding_list)-1;$i++)
					{
						$is_output_selected = '';
						if ($encoding_list[$i]==$Request->response['outputenc'])
						{
							$is_output_selected=' selected="selected"';
						}						
						echo '<option value="'.$encoding_list[$i].'"'. $is_output_selected.'>'.$encoding_list[$i].'</option>';
					}
					?>
					</select>&nbsp;<span style="position:relative;top:-10px">[<a href="#" title="Find it in Wiki" onclick="window.open('http://en.wikipedia.org/wiki/Special:Search?search='+document.getElementById('output-encoding').options[document.getElementById('output-encoding').selectedIndex].value+ ' Encoding')">charset info</a>]</span>
				</fieldset>
				<fieldset>
					<button type="button" id="input-to-charcode" onclick="Encoder.toCharCode('input');">toCharCode()</button> 
					<button type="button" id="input-to-urlencode" onclick="Encoder.toUrlEncode('input');">encodeURIComponent()</button> 
					<button type="button" id="input-from-charcode" onclick="Encoder.fromCharCode('input');">fromCharCode()</button>
					<button type="button" id="input-from-urlencode" onclick="Encoder.fromUrlEncode('input');">decodeURIComponent()</button> 
                    <select id="encdec" onblur="setTimeout('document.getElementById(\'encdec\').selectedIndex=0',5000)">
                    	<option>--Encoder/Decoder--</option>
                        <optgroup label="Encode">                            
                            <option onclick="Encoder.toDecEnt('input');">to decimal entities</option>
                            <option onclick="Encoder.toHexEnt('input');">to HEX entities</option>
                            <option onclick="Encoder.toSQLHex('input');">to SQL HEX()</option>
			                <option onclick="Encoder.toSQLChar('input');">to SQL Char()</option>
                            <option onclick="Encoder.toOctEnt('input');">to octal JS entities</option>
                            <option onclick="Encoder.toBase64('input');">to Base64</option>
                            <option onclick="Encoder.toBase62('input');">to Base62</option>
                        </optgroup>
		                <optgroup label="Decode">                            
                            <option onclick="Encoder.fromDecEnt('input');">from decimal entities</option>
                            <option onclick="Encoder.fromHexEnt('input');">from HEX entities</option>
                            <option onclick="Encoder.fromSQLHex('input');">from SQL HEX()</option>
			                <option onclick="Encoder.fromSQLChar('input');">from SQL Char()</option>
                            <option onclick="Encoder.fromOctEnt('input');">from octal JS entities</option>
                            <option onclick="Encoder.fromBase64('input');">from Base64</option>
							<option onclick="Encoder.fromBase62('input');">from Base62</option>                  
                        </optgroup>
		                <optgroup label="Convert">
                            <option onclick="Encoder.fromBsToEnt('input');">from \NN to &amp;#NN;</option>
                            <option onclick="Encoder.fromEntToBs('input');">from &amp;#NN; to \NN</option>
				            <option onclick="Encoder.fromLftoCrlf('input');">from %0A to %0D%0A</option>
                        </optgroup>
                       <optgroup label="Misc">
                            <option onclick="Encoder.Minify('input');">Minify</option>
                        </optgroup>
                    </select>                        
                    <select onchange="Encoder.fromVectorSource(this, 'input')">
                        <option value="">-----------------Updated XSS Payloads---------------------</option>
                        <?php echo $options; ?>
                    </select>
                    <br />
					<textarea name="input-text" id="input-text" cols="75" rows="6">
                        <?php echo isset($_GET['hv'])?htmlspecialchars(rawurldecode($_GET['hv']), ENT_QUOTES, 'UTF-8'):'';?>
                        <?php echo htmlspecialchars(stripslashes($Request->response['outputtext'])); ?>
                    </textarea>
				</fieldset>
                <fieldset>
				    <input id="submit" type="submit" value="Convert me!" /> &nbsp;&nbsp;<input id="h4kvertor" type="button" onclick="Encoder.Send2HV('input');" value="Send to HackVertor API" /> &nbsp;&nbsp;<input id="reset" type="reset" value="Clear All" />
                </fieldset>
			</form>
		</div>
        <div id="footer">&copy; <a href="http://mario.heideri.ch/">.mario</a> 2007, 2008 - <a href="http://validator.w3.org/check?uri=http%3A%2F%2Fh4k.in%2Fencoding%2F">XHTML 1.0 Strict</a><br />Special thanks to <a href="http://yehg.org">d0ubl3_h3lix</a> for further improvements<br/>Last updated: 2008/03/19</div>
        <div id="selfpromotion">
            <h3>Other cool stuff:</h3>
            <ul>
                <li><a href="http://h4k.in/encoding">PHP Charset Encoder</a></li>
                <li><a href="http://h4k.in/characters">PHP Unicode Generator</a></li>
                <li><a href="http://phpids.heideri.ch/">PHPIDS Smoketest</a></li>
                <li><a href="http://h4k.in/dataurl">data: URL testcases</a></li>
            </ul>
        </div>
        <script type="text/javascript">document.getElementById('input-text').focus();</script>
	</body>
</html>