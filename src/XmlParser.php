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
  public function getAllSourceTags(): array {
    return $this->getDocument()->find('source');
  }

  public function getAssetTags(): array {
    return $this->getDocument()->find('asset');
  }

  public function getNameBySource(\Lyrics\Wirecast\Source $source): string {
    return array_find($this->getAssetTags(), function ($asset) use ($source) {
        return $asset->getAttribute('unique_id') == $source->getUniqueId();
    })->getAttribute('name');
  }

  /**
   * @return \DiDom\Element|\DiDom\DOMElement
   */
  public function getAssetByUniqueId(string $unique_id) {
    return $this->getDocument()->find("asset[unique_id='$unique_id']")[0];
  }
}

