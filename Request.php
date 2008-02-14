<?php
/**
 *  This class wraps the simple request handling abilities of 
 *  the php charset encoder
 * 
 *  @author mario
 *  @package Encoder
 *  @license http://www.gnu.org/licenses/lgpl.html LGPL
 */
class Encoder_Request {

    /**
     *  gathered responde data
     */
    public $response = array();
 
    /**
     * 
     */
    public function __construct () {
		
	}       
    
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
            
            if ($this->response['outputenc'] == 'Punycode')
            {
				require_once('idna_convert_060/idna_convert.class.php');
				require_once('idna_convert_060/transcode_wrapper.php');
				$IDN = new idna_convert();	
				$this->response['outputtext'] =  $IDN->encode(encode_utf8($this->response['inputtext'], $this->response['inputenc']));
							
			}
			else if($this->response['inputenc'] == 'Punycode')
			{
				require_once('idna_convert_060/idna_convert.class.php');
				require_once('idna_convert_060/transcode_wrapper.php');
				$IDN = new idna_convert();	
				$this->response['outputtext'] =  $IDN->decode($this->response['inputtext']);
			}
			else
			{
				$this->response['outputtext'] = mb_convert_encoding(
                                                    $this->response['inputtext'], 
                                                    $this->response['outputenc'], 
                                                    $this->response['inputenc']);
			}
            
        } else {

            $this->response['inputenc'] = 'UTF-8';
            $this->response['inputtext'] = null;
            $this->response['outputenc'] = 'UTF-7';
            $this->response['outputtext'] = null;
        }        

        return true;
    }
}
