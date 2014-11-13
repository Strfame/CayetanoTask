<?php
class url {
    
    var $sitePatch;
    
    function __construct($sitePatch) {        
        $this->sitePatch = $this->removeSlash($sitePatch);
    }
    
    function __toString() {
        return $this->sitePatch;
    }
    
    private function removeSlash($string) {                
        if($string[strlen($string) - 1] == '/') {
            $string = trim($string, '/');        
        }
        return $string;
    }
    
    function segment($segment) {
        $url = str_replace($this->sitePatch, '', $_SERVER['REQUEST_URI']);
        $url = explode('/', $url);
        if(isset($url[$segment])){
            return $url[$segment];
        } else {
            return false;
        }
    }
    
}
