<?php
require 'vendor/autoload.php';

use DiDom\Document;

$document = new Document('messe.xml', isFile: true);
$source_nodes = $document->find('source_configurations > source');

foreach ($source_nodes as $source) {
    try {
        print_r($source);

    } catch (Exception $e) {

        print_r($source);
    }
}

