<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 23.06.18
 * Time: 19:00
 */

namespace Tests\app\Helpers;


use App\Helpers\Constants;
use Tests\TestCase;

class ConstantsTest extends TestCase
{
    const True = 1;
    const False = 0;

    private static function VkPageRegexPatternMath($string){
        // возвращает 1, если матчится, 0 - если нет, FALSE - если какая-то ошибка
        return preg_match("/".Constants::VkPageRegexPattern."/", $string);
    }

    public function test_VkPageRegexPattern_АдресБезПроокола(){
        $source = "vk.com/maxim";

        $this->assertEquals(self::True, self::VkPageRegexPatternMath($source));
    }

    public function test_VkPageRegexPattern_АдресБезHttps(){
        $source = "http://vk.com/maxim";

        $this->assertEquals(self::False, self::VkPageRegexPatternMath($source));
    }

    public function test_VkPageRegexPattern_БуквыИЦифры(){
        $source = "https://vk.com/maxim12312312";

        $this->assertEquals(self::True, self::VkPageRegexPatternMath($source));
    }

    public function test_VkPageRegexPattern_БуквыЦифрыИСпецСимволы(){
        $source = "https://vk.com/maxim12312<>1^&*(312";

        $this->assertEquals(self::False, self::VkPageRegexPatternMath($source));
    }

    public function test_VkPageRegexPattern_БуквыЦифрыИСпецСимволы_1(){
        $source = "https://vk.com/awesome_person";

        $this->assertEquals(self::True, self::VkPageRegexPatternMath($source));
    }

    public function test_VkPageRegexPattern_БуквыЦифрыИСпецСимволы_2(){
        $source = "https://vk.com/awesome-person";

        $this->assertEquals(self::True, self::VkPageRegexPatternMath($source));
    }
}