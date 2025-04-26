<?php

namespace Lyrics\Wirecast;
use DiDom\Document;
use DiDom\Query;
use DiDom\Element;

class Source {
  protected $node;
  public function __construct(Element $node) {
    $this->node = $node;
  }
  public function getLyrics(): string {
    $widget_settings = $this->node->first('xml_tag')->getAttribute('widget_settings');
    if (!$widget_settings) {
      return '';
    }
    return urldecode(base64_decode(json_decode($widget_settings)->text));
  }
}

