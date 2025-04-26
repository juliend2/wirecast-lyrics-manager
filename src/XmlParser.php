<?php

namespace Lyrics;

use DiDom\Document;
use DiDom\Query;

class XmlParser {
  protected $xml;
  public function __construct(string $document) {
    $this->xml = $document;
  }
  public function getDocument() {
    $doc = new Document();
    $doc->loadXml($this->xml);
    return $doc;
  }
  public function getSourceTags() {
    return $this->getDocument()->find('source');
  }
}

