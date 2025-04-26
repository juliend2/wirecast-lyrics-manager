<?php
declare(strict_types=1);

namespace Lyrics;

use DiDom\Element;
use Lyrics\XmlParser;
use Lyrics\Song;
use Lyrics\Wirecast\Source;

class SongFinder {
  protected $document;
  protected $xml_parser;

  function __construct(XmlParser $xml_parser) {
    $this->document = $xml_parser->getDocument();
    $this->xml_parser = $xml_parser;
  }

  protected function findSourcesByLyrics(string $excerpt) {
    $sources = [];
    foreach ($this->xml_parser->getAllSourceTags() as $source_tag) {
      $source = new Source($source_tag);
      if (str_contains($source->getLyrics(), $excerpt)) {
        $sources[] = $source;
      }
    }
    return $sources;
  }

  public function findSongByLyrics(string $excerpt) {
    $songs = [];
    $sources = $this->findSourcesByLyrics($excerpt);
    foreach ($sources as $source) {
      $name = $this->xml_parser->getNameBySource($source);
      $lyrics = $source->getLyrics();
      $songs[] = new Song($name, $lyrics);
    }
    return $songs;
  }
}
