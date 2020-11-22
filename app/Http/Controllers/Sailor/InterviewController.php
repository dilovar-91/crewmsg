<?php

namespace App\Http\Controllers\Sailor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Interview;
Use App\Models\Question;

class InterviewController extends Controller
{
    public function getQuestions($interview_id)
    {
        //$questions = Question::where('interview_id', $interview_id)->first();
        
        return response()->json($questions, 201);
    }
    public function getInterview($interview_id)
    {
        //$interview = Interview::with(["invite", 'questions'])->where('id', $interview_id)->first();
        $interview = Interview::with(['questions', 'user', 'questions.answer'])->where('id', $interview_id)->first();      
        return response()->json($interview, 201);
    }
}
