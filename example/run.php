<?php

use jblond\export\WordpressXmlMediaExporter;

require '../vendor/autoload.php';

$exporter = new WordpressXmlMediaExporter();
try {
    $exporter->setFile('WordPress-media-export.xml');
} catch (Exception $exception) {
    echo $exception->getMessage();
}
$export = $exporter->getData();
print_r($export);
