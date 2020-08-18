<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Interview;
use App\Models\User;
use App\Models\Invite;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewUserNotification;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmail;


class InviteController extends Controller
{
    
    public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employer.index');
    }

    public function sendinvites(Request $request){        
        //dd($request->invites);
        
        foreach($request->invites as $key){         
           if($key['checked'] == false) break;
            $details = array(
                            'vacancy_id'=>$key['vacancy'],
                            'candidate'=>$key['candidate'],
                            'email'=>$key['email'],
                            'phone'=>$key['phone'],
                            'invited_by_id'=>14,
                );                
                SendEmail::dispatch($details);

        }

        //$result  = Invite::insert($data);
        return response()->json("Sended", 201);
    }


    public function response()
    {
        $user_id = Auth::user()->id;
        $feedback = Feedback::with(['invite.interview', 'invite.inviter'])->where('user_id', 15)->get();
        //dd($feedback);
        return view('employer.response')->with(array('feedback'=>$feedback)); 
    }


    
    
}
