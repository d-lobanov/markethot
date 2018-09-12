<?php

namespace Market\Http\Controllers;

use Illuminate\View\View;
use Market\Console\Services\ProductRepository;

class HomePageController extends Controller
{
    /**
     * @param ProductRepository $repository
     * @return View
     */
    public function index(ProductRepository $repository)
    {
        return view('homepage', [
            'products' => $repository->getBestSelling(),
        ]);
    }
}
