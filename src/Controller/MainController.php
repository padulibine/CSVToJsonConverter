<?php

namespace App\Controller;

require 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Exception;
use App\Service\ConverterService;
use App\Service\MergeService;
use Markenwerk\JsonPrettyPrinter\JsonPrettyPrinter;


class MainController
{

    private static $instance = null;

    public function home()
    {

        $extraCSV = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "fichierCSV" . DIRECTORY_SEPARATOR . "extra.csv";
        $inCSV = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "fichierCSV" . DIRECTORY_SEPARATOR . "in.csv";
        $prettyJson = new JsonPrettyPrinter();
        $converter = new ConverterService();
        $merger = new MergeService();

        try {
            $extraInMergded = $merger->mergeCSV($extraCSV, $inCSV);

            $prettyMerge = $prettyJson
                ->setIndentationString('  ')
                ->prettyPrint($extraInMergded);

            file_put_contents("fichierJson/merged-files.json", $prettyMerge);
        } catch (Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }

        try {
            $inJson = $converter->convertCSV($inCSV);
            $extraJson = $converter->convertCSV($extraCSV);

            $prettyIn = $prettyJson
                ->setIndentationString('  ')
                ->prettyPrint($inJson);

            $prettyExtra = $prettyJson
                ->setIndentationString('  ')
                ->prettyPrint($extraJson);

            file_put_contents("fichierJson/in.json", $prettyIn);
            file_put_contents("fichierJson/extra.json", $prettyExtra);
        } catch (Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        };

        require 'template' . DIRECTORY_SEPARATOR . 'mainTemplate.php';
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new MainController();
        }

        return self::$instance;
    }
}
