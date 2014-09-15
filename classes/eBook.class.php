<?php

class eBook {

    /**
     * @var string $title
     */
    private $title   = '';

    /**
     * @var string $content
     */
    private $content = '';

    /**
     * @var array $images
     */
    private $images  = array();


    /**
     * @param string $pathToEbook
     */
    public function __construct ($pathToEbook) {

        // Loading the XML file for the meta-content
        $metaXML = new DOMDocument();
        $metaXML->load($pathToEbook . 'content.opf');


        $this->setTitle($metaXML);

        // Looking for the paths for the chapters
        foreach($metaXML->getElementsByTagName('package') as $root) {
            foreach($root->getElementsByTagName('manifest') as $manifest) {
                foreach($manifest->childNodes as $nodeChild) {
                    if($nodeChild->nodeName == 'item') {

                        $ebookElementType = $nodeChild->getAttribute('media-type');
                        $ebookElementPath = $nodeChild->getAttribute('href');

                        // Adding chapters to content
                        // by searching for HTML documents references
                        if ($ebookElementType == 'application/xhtml+xml') {

                            // Reads chapter file content into a string
                            $chapter = file_get_contents($pathToEbook . $ebookElementPath);

                            // Get the content of the body tag
                            preg_match('#<body[^>]*>(.*?)<\/body>#is', $chapter, $matches);
                            $chapterBody = $matches[1];

                            // Search & replace src attributes inside img tags
                            $imgPath = 'src="' . $pathToEbook;
                            $chapterBody = preg_replace('#src="#i', $imgPath, $chapterBody);

                            // Search & remove styles attributes
                            $chapterBody = preg_replace('#style="([^"]*)"#i', '', $chapterBody);

                            $this->content .= $chapterBody;
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



    // -------------- //
    //    Accessors   //
    // -------------- //


    /**
     * Gets the value of title.
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Sets the value of title.
     *
     * @param string $title $title the title 
     *
     * @return self
     */
    private function setTitle($metaXML)
    {

        foreach($metaXML->getElementsByTagName('package') as $root) {
            foreach($root->getElementsByTagName('metadata') as $metadata) {
                foreach($metadata->childNodes as $nodeChild) {
                    if($nodeChild->nodeName == 'dc:title') {
                        $this->title = $nodeChild->nodeValue;
                    }
                }
            }
        }

        return $this;
    }


    /**
     * Gets the value of content.
     *
     * @return string $content
     */
    public function getContent()
    {
        return $this->content;
    }
    
    /**
     * Sets the value of content.
     *
     * @param string $content $content the content 
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }


    /**
     * Gets the value of images.
     *
     * @return array $images
     */
    public function getImages()
    {
        return $this->images;
    }
    
    /**
     * Sets the value of images.
     *
     * @param array $images $images the images 
     *
     * @return self
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }
}

?>
