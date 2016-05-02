<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use App\Question;
class HomeController extends Controller {

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

         // get questions 

         $questions = Question::where('client_id',$request->user()->id)
                               ->join('response_types','questions.response_type_id','=','response_types.type_id')
                               ->orderBy('id', 'desc')
                               ->get();
          //echo '<pre>'.print_r($questions,1) .'</pre>';exit;                   

         $data['questions']=  $questions;

         foreach ($questions as $flight) {
         	       //echo $flight->value;
                    //echo '<pre>'.print_r($flight->value,1) .'</pre>';
                  }

		//return view('questions');

		//return View::make('questions')->with('title', 'Survey Qusestions')->with('questions',Question::all());
	
         return view('questions', $data );
		//return view('home');
	}

}
