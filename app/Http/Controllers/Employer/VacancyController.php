<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{

    public function update(Request $request)
    {
        //dd($request);
        
        $vacancy_id = $request->vacancy_id;
        $vacancy = Vacancy::find($vacancy_id);
        $vacancy->title = $request->title;
        $vacancy->user_id = $request->user_id;
        $vacancy->pic = $request->image;
        $vacancy->description = $request->content;
        $vacancy->videointerview = $request->videointerview;
        $vacancy->test = $request->test;
        $vacancy->save();         
        return response()->json($vacancy, 201);
    }

    public function vacancies($user_id)
    {
        $vacancies = Vacancy::where('user_id', $user_id)->get();
        return response()->json($vacancies, 200);

    }
    public function candidates()
    {
        $vacancies = User::select('id','name')->with(['roles' => function($q){
            $q->where('name', 'seamen');
        }])->get();
        return response()->json($vacancies, 200);
        
    }
    public function allvacancies()
    {
        $vacancies = Vacancy::where('active', '1')->get();
        return response()->json($vacancies, 200);
        
    }

    public function imageUpload(Request $request)
    {
    	$imageName = time().'.'.$request->file->getClientOriginalExtension();
        $request->file->move(public_path('images/vacancy'), $imageName);         
    	return response()->json(['imageName'=>$imageName]);
    }


    public function save(Request $request)
    {
        $vacancy = new Vacancy;
        $vacancy->title = $request->title;
        $vacancy->user_id = $request->user_id;
        $vacancy->pic = $request->image;        
        $vacancy->description = $request->content;
        $vacancy->videointerview = ($request->videointerview == true ? 1 : 0);
        $vacancy->test = ($request->quiz == true ? 1 : 0);
        $vacancy->save();
        return response()->json($vacancy, 201);
        
    }
}
