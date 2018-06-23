<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 23.06.18
 * Time: 12:49
 */

namespace App\Helpers;


abstract class HttpStatuses
{
    const Ok = 200;

    const AuthorizeRequired = 401;

    const NotFound = 404;

    const ServerError = 500;
}