<?php

namespace jblond\export;

use Exception;
use SimpleXMLElement;

/**
 * Class wordpressXmlMediaExporter
 * @package jblond\export
 */
class WordpressXmlMediaExporter
{
    /**
     * @var SimpleXMLElement|null
     */
    private ?SimpleXMLElement $file;

    /**
     * @param string $file
     * @throws Exception
     */
    public function setFile(string $file): void
    {
        if (!file_exists($file)) {
            throw new Exception('Invalid Input file');
        }
        $this->file = simplexml_load_file($file);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $data = $this->simplexml2array($this->file);
        $items = $data['channel']['item'];
        $return = [];
        $counter = 0;
        foreach ($items as $entry) {
            $return[$counter] = $entry['guid'];
            $counter++;
        }
        return $return;
    }

    /**
     * concerts a simplexml object to an PHP array
     * @param $xml
     * @return array|string array
     */
    private function simplexml2array($xml)
    {
        if (is_object($xml) && get_class($xml) == 'SimpleXMLElement') {
            $attributes = $xml->attributes();
            foreach ($attributes as $k => $v) {
                if ($v) {
                    $a[$k] = (string) $v;
                }
            }
            $x = $xml;
            $xml = get_object_vars($xml);
        }

        if (is_array($xml)) {
            $r = [];
            if (count($xml) == 0) {
                if (isset($x) && $x != '') {
                    $a['cdata'] = (string) $x;
                }
                if (isset($a)) {
                    $r['@'] = $a;
                }

                return $r;
            }

            if (isset($a)) {
                $r['@'] = $a;    // Attributes
            }

            foreach ($xml as $key => $value) {
                $r[$key] = $this->simplexml2array($value);
            }

            return $r;
        }
        return (string) $xml;
    }
}
