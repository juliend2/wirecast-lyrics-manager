<?php declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Lyrics\Wirecast\Source;
use Lyrics\XmlParser;

final class SourceTest extends TestCase {
  
  public function testContent(): void {
    $xml = file_get_contents(__DIR__.'/../fixtures/source.xml');
    $parser = new XmlParser($xml);
    $source = new Source($parser->getSourceTags()[0]);
    $this->assertStringContainsString(
      '1. De toi, Seigneur, nous attendons la vie',
      $source->getLyrics()
    );
  }

  public function testNoContent(): void {
    $xml = <<<XML
      <document>
        <source_configurations>
          <source>
            <xml_tag widget_settings=""/>
          </source>
        </source_configurations>
      </document>
    XML;
    $parser = new XmlParser($xml);
    $source = new Source($parser->getSourceTags()[0]);
    $this->assertEmpty($source->getLyrics());
  }
}