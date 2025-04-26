<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Lyrics\XmlParser;

final class XmlParserTest extends TestCase {
  public function testContent(): void {
    $xml = file_get_contents(__DIR__.'/fixtures/source.xml');
    $parser = new XmlParser($xml);
    $this->assertNotEmpty($parser->getSourceTags());
  }

  public function testEmptyContent(): void {
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
    $this->assertNotEmpty($parser->getSourceTags());
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
    $this->assertEmpty($parser->getSourceTags());
  }
}