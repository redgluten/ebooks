<?php

class eBook {

    private $title   = '';
    private $content = '';
    private $images  = array();

    public function __construct ($pathToEbook) {

        // Loading the XML file for the meta-content
        $metaXML = new DOMDocument();
        $metaXML->load($pathToEbook . 'content.opf');

        // Setting the title
        foreach($metaXML->getElementsByTagName('package') as $root) {
            foreach($root->getElementsByTagName('metadata') as $metadata) {
                foreach($metadata->childNodes as $nodeChild) {
                    if($nodeChild->nodeName == 'dc:title') {
                        $this->title = $nodeChild->nodeValue;
                    }
                }
            }
        }

        // Looking for the paths for the chapters
        foreach($metaXML->getElementsByTagName('package') as $root) {
            foreach($root->getElementsByTagName('manifest') as $manifest) {
                foreach($manifest->childNodes as $nodeChild) {
                    if($nodeChild->nodeName == 'item') {

                        $ebookElementType = $nodeChild->getAttribute('media-type');
                        $ebookElementPath = $nodeChild->getAttribute('href');

                        // Adding chapters to content
                        if ($ebookElementType == 'application/xhtml+xml') {

                            // Reads chapter file content into a string
                            $chapter = file_get_contents($pathToEbook . $ebookElementPath);

                            // Get the content of the body tag
                            preg_match('/<body.*\/body>/s', $chapter, $matches);

                            $this->content .= $matches[0];
                        }

                        // Getting images paths
                        if ($ebookElementType == 'image/jpeg') {
                            array_push($this->images, $ebookElementPath);
                        }
                    }
                }
            }
        }
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
