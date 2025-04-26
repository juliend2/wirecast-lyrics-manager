<?php

namespace Lyrics;

use DiDom\Document;

class XmlParser {
  protected string $xml;

  public function __construct(string $document) {
    $this->xml = $document;
  }
  public function getDocument(): Document {
    $doc = new Document();
    $doc->loadXml($this->xml);
    return $doc;
  }

  /**
   * @return \DiDom\Element[]|\DiDom\DOMElement[]
   */
  public function getSourceTags(): array {
    return $this->getDocument()->find('source');
  }
}

