<?php

class eBook {

    private $title   = '';
    private $content = '';

    public function __construct ($pathToEbook) {

        // Reads file into a string
        $file = file_get_contents($pathToEbook);

        // Get the content of the title tag
        preg_match('(<title[^>]*>(.*?)</title>)', $file, $matches);
        $this->title = $matches[0];

        // Get the content of the body tag
        preg_match('/<body.*\/body>/s', $file, $matches);
        $this->content = $matches[0];
    }


    // Getters

    public function getTitle () {
        return $this->title;
    }

    public function getContent () {
        return $this->content;
    }


}

?>
