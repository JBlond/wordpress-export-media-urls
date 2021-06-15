# Wordpress export media urls from XML

## install via composer

```bash
composer require jblond/wordpress-export-media-urls 
```

## Wordpress export

Goto: Tools -> Export. Select: Media. Choose your start date and end date.

## Example

```PHP
<?php

use jblond\export\WordpressXmlMediaExporter;

require '../vendor/autoload.php';

$exporter = new WordpressXmlMediaExporter;
$exporter->setFile('WordPress-media-export.xml');
$export = $exporter->getData();
foreach ($export as $row){
    echo 'curl -LO ' . $row . "\n";
}
```
