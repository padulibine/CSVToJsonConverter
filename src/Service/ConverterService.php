<?php

namespace App\Service;

require 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Exception;
use SimpleExcel\SimpleExcel;

class ConverterService
{
    private $EXCEPTION_FILE = "Not a file";
    private $EXCEPTION_FORMAT = "Not a recognised format";
    private $EXCEPTION_CONVERSION = "Error Conversion";

    private $file;
    private $json;
    private $arrayFormat;
    private $opFile;

    public function convertCSV($file, $arrayFormat = false)
    {

        $this->file = $file;
        $this->arrayFormat = $arrayFormat;

        if (!is_file($this->file)) {
            throw new Exception($this->EXCEPTION_FILE);
        }
        $this->opFile = fopen($this->file, 'r');

        if (!$this->checkFormat()) {
            throw new Exception($this->EXCEPTION_FORMAT);
        }

        if (!$this->convert()) {
            throw new Exception($this->EXCEPTION_CONVERSION);
        }

        return $this->json;
    }

    private function checkFormat()
    {

        if (substr(basename($this->file), -3) !== "csv") {
            return false;
        }

        return true;
    }

    private function convert()
    {
        $columns = str_getcsv(trim(fgets($this->opFile), " \n\r\t\v\x00"), ";", '"');

        foreach ($columns as $c) {
            $col_name[] = $c;
        }

        while ($line = fgets($this->opFile)) {
            $l = str_getcsv(trim($line, " \n\r\t\v\x00"), ";", '"');
            $datas[] = $l;
        }

        for ($i = 0; $i < count($datas); $i++) {
            $data_line = array_combine($col_name, $datas[$i]);
            $json_format[] = $data_line;
        }

        if ($this->arrayFormat) {
            $this->json = $json_format;
        } else {
            $this->json = json_encode($json_format);
        }


        // Autre façon de convertir en Json avec la librairie SimpleExcel

        /*
        $csvFile = new SimpleExcel('CSV');
        $csvFile->parser->setDelimiter(";");
        $csvFile->parser->loadFile($this->file);

        $csvFile->convertTo('JSON');

        $tab_json = json_decode($csvFile->writer->saveString(), true);
        $col_name = array_shift($tab_json);
        $size_line = sizeof($col_name);

        foreach ($tab_json as $line) {
            $final_line = [];
            for ($i = 0; $i < $size_line; $i++) {
                $final_line[$col_name[$i]] = $line[$i];
            }
            $final_tab[] = $final_line;
        }

        if ($this->arrayFormat) {
            $this->json = $final_tab;
        } else {
            $this->json = json_encode($final_tab);
        }*/

        return true;
    }
}
