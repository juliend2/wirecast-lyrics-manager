<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Lyrics\XmlParser;

final class XmlParserTest extends TestCase {
  public function testContent(): void {
    $xml = file_get_contents(__DIR__.'/fixtures/source.xml');
    $parser = new XmlParser($xml);
    $this->assertNotEmpty($parser->getAllSourceTags());
    $this->assertEquals(2, count($parser->getAllSourceTags()));
  }

  public function testTagWithEmptyContent(): void {
    $xml = <<<XML
      <document>
        <source_configurations>
          <source>
            <xml_tag />
          </source>
        </source_configurations>
      </document>
    XML;
    $parser = new XmlParser($xml);
    $this->assertNotEmpty($parser->getAllSourceTags());
  }

  public function testNoSourceTag(): void {
    $xml = <<<XML
      <document>
        <source_configurations>
          <!-- No <source> tag -->
        </source_configurations>
      </document>
    XML;
    $parser = new XmlParser($xml);
    $this->assertEmpty($parser->getAllSourceTags());
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
