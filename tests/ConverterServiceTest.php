<?php

use PHPUnit\Framework\TestCase;
use App\Service\ConverterService;

class ConverterServiceTest extends TestCase
{

    private $testIn ='[{"product_id":"10201","product_name":"HUMMINGBIRD PRINTED T-SHIRT","product_SKU":"HMNGB201","product_price":"28,68","product_currency":"EUR","product_description":"Regular fit, round neckline, short sleeves. Made of extra long staple pima cotton.","product_status":"2","is_available":"1"},{"product_id":"10202","product_name":"HUMMINGBIRD PRINTED SWEATER","product_SKU":"HMNGBSW202","product_price":"43,08","product_currency":"EUR","product_description":"Regular fit, round neckline, long sleeves. 100% cotton, brushed inner side for extra comfort. ","product_status":"1","is_available":"1"},{"product_id":"10203","product_name":"TODAY IS A GOOD DAY FRAMED POSTER","product_SKU":"TDIGD203","product_price":"34","product_currency":"EUR","product_description":"<p><span style=\"font-size:10pt;font-style:normal;\">The best is yet to come! Give your walls a voice with a framed poster. This aesthethic, optimistic poster will look great in your desk or in an open-space office. Painted wooden frame with passe-partout for more depth.<\/span><\/p>","product_status":"0","is_available":"0"},{"product_id":"10204","product_name":"MUG THE ADVENTURE BEGINS","product_SKU":"MTAB204","product_price":"14,28","product_currency":"EUR","product_description":"<div class=\"product-description\"><p><span style=\"font-size:10pt;font-style:normal;\">The adventure begins with a cup of coffee. Set out to conquer the day! 8,2cm diameter \/ 9,5cm height \/ 0.43kg. Dishwasher-proof.<\/span><\/p><\/div>","product_status":"0","is_available":"0"},{"product_id":"10205","product_name":"MOUNTAIN FOX CUSHION","product_SKU":"MFC205","product_price":"17,47","product_currency":"EUR","product_description":"<p><span style=\"font-size:10pt;font-style:normal;\">The Mountain fox notebook is the best option to write down your most ingenious ideas. At work, at home or when traveling, its endearing design and manufacturing quality will make you feel like writing! 90 gsm paper \/ double spiral binding.<\/span><\/p>","product_status":"0","is_available":"0"},{"product_id":"10206","product_name":"BROWN BEAR - VECTOR GRAPHICS","product_SKU":"BBVG206","product_price":"","product_currency":"EUR","product_description":"<div class=\"product-description\"><p><span style=\"font-size:10pt;font-style:normal;\">You have a custom printing creative project? The vector graphic Mountain fox illustration can be used for printing purpose on any support, without size limitation. <\/span><\/p><\/div>","product_status":"3","is_available":"1"},{"product_id":"10207","product_name":"BROWN BEAR NOTEBOOK","product_SKU":"BBN207","product_price":"15,48","product_currency":"EUR","product_description":"120 sheets notebook with hard cover made of recycled cardboard. 16x22cm","product_status":"1","is_available":"1"}]';
    
    public function testConverter()
    {
        $converter = new ConverterService();
        $inCSV = dirname(__DIR__) . DIRECTORY_SEPARATOR . "fichierCSV" . DIRECTORY_SEPARATOR . "in.csv";
        $inJson = $converter->convertCSV($inCSV);

        $this->assertEquals($inJson, $this->testIn);
    }
}