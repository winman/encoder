<?php
/**
 *  This class wraps the feed fetching abilities of the 
 *  php charset encoder
 * 
 *  @author mario
 *  @package Encoder
 *  @license http://www.gnu.org/licenses/lgpl.html LGPL
 */
class Encoder_Feed {
    
    /**
     *  
     */
    public function __construct() {
        
    }

    /**
     *  returns HTML option tags with the needed feed items
     * 
     *  @return string exploit options
     */
    public function createHTMLOptions() {

        $handle = fopen(dirname(__FILE__) . "/xssdb.csv", "r");
        $feed = array();        
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            $feed[] = $data;
        }
        fclose($handle);           
        unset($feed[0]);        
        $options = NULL;
        foreach ($feed as $entry) {
            $options .= '<option value="'.htmlspecialchars($entry[1]).'">' . htmlentities($entry[0]) . '</option>';
        }

        return $options;         
    }

    public function replaceBRTags($string) {
        
        $string = str_replace('<br>', "\n", $string);
        $string = str_replace('<br/>', "\n", $string);
        
        return $string;
    }
    
    /**
     *  
     */
    public function setFeedUrl($feedUrl = null) {
        if(!empty($feedUrl)){
            $this->feedUrl = $feedUrl;
        } else {
            throw new InvalidArgumentException('Invalid feed url given');    
        }
    }    
}
