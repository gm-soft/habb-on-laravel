<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/13/18
 * Time: 9:43 PM
 */

namespace App\Traits;


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
            $result[] = trim($hashtag);
        }

        return $result;
    }
}