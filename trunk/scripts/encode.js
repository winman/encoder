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
	return false;
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
	return false;
}
Encoder.toUrlEncode = function (field){
	var text = document.getElementById(field + '-text').value;
	if(text.length > 0){
		output = encodeURIComponent(text);
		document.getElementById(field + '-text').value = output;
	}
	return false;
}
Encoder.fromUrlEncode = function (field){
	var text = document.getElementById(field + '-text').value;
	if(text.length > 0){
		output = decodeURIComponent(text);
		document.getElementById(field + '-text').value = output;
	}
	return false;
}
Encoder.toHexEnt = function (field){
    var text = document.getElementById(field + '-text').value;
    var output = ''		            
    for (var i=0; i<text.length; i++) {
        output += '&#x' + text.charCodeAt(i).toString(16) + ';';
    }
    document.getElementById(field + '-text').value = output;
    return false;
}
Encoder.toDecEnt = function (field){
    var text = document.getElementById(field + '-text').value;
    var output = ''		            
    for (var i=0; i<text.length; i++) {
        output += '&#' + text.charCodeAt(i).toString(10) + ';';
    }
    document.getElementById(field + '-text').value = output;
    return false;
}
Encoder.toOctEnt = function (field){
    var text = document.getElementById(field + '-text').value;
    var output = ''		            
    for (var i=0; i<text.length; i++) {
        output += '\\' + text.charCodeAt(i).toString(8);
    }
    document.getElementById(field + '-text').value = output;
    return false;
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
    return false;
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
    return false;
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
    return false;
}
Encoder.fromVectorSource = function (option, field){
    var exploit = option.options[option.selectedIndex].value;
    document.getElementById(field + '-text').value = exploit;

    return false;
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
    return false;  
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
	return false;
}

Encoder.toSQLChar = function (field){
    var text = document.getElementById(field + '-text').value;
    var output = ''		            
    for (var i=0; i<text.length; i++) {
        output += 'Char(' + text.charCodeAt(i).toString(10) + '),';
    }
    document.getElementById(field + '-text').value = output.substr(0,output.length-1);
    return false;
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
    return false;
}

Encoder.fromBsToEnt = function(field) {
    var text = document.getElementById(field + '-text').value;
    var output = text.replace(/\\(\w{2,5})/ig, '&#$1;'); 
    document.getElementById(field + '-text').value = output;
    return false;
}

Encoder.fromEntToBs = function(field) {
    var text = document.getElementById(field + '-text').value;
    var output = text.replace(/&#(\w{2,5});/ig, '\\\$1'); 
    document.getElementById(field + '-text').value = output;
    return false;
}
