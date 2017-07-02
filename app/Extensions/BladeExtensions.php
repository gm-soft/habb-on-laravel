<?php

namespace App\Extensions;

use App\Helpers\Constants;
use App\Models\Gamer;
use Blade;

class BladeExtensions
{
    public static function AddExtensions() {
        self::AddWrappers();
        self::AddPatterns();
        self::AddRoleFunctions();
        self::AddSelectSnippets();
    }

    public static function AddWrappers() {
    }

    public static function AddRoleFunctions() {

        Blade::directive('isAdmin', function() {
            return "<?php if(Auth::user()->isAdmin()): ?>";
        });

        Blade::directive('endisAdmin', function() {
            return "<?php endif; ?>";
        });

// Blade custom directives for isVisitor

        Blade::directive('isVisitor', function() {
            return "<?php if(Auth::user()->isVisitor()): ?>";
        });

        Blade::directive('endisVisitor', function() {
            return "<?php endif; ?>";
        });

// Blade custom directives for isDisabled

        Blade::directive('isDisabled', function() {
            return "<?php if(Auth::user()->isDisabled()): ?>";
        });

        Blade::directive('endisDisabled', function() {
            return "<?php endif; ?>";
        });

        Blade::directive('isDeveloper', function() {
            return "<?php if(Auth::user()->isDeveloper()): ?>";
        });

        Blade::directive('endisDeveloper', function() {
            return "<?php endif; ?>";
        });

        Blade::directive('getUsername', function() {
            return "<?php Auth::user()->getName() ?>";
        });
    }
    public static function AddPatterns() {
        Blade::directive('EmailFieldPattern', function() {
            return Constants::EmailRegexPattern;
        });

        Blade::directive('PhoneFieldPattern', function() {
            return Constants::PhoneRegexPattern;
        });

        Blade::directive('VkFieldPattern', function() {
            return Constants::VkPageRegexPattern;
        });

        /*Blade::directive('VkFieldPattern', function() {
            return '^(https:\/\/)?(vk\.com)([\/\w \.-]{1,50})*\/?$';
        });*/
    }
    public static function AddSelectSnippets() {
        Blade::directive('renderCitiesSelect', function($selectedCity = null,
                                                        $isRequired = false,
                                                        $name="city",
                                                        $id="city",
                                                        $withAll = false) {
            $content = "";
            $cities = Constants::getCities();
            $requiredState = $isRequired == true ? "required" : "";
            $content = "<select class='form-control' name='$name' id='$id' $requiredState>\n";
            $content .= "<option value='' disabled>Город</option>\n";
            $content .= $withAll == true ? "<option value='all' selected>Все города</option>\n" : "";
            for ($i = 0; $i<count($cities); $i++) {
                $selectedState = $selectedCity == $cities[$i] ? "selected" : "";
                $content .= "<option value='$cities[$i]' $selectedState>$cities[$i]</option>\n";
            }
            $content .= "</select>";
            return $content;
        });

        Blade::directive('GamersSelect2', function($fieldName, $gamersSelected, $isRequired = true, $multiple = false) {

            /** @var Gamer[] $gamers */
            $gamers = Gamer::all();
            $list = [];
            foreach ($gamers as $gamer) {
                $list[$gamer->getIdentifier()] = $gamer->getName();
            }
            $options = array();
            $classAttr = $multiple == true ? "multiple" : "single";

            $options['class'] = "form-control select2-$classAttr";
            if ($isRequired == true) $options["required"] = true;
            if ($multiple == true) $options["multiple"] = true;

            return \Collective\Html\FormFacade::select($fieldName, $list, $gamersSelected, $options);
        });

        Blade::directive('renderGameSelectField', function($selectedGame = null,
                                                           $isRequired = true,
                                                           $name = "game_name",
                                                           $id = "game_name") {
            $games = Constants::getGameArray();
            $requiredState = $isRequired == true ? "required" : "";
            $content = "";
            $content .= "<select class='form-control' name='$name' id='$id' $requiredState>\n";
            $content .= "<option value='' disabled>Игра</option>\n";


            for ($i = 0; $i<count($games); $i++) {

                $selectedState = $selectedGame == $games[$i] ? "selected" : "";
                $content .= "<option value='$games[$i]' $selectedState>$games[$i]</option>\n";
            }


            $content .= "</select>\n";
            return $content;
        });



    }
}