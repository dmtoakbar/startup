<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Subtag;
use App\Models\Digestcontent;
use Illuminate\Support\Facades\File;

class OfficeDigestController extends Controller
{
    function index()
    {
        $tag = Tag::all()->sortByDesc("created_at");
        return view('office_admin.daily_digest.tag.tag', compact('tag'));
    }

    // add
     function tagAddAndEdit(Request $req)
     { 
         if ($req->isMethod('post')) {
             $check = Tag::where('name', trim($req->name))->get();
             if (count($check) <= 0) {
                 $tag = new Tag();
                 $tag->name = $req->name;
                 $saving_status = $tag->save();
                 if ($saving_status) {
                     Session::flash('success', 'Tag add successfully...');
                     return redirect()->route('office-digest-tag');
                     exit();
                 } else {
                     Session::flash('failed', 'Tag adding failed...');
                     return redirect()->route('office-digest-tag');
                     exit();
                 }
             } else {
                 Session::flash('warning', 'This tag already exist...');
                 return redirect()->route('office-digest-tag');
                 exit();
             }
         } else if($req->isMethod('PUT')) {
            $check = Tag::where('name', trim($req->name))
                    ->where('id', '!=', $req->id)
                    ->get();
                if (count($check) <= 0) {
                    $update = Tag::findOrFail($req->id)->update(['name' => trim($req->name)]);
                    if ($update) {
                        Session::flash('success', 'Tag updated successfully...');
                        return redirect()->route('office-digest-tag');
                        exit();
                    } else {
                        Session::flash('failed', 'Tag updation failed...');
                        return redirect()->route('office-digest-tag');
                        exit();
                    }
                } else {
                    Session::flash('warning', 'This tag already exist...');
                    return redirect()->route('office-digest-tag');
                    exit();
               }
            
         } else {
            return redirect()->route('office-digest-tag');
         }
     }


      // delete tag
      function deleteTag(Request $req)
      {
          $tag = Tag::findOrFail($req->id)->delete();
          if ($tag) {
              Session::flash('success', 'tag delete successfully...');
              return redirect()->route('office-digest-tag');
              exit();
          } else {
              Session::flash('failed', 'tag deletion failed...');
              return redirect()->route('office-digest-tag');
              exit();
          }
      }

      // change tag status
       // change status
    function changeTagStatus(Request $req) {
        $tag = Tag::findOrFail($req->id);
        $tag->status = $req->status;
        $result = $tag->save();
        if ($result) {
            Session::flash('success', 'Tag status updated successfully...');
            return redirect()->route('office-digest-tag');
            exit();
        } else {
            Session::flash('failed', 'Tag status updation failed...');
            return redirect()->route('office-digest-tag');
            exit();
        }
    }

// --------------------- sub tag  operation-----------------
    function indexSubTag()
    {
        $subTag = Subtag::all()->sortByDesc("created_at");
        return view('office_admin.daily_digest.sub_tag.sub_tag', compact('subTag'));
    }


       // add
       function subTagAddAndEdit(Request $req)
       { 
           if ($req->isMethod('post')) {
               $check = Subtag::where('name', trim($req->name))
                      ->where('tag_id', $req->tag_id)
                      ->get();
               if (count($check) <= 0) {
                   $subTag = new Subtag();
                   $subTag->name = $req->name;
                   $subTag->tag_id = $req->tag_id;
                   $saving_status = $subTag->save();
                   if ($saving_status) {
                       Session::flash('success', 'Sub tag add successfully...');
                       return redirect()->route('office-digest-sub-tag');
                       exit();
                   } else {
                       Session::flash('failed', 'Sub tag adding failed...');
                       return redirect()->route('office-digest-sub-tag');
                       exit();
                   }
               } else {
                   Session::flash('warning', 'This sub tag already exist...');
                   return redirect()->route('office-digest-sub-tag');
                   exit();
               }
           } else if($req->isMethod('PUT')) {
              $check = Subtag::where('name', trim($req->name))
                      ->where('tag_id', $req->tag_id)
                      ->where('id', '!=', $req->id)
                      ->get();
                  if (count($check) <= 0) {
                      $update = Subtag::findOrFail($req->id);
                      $update->name = trim($req->name);
                      $update->tag_id = $req->tag_id;
                      if ($update->save()) {
                          Session::flash('success', 'Sub tag updated successfully...');
                          return redirect()->route('office-digest-sub-tag');
                          exit();
                      } else {
                          Session::flash('failed', 'Sub tag updation failed...');
                          return redirect()->route('office-digest-sub-tag');
                          exit();
                      }
                  } else {
                      Session::flash('warning', 'This sub tag already exist...');
                      return redirect()->route('office-digest-sub-tag');
                      exit();
                 }
              
           } else {
            return redirect()->route('office-digest-sub-tag');
           }
       }


    // change status
    function changeSubTagStatus(Request $req) {
        $subTag = Subtag::findOrFail($req->id);
        $subTag->status = $req->status;
        $result = $subTag->save();
        if ($result) {
            Session::flash('success', 'Sub tag status updated successfully...');
            return redirect()->route('office-digest-sub-tag');
            exit();
        } else {
            Session::flash('failed', 'Sub tag status updation failed...');
            return redirect()->route('office-digest-sub-tag');
            exit();
        }
    }

     // delete sub tag
     function deleteSubTag(Request $req)
     {
         $subTag = Subtag::findOrFail($req->id)->delete();
         if ($subTag) {
             Session::flash('success', 'Sub tag delete successfully...');
             return redirect()->route('office-digest-sub-tag');
             exit();
         } else {
             Session::flash('failed', 'Sub tag deletion failed...');
             return redirect()->route('office-digest-sub-tag');
             exit();
         }
     }

// --------------------------- end sub tag operation -------------------------

// --------------------------- digest content operation ---------------------
function indexDigest()
{
    $digest = Digestcontent::all()->sortByDesc("created_at");
    return view('office_admin.daily_digest.digest.digest', compact('digest'));
}

function addDigestContent(Request $req) {

    if(isset($req->tag_return_id)) {
     $subTag = Subtag::where('tag_id', $req->tag_id)->get();
     $count = $subTag->count();
     return response()->json(['sub_tag' => $subTag, 'count' => $count], 200);
     exit();
    } else if($req->isMethod('POST') & isset($req->add_conent_key))
     {
        $req->validate([
            'title' => 'required',
             'tag' => 'required',
             'content' => 'required'
        ]);

        $content = new Digestcontent();
        $content->title = $req->title;
        $content->content = trim($req->content);
        $content->tag_id = trim($req->tag);
        if(isset($req->sub_tag) & $req->sub_tag != null) {
            $content->subtag_id = $req->sub_tag;
        }
        if($req->hasfile('img'))
        {
            $file = $req->file('img');
            $extention = $file->getClientOriginalExtension();
            $filename = 'digest_content'.time().'.'.$extention;
            $file->move('image/digest_content/', $filename);
            $content->feature_img = $filename;
        }
        $saving_status = $content->save();
        if ($saving_status) {
            Session::flash('success', 'Content add successfully...');
            return redirect()->route('office-digest-content');
            exit();
        } else {
            Session::flash('failed', 'Content adding failed...');
            return redirect()->route('office-digest-content');
            exit();
        }

    } else {
        return view('office_admin.daily_digest.digest.digest_add');
        exit();
    }
    
}

function editDigestContent(Request $req) {
    if($req->isMethod('POST')) {
        $req->validate([
            'title' => 'required',
             'tag' => 'required',
             'content' => 'required'
        ]);

        $content = Digestcontent::findOrFail($req->id);
        $content->title = $req->title;
        $content->content = trim($req->content);
        $content->tag_id = trim($req->tag);
        if(isset($req->sub_tag) & $req->sub_tag != null) {
            $content->subtag_id = $req->sub_tag;
        }
        if($req->hasfile('img'))
        {
            $destination = 'image/digest_content/'.$content->feature_img;
            if(File::exists($destination))
            {
                File::delete($destination);
            }

            $file = $req->file('img');
            $extention = $file->getClientOriginalExtension();
            $filename = 'digest_content'.time().'.'.$extention;
            $file->move('image/digest_content/', $filename);
            $content->feature_img = $filename;
        }
        $saving_status = $content->save();
        if ($saving_status) {
            Session::flash('success', 'Content updated successfully...');
            return redirect()->route('office-digest-content');
            exit();
        } else {
            Session::flash('failed', 'Content updation failed...');
            return redirect()->route('office-digest-content');
            exit();
        }

    } else {
        $data = Digestcontent::findOrFail($req->id);
       return view('office_admin.daily_digest.digest.digest_edit', compact('data'));
       exit();
    }
}

 // change status
 function changeDigestContentStatus(Request $req) {
    $con = Digestcontent::findOrFail($req->id);
    $con->status = $req->status;
    $result = $con->save();
    if ($result) {
        Session::flash('success', 'Content status updated successfully...');
        return redirect()->route('office-digest-content');
        exit();
    } else {
        Session::flash('failed', 'Content status updation failed...');
        return redirect()->route('office-digest-content');
        exit();
    }
 }
  // delete
  function deleteDigestContent(Request $req)
  {
      $con = Digestcontent::find($req->id);
      $destination = 'image/digest_content/'.$con->feature_img;
      if(File::exists($destination))
      {
          File::delete($destination);
      }
      $c = $con->delete();
      if ($c) {
          Session::flash('success', 'Content delete successfully...');
          return redirect()->route('office-digest-content');
          exit();
      } else {
          Session::flash('failed', 'Content deletion failed...');
          return redirect()->route('office-digest-content');
          exit();
      }
  }


  public function digestContentPreview(Request $req) {
    $digestcontent = Digestcontent::findOrFail($req->id);
    return view('office_admin.daily_digest.digest.digest_content_preview', compact('digestcontent'));
}

//--------------------------- end digest content operation -----------------
    
}
