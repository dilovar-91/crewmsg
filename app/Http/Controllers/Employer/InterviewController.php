<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Interview;
use App\Models\User;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class InterviewController extends Controller
{
    
    public function welcome()
    {
        $user_id = Auth::user()->id;
        return view('employer.welcome')->with(array('user_id'=>$user_id)); 
        
    }
    public function create(Request $request)
    {
        $user_id = Auth::user()->id;
        return view('employer.add-interview')->with(array('user_id'=>$user_id)); 
        
    }

    public function interviews()
    {
        $user_id = Auth::user()->id;
        $interviews = Interview::with(['questions', 'quizzes'])->where('invite_id', $user_id)->orderBy('created_at', 'desc')->paginate(15); 
        return view('employer.interviews')->with(array('interviews'=>$interviews));
    }

    public function detail($id)
    {
        $interview = Interview::with(['questions', 'user', 'quizzes'])->where('id', $id)->first();
        //dd($interview);
        return view('employer.interview-detail')->with(array('interview'=>$interview));
    }
    public function edit($id)
    {
        $user_id = Auth::user()->id;
        $interview = Interview::with(['questions', 'user', 'quizzes'])->where('id', $id)->first();
        //dd($interview);
        return view('employer.interview-edit')->with(array('user_id'=>$user_id, 'interview'=>$interview));
    }
    public function delete($id)
    {
        $interview = Interview::findOrFail($id);
        $interview->delete(); //doesn't delete permanently    
        Question::where('interview_id', $id)->delete();
        Quiz::where('interview_id', $id)->delete();
        return redirect()->to('/employer/interviews');
       
    }

    public function save(Request $request)
    {
        $interview = new Interview;
        $interview->title = $request->title;
        $interview->invite_id = $request->user_id;
        $interview->vacancy_id = $request->vacancy['id'];
        $interview->description = $request->description;
               
        $interview->save(); 
        $interview_id = $interview->id;
        
        if(count($request->questions) > 0){
            foreach ($request->questions as $question){
            $questions[] = array(
                'interview_id'=>$interview_id,
                'question'=>$question['text'],
                'time'=>$question['time']                
            );
            }             
        }
        if(count($request->quizzes) > 0){
            
            foreach ($request->quizzes as $quiz){
                
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
        return response()->json($quizzes, 201);
    }
    public function update(Request $request)
    {
        //dd($request);
        
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
}
