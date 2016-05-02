<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use App\Question;
use App\Device;
use App\Radioresponses;
use App\Checkresponses;
use App\Rating_bar_responses;
use App\slider_responses;
class survey_responseController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{


		 if ($request->user()) {
         
          //echo '<pre>'.print_r($request->user()->id,1) .'</pre>';
        }

  //        // get questions 

  //        $questions = Question::where('client_id',$request->user()->id)
  //                              ->join('response_types','questions.response_type_id','=','response_types.type_id')
  //                              ->orderBy('id', 'desc')
  //                              ->get();
  //         //echo '<pre>'.print_r($questions,1) .'</pre>';exit;                   

  //        $data['questions']=  $questions;

  //        foreach ($questions as $flight) {
  //        	       //echo $flight->value;
  //                   //echo '<pre>'.print_r($flight->value,1) .'</pre>';
  //                 }

		// //return view('questions');

		// //return View::make('questions')->with('title', 'Survey Qusestions')->with('questions',Question::all());
	
  //        return view('questions', $data );
		return view('survey_response');
	}

	function survey_responses(Request $request){
		$surveys = Device::where('client_id','4')
		                     ->join('sessions','devices.id','=','sessions.device_id')
		                     ->join('surveys_session_answer_transactions','sessions.id','=','surveys_session_answer_transactions.session_id')
		                     ->join('response_types','surveys_session_answer_transactions.response_type_id','=','response_types.type_id')
		                     ->get();

        $data=[];
		if(isset($surveys)){
                  foreach($surveys as $key => $value)
                  {

                  	
                  	$answer_text='';

                  	if ($surveys[$key]->response_type_id=='1'){
                          
                  		$answer_text='<div class="radio"> <label> <input type="radio" checked>'.$surveys[$key]->answer_text.'<label></div>';

			             $answer_text="";           

                  		$radioresponses=Radioresponses::where('question_id',$surveys[$key]->question_id)
                                         ->get(); 
                       
                        
                        foreach ($radioresponses as $keya => $value) {
                                 
                        	$answer_text=$answer_text."<div class='radio'><label><input type='radio' >".$radioresponses[$keya]->response."</label></div>";
                                        }        
                             $surveys[$key]->options= $answer_text;        
                  		
                  	}

                  	if ($surveys[$key]->response_type_id=='4'){
                          
                  		$answer_text='<div class="checkbox"> <label> <input type="checkbox" checked>'.$surveys[$key]->answer_text.'<label></div>';

			             $answer_text="";           

                  		$radioresponses=Checkresponses::where('question_id',$surveys[$key]->question_id)
                                         ->get(); 
                       
                        
                        foreach ($radioresponses as $keya => $value) {
                                 
                        	$answer_text=$answer_text."<div class='checkbox'><label><input type='checkbox' >".$radioresponses[$keya]->response."</label></div>";
                                        }        
                             $surveys[$key]->options= $answer_text;        
                  		
                  	}

                  	if ($surveys[$key]->response_type_id=='3'){
                      $radioresponses=Rating_bar_responses::where('question_id',$surveys[$key]->question_id)
                                         ->get(); 
                          
                       $surveys[$key]->options= "Maximum Value:   ".$radioresponses[0]->maximum_value;

                   }
                   if ($surveys[$key]->response_type_id=='5'){
                      $radioresponses=Slider_responses::where('question_id',$surveys[$key]->question_id)
                                         ->get(); 
                          
                       $surveys[$key]->options="minimum Value:   ".$radioresponses[0]->maximum_value. "Maximum Value:   ".$radioresponses[0]->maximum_value;

                   }
                    
                  }  
                  }                   
      $data = array('data' => $surveys);
      echo json_encode($data);
	  //echo '<pre>'.print_r($data,1) .'</pre>';                    
	}

}
