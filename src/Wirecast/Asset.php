<?php

namespace Lyrics\Wirecast;
use DiDom\Element;

class Asset {
  protected Element $node;
  
  public function __construct(Element $node) {
    $this->node = $node;
  }

  public function getName(): string {
    return $this->node->getAttribute('name');
  }

  public function getUniqueId(): string {
    return $this->node->getAttribute('unique_id');
  }
}

