<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Homecontentname;
use App\Models\Carousel;
use Illuminate\Support\Facades\File;

class SiteHomePageController extends Controller
{
    function index() {
        return view('office_admin.site_home_page.home');
    }
    function homeContentName() {
        $contentname = Homecontentname::all()->sortByDesc('id');
        return view('office_admin.site_home_page.home_content_name.home-content-name', compact('contentname'));
    }
    function homeContentNameAdd(Request $req) {
        if ($req->isMethod('post')) {
            $check = Homecontentname::where('name', trim($req->contentName))->get();
            if (count($check) <= 0) {
                $c = new Homecontentname();
                $c->name = $req->contentName;
                $saving_status = $c->save();
                if ($saving_status) {
                    Session::flash('success', 'Content name add successfully...');
                    return redirect()->route('office-site-home-page-content-name');
                    exit();
                } else {
                    Session::flash('failed', 'Content name adding failed...');
                    return redirect()->route('office-site-home-page-content-name');
                    exit();
                }
            } else {
                Session::flash('warning', 'This content name already exist...');
                return redirect()->route('office-site-home-page-content-name');
                exit();
            }
        } else {
            return view('office_admin.site_home_page.home_content_name.home-content-name-add');
        }
    }

    function homeContentNameEdit(Request $req) {
        if ($req->isMethod('post')) {
            $check = Homecontentname::where('name', trim($req->contentName))->get();
            if (count($check) <= 0) {
                $c = Homecontentname::find($req->id);
                $c->name = $req->contentName;
                $saving_status = $c->save();
                if ($saving_status) {
                    Session::flash('success', 'Content name updated successfully...');
                    return redirect()->route('office-site-home-page-content-name');
                    exit();
                } else {
                    Session::flash('failed', 'Content name updation failed...');
                    return redirect()->route('office-site-home-page-content-name');
                    exit();
                }
            } else {
                Session::flash('warning', 'This content name already exist...');
                return redirect()->route('office-site-home-page-content-name');
                exit();
            }
        } else {
            $content = Homecontentname::find($req->id);
            return view('office_admin.site_home_page.home_content_name.home-content-name-edit', compact('content'));
        }
    }

    function homeContentNameDelete(Request $req) {
        $c = Homecontentname::find($req->id)->delete();
        if ($c) {
            Session::flash('success', 'Content name delete successfully...');
            return redirect()->route('office-site-home-page-content-name');
            exit();
        } else {
            Session::flash('failed', 'Content name deletion failed...');
            return redirect()->route('office-site-home-page-content-name');
            exit();
        }
    }


    // carousel
    function carousel() {
        $carousel = Carousel::all()->sortByDesc('id');
        return view('office_admin.site_home_page.carousel.carousel', compact('carousel'));
    }
     // add carousel
     function carouselAdd(Request $req)
    {
        if ($req->isMethod('post')) {
          $carousel = new Carousel();
          $carousel->title = trim($req->input('title'));
          $carousel->describe = trim($req->input('describe'));
          $carousel->link = trim($req->input('link'));
          if($req->hasfile('image'))
        {
            $file = $req->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = 'carousel'.time().'.'.$extention;
            $file->move('image/carousel/', $filename);
            $carousel->image = $filename;
        }
        $saving_status = $carousel->save();
        if ($saving_status) {
            Session::flash('success', 'Carousel add successfully...');
            return redirect()->route('office-site-home-page-carousel');
            exit();
        } else {
            Session::flash('failed', 'Carousel adding failed...');
            return redirect()->route('office-site-home-page-carousel');
            exit();
        }
        } else {
            return view('office_admin.site_home_page.carousel.carousel-add');
        }
    }

     // edit carousel
     function carouselEdit(Request $req)
    {
        if ($req->isMethod('post')) {
          $carousel = Carousel::find($req->id);
          $carousel->title = trim($req->input('title'));
          $carousel->describe = trim($req->input('describe'));
          $carousel->link = trim($req->input('link'));
          if($req->hasfile('image'))
        {
            $destination = 'image/carousel/'.$carousel->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }

            $file = $req->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = 'carousel'.time().'.'.$extention;
            $file->move('image/carousel/', $filename);
            $carousel->image = $filename;
        }
        $saving_status = $carousel->save();
        if ($saving_status) {
            Session::flash('success', 'Carousel updated successfully...');
            return redirect()->route('office-site-home-page-carousel');
            exit();
        } else {
            Session::flash('failed', 'Carousel updating failed...');
            return redirect()->route('office-site-home-page-carousel');
            exit();
        }
        } else {
            $carousel = Carousel::find($req->id);
            return view('office_admin.site_home_page.carousel.carousel-edit', compact('carousel'));
        }
    }

      // delete carousel
      function carouselDelete(Request $req)
    {
        $carousel = Carousel::find($req->id);
        $destination = 'image/carousel/'.$carousel->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $c = $carousel->delete();
        if ($c) {
            Session::flash('success', 'Carousel delete successfully...');
            return redirect()->route('office-site-home-page-carousel');
            exit();
        } else {
            Session::flash('failed', 'Carousel deletion failed...');
            return redirect()->route('office-site-home-page-carousel');
            exit();
        }
    }
}
