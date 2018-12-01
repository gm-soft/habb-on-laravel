<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 23.06.18
 * Time: 13:45
 */

namespace Tests\app\Helpers;


use App\Helpers\MiscUtils;
use Tests\TestCase;

class MiscUtilsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_getValueOrDefault_возвращаетсяЗначениеСуществующегоКлюча()
    {
        $input = [
            "awesome_string" => "12345",
        ];

        $this->assertEquals("12345", MiscUtils::getValueOrDefault($input, "awesome_string"));
    }

    public function test_getValueOrDefault_КлючНеСуществуетВозвращаетсяNULL()
    {
        $input = [
            "awesome_string" => "12345",
        ];

        $this->assertNull(MiscUtils::getValueOrDefault($input, "awesome_int"));
    }

    public function test_getValueOrDefault_КлючНеСуществуетВозвращаетсяПереданноеДефолтово()
    {
        $input = [
            "awesome_string" => "12345",
        ];

        $this->assertEquals(1488, MiscUtils::getValueOrDefault($input, "awesome_int", 1488));
    }

    public function test_formatPhone_МаксированноеЗначение(){
        $phone = "+7(701)762-07-87";

        $this->assertEquals("87017620787", MiscUtils::formatPhone($phone));
    }

    public function test_formatPhone_МаксированноеЗначение_ТелефонНачинаетсяССемерки(){
        $phone = "7(701)762-07-87";

        $this->assertEquals("87017620787", MiscUtils::formatPhone($phone));
    }

    public function test_formatPhone_МаксированноеЗначение_ЕстьПробелы(){
        $phone = "7(701) 762-07-87";

        $this->assertEquals("87017620787", MiscUtils::formatPhone($phone));
    }


    public function test_inArray_МассивИзСтрок_ПередаютСтроку_Ок(){

        $this->assertEquals(true, MiscUtils::inArray("1", ["1", "2", "3"]));
    }

    public function test_inArray_МассивИзСтрок_ПередаютЧисло_Ок(){

        $this->assertEquals(true, MiscUtils::inArray(1, ["1", "2", "3"]));
    }

    public function test_inArray_МассивИзСтрок_ПередаютЧисло_СтрогоеСравнение_Ок(){

        $this->assertEquals(false, MiscUtils::inArray(1, ["1", "2", "3"], true));
    }
}
