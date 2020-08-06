<?php

namespace App\Http\Controllers\Web;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers\Web
 */
class HomeController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('app.home.index');
    }
}