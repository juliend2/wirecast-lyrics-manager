<?php

namespace Lyrics\Wirecast;
use DiDom\Document;
use DiDom\Query;

class Shot {
  protected $node;
  public function __construct($node) {
    $this->node = $node;
  }
  public function getLyrics() {
    return '';
  }
}
