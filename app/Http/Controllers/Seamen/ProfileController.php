<?php

namespace App\Http\Controllers\Seamen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\School;
use App\Models\Document;
use App\Models\Country;
use App\Models\DocType;
use App\Models\SeaService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $user = User::with(['roles'])->where('id', $user_id)->first();
        $education = School::where('user_id', $user_id)->get();
        $services = SeaService::with(['country'])->where('user_id', $user_id)->get();
        
        $documents = Document::with(['doctype', 'country'])->where('user_id', $user_id)->get();
        return view('seamen.profile.index')->with(array('user'=>$user, 'education'=>$education, 'documents'=>$documents, 'services'=>$services));
    }
    public function userinfo($id)
    {
        
        $user = User::with(['roles'])->where('id', $id)->first();
        return response()->json($user, 200);
        
    }
    public function editschool()
    {
        $education = School::where('user_id', Auth::user()->id)->get();
        return view('seamen.profile.school')->with(array('education'=>$education));
    }
    public function editpersonal()
    {
        $user_id = Auth::user()->id;
        $user = User::with(['roles'])->where('id', $user_id)->first();
        return view('seamen.profile.personalinfo')->with(array('user'=>$user));
    }
    public function editmaininfo()
    {
        $user_id = Auth::user()->id;
        $user = User::with(['roles'])->where('id', $user_id)->first();
        return view('seamen.profile.maininfo')->with(array('user'=>$user));
    }
    public function editadress()
    {
        $user_id = Auth::user()->id;
        $user = User::with(['roles'])->where('id', $user_id)->first();
        return view('seamen.profile.adress')->with(array('user'=>$user));
    }
    public function editservice()
    {
        $user_id = Auth::user()->id;
        $user = User::with(['roles'])->where('id', $user_id)->first();
        return view('seamen.profile.service')->with(array('user'=>$user));
    }

    public function updatepersonal(Request $request)
    {
        $data =  $request->post('data');
        $user  = User::findOrFail($data['id']);
        $user->surname = $data['surname'];
        $user->first_name = $data['first_name'];
        $user->other_name = $data['other_name'];
        $user->date_of_birth = $data['date_of_birth'];
        $user->place_of_birth = $data['place_of_birth'];
        $user->sex = $data['sex'];
        $user->citizenship = $data['citizenship'];
        $user->marital_status = $data['marital_status'];
        $user->colour_of_eyes = $data['colour_of_eyes'];
        $user->colour_of_hair = $data['colour_of_hair'];
        $user->height = $data['height'];
        $user->weight = $data['weight'];
        $user->boilersuit_size = $data['boilersuit_size'];
        $user->boots_size = $data['boots_size'];
        $user->language = $data['language'];
        $user->level = $data['level'];
        $user->save();
        return response()->json($user, 201);
    }
    public function updatemaininfo(Request $request)
    {
        $data =  $request->post('data');
        $user  = User::findOrFail($data['id']);
        $user->position_as = $data['position_as'];
        $user->position_other = $data['position_other'];
        $user->ready_from = $data['ready_from'];
        $user->salary = $data['salary'];
        $user->save();
        return response()->json($user, 201);
    }
    public function updateaddress(Request $request)
    {
        $data =  $request->post('data');
        $user  = User::findOrFail($data['id']);
        $user->country = $data['country'];
        $user->city = $data['city'];
        $user->post_code = $data['post_code'];
        $user->mobile = $data['mobile'];
        $user->email = $data['email'];
        $user->skype = $data['skype'];
        $user->next_of_kin = $data['next_of_kin'];
        $user->kin_surname = $data['kin_surname'];
        $user->kin_adress = $data['kin_adress'];
        $user->kin_mobile = $data['kin_mobile'];
        $user->save();
        return response()->json($user, 201);
    }
    public function editdoc()
    {
        //$education = School::where('user_id', Auth::user()->id)->get();
        return view('seamen.profile.document');
    }
    public function documents($id = null)
    {
        $document = Document::where('user_id', $id)->with(['doctype','country'])->get();
        return response()->json($document, 200);
    }
    public function services($id = null)
    {
        $services = SeaService::where('user_id', $id)->with(['country'])->get();
        return response()->json($services, 200);
    }
    public function userschools($id = null)
    {
        $education = School::where('user_id', $id)->get();
        return response()->json($education, 200);
    }
    public function addschool(Request $request)
    {
        $school = new School;
        //print_r($request->post('data'));
        $data =  $request->post('data');
        $from = date('Y-m-d', strtotime($data['from']));
        $to = date('Y-m-d', strtotime($data['to']));
        $school->user_id = $data['user_id'];
        $school->name = $data['name'];
        $school->from = $from;
        $school->to = $to;
        $school->save();
        return response()->json($school, 201);
    }

    public function addservice(Request $request)
    {
        $service = new SeaService;
        //print_r($request->post('data'));
        $data =  $request->post('data');
        $from = date('Y-m-d', strtotime($data['from']));
        $till = date('Y-m-d', strtotime($data['till']));
        $service->user_id = $data['user_id'];
        $service->position = $data['position'];
        $service->vessel_name = $data['vessel_name'];
        $service->vessel_type = $data['vessel_type'];
        $service->me_type = $data['me_type'];
        $service->from = $from;
        $service->till = $till;
        $service->shipowner = $data['shipowner'];
        $service->country_id = $data['country_id'];
        $service->save();
        return response()->json($service, 201);
    }
    
    public function updateservice(Request $request)
    {
        $data =  $request->post('data');
        $service  = SeaService::findOrFail($data['id']);
        $from = date('Y-m-d', strtotime($data['from']));
        $till = date('Y-m-d', strtotime($data['till']));
        $service->user_id = $data['user_id'];
        $service->position = $data['position'];
        $service->vessel_name = $data['vessel_name'];
        $service->vessel_type = $data['vessel_type'];
        $service->me_type = $data['me_type'];
        $service->from = $from;
        $service->till = $till;
        $service->shipowner = $data['shipowner'];
        $service->country_id = $data['country_id'];
        $service->save();
        return response()->json($service, 201);
    }
    

    public function updateschool(Request $request)
    {
        $data =  $request->post('data');
        $school  = School::findOrFail($data['id']);
        $from = date('Y-m-d', strtotime($data['from']));
        $to = date('Y-m-d', strtotime($data['to']));
        $school->user_id = $data['user_id'];
        $school->name = $data['name'];
        $school->from = $from;
        $school->to = $to;
        $school->save();
        return response()->json($school, 201);
    }
    
    public function schooldelete($id = null)
    {
        $school = School::find($id);
        $school->delete();
        return response()->json($school, 201);
    }



    public function documentadd(Request $request)
    {
        $document = new Document;
        //print_r($request->post('data'));
        $data =  $request->post('data');
        $date_of_issue = date('Y-m-d', strtotime($data['valid_untill']));
        $valid_untill = date('Y-m-d', strtotime($data['valid_untill']));
        $document->user_id = $data['user_id'];
        $document->title = $data['title'];
        $document->number = $data['number'];
        $document->doctype_id = $data['doctype_id'];
        $document->country_id = $data['country_id'];
        $document->date_of_issue = $date_of_issue;
        $document->valid_untill = $valid_untill;
        $document->save();
        return response()->json($document, 201);
    }

    public function updatedocument(Request $request)
    {
        
        $data =  $request->post('data');
        $document  = Document::findOrFail($data['id']);
        $date_of_issue = date('Y-m-d', strtotime($data['valid_untill']));
        $valid_untill = date('Y-m-d', strtotime($data['valid_untill']));
        $document->user_id = $data['user_id'];
        $document->title = $data['title'];
        $document->number = $data['number'];
        $document->doctype_id = $data['doctype_id'];
        $document->country_id = $data['country_id'];
        $document->date_of_issue = $date_of_issue;
        $document->valid_untill = $valid_untill;
        $document->save();
        return response()->json($document, 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function countries()
    {
        $countries = Country::get();
        return response()->json($countries, 200);
    }
    public function doctypes()
    {
        $doctypes = DocType::get();
        return response()->json($doctypes, 200);
    }
}
