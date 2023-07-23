<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class PageController.
 */
class PageController extends Controller
{
    /**
     * Show the application home page.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('frontend.home');
    }
}
