<?php

namespace Tests\WordpressXmlMediaExporter;

use Exception;
use jblond\export\WordpressXmlMediaExporter;
use PHPUnit\Framework\TestCase;

/**
 * Class WordpressXmlMediaExporterTest
 * @package Tests\WordpressXmlMediaExporter
 */
class WordpressXmlMediaExporterTest extends TestCase
{

    /**
     * @throws Exception
     */
    public function testSetFile()
    {
        $this->expectException(Exception::class);
        $exporter = new WordpressXmlMediaExporter;
        $exporter->setFile('../WordPress-media-export.xml');
    }

    /**
     * @throws Exception
     */
    public function testGetData()
    {
        $exporter = new WordpressXmlMediaExporter;
        $exporter->setFile(__DIR__ . '/WordPress-media-export.xml');
        $export = $exporter->getData();
        require __DIR__ . '/testArray.php';
        $this->assertEquals($array, $export);
    }


}
