//@modified: March 24, 2008

var Encoder = new Object;

Encoder.toCharCode = function (field){
	var text = document.getElementById(field + '-text').value;
	if(text.length > 0){
		var charcode = new Array;
		for(i=0;text.length>i;i++){
			charcode += text.charCodeAt(i);
			if(i<(text.length-1)){
				charcode +=  ',';
			}
		}
		document.getElementById(field + '-text').value = charcode;										
	}
	this.SetFocus(field);return false;
}
Encoder.fromCharCode = function (field){
	var text = document.getElementById(field + '-text').value;
	if(text.length > 0){
		charcode = text.split(',');
		output = '';
		for(i=0;charcode.length>i;i++){
			output += String.fromCharCode(charcode[i]);
		}					
		document.getElementById(field + '-text').value = output;	
	}
	this.SetFocus(field);return false;
}
Encoder.toUrlEncode = function (field){
	var text = document.getElementById(field + '-text').value;
	if(text.length > 0){
		output = encodeURIComponent(text);
		document.getElementById(field + '-text').value = output;
	}
	this.SetFocus(field);return false;
}

Encoder.fromUrlEncode = function (field){
	var text = document.getElementById(field + '-text').value;
	if(text.length > 0){
		output = decodeURIComponent(text);
		document.getElementById(field + '-text').value = output;
	}
	this.SetFocus(field);return false;
}
Encoder.toHexEnt = function (field){
    var text = document.getElementById(field + '-text').value;
    var output = ''		            
    for (var i=0; i<text.length; i++) {
        output += '&#x' + text.charCodeAt(i).toString(16) + ';';
    }
    document.getElementById(field + '-text').value = output;
	this.SetFocus(field);return false;
}
Encoder.toDecEnt = function (field){
    var text = document.getElementById(field + '-text').value;
    var output = ''		            
    for (var i=0; i<text.length; i++) {
        output += '&#' + text.charCodeAt(i).toString(10) + ';';
    }
    document.getElementById(field + '-text').value = output;
	this.SetFocus(field);return false;
}
Encoder.toOctEnt = function (field){
    var text = document.getElementById(field + '-text').value;
    var output = ''		            
    for (var i=0; i<text.length; i++) {
        output += '\\' + text.charCodeAt(i).toString(8);
    }
    document.getElementById(field + '-text').value = output;
    this.SetFocus(field);return false;
}

//FIXED : JS Base64 Buggy Issue
Encoder.Send2HV = function (field){
	var text = document.getElementById(field+'-text').value;
	if(text.length > 0){
		var win_hv = window.open("?sendtohackvertor="+escape(document.getElementById(field+'-text').value));
		if (win_hv==null)alert("Please allow Popup!");
	}
	this.SetFocus(field);return false;
}
/***** [BASE64 ROUTINE] *****/
// Credits: RSnake http://ha.ckers.org/xss.html
var base64Chars = new Array(
    'A','B','C','D','E','F','G','H',
    'I','J','K','L','M','N','O','P',
    'Q','R','S','T','U','V','W','X',
    'Y','Z','a','b','c','d','e','f',
    'g','h','i','j','k','l','m','n',
    'o','p','q','r','s','t','u','v',
    'w','x','y','z','0','1','2','3',
    '4','5','6','7','8','9','+','/'
);

var reverseBase64Chars = new Array();
for (var i=0; i < base64Chars.length; i++){
    reverseBase64Chars[base64Chars[i]] = i;
}

var base64Str;
var base64Count;
function setBase64Str(str){
    base64Str = str;
    base64Count = 0;
}
function readBase64(){    
    if (!base64Str) return -1;
    if (base64Count >= base64Str.length) return -1;
    var c = base64Str.charCodeAt(base64Count) & 0xff;
    base64Count++;
    return c;
}

function ntos(n){
    n=n.toString(16);
    if (n.length == 1) n="0"+n;
    n="%"+n;
    return unescape(n);
}

function readReverseBase64(){   
    if (!base64Str) return -1;
    while (true){      
        if (base64Count >= base64Str.length) return -1;
        var nextCharacter = base64Str.charAt(base64Count);
        base64Count++;
        if (reverseBase64Chars[nextCharacter]){
            return reverseBase64Chars[nextCharacter];
        }
        if (nextCharacter == 'A') return 0;
    } 
}

Encoder.toBase64 = function (field){
    var text = document.getElementById(field + '-text').value;

    setBase64Str(text);
    var result = '';
    var inBuffer = new Array(3);
    var lineCount = 0;
    var done = false;
    while (!done && (inBuffer[0] = readBase64()) != -1){
        inBuffer[1] = readBase64();
        inBuffer[2] = readBase64();
        result += (base64Chars[ inBuffer[0] >> 2 ]);
        if (inBuffer[1] != -1){
            result += (base64Chars [(( inBuffer[0] << 4 ) & 0x30) | (inBuffer[1] >> 4) ]);
            if (inBuffer[2] != -1){
                result += (base64Chars [((inBuffer[1] << 2) & 0x3c) | (inBuffer[2] >> 6) ]);
                result += (base64Chars [inBuffer[2] & 0x3F]);
            } else {
                result += (base64Chars [((inBuffer[1] << 2) & 0x3c)]);
                result += ('=');
                done = true;
            }
        } else {
            result += (base64Chars [(( inBuffer[0] << 4 ) & 0x30)]);
            result += ('=');
            result += ('=');
            done = true;
        }
        lineCount += 4;
        if (lineCount >= 76){
            result += ('\n');
            lineCount = 0;
        }
    }
    document.getElementById(field + '-text').value = result;
    this.SetFocus(field);return false;
}

Encoder.fromBase64 = function (field){
    var text = document.getElementById(field + '-text').value;
    setBase64Str(text);
    var result = "";
    var inBuffer = new Array(4);
    var done = false;
    while (!done && (inBuffer[0] = readReverseBase64()) != -1
        && (inBuffer[1] = readReverseBase64()) != -1){
        inBuffer[2] = readReverseBase64();
        inBuffer[3] = readReverseBase64();
        result += ntos((((inBuffer[0] << 2) & 0xff)| inBuffer[1] >> 4));
        if (inBuffer[2] != -1){
            result +=  ntos((((inBuffer[1] << 4) & 0xff)| inBuffer[2] >> 2));
            if (inBuffer[3] != -1){
                result +=  ntos((((inBuffer[2] << 6)  & 0xff) | inBuffer[3]));
            } else {
                done = true;
            }
        } else {
            done = true;
        }
    }
    document.getElementById(field + '-text').value = result;
    this.SetFocus(field);return false;
}

/***** [/BASE64 ROUTINE] *****/

/***** [BASE62 ROUTINE] *****/
// Credits: Dean Edwards http://deanedwards.name/packer
Encoder.toBase62 = function (field){
	var x = confirm("Dean Edwards' base62 packing will cause your payload to fail\nbecause it removes all comments, whitespaces,carriage returns\nthat you might have used to bypass filters.\n\nAnyway, continue?");
	if(x)
	{
		var packer = new Packer;
	    var text = document.getElementById(field + '-text').value;
		var result = packer.pack(text, true, false);
		document.getElementById(field + '-text').value = result;
	}
    this.SetFocus(field);return false;
}
Encoder.fromBase62 = function (field){
    var text = document.getElementById(field + '-text').value;
    eval("var Base62Value=String" + text.slice(4));
	document.getElementById(field + '-text').value = Base62Value;
    this.SetFocus(field);return false;
}

/***** [/BASE62 ROUTINE] *****/
Encoder.toUnicode = function (field){
    var text = document.getElementById(field + '-text').value;
    var output = ''		            
    for (var i=0; i<text.length; i++) {
        output += '%u00' + text.charCodeAt(i).toString(16) ;
    }
    document.getElementById(field + '-text').value = output;
	this.SetFocus(field);return false;
}
Encoder.fromUnicode = function (field){
    var text = document.getElementById(field + '-text').value;
    var array = text.split('%u00');
    var output = '';    
    for (var i=0; i<array.length; i++) {
        var node = array[i].replace('%u00','');        
        if(node != ''){
            output += String.fromCharCode(parseInt(node,16));        
        }
    }
    if(output != ''){
        document.getElementById(field + '-text').value = output;
    }
    this.SetFocus(field);return false;
}

Encoder.fromHexEnt = function (field){
    var text = document.getElementById(field + '-text').value;
    var array = text.split(';');
    var output = '';    
    for (var i=0; i<array.length; i++) {
        var node = array[i].replace('&#x','');        
        if(node != ''){
            output += String.fromCharCode(parseInt(node,16));        
        }
    }
    if(output != ''){
        document.getElementById(field + '-text').value = output;
    }
    this.SetFocus(field);return false;
}
Encoder.fromDecEnt = function (field){
    var text = document.getElementById(field + '-text').value;
    var array = text.split(';');
    var output = '';    
    for (var i=0; i<array.length; i++) {
        var node = array[i].replace('&#','');        
        if(!isNaN(node) && node != ''){
            output += String.fromCharCode(node);        
        }
    }
    if(output != ''){
        document.getElementById(field + '-text').value = output;
    }
    this.SetFocus(field);return false;
}
Encoder.fromOctEnt = function (field){
    var text = document.getElementById(field + '-text').value;
    var array = text.split('\\');
    var output = '';    
    for (var i=0; i<array.length; i++) {
        var node = array[i].replace('\\','');        
        if(!isNaN(node) && node != ''){
            output += String.fromCharCode(parseInt(node,8));        
        }
    }
    if(output != ''){
        document.getElementById(field + '-text').value = output;
    }
    this.SetFocus(field);return false;
}
Encoder.fromVectorSource = function (option, field){
    var exploit = option.options[option.selectedIndex].value;
    document.getElementById(field + '-text').value = exploit;
    this.SetFocus(field);return false;
}

Encoder.fromSQLHex = function(field) {

    var text = document.getElementById(field + '-text').value;
    var array = text.slice(2).split(/(\w{2})/);
    var output = '';    
    for (var i=0; i<array.length; i++) {
        if(array[i] != '') {
            var node = parseInt('0x'+array[i]);        
            if(!isNaN(node) && node != ''){
                output += String.fromCharCode(node);        
            }
        }    
    }
    if(output != ''){
        document.getElementById(field + '-text').value = output;
    }
    this.SetFocus(field);return false;  
}

Encoder.toSQLHex = function(field) {

    var hexchars ="0123456789ABCDEF";
	var text = document.getElementById(field + '-text').value;
	if(text.length > 0){
		var charcode = new Array;
		for(i=0;text.length>i;i++){
            charcode += hexchars.charAt((text.charCodeAt(i)>>4)&0xf)+hexchars.charAt(text.charCodeAt(i)&0xf)
		}
		document.getElementById(field + '-text').value = '0x' + charcode;										
		document.getElementById(field + '-from-charcode').disabled=false;
		document.getElementById(field + '-to-charcode').disabled=true;
	}
	this.SetFocus(field);return false;
}

Encoder.toSQLChar = function (field){
    var text = document.getElementById(field + '-text').value;
    var output = ''		            
    for (var i=0; i<text.length; i++) {
        output += 'Char(' + text.charCodeAt(i).toString(10) + '),';
    }
    document.getElementById(field + '-text').value = output.substr(0,output.length-1);
    this.SetFocus(field);return false;
}

Encoder.fromSQLChar = function (field){
    var text = document.getElementById(field + '-text').value + ',';
    var array = text.split('),');
    var output = '';    
    for (var i=0; i<array.length; i++) {
        var node = array[i].replace('Char(','');        
        if(!isNaN(node) && node != ''){
            output += String.fromCharCode(node);        
        }
    }
    if(output != ''){
        document.getElementById(field + '-text').value = output;
    }
    this.SetFocus(field);return false;
}

Encoder.fromBsToEnt = function(field) {
    var text = document.getElementById(field + '-text').value;
    var output = text.replace(/\\(\w{2,5})/ig, '&#$1;'); 
    document.getElementById(field + '-text').value = output;
    this.SetFocus(field);return false;
}

Encoder.fromEntToBs = function(field) {
    var text = document.getElementById(field + '-text').value;
    var output = text.replace(/&#(\w{2,5});/ig, '\\\$1'); 
    document.getElementById(field + '-text').value = output;
    this.SetFocus(field);return false;
}
Encoder.toUnicode = function (field){
    var text = document.getElementById(field + '-text').value;
    var output = ''		            
    for (var i=0; i<text.length; i++) {
        output += '%u00' + text.charCodeAt(i).toString(16) ;
    }
    document.getElementById(field + '-text').value = output;
	this.SetFocus(field);return false;
}
Encoder.fromPercent2Slash = function(field) {
    var text = document.getElementById(field + '-text').value;
    var output = text.replace(/%/ig, '\\'); 
    document.getElementById(field + '-text').value = output;
    this.SetFocus(field);return false;
}
Encoder.fromLftoCrlf = function(field) {
    var text = document.getElementById(field + '-text').value;
    var output = text.replace(/%0A/ig, '%0D%0A'); 
    document.getElementById(field + '-text').value = output;
    this.SetFocus(field);return false;
}

/****** Misc Funcs *******/
Encoder.Minify = function (field){
	var x = confirm("Minizing or compressing will cause your payload to fail\nbecause it removes all comments, whitespaces,carriage returns\nthat you might have used to bypass filters.\n\nAnyway, continue?");
	if(x)
	{
		var packer = new Packer;
	    var text = document.getElementById(field + '-text').value;
		var result = packer.pack(text, false, false);
		document.getElementById(field + '-text').value = result;	
	}	
    this.SetFocus(field);return false;
}
Encoder.CalcLength = function (field){
	var text = document.getElementById(field + '-text').value;
	alert(text.length);	

    this.SetFocus(field);return false;
}
var last_saved_cookie_name = '';

Encoder.RestoreCookie = function (field){
	var text = document.getElementById(field + '-text').value;
	var cookie_name = prompt("Enter a cookie name to retrieve your customed attack payload.\nIf you forget it, choose 'view all cookies'.",last_saved_cookie_name);
	if (cookie_name==null||cookie_name=='')return;
	if (document.cookie.indexOf(cookie_name)>=0)
	{
	   	var output = this.GetCookie(cookie_name) ;
		document.getElementById(field + '-text').value = unescape(output);
	}

    this.SetFocus(field);return false;
}
Encoder.SaveCookie = function (field){
	var text = document.getElementById(field + '-text').value;
	var cookie_name = prompt("Enter a cookie name to save your customed attack payload.\nIt will overwrite previous cookie if their names are equivalent.");
	var cookie_value = text; 
	if (cookie_name==null||cookie_name=='')return;
	if (text.length>0)
	{
	 	var expdate = new Date();
		expdate.setTime (expdate.getTime() + (24 * 60 * 60 * 1000 * 31));
		last_saved_cookie_name = cookie_name;
		this.SetCookie (cookie_name, cookie_value, expdate);		
	}	

    this.SetFocus(field);return false;
}
Encoder.GetCookieVal = function (offset) {
	var endstr = document.cookie.indexOf (";", offset);
	if (endstr == -1)
	endstr = document.cookie.length;
	return unescape(document.cookie.substring(offset, endstr));
}
Encoder.GetCookie = function(name) {
	var arg = name + "=";
	var alen = arg.length;
	var clen = document.cookie.length;
	var i = 0;
	while (i < clen) {
	var j = i + alen;
	if (document.cookie.substring(i, j) == arg)
	return this.GetCookieVal (j);
	i = document.cookie.indexOf(" ", i) + 1;
	if (i == 0) break; 
	}
	return null;
}  
Encoder.SetCookie=function (name, value) {
	var argv = this.SetCookie.arguments;
	var argc = this.SetCookie.arguments.length;
	var expires = (argc > 2) ? argv[2] : null;
	var path = (argc > 3) ? argv[3] : null;
	var domain = (argc > 4) ? argv[4] : null;
	var secure = (argc > 5) ? argv[5] : false;	
	document.cookie = name + "=" + escape (value) +
	((expires == null) ? "" : ("; expires=" + expires.toGMTString())) +
	((path == null) ? "" : ("; path=" + path)) +
	((domain == null) ? "" : ("; domain=" + domain)) +
	((secure == true) ? "; secure" : "");
}
Encoder.SetFocus = function (field){
   document.getElementById(field + '-text').focus();
}
Encoder.Reverse = function (field){
   var text = document.getElementById(field + '-text').value;
   var output = text.split("").reverse().join("");
   document.getElementById(field + '-text').value = output;
}
Encoder.IncrementChar = function(field)
{
	var text = document.getElementById(field + '-text').value;
	if(text.length > 0){
		var charcode = new Array;
		for(i=0;text.length>i;i++){
			charcode += text.charCodeAt(i)+1;
			if(i<(text.length-1)){
				charcode +=  ',';
			}
		}
		charcode = charcode.split(',');
		output = '';
		for(i=0;charcode.length>i;i++){
			output += String.fromCharCode(charcode[i]);
		}					
		document.getElementById(field + '-text').value = output;	
			
	}
	this.SetFocus(field);return false;	
}
Encoder.DecrementChar = function(field)
{
	var text = document.getElementById(field + '-text').value;
	if(text.length > 0){
		var charcode = new Array;
		for(i=0;text.length>i;i++){
			charcode += text.charCodeAt(i)-1;
			if(i<(text.length-1)){
				charcode +=  ',';
			}
		}
		charcode = charcode.split(',');
		output = '';
		for(i=0;charcode.length>i;i++){
			output += String.fromCharCode(charcode[i]);
		}					
		document.getElementById(field + '-text').value = output;	
			
	}
	this.SetFocus(field);return false;	
}
/****** Repeater *******/
window.onload = function() {
    var repeat_button = document.getElementById('repeat');
    var times = document.getElementById('times');
    String.prototype.repeat = function(l){
        return new Array(l+1).join(this);
    };

    repeat_button.onclick = function() {
        if(times.value && !isNaN(times.value)) {
            var result = document.getElementById('input-text').value.repeat(parseInt(times.value,10));
            document.getElementById('input-text').value = result;
        }
        return false;
    }
}
