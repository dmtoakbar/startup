<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\Jobtag;
use App\Models\Jobcontent;
use Illuminate\Support\Facades\File;

class OfficeJobController extends Controller
{
    public function jobTag() {
        $jobtag = Jobtag::all()->sortByDesc("created_at");
        return view('office_admin.jobs.job_tags.job_tag', compact('jobtag'));
    }

    function tagJobAddAndEdit(Request $req)
     { 
         if ($req->isMethod('post')) {
             $check = Jobtag::where('name', trim($req->name))->get();
             if (count($check) <= 0) {
                 $tag = new Jobtag();
                 $tag->name = $req->name;
                 $saving_status = $tag->save();
                 if ($saving_status) {
                     Session::flash('success', 'Tag add successfully...');
                     return redirect()->route('office-job-tag');
                     exit();
                 } else {
                     Session::flash('failed', 'Tag adding failed...');
                     return redirect()->route('office-job-tag');
                     exit();
                 }
             } else {
                 Session::flash('warning', 'This tag already exist...');
                 return redirect()->route('office-job-tag');
                 exit();
             }
         } else if($req->isMethod('PUT')) {
            $check = Jobtag::where('name', trim($req->name))
                    ->where('id', '!=', $req->id)
                    ->get();
                if (count($check) <= 0) {
                    $update = Jobtag::findOrFail($req->id)->update(['name' => trim($req->name)]);
                    if ($update) {
                        Session::flash('success', 'Tag updated successfully...');
                        return redirect()->route('office-job-tag');
                        exit();
                    } else {
                        Session::flash('failed', 'Tag updation failed...');
                        return redirect()->route('office-job-tag');
                        exit();
                    }
                } else {
                    Session::flash('warning', 'This tag already exist...');
                    return redirect()->route('office-job-tag');
                    exit();
               }
            
         } else {
            return redirect()->route('office-job-tag');
            exit();
         }
     }

     function changeJobTagStatus(Request $req) {
        $tag = Jobtag::findOrFail($req->id);
        $tag->status = $req->status;
        $result = $tag->save();
        if ($result) {
            Session::flash('success', 'Tag status updated successfully...');
            return redirect()->route('office-job-tag');
            exit();
        } else {
            Session::flash('failed', 'Tag status updation failed...');
            return redirect()->route('office-job-tag');
            exit();
        }
    }

     // delete tag
     function deleteJobTag(Request $req)
     {
         $tag = Jobtag::findOrFail($req->id)->delete();
         if ($tag) {
             Session::flash('success', 'tag delete successfully...');
             return redirect()->route('office-job-tag');
             exit();
         } else {
             Session::flash('failed', 'tag deletion failed...');
             return redirect()->route('office-job-tag');
             exit();
         }
     }

    //  ---------------------------------- job content --------------------------------------
    public function jobContent() {
        $jobcontent = Jobcontent::all()->sortByDesc("created_at");
        return view('office_admin.jobs.job_contents.job_content', compact('jobcontent'));
    }

    function jobContentAdd(Request $req) {
        if($req->isMethod('POST')) {

            $req->validate([
                'title' => 'required',
                'tag' => 'required',
                'description' => 'required',
                'orgnisation_intro' => 'required',
                'important_dates' => 'required',
                'fee_structure' => 'required',
                'basic_qualifaction' => 'required',
                'detail_first' => 'required',
            ]);

            $jobcontent = new Jobcontent();
            $jobcontent->title = $req->title;
            $jobcontent->jobtag_id = $req->tag;
            $jobcontent->description = $req->description;
            $jobcontent->organisation_intro = $req->orgnisation_intro;
            $jobcontent->important_dates = $req->important_dates;
            $jobcontent->fee_structure = $req->fee_structure;
            $jobcontent->basic_qualifaction = $req->basic_qualifaction;
            $jobcontent->detail_first = $req->detail_first;
            if(isset($req->detail_second) && $req->detail_second != null) {
                $jobcontent->detail_second = $req->detail_second;
            }

            if(isset($req->detail_third) && $req->detail_third != null) {
                $jobcontent->detail_third = $req->detail_third;
            }

            $link = array();
            for($i = 0; $i < count($req->link); $i++) {
                $temp = array($req->link_title[$i], $req->link_name[$i], $req->link[$i]);
                $link[$i] = $temp;
            }
            $jobcontent->important_links = json_encode($link);

            $saving_status = $jobcontent->save();
            if ($saving_status) {
                Session::flash('success', 'Job Content add successfully...');
                return redirect()->route('office-job-content');
                exit();
            } else {
                Session::flash('failed', 'Job Content failed...');
                return redirect()->route('office-job-content');
                exit();
            }

        } else {
            return view('office_admin.jobs.job_contents.job_content_add');
        }
    }


    function jobContentEdit(Request $req) {
        if($req->isMethod('POST')) {

            $req->validate([
                'title' => 'required',
                'tag' => 'required',
                'description' => 'required',
                'orgnisation_intro' => 'required',
                'important_dates' => 'required',
                'fee_structure' => 'required',
                'basic_qualifaction' => 'required',
                'detail_first' => 'required',
            ]);

            $jobcontent = Jobcontent::findOrFail($req->id);
            $jobcontent->title = $req->title;
            $jobcontent->jobtag_id = $req->tag;
            $jobcontent->description = $req->description;
            $jobcontent->organisation_intro = $req->orgnisation_intro;
            $jobcontent->important_dates = $req->important_dates;
            $jobcontent->fee_structure = $req->fee_structure;
            $jobcontent->basic_qualifaction = $req->basic_qualifaction;
            $jobcontent->detail_first = $req->detail_first;
            $jobcontent->detail_second = trim($req->detail_second);
            $jobcontent->detail_third = trim($req->detail_third);

            $link = array();
            for($i = 0; $i < count($req->link); $i++) {
                $temp = array($req->link_title[$i], $req->link_name[$i], $req->link[$i]);
                $link[$i] = $temp;
            }
            $jobcontent->important_links = json_encode($link);

            $saving_status = $jobcontent->save();
            if ($saving_status) {
                Session::flash('success', 'Job Content updated successfully...');
                return redirect()->route('office-job-content');
                exit();
            } else {
                Session::flash('failed', 'Job Content updation failed...');
                return redirect()->route('office-job-content');
                exit();
            }

        } else {
            $jobcontent = Jobcontent::findOrFail($req->id);
            return view('office_admin.jobs.job_contents.job_content_edit', compact('jobcontent'));
        }
    }

    function changeJobContentStatus(Request $req) {
        $jobcontent = Jobcontent::findOrFail($req->id);
        $jobcontent->status = $req->status;
        $result = $jobcontent->save();
        if ($result) {
            Session::flash('success', 'Job content status updated successfully...');
            return redirect()->route('office-job-content');
            exit();
        } else {
            Session::flash('failed', 'Job content status updation failed...');
            return redirect()->route('office-job-content');
            exit();
        }
    }

    function deleteJobContent(Request $req)
     {
         $content = Jobcontent::findOrFail($req->id)->delete();
         if ($content) {
             Session::flash('success', 'Job content delete successfully...');
             return redirect()->route('office-job-content');
             exit();
         } else {
             Session::flash('failed', 'Job content deletion failed...');
             return redirect()->route('office-job-content');
             exit();
         }
     }

     function jobContentCopy(Request $req) {
        if($req->isMethod('POST')) {

            $req->validate([
                'title' => 'required',
                'tag' => 'required',
                'description' => 'required',
                'orgnisation_intro' => 'required',
                'important_dates' => 'required',
                'fee_structure' => 'required',
                'basic_qualifaction' => 'required',
                'detail_first' => 'required',
            ]);

            $jobcontent = new Jobcontent();
            $jobcontent->title = $req->title;
            $jobcontent->jobtag_id = $req->tag;
            $jobcontent->description = $req->description;
            $jobcontent->organisation_intro = $req->orgnisation_intro;
            $jobcontent->important_dates = $req->important_dates;
            $jobcontent->fee_structure = $req->fee_structure;
            $jobcontent->basic_qualifaction = $req->basic_qualifaction;
            $jobcontent->detail_first = $req->detail_first;
            $jobcontent->detail_second = trim($req->detail_second);
            $jobcontent->detail_third = trim($req->detail_third);

            $link = array();
            for($i = 0; $i < count($req->link); $i++) {
                $temp = array($req->link_title[$i], $req->link_name[$i], $req->link[$i]);
                $link[$i] = $temp;
            }
            $jobcontent->important_links = json_encode($link);

            $saving_status = $jobcontent->save();
            if ($saving_status) {
                Session::flash('success', 'Job Content added successfully...');
                return redirect()->route('office-job-content');
                exit();
            } else {
                Session::flash('failed', 'Job Content adding failed...');
                return redirect()->route('office-job-content');
                exit();
            }

        } else {
            $jobcontent = Jobcontent::findOrFail($req->id);
            return view('office_admin.jobs.job_contents.job_content_copy', compact('jobcontent'));
        }
    }

  public function jobContentPreview(Request $req) {
        $jobcontent = Jobcontent::findOrFail($req->id);
        return view('office_admin.jobs.job_contents.job_content_preview', compact('jobcontent'));
    }
}
