<?php

namespace App\Http\Controllers\Sailor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Interview;
Use App\Models\Invite;

class InterviewController extends Controller
{
    public function getInterview($interview_id)
    {
        $interview = Interview::with(['questions', 'user', 'questions.answer'])->where('id', $interview_id)->first();
        return response()->json($interview, 201);
    }

    public function getUserInterviews($id)
    {
        $interviews = Invite::with(['interview'])->where('user_id', $id)->get();
        return response()->json($interviews, 201);
    }
}
