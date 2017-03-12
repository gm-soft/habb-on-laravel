<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->View('front.home.index');
    }

    public function news() {
        return $this->View('front.home.news');
    }

    public function about() {
        return $this->View('front.home.about');
    }

    public function contacts() {
        return $this->View('front.home.contacts');
    }
}
