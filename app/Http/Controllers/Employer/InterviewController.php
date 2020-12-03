<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Interview;
use App\Models\Invite;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class InterviewController extends Controller
{

    public function delete($id)
    {
        $interview = Interview::findOrFail($id);
        $interview->delete(); //doesn't delete permanently    
        Question::where('interview_id', $id)->delete();
        Quiz::where('interview_id', $id)->delete();
        return redirect()->to('/employer/interviews');
       
    }

    public function create(Request $request)
    {
        //return response()->json($request, 201);
        $interview = new Interview;
        $interview->title = $request->item['title'];
        $interview->invite_id = $request->item['invite_id'];
        $interview->vacancy_id = $request->item['vacancy_id'];
        $interview->description = $request->item['description'];
        $interview->save();
        $interview_id = $interview->id;
        if(count($request->item['questions']) > 0){
            foreach ($request->item['questions'] as $question){
                $questions[] = array(
                    'interview_id'=>$interview_id,
                    'question'=>$question['text'],
                    'time'=>$question['time']
                );
            }
        }
        if(count($request->item['quizzes']) > 0){
            foreach ($request->item['quizzes'] as $quiz){
                $ans = array($quiz['option1'], $quiz['option2'], $quiz['option3'], $quiz['option4']);
                $quizzes[] = [
                    'interview_id'=>$interview_id,
                    'question'=>$quiz['text'],
                    'option1'=>$quiz['option1'],
                    'option2'=>$quiz['option2'],
                    'option3'=>$quiz['option3'],
                    'option4'=>$quiz['option4'],
                    'correct'=>$quiz['answer']
                ];
            }
        }
        Question::insert($questions);
        Quiz::insert($quizzes);
        return response()->json($interview, 201);


    }
    public function update(Request $request)
    {

        $interview_id = $request->interview_id;
        $interview = Interview::find($interview_id);
        $interview->title = $request->title;
        $interview->invite_id = $request->user_id;
        $interview->vacancy_id = $request->vacancy;
        $interview->description = $request->description;
        $interview->save();         
        Question::where('interview_id', $interview_id)->delete();
        Quiz::where('interview_id', $interview_id)->delete();
        if(count($request->questions) > 0){
            foreach ($request->questions as $question){
            $questions[] = array(
                'interview_id'=>$interview_id,
                'question'=>$question['question'],
                'time'=>$question['time']                
            );
            }             
        }
        if(count($request->quizzes) > 0){
            
            foreach ($request->quizzes as $quiz){
            $ans = array($quiz['option1'], $quiz['option2'], $quiz['option3'], $quiz['option4']);
                $quizzes[] = [
                'interview_id'=>$interview_id,
                'question'=>$quiz['question'],
                'option1'=>$quiz['option1'],                
                'option2'=>$quiz['option2'],                
                'option3'=>$quiz['option3'],                
                'option4'=>$quiz['option4'],
                'correct'=>$quiz['correct']
            ];
            }              
        }
        Question::insert($questions);
        Quiz::insert($quizzes);
        return response()->json($quizzes, 201);
    }

    public function getInterview($interview_id){
        $interview = Interview::with(['questions', 'user', 'quizzes'])->where('id', $interview_id)->first();
        return response()->json($interview, 200);
    }

    public function getInterviews ($id)
    {
        $interviews = Interview::with(['vacancy', 'questions'])->where('invite_id', $id)->get();
        return response()->json($interviews, 201);
    }
}
