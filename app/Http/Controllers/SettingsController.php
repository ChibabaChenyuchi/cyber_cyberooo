<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

use View;
use Input;

use DB;
use App\Response_types;
use App\Question;
use App\Radioresponses;
use App\Checkresponses;
use App\Slider_responses;
use App\Rating_bar_responses;
Use App\Upload;

class SettingsController extends Controller {

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

         // $questions = Question::where('client_id',$request->user()->id)
         //                       ->join('response_types','questions.response_type_id','=','response_types.type_id')
         //                       ->orderBy('id', 'desc')
         //                       ->get();
         //  //echo '<pre>'.print_r($questions,1) .'</pre>';exit;                   

         // $data['questions']=  $questions;

         // foreach ($questions as $flight) {
         // 	       //echo $flight->value;
         //            //echo '<pre>'.print_r($flight->value,1) .'</pre>';
         //          }

		//return view('questions');

		//return View::make('questions')->with('title', 'Survey Qusestions')->with('questions',Question::all());
	
         return view('settings' );
		//return view('home');
	}

	public function settings_picture_save(Request $request){
		$src = Input::get('quest_id');
		        //get the base-64 from data
        //$base64_str = substr($myquest_id, strpos($myquest_id, ",")+1);
        $src = str_replace('data:image/png;base64,', '', $src);
		$src = str_replace(' ', '+', $src);

        //decode base64 string
        $image = base64_decode($src);
        $png_url = "product-".time().".png";
        $path = public_path('uploads/' . $png_url);

        //Image::make($image->getRealPath())->save($path);
        // I've tried using 
        $result = file_put_contents($path, $image); 
        // too but still not working

        if (Upload::where('user_id', '=', $request->user()->id)->count()>0) {
          
           Upload::where('user_id', '=', $request->user()->id)
            ->update(array(
                'upload_file_name' => $png_url
                )
            );

        }else{

         $will_testator_s_personal_details=new Upload;
         $will_testator_s_personal_details->user_id=$request->user()->id;
         $will_testator_s_personal_details->upload_file_name=$png_url;
         $will_testator_s_personal_details->upload_file_type="png";
         $will_testator_s_personal_details->upload_file_size="";
         $will_testator_s_personal_details->upload_url=$path = public_path('uploads/');
         $will_testator_s_personal_details->upload_type_id="1";
         $will_testator_s_personal_details->upload_description="logo ";
         $will_testator_s_personal_details->uploads_verified="";
         $will_testator_s_personal_details->save();
        }

        $response = array(
            'status' => 'success',
        );
        //return Response::json( $response  );

        echo json_encode('done');
	}

}
