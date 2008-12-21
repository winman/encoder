<?php
/**
 *  This class wraps the simple request handling abilities of 
 *  the php charset encoder
 * 
 *  @author mario
 *  @package Encoder
 *  @license http://www.gnu.org/licenses/lgpl.html LGPL
 *  @lastmodified: 2008 March 14 by d0ubl3_h3lix <yehg.org>
 */
class Encoder_Request {

    /**
     *  gathered responde data
     */
    public $response = array();
    
    /**
     *  handles the incoming reqest and prepares the response array
     */
    public function handleRequest() {
        
        if(isset($_POST['input-text']) 
                && isset($_POST['output-encoding']) 
                        && isset($_POST['input-encoding'])){
            
            $this->response['inputenc'] = $_POST['input-encoding'];
            $this->response['inputtext'] = stripslashes($_POST['input-text']);
            $this->response['outputenc'] = $_POST['output-encoding'];
            
            if ($this->response['outputenc'] == 'PUNYCODE') {
				$this->response['outputtext'] =  $this->punyencode($this->response['inputtext'],$this->response['inputenc']);
							
			} else if($this->response['inputenc'] == 'PUNYCODE') {
				$this->response['outputtext'] =	$this->punydecode($this->response['inputtext']);	
			} else if ($this->response['outputenc'] == 'UUENCODE') {
				$this->response['outputtext'] =  convert_uuencode($this->response['inputtext']);
							
			} else if($this->response['inputenc'] == 'UUENCODE') {
				$this->response['outputtext'] =	convert_uudecode($this->response['inputtext']);	
			} else {
				    $this->response['outputtext'] = mb_convert_encoding(
                    $this->response['inputtext'], 
                    $this->response['outputenc'], 
                    $this->response['inputenc']
                );
			}
        } else {
            $this->response['inputenc'] = 'UTF-8';
            $this->response['inputtext'] = null;
            $this->response['outputenc'] = 'UTF-7';
            $this->response['outputtext'] = null;
        }        
        return true;
    }
    
    /**
     * punyencode
     * 
     * @return 
     * @param $inputtext Object
     * @param $inputenc Object
     */
    public function punyencode($inputtext,$inputenc) {
		require 'assets/php/vendors/idna_convert_060/idna_convert.class.php';
		require 'assets/php/vendors/idna_convert_060/transcode_wrapper.php';
	
		$IDN = new idna_convert();	
		return $IDN->encode(encode_utf8($inputtext,$inputenc));	
	}	
    
    /**
     * punydecode
     * 
     * @return 
     * @param $inputtext Object
     */
    public function punydecode($inputtext) {
		require 'assets/php/vendors/idna_convert_060/idna_convert.class.php';
		require 'assets/php/vendors/idna_convert_060/transcode_wrapper.php';
	
		$IDN = new idna_convert();	
		return $IDN->decode($this->response['inputtext']);		
	}
}