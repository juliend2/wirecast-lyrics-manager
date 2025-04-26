<?php

namespace Lyrics\Wirecast;
use DiDom\Element;

class Source {
  protected Element $node;

  public function __construct(Element $node) {
    $this->node = $node;
  }

  protected function getLyricsMultiLine(): string {
    $widget_settings = $this->node->first('xml_tag')->getAttribute('widget_settings');
    if (!$widget_settings) {
      return '';
    }
    return urldecode(base64_decode(json_decode($widget_settings)->text));
  }

  public function getLyrics(): string {
    return strtr($this->getLyricsMultiLine(), "\n", '');
  }

  public function getUniqueId(): string {
    return $this->node->getAttribute('unique_id');
  }
}

