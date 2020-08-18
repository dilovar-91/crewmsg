<?php

namespace App\Http\Controllers\Seamen;

use App\Http\Controllers\Controller;
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
        $data = $this->validate($request, [
            'blob'        => 'required',
        ]);
        $filename = uniqid();
        Storage::disk('public')
            ->put('videos/'.$filename.'.webm', file_get_contents($request->blob));
        
        $answer = new Answer;
        $answer->invite_id = $request->invite_id;
        $answer->question_id = $request->question_id;
        $answer->answer = $filename.'.mp4';
        $answer->user_id = $request->user_id;
        $answer->comment = $request->comment ?? '';
        $answer->save();
        ProcessVideoConvert::dispatch($answer);
        // return response()->json(['status'=>'success']);
        return response()->json($answer, 201);
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
