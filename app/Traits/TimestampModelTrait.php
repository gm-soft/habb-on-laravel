<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/13/18
 * Time: 7:12 PM
 */

namespace App\Traits;


trait TimestampModelTrait
{
    public function CreatedAt($format = "d.m.Y"){
        return $this->created_at->format($format);
    }

    public function UpdatedAt($format = "d.m.Y"){
        return $this->updated_at->format($format);
    }
}