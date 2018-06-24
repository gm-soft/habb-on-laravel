<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 23.06.18
 * Time: 13:52
 */

namespace Tests\app\Http\Controllers;


use App\Helpers\HttpStatuses;
use Tests\TestCase;

class FrontControllerTest extends TestCase
{
    public function test_index()
    {
        $response = $this->get('/');

        $response->assertStatus(HttpStatuses::Ok);
    }
}