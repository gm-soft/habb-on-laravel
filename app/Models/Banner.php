<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelArdent\Ardent\Ardent;

/**
 * Class Banner
 *
 * @package App\Models
 */
class Banner extends Ardent
{
    use SoftDeletes;

    public static $rules = [

    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $table = "banners";
}
