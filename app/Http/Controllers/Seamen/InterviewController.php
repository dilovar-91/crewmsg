<?php

namespace App\Http\Controllers\Seamen;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\Interview;
use App\Models\User;
use App\Models\Invite;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ProcessVideoConvert;

class InterviewController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }

    public function index()
    {
        
    }
    public function detail($id)
    {
        $interview = Interview::with(['questions', 'user', 'questions.answer'])->first();
        //dd($interview);
        return view('seamen.interview_detail')->with(array('interview'=>$interview));
    }
    public function interview($id)
    {
        $interview = Interview::with(['questions', 'user', 'questions.answer'])->where('id', $id)->first();        
        return view('seamen.interview_detail')->with(array('interview'=>$interview));
    }
    public function quiz($interview_id)
    {
        $interview = Interview::with(['invite'])->where('id', $interview_id)->first();
        //dd($interview);
        return view('seamen.interview_quiz')->with(array('interview'=>$interview));
    }
    public function question($id)
    {
        $question = Question::with(['interview', 'invite'])->first();        
        return view('seamen.interview_question')->with(array('question'=>$question));
    }
    public function record($interview_id)
    {
        $interview = Interview::with(['questions', 'invite.feedback'])->first();
        //dd($interview);
        return view('seamen.interview_record')->with(array('interview'=>$interview));
    }

    public function videoSend(Request $request){
        return response()->json($request, 200);
        $data = $this->validate($request, [
            'file'        => 'required',
        ]);
        $filename = time() . "_". uniqid();
        Storage::disk('public')
            ->put('videos/'.$filename.'.webm', file_get_contents($request->file));
        
        $feedback = new Feedback();
        $feedback->invite_id = $request->invite_id;
        $feedback->user_id = $request->user_id;
        $feedback->video = $filename.'.mp4';
        $feedback->comment = $request->comment ?? '';
        $feedback->save();
        ProcessVideoConvert::dispatch($feedback);
        return response()->json($feedback, 201);
    }


    public function quizzes($interview_id)
    {
        $quizzes = Interview::with(['quizzes', 'invite'])->where('id', $interview_id)->first();
        return response()->json($quizzes, 200);
        
    }
    public function questions($interview_id)
    {
        $questions = Interview::with(['questions', 'invite'])->where('id', $interview_id)->first();
        return response()->json($questions, 200);
        
    }

    public function quizResult(Request $request){
        $result = new QuizResult;
        $result->score = $request->score;
        $result->user_id = $request->user_id;
        $result->invite_id = $request->invite_id;
        $result->save();
        return response()->json($result, 201);
    }
    public function invited(Request $request){       
        $invite = Invite::find($request->input('invite_id'));
        $invite->completed = 1;
        $invite->save();
        return response()->json($invite, 201);
    }
}
