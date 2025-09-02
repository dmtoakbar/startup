<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;
use App\Models\Service;
use App\Models\Test;
use App\Models\Questionpaperfront;
use Session;

class SiteIndexPageController extends Controller
{
    function index()
    {
        $carousel = Carousel::all()->sortByDesc('id');
        return view('index', compact('carousel'));
    }

    function testCollection(Request $req)
    {
        $test = Test::findOrFail(trim($req->id));
        $testName = $test->name;
        $testCollection = Questionpaperfront::where('test_name', $testName)->select()->get()->unique('name')->sortByDesc('id');

        return view('test-collection', compact('testCollection'));
    }

    function testCollectionParticular(Request $req)
    {
        $test = Questionpaperfront::findOrFail(trim($req->id));
        $testName = $test->name;
        $testCollection = Questionpaperfront::where('name', $testName)->get()->sortByDesc('id');

        return view('test-collection-particular', compact('testCollection'));
    }
}
