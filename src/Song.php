<?php

namespace Lyrics;

class Song {
  protected $name;
  protected $lyrics;

  function __construct($name, $lyrics) {
    $this->name = $name;
    $this->lyrics = $lyrics;
  }

  function getName() {
    return $this->name;
  }

  function getLyrics() {
    return $this->lyrics;
  }
}
