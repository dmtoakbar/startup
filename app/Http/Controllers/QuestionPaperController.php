<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Models\Questionpaper;
use App\Models\Questionpaperfront;
use App\Models\Test;
use App\Models\Subject;
use Illuminate\Support\Facades\Crypt;

class QuestionPaperController extends Controller
{
    function index() {
    $all = Questionpaperfront::all()->sortByDesc('id');
    $question = Questionpaper::all()->sortByDesc('id');
    return view('office_admin.online_test.question_paper.question-paper', compact('all', 'question'));
    }
    // add question paper
    function add(Request $req)
    {
        if ($req->isMethod('post')) {
                $qpf = new Questionpaperfront();
                $qpf->test_name = $req->testName;
                $qpf->name = trim($req->qpfName);
                $qpf->sub_title = trim($req->subName);
                $qpf->total_question = trim($req->totalquestion);
                $qpf->total_number = trim($req->totalnumber);
                $qpf->minus_per_wrong_question = trim($req->minusNumber);
                $qpf->duration = trim($req->duration);
                $qpf->description = trim($req->description);
                $saving_status = $qpf->save();
                if ($saving_status) {
                    Session::flash('success', 'Question paper add successfully...');
                    return redirect()->route('office-questionpaper');
                    exit();
                } else {
                    Session::flash('failed', 'Question Paper adding failed...');
                    return redirect()->route('office-questionpaper');
                    exit();
                }
        } else {
            $test = Test::all()->sortByDesc('id');
            return view('office_admin.online_test.question_paper.question-paper-add', compact('test'));
        }
    }
    // edit
    function edit(Request $req) {
        if ($req->isMethod('post')) {
                $qpf = Questionpaperfront::findOrFail($req->id);
                $qpf->test_name = $req->testName;
                $qpf->name = trim($req->qpfName);
                $qpf->sub_title = trim($req->subName);
                $qpf->total_question = trim($req->totalquestion);
                $qpf->total_number = trim($req->totalnumber);
                $qpf->minus_per_wrong_question = trim($req->minusNumber);
                $qpf->duration = trim($req->duration);
                $qpf->description = trim($req->description);
                $saving_status = $qpf->save();
                if ($saving_status) {
                    Session::flash('success', 'Question paper updated successfully...');
                    return redirect()->route('office-questionpaper');
                    exit();
                } else {
                    Session::flash('failed', 'Question Paper updation failed...');
                    return redirect()->route('office-questionpaper');
                    exit();
                }
        } else {
            $qpf[0] = Questionpaperfront::findOrFail($req->id);
            $qpf[1] = Test::all()->sortByDesc('id');
            return view('office_admin.online_test.question_paper.question-paper-edit', compact('qpf'));
        }
    }
    // delete
    function delete(Request $req)
    {
        $qpf = Questionpaperfront::findOrFail($req->id)->delete();
        $question_exist = Questionpaper::where('questionpaperfronts_id', $req->id)->get();
        if(count($question_exist) > 0) {
            $q = Questionpaper::where('questionpaperfronts_id', $req->id)->delete();
        } else {
           $q = true;
        }

        if ($qpf && $q) {
            Session::flash('success', 'Question Paper delete successfully...');
            return redirect()->route('office-questionpaper');
            exit();
        } else {
            Session::flash('failed', 'Question Paper deletion failed...');
            return redirect()->route('office-questionpaper');
            exit();
        }
    }

    // change status
    function changeStatus(Request $req) {
        $status = Questionpaperfront::findOrFail($req->id);
        $status->status = $req->status;
        $result = $status->save();
        if ($result) {
            Session::flash('success', 'Question paper status updated successfully...');
            return redirect()->route('office-questionpaper');
            exit();
        } else {
            Session::flash('failed', 'Question paper status updation failed...');
            return redirect()->route('office-questionpaper');
            exit();
        }
    }
    // end change status

    // set payment
      function setPayment(Request $req) {
        $result = Questionpaperfront::findOrFail($req->id)->update(['payment_id' => $req->payment]);
        if ($result) {
            Session::flash('success', 'Question paper payment updated successfully...');
            return redirect()->route('office-questionpaper');
            exit();
        } else {
            Session::flash('failed', 'Question paper payment updation failed...');
            return redirect()->route('office-questionpaper');
            exit();
        }
      }
    // end set payment

    // question
    function question(Request $req) {
        $questions = Questionpaper::where('questionpaperfronts_id', trim($req->id))->get()->sortByDesc('id');
        $questionpaperfronts_id = trim($req->id);
        return view('office_admin.online_test.question_paper.question', compact('questions', 'questionpaperfronts_id'));
    }

    // question add
    function addQuestion(Request $req)
    {
        if ($req->isMethod('post')) {
                $q = new Questionpaper();
                $q->questionpaperfronts_id = trim($req->id);
                $q->subject = trim($req->subject);
                $q->direction = trim($req->direction);
                $q->mark = trim($req->mark);
                $q->negative = trim($req->negative);
                $q->question = trim($req->question);
                $q->a = trim($req->a);
                $q->b = trim($req->b);
                $q->c = trim($req->c);
                $q->d = trim($req->d);
                $q->e = trim($req->e);
                $q->answer = trim($req->answer);
                $q->description = trim($req->description);
                $saving_status = $q->save();

                if ($saving_status) {
                    Session::flash('success', 'Question add successfully...');
                    return redirect()->route('office-questionpaper-question', trim($req->id));
                    exit();
                } else {
                    Session::flash('failed', 'Question adding failed...');
                    return redirect()->route('office-questionpaper-question', trim($req->id));
                    exit();
                }
        } else {
            $id_subject[0] = trim($req->id);
            $id_subject[1] = Subject::all()->sortByDesc('id');
            return view('office_admin.online_test.question_paper.question-add', compact('id_subject'));
        }
    }
        // edit question
        function editQuestion(Request $req) {
        if ($req->isMethod('post')) {
                $q = Questionpaper::findOrFail($req->id);
                
                // for redirecting purpose
                $questionpaperfronts_ids = $q->questionpaperfronts_id;
                // end

                $q->subject = trim($req->subject);
                $q->direction = trim($req->direction);
                $q->mark = trim($req->mark);
                $q->negative = trim($req->negative);
                $q->question = trim($req->question);
                $q->a = trim($req->a);
                $q->b = trim($req->b);
                $q->c = trim($req->c);
                $q->d = trim($req->d);
                $q->e = trim($req->e);
                $q->answer = trim($req->answer);
                $q->description = trim($req->description);
                $saving_status = $q->save();
                 
                $questionpaperfronts_id = $questionpaperfronts_ids;

                if ($saving_status) {
                    Session::flash('success', 'Question updated successfully...');
                    return redirect()->route('office-questionpaper-question', $questionpaperfronts_id);
                    exit();
                } else {
                    Session::flash('failed', 'Question updation failed...');
                    return redirect()->route('office-questionpaper-question', $questionpaperfronts_id);
                    exit();
                }
        } else {
            $question = Questionpaper::findOrFail($req->id);
            $subject =Subject::all()->sortByDesc('id');
            return view('office_admin.online_test.question_paper.question-edit', compact('question', 'subject'));
        }
    }

     // delete question
   public function delQuestionOne(Request $req)
    {   
        $q = Questionpaper::findOrFail($req->id);        
        // for redirecting purpose
        $questionpaperfronts_ids = $q->questionpaperfronts_id;
        // end
        $qs = Questionpaper::findOrFail($req->id)->delete();

        $questionpaperfronts_id = $questionpaperfronts_ids;

        if ($qs) {
            Session::flash('success', 'Question delete successfully...');
            return redirect()->route('office-questionpaper-question', $questionpaperfronts_id);
            exit();
        } else {
            Session::flash('failed', 'Question deletion failed...');
            return redirect()->route('office-questionpaper-question', $questionpaperfronts_id);
            exit();
        }
    }
}
