<?php

class eBook {

    private $title   = '';
    private $content = '';

    public function __construct ($pathToEbook) {

        // # Meta-Content //

        // Loading the XML file for the meta-content
        $metaXML = new DOMDocument();
        $metaXML->load($pathToEbook . 'content.opf');

        // Looking for the title tag
        foreach($metaXML->getElementsByTagName('package') as $root) {
            foreach($root->getElementsByTagName('metadata') as $metadata) {
                foreach($metadata->childNodes as $nodeValue) {
                    if($nodeValue->nodeName == 'dc:title') {
                        $this->title = $nodeValue->nodeValue;
                    }
                }
            }
        }

        // # Content //

        // Parsing of the different chapters
        $directory = new RecursiveDirectoryIterator($pathToEbook);
        $iterator  = new RecursiveIteratorIterator($directory);
        $files     = new RegexIterator($iterator, '/^.+\.html$/i', RecursiveRegexIterator::GET_MATCH);
        var_dump($files);

        foreach ($files as $file) {
            // Reads chapter file content into a string
            $file = file_get_contents($pathToEbook);
        }

        // Get the content of the body tag
        preg_match('/<body.*\/body>/s', $file, $matches);
        $this->content = $matches[1];
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
