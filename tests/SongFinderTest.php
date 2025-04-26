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

  public function testFindAssetByUniqueId(): void {
    $kyrie_eleison = 'A2893B0E-5912-4C6C-A610-97D13D930BB3';
    $xml = <<<XML
      <document>
        <assets>
          <asset name="Agnus Dei" unique_id="6D31FC42-6EDD-4880-9B58-7CA5A2E4B810" type="shot" media-type="9" audio_tracks="0" video_tracks="1" still_image_tracks="0" veil_track_count="0" alpha_track_count="0" sort_on_overlay="38" created_for_layer="2" sort_on_normal="13"/>
          <asset name="Kyrie Eleison" unique_id="A2893B0E-5912-4C6C-A610-97D13D930BB3" type="shot" media-type="9" audio_tracks="0" video_tracks="1" still_image_tracks="0" veil_track_count="0" alpha_track_count="0" sort_on_overlay="107" created_for_layer="2" sort_on_normal="87"/>
        </assets>
      </document>
    XML;
    $parser = new XmlParser($xml);
    $asset = $parser->getAssetByUniqueId($kyrie_eleison);
    $this->assertEquals($kyrie_eleison, $asset->getAttribute('unique_id'));
  }
}
