<?php

use jblond\export\WordpressXmlMediaExporter;

require '../vendor/autoload.php';

$exporter = new WordpressXmlMediaExporter;
$exporter->setFile('WordPress-media-export.xml');
$export = $exporter->getData();
print_r($export);
