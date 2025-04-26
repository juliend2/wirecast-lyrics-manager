<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Lyrics\SongFinder;
use Lyrics\XmlParser;

final class SongFinderTest extends TestCase {
  public function testFindingSong(): void {
    $xml = file_get_contents(__DIR__.'/fixtures/tag_relationships.xml');
    $xml_parser = new XmlParser($xml);
    $song_finder = new SongFinder($xml_parser);
    $song = $song_finder->findSongByLyrics('eleison')[0];
    $this->assertEquals('Kyrie eleison', $song->getName());
  }
}
