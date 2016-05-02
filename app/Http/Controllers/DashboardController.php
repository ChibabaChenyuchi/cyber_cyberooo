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
class DashboardController extends Controller {

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

 
		return view('dashboard');
	}

	function survey_responses(Request $request){
		$surveys = Device::where('client_id','3')
		                     ->join('sessions','devices.id','=','sessions.device_id')
		                     ->join('surveys_session_answer_transactions','sessions.id','=','surveys_session_answer_transactions.session_id')
		                     ->join('response_types','surveys_session_answer_transactions.response_type_id','=','response_types.type_id')
		                     ->groupBy('question_id')
		                     ->get();

       $arr = array();

      foreach($surveys as $key => $item)
      {
         $arr[$item['question_id']][$key] = $item;
      }

      ksort($arr, SORT_NUMERIC);
       
        foreach ($surveys as $key => $value) {
        	# code...
        	$options=null;
        	 var_dump($value->question_id); // <---- or toJson()
        	 var_dump($value->response_type_id);
        	 if ($value->response_type_id==1) {
        	 	# code...
        	 	$options=Radioresponses::where('question_id',$value->question_id)
                                         ->get(); 

                          foreach ($options as $optionskey => $optionsvalue) {
                                         	# code...
                                $optioncount=Device::where('client_id','3')
                                                     ->where('question_id',$value->question_id)
                                                     ->where('response_type_id',$value->response_type_id)
                                                     ->where('answer_id',$optionsvalue->id)
								                     ->join('sessions','devices.id','=','sessions.device_id')
								                     ->join('surveys_session_answer_transactions','sessions.id','=','surveys_session_answer_transactions.session_id')
								                     ->join('response_types','surveys_session_answer_transactions.response_type_id','=','response_types.type_id')
								                     ->get()
								                     ->count();
								    echo '<pre>';
								    var_dump('number on '.$optionsvalue->response."  ".$optioncount); 

								    echo '</pre>';                
                                         }               
           //    echo '<pre>';
        	  // var_dump($options->toArray());
        	  // echo '</pre>';                       
        	 }
        	 if ($value->response_type_id==4) {
        	 	# code...

        	 	echo "pano";
        	 	$options=Checkresponses::where('question_id',$value->question_id)
                                         ->get(); 
                           foreach ($options as $optionskey => $optionsvalue) {
                                         	# code...
                                $optioncount=Device::where('client_id','3')
                                                     ->where('question_id',$value->question_id)
                                                     ->where('response_type_id',$value->response_type_id)
                                                     ->where('answer_id',$optionsvalue->id)
								                     ->join('sessions','devices.id','=','sessions.device_id')
								                     ->join('surveys_session_answer_transactions','sessions.id','=','surveys_session_answer_transactions.session_id')
								                     ->join('response_types','surveys_session_answer_transactions.response_type_id','=','response_types.type_id')
								                     ->get()
								                     ->count();
								    echo '<pre>';
								    var_dump('number on '.$optionsvalue->response."  ".$optioncount); 

								    echo '</pre>';                                 
                                         }          

              echo 'check <pre>';
        	  var_dump($options->toArray());
        	  echo '</pre>';                         
        	 }
              
        }

                  
      $data = array('data' => $surveys);
     // echo json_encode($data);
	  //echo '<pre>'.print_r($data,1) .'</pre>';                    
	}

}
