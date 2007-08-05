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
     *  the feed url
     * 
     *  @access private
     */
    private $feedUrl = '';
    
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
        
        $source = file_get_contents($this->feedUrl);
        $feed = new XML_Feed_Parser($source);            
        
        $options = string;
        
        foreach ($feed as $entry) {
            preg_match('/Exploit String: <\/b>(.*)<br><b>Exploit Tags:/ism', $entry->description, $matches);
            $matches[1] = $this->replaceBRTags($matches[1]);
            $options .= '<option value="'.htmlspecialchars($matches[1]).'">' . $entry->title . '</option>';
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