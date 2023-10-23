<?php

namespace App\Service;

require 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Exception;
use App\Service\ConverterService;

class MergeService
{

    private $EXCEPTION_CONVERT = "Erreur dans la conversion";

    private $extraCsv;
    private $inCsv;
    private $extraArrayFormat;
    private $inArrayFormat;
    private $mergeTab;
    private $mergeTabJson;

    public function mergeCSV($extraCsv, $inCsv)
    {

        $this->extraCsv = $extraCsv;
        $this->inCsv = $inCsv;

        if (!$this->convertFiles()) {
            throw new Exception($this->EXCEPTION_CONVERT);
        }

        if (!$this->mergeArray()) {
            throw new Exception($this->EXCEPTION_CONVERT);
        }

        if (!$this->convertToJson()) {
            throw new Exception($this->EXCEPTION_CONVERT_JSON);
        }

        return $this->mergeTabJson;
    }

    private function convertFiles()
    {
        $converter = new ConverterService();
        try {
            $this->extraArrayFormat = $converter->convertCSV($this->extraCsv, true);
            $this->inArrayFormat = $converter->convertCSV($this->inCsv, true);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    private function mergeArray()
    {
        $mergeTab = [];

        foreach ($this->inArrayFormat as $line) {
            $i = 0;
            $matchLine = null;
            while ($line["product_SKU"] != $this->extraArrayFormat[$i]["product_SKU"]) {
                $i++;
            }
            if ($i == count($this->inArrayFormat)) {
                $mergeTab[] = $line;
            } else {
                $matchLine = $this->extraArrayFormat[$i];
                $mergeLine = array_merge($matchLine, $line);
                $mergeTab[$line["product_id"]] = $mergeLine;
            }
        }

        $this->mergeTab = $mergeTab;

        return true;
    }

    private function convertToJson()
    {

        $this->mergeTabJson = json_encode($this->mergeTab);
        return true;
    }
}
