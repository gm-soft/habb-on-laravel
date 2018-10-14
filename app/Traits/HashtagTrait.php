<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/13/18
 * Time: 9:43 PM
 */

namespace App\Traits;


use App\Helpers\VarDumper;

trait HashtagTrait
{

    /**
     * @return string[]
     */
    public function getHashtagsAsArray()
    {
        $hashtags = explode(',', $this->hashtags);

        $result = [];
        foreach ($hashtags as $hashtag){

            $trimmed = trim($hashtag);

            if ($trimmed != '')
                $result[] = $trimmed;
        }

        return $result;
    }
}