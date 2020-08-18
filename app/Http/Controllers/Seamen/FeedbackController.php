<?php

namespace App\Http\Controllers\Seamen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Interview;
use App\Models\User;
use App\Models\Invite;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Feedback;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function index()
    {
        $user_id = Auth::user()->id;
        $feedback = Feedback::with(['user', 'answers', 'answers.question', 'invite.interview', 'invite.inviter'])->where('user_id', 15)->get();
        //dd($feedback);
        return view('seamen.feedback')->with(array('feedback'=>$feedback)); 
    }
    public function detail($id)
    {
        $user_id = Auth::user()->id;
        $feedback = Feedback::with(['user', 'answers', 'answers.question', 'invite.interview', 'invite.inviter'])->where('id', $id)->where('user_id', $user_id)->first();
        dd($feedback);
        return view('seamen.feedback-detail')->with(array('feedback'=>$feedback)); 
    }
    public function answers($id)
    {
       
        $answers = Answer::with(['user', 'question', 'feedback', 'feedback.invite.inviter'])->where('feedback_id', $id)->get();
        return response()->json($answers, 200);
        //return view('seamen.feedback-detail')->with(array('answers'=>$answers)); 
    }
}
