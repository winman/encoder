<?php
/**
 *  index file
 * 
 *  @author mario
 *  @package Encoder
 *  @license http://www.gnu.org/licenses/lgpl.html LGPL
 */
            

# include needed files
require 'XML/Feed/Parser.php';
require 'Feed.php';
require 'Request.php';


# fetch the vectors from the xssDB
$Feed = new Encoder_Feed;
$Feed->setFeedUrl(
    'http://xssdb.dabbledb.com/publish/xssdb/e31f5ab5-eb91-4bc4-b5a2-9e7a994483f1/xssdbtestview01.rss'
    );
$options = $Feed->createHTMLOptions(); 


# handle incoming requests
$Request = new Encoder_Request;
$Request->handleRequest();
$Request->response['inputenc'];
$Request->response['inputtext'];
$Request->response['outputenc'];
$Request->response['outputtext'];


#generate the HTML
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>PHP charset encoder</title>
		<link rel="Stylesheet" type="text/css" href="styles/style.css" />
		<script type="text/javascript" language="javascript" src="scripts/encode.js"></script>
	</head>
	<body>
		<div>
			<h1>PHP charset encoder</h1>
		</div>
		<div>
			This tool helps you encoding arbitrary texts to and from various charsets. Also some encoding functions featured by 
			javascript are provided. Feel free to give <a href="mailto:mario.heiderich@gmail.com">feedback</a> if you are missing something or if you found a bug.
		</div>
		<div>
			<form method="post" action="index.php">
				<fieldset>
					<label for="input-encoding">input encoding</label>
					<select name="input-encoding" id="input-encoding">
						<option value="UCS-4"<?php if($Request->response['inputenc'] == 'UCS-4'){ echo ' selected="selected"'; } ?>>UCS-4</option>
					    <option value="UCS-4BE"<?php if($Request->response['inputenc'] == 'UCS-4BE'){ echo ' selected="selected"'; } ?>>UCS-4BE</option>
					    <option value="UCS-4LE"<?php if($Request->response['inputenc'] == 'UCS-4LE'){ echo ' selected="selected"'; } ?>>UCS-4LE</option>
					    <option value="UCS-2"<?php if($Request->response['inputenc'] == 'UCS-2'){ echo ' selected="selected"'; } ?>>UCS-2</option>
					    <option value="UCS-2BE"<?php if($Request->response['inputenc'] == 'UCS-2BE'){ echo ' selected="selected"'; } ?>>UCS-2BE</option>
					    <option value="UCS-2LE"<?php if($Request->response['inputenc'] == 'UCS-2LE'){ echo ' selected="selected"'; } ?>>UCS-2LE</option>
					    <option value="UTF-32"<?php if($Request->response['inputenc'] == 'UTF-32'){ echo ' selected="selected"'; } ?>>UTF-32</option>
					    <option value="UTF-32BE"<?php if($Request->response['inputenc'] == 'UTF-32BE'){ echo ' selected="selected"'; } ?>>UTF-32BE</option>
					    <option value="UTF-32LE"<?php if($Request->response['inputenc'] == 'UTF-32LE'){ echo ' selected="selected"'; } ?>>UTF-32LE</option>
					    <option value="UTF-16"<?php if($Request->response['inputenc'] == 'UTF-16'){ echo ' selected="selected"'; } ?>>UTF-16</option>
					    <option value="UTF-16BE"<?php if($Request->response['inputenc'] == 'UTF-16BE'){ echo ' selected="selected"'; } ?>>UTF-16BE</option>
					    <option value="UTF-16LE"<?php if($Request->response['inputenc'] == 'UTF-16LE'){ echo ' selected="selected"'; } ?>>UTF-16LE</option>
					    <option value="UTF-7"<?php if($Request->response['inputenc'] == 'UTF-7'){ echo ' selected="selected"'; } ?>>UTF-7</option>
					    <option value="UTF7-IMAP"<?php if($Request->response['inputenc'] == 'UTF7-IMAP'){ echo ' selected="selected"'; } ?>>UTF7-IMAP</option>
					    <option value="UTF-8"<?php if($Request->response['inputenc'] == 'UTF-8'){ echo ' selected="selected"'; } ?>>UTF-8</option>
					    <option value="ASCII"<?php if($Request->response['inputenc'] == 'ASCII'){ echo ' selected="selected"'; } ?>>ASCII</option>
					    <option value="EUC-JP"<?php if($Request->response['inputenc'] == 'EUC-JP'){ echo ' selected="selected"'; } ?>>EUC-JP</option>
					    <option value="SJIS"<?php if($Request->response['inputenc'] == 'SJIS'){ echo ' selected="selected"'; } ?>>SJIS</option>
					    <option value="eucJP-win"<?php if($Request->response['inputenc'] == 'eucJP-win'){ echo ' selected="selected"'; } ?>>eucJP-win</option>
					    <option value="SJIS-win"<?php if($Request->response['inputenc'] == 'SJIS-win'){ echo ' selected="selected"'; } ?>>SJIS-win</option>
					    <option value="ISO-2022-JP"<?php if($Request->response['inputenc'] == 'ISO-2022-JP'){ echo ' selected="selected"'; } ?>>ISO-2022-JP</option>
					    <option value="JIS"<?php if($Request->response['inputenc'] == 'JIS'){ echo ' selected="selected"'; } ?>>JIS</option>
					    <option value="ISO-8859-1"<?php if($Request->response['inputenc'] == 'ISO-8859-1'){ echo ' selected="selected"'; } ?>>ISO-8859-1</option>
					    <option value="ISO-8859-2"<?php if($Request->response['inputenc'] == 'ISO-8859-2'){ echo ' selected="selected"'; } ?>>ISO-8859-2</option>
					    <option value="ISO-8859-3"<?php if($Request->response['inputenc'] == 'ISO-8859-3'){ echo ' selected="selected"'; } ?>>ISO-8859-3</option>
					    <option value="ISO-8859-4"<?php if($Request->response['inputenc'] == 'ISO-8859-4'){ echo ' selected="selected"'; } ?>>ISO-8859-4</option>
					    <option value="ISO-8859-5"<?php if($Request->response['inputenc'] == 'ISO-8859-5'){ echo ' selected="selected"'; } ?>>ISO-8859-5</option>
					    <option value="ISO-8859-6"<?php if($Request->response['inputenc'] == 'ISO-8859-6'){ echo ' selected="selected"'; } ?>>ISO-8859-6</option>
					    <option value="ISO-8859-7"<?php if($Request->response['inputenc'] == 'ISO-8859-7'){ echo ' selected="selected"'; } ?>>ISO-8859-7</option>
					    <option value="ISO-8859-8"<?php if($Request->response['inputenc'] == 'ISO-8859-8'){ echo ' selected="selected"'; } ?>>ISO-8859-8</option>
					    <option value="ISO-8859-9"<?php if($Request->response['inputenc'] == 'ISO-8859-9'){ echo ' selected="selected"'; } ?>>ISO-8859-9</option>
					    <option value="ISO-8859-10"<?php if($Request->response['inputenc'] == 'ISO-8859-10'){ echo ' selected="selected"'; } ?>>ISO-8859-10</option>
					    <option value="ISO-8859-13"<?php if($Request->response['inputenc'] == 'ISO-8859-13'){ echo ' selected="selected"'; } ?>>ISO-8859-13</option>
					    <option value="ISO-8859-14"<?php if($Request->response['inputenc'] == 'ISO-8859-14'){ echo ' selected="selected"'; } ?>>ISO-8859-14</option>
					    <option value="ISO-8859-15"<?php if($Request->response['inputenc'] == 'ISO-8859-15'){ echo ' selected="selected"'; } ?>>ISO-8859-15</option>
					    <option value="byte2be"<?php if($Request->response['inputenc'] == 'byte2be'){ echo ' selected="selected"'; } ?>>byte2be</option>
					    <option value="byte2le"<?php if($Request->response['inputenc'] == 'byte2le'){ echo ' selected="selected"'; } ?>>byte2le</option>
					    <option value="byte4be"<?php if($Request->response['inputenc'] == 'byte4be'){ echo ' selected="selected"'; } ?>>byte4be</option>
					    <option value="byte4le"<?php if($Request->response['inputenc'] == 'byte4le'){ echo ' selected="selected"'; } ?>>byte4le</option>
					    <option value="BASE64"<?php if($Request->response['inputenc'] == 'BASE64'){ echo ' selected="selected"'; } ?>>BASE64</option>
					    <option value="HTML-ENTITIES"<?php if($Request->response['inputenc'] == 'HTML-ENTITIES'){ echo ' selected="selected"'; } ?>>HTML-ENTITIES</option>
					    <option value="7bit"<?php if($Request->response['inputenc'] == '7bit'){ echo ' selected="selected"'; } ?>>7bit</option>
					    <option value="8bit"<?php if($Request->response['inputenc'] == '8bit'){ echo ' selected="selected"'; } ?>>8bit</option>
					    <option value="EUC-CN"<?php if($Request->response['inputenc'] == 'EUC-CN'){ echo ' selected="selected"'; } ?>>EUC-CN</option>
					    <option value="CP936"<?php if($Request->response['inputenc'] == 'CP936'){ echo ' selected="selected"'; } ?>>CP936</option>
					    <option value="HZ"<?php if($Request->response['inputenc'] == 'HZ'){ echo ' selected="selected"'; } ?>>HZ</option>
					    <option value="EUC-TW"<?php if($Request->response['inputenc'] == 'EUC-TW'){ echo ' selected="selected"'; } ?>>EUC-TW</option>
					    <option value="CP950"<?php if($Request->response['inputenc'] == 'CP950'){ echo ' selected="selected"'; } ?>>CP950</option>
					    <option value="BIG-5"<?php if($Request->response['inputenc'] == 'BIG-5'){ echo ' selected="selected"'; } ?>>BIG-5</option>
					    <option value="EUC-KR"<?php if($Request->response['inputenc'] == 'EUC-KR'){ echo ' selected="selected"'; } ?>>EUC-KR</option>
					    <option value="UHC (CP949)"<?php if($Request->response['inputenc'] == 'UHC (CP949)'){ echo ' selected="selected"'; } ?>>UHC (CP949)</option>
					    <option value="ISO-2022-KR"<?php if($Request->response['inputenc'] == 'ISO-2022-KR'){ echo ' selected="selected"'; } ?>>ISO-2022-KR</option>
					    <option value="Windows-1251 (CP1251)"<?php if($Request->response['inputenc'] == 'Windows-1251 (CP1251)'){ echo ' selected="selected"'; } ?>>Windows-1251 (CP1251)</option>
					    <option value="Windows-1252 (CP1252)"<?php if($Request->response['inputenc'] == 'Windows-1252 (CP1252)'){ echo ' selected="selected"'; } ?>>Windows-1252 (CP1252)</option>
					    <option value="CP866 (IBM866)"<?php if($Request->response['inputenc'] == 'CP866 (IBM866)'){ echo ' selected="selected"'; } ?>>CP866 (IBM866)</option>
					    <option value="KOI8-R"<?php if($Request->response['inputenc'] == 'KOI8-R'){ echo ' selected="selected"'; } ?>>KOI8-R</option>
					</select>
					<label for="output-encoding">output encoding</label>
					<select name="output-encoding" id="output-encoding">
						<option value="UCS-4"<?php if($Request->response['outputenc'] == 'UCS-4'){ echo ' selected="selected"'; } ?>>UCS-4</option>
					    <option value="UCS-4BE"<?php if($Request->response['outputenc'] == 'UCS-4BE'){ echo ' selected="selected"'; } ?>>UCS-4BE</option>
					    <option value="UCS-4LE"<?php if($Request->response['outputenc'] == 'UCS-4LE'){ echo ' selected="selected"'; } ?>>UCS-4LE</option>
					    <option value="UCS-2"<?php if($Request->response['outputenc'] == 'UCS-2'){ echo ' selected="selected"'; } ?>>UCS-2</option>
					    <option value="UCS-2BE"<?php if($Request->response['outputenc'] == 'UCS-2BE'){ echo ' selected="selected"'; } ?>>UCS-2BE</option>
					    <option value="UCS-2LE"<?php if($Request->response['outputenc'] == 'UCS-2LE'){ echo ' selected="selected"'; } ?>>UCS-2LE</option>
					    <option value="UTF-32"<?php if($Request->response['outputenc'] == 'UTF-32'){ echo ' selected="selected"'; } ?>>UTF-32</option>
					    <option value="UTF-32BE"<?php if($Request->response['outputenc'] == 'UTF-32BE'){ echo ' selected="selected"'; } ?>>UTF-32BE</option>
					    <option value="UTF-32LE"<?php if($Request->response['outputenc'] == 'UTF-32LE'){ echo ' selected="selected"'; } ?>>UTF-32LE</option>
					    <option value="UTF-16"<?php if($Request->response['outputenc'] == 'UTF-16'){ echo ' selected="selected"'; } ?>>UTF-16</option>
					    <option value="UTF-16BE"<?php if($Request->response['outputenc'] == 'UTF-16BE'){ echo ' selected="selected"'; } ?>>UTF-16BE</option>
					    <option value="UTF-16LE"<?php if($Request->response['outputenc'] == 'UTF-16LE'){ echo ' selected="selected"'; } ?>>UTF-16LE</option>
					    <option value="UTF-7"<?php if($Request->response['outputenc'] == 'UTF-7'){ echo ' selected="selected"'; } ?>>UTF-7</option>
					    <option value="UTF7-IMAP"<?php if($Request->response['outputenc'] == 'UTF7-IMAP'){ echo ' selected="selected"'; } ?>>UTF7-IMAP</option>
					    <option value="UTF-8"<?php if($Request->response['outputenc'] == 'UTF-8'){ echo ' selected="selected"'; } ?>>UTF-8</option>
					    <option value="ASCII"<?php if($Request->response['outputenc'] == 'ASCII'){ echo ' selected="selected"'; } ?>>ASCII</option>
					    <option value="EUC-JP"<?php if($Request->response['outputenc'] == 'EUC-JP'){ echo ' selected="selected"'; } ?>>EUC-JP</option>
					    <option value="SJIS"<?php if($Request->response['outputenc'] == 'SJIS'){ echo ' selected="selected"'; } ?>>SJIS</option>
					    <option value="eucJP-win"<?php if($Request->response['outputenc'] == 'eucJP-win'){ echo ' selected="selected"'; } ?>>eucJP-win</option>
					    <option value="SJIS-win"<?php if($Request->response['outputenc'] == 'SJIS-win'){ echo ' selected="selected"'; } ?>>SJIS-win</option>
					    <option value="ISO-2022-JP"<?php if($Request->response['outputenc'] == 'ISO-2022-JP'){ echo ' selected="selected"'; } ?>>ISO-2022-JP</option>
					    <option value="JIS"<?php if($Request->response['outputenc'] == 'JIS'){ echo ' selected="selected"'; } ?>>JIS</option>
					    <option value="ISO-8859-1"<?php if($Request->response['outputenc'] == 'ISO-8859-1'){ echo ' selected="selected"'; } ?>>ISO-8859-1</option>
					    <option value="ISO-8859-2"<?php if($Request->response['outputenc'] == 'ISO-8859-2'){ echo ' selected="selected"'; } ?>>ISO-8859-2</option>
					    <option value="ISO-8859-3"<?php if($Request->response['outputenc'] == 'ISO-8859-3'){ echo ' selected="selected"'; } ?>>ISO-8859-3</option>
					    <option value="ISO-8859-4"<?php if($Request->response['outputenc'] == 'ISO-8859-4'){ echo ' selected="selected"'; } ?>>ISO-8859-4</option>
					    <option value="ISO-8859-5"<?php if($Request->response['outputenc'] == 'ISO-8859-5'){ echo ' selected="selected"'; } ?>>ISO-8859-5</option>
					    <option value="ISO-8859-6"<?php if($Request->response['outputenc'] == 'ISO-8859-6'){ echo ' selected="selected"'; } ?>>ISO-8859-6</option>
					    <option value="ISO-8859-7"<?php if($Request->response['outputenc'] == 'ISO-8859-7'){ echo ' selected="selected"'; } ?>>ISO-8859-7</option>
					    <option value="ISO-8859-8"<?php if($Request->response['outputenc'] == 'ISO-8859-8'){ echo ' selected="selected"'; } ?>>ISO-8859-8</option>
					    <option value="ISO-8859-9"<?php if($Request->response['outputenc'] == 'ISO-8859-9'){ echo ' selected="selected"'; } ?>>ISO-8859-9</option>
					    <option value="ISO-8859-10"<?php if($Request->response['outputenc'] == 'ISO-8859-10'){ echo ' selected="selected"'; } ?>>ISO-8859-10</option>
					    <option value="ISO-8859-13"<?php if($Request->response['outputenc'] == 'ISO-8859-13'){ echo ' selected="selected"'; } ?>>ISO-8859-13</option>
					    <option value="ISO-8859-14"<?php if($Request->response['outputenc'] == 'ISO-8859-14'){ echo ' selected="selected"'; } ?>>ISO-8859-14</option>
					    <option value="ISO-8859-15"<?php if($Request->response['outputenc'] == 'ISO-8859-15'){ echo ' selected="selected"'; } ?>>ISO-8859-15</option>
					    <option value="byte2be"<?php if($Request->response['outputenc'] == 'byte2be'){ echo ' selected="selected"'; } ?>>byte2be</option>
					    <option value="byte2le"<?php if($Request->response['outputenc'] == 'byte2le'){ echo ' selected="selected"'; } ?>>byte2le</option>
					    <option value="byte4be"<?php if($Request->response['outputenc'] == 'byte4be'){ echo ' selected="selected"'; } ?>>byte4be</option>
					    <option value="byte4le"<?php if($Request->response['outputenc'] == 'byte4le'){ echo ' selected="selected"'; } ?>>byte4le</option>
					    <option value="BASE64"<?php if($Request->response['outputenc'] == 'BASE64'){ echo ' selected="selected"'; } ?>>BASE64</option>
					    <option value="HTML-ENTITIES"<?php if($Request->response['outputenc'] == 'HTML-ENTITIES'){ echo ' selected="selected"'; } ?>>HTML-ENTITIES</option>
					    <option value="7bit"<?php if($Request->response['outputenc'] == '7bit'){ echo ' selected="selected"'; } ?>>7bit</option>
					    <option value="8bit"<?php if($Request->response['outputenc'] == '8bit'){ echo ' selected="selected"'; } ?>>8bit</option>
					    <option value="EUC-CN"<?php if($Request->response['outputenc'] == 'EUC-CN'){ echo ' selected="selected"'; } ?>>EUC-CN</option>
					    <option value="CP936"<?php if($Request->response['outputenc'] == 'CP936'){ echo ' selected="selected"'; } ?>>CP936</option>
						<option value="HZ"<?php if($Request->response['outputenc'] == 'HZ'){ echo ' selected="selected"'; } ?>>HZ</option>
					    <option value="EUC-TW"<?php if($Request->response['outputenc'] == 'EUC-TW'){ echo ' selected="selected"'; } ?>>EUC-TW</option>
					    <option value="CP950"<?php if($Request->response['outputenc'] == 'CP950'){ echo ' selected="selected"'; } ?>>CP950</option>
					    <option value="BIG-5"<?php if($Request->response['outputenc'] == 'BIG-5'){ echo ' selected="selected"'; } ?>>BIG-5</option>
					    <option value="EUC-KR"<?php if($Request->response['outputenc'] == 'EUC-KR'){ echo ' selected="selected"'; } ?>>EUC-KR</option>
					    <option value="UHC (CP949)"<?php if($Request->response['outputenc'] == 'UHC (CP949)'){ echo ' selected="selected"'; } ?>>UHC (CP949)</option>
					    <option value="ISO-2022-KR"<?php if($Request->response['outputenc'] == 'ISO-2022-KR'){ echo ' selected="selected"'; } ?>>ISO-2022-KR</option>
					    <option value="Windows-1251 (CP1251)"<?php if($Request->response['outputenc'] == 'Windows-1251 (CP1251)'){ echo ' selected="selected"'; } ?>>Windows-1251 (CP1251)</option>
					    <option value="Windows-1252 (CP1252)"<?php if($Request->response['outputenc'] == 'Windows-1252 (CP1252)'){ echo ' selected="selected"'; } ?>>Windows-1252 (CP1252)</option>
					    <option value="CP866 (IBM866)"<?php if($Request->response['outputenc'] == 'CP866 (IBM866)'){ echo ' selected="selected"'; } ?>>CP866 (IBM866)</option>
					    <option value="KOI8-R"<?php if($Request->response['outputenc'] == 'KOI8-R'){ echo ' selected="selected"'; } ?>>KOI8-R</option>
					</select>
				</fieldset>
				<fieldset>
					<div>
						<label for="input-text"><strong>input</strong></label> 
						<button type="button" id="input-to-charcode" onclick="Encoder.toCharCode('input');">toCharCode()</button> 
						<button type="button" id="input-to-urlencode" onclick="Encoder.toUrlEncode('input');">encodeURIComponent()</button> 
						<button type="button" id="input-from-charcode" onclick="Encoder.fromCharCode('input');" disabled="disabled">fromCharCode()</button>
						<button type="button" id="input-from-urlencode" onclick="Encoder.fromUrlEncode('input');" disabled="disabled">decodeURIComponent()</button> 
                        <nowrap> 
                            <label>entities:</label>                        
                            <button type="button" id="input-to-dec-ent" onclick="Encoder.toDecEnt('input');">to DEC</button>
                            <button type="button" id="input-to-hex-ent" onclick="Encoder.toHexEnt('input');">to HEX</button>
                            <button type="button" id="input-to-dec-ent" onclick="Encoder.fromDecEnt('input');">from DEC</button>
                            <button type="button" id="input-to-hex-ent" onclick="Encoder.fromHexEnt('input');">from HEX</button>  						
                        </nowrap>
                        <nowrap> 
                            <label>vectors:</label>
                            <select onchange="Encoder.fromVectorSource(this, 'input')"><?php echo $options; ?></select>
                        </nowrap>
                        <br />
						<textarea name="input-text" id="input-text" cols="75" rows="6"><?php echo htmlspecialchars(stripslashes($Request->response['inputtext'])); ?></textarea>
					</div>
					<div>
						<label for="output-text"><strong>output</strong></label>
						<button type="button" id="output-to-charcode" onclick="Encoder.toCharCode('output');">toCharCode()</button> 
						<button type="button" id="output-to-urlencode" onclick="Encoder.toUrlEncode('output');">encodeURIComponent()</button> 
						<button type="button" id="output-from-charcode" onclick="Encoder.fromCharCode('output');">fromCharCode()</button>
						<button type="button" id="output-from-urlencode" onclick="Encoder.fromUrlEncode('output');">decodeURIComponent()</button>                          
                        <nowrap> 
                            <label>entities:</label>                     
                            <button type="button" id="input-to-dec-ent" onclick="Encoder.toDecEnt('output');">to DEC</button>
                            <button type="button" id="input-to-hex-ent" onclick="Encoder.toHexEnt('output');">to HEX</button>
                            <button type="button" id="input-to-dec-ent" onclick="Encoder.fromDecEnt('output');">from DEC</button>
                            <button type="button" id="input-to-hex-ent" onclick="Encoder.fromHexEnt('output');">from HEX</button> 						
                        </nowrap>
                        <nowrap> 
                            <label>vectors:</label>
                            <select onchange="Encoder.fromVectorSource(this, 'output')"><?php echo $options; ?></select>
						</nowrap>
                        <br />
						<textarea name="output-text" id="output-text" cols="75" rows="6"><?php echo htmlspecialchars(stripslashes($Request->response['outputtext'])); ?></textarea>
					</div>
				</fieldset>
				<input type="submit" />
			</form>
		</div>
        <div id="footer">&copy; <a href="http://mario.heideri.ch/" target="_blank">.mario</a> 2007</div>
	</body>
</html>