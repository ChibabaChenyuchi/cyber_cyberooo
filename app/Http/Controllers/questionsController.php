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


class questionsController extends Controller {

	//

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
	}

	public function edit($quesion_id,Request $request){
     // $quesion_id=1;
      // echo "I got here";
        $data['quesion_id'] = $quesion_id;
         ///echo $quesion_id;exit;
         $data['question'] = Question::where('id',$quesion_id)
                               ->where('client_id',$request->user()->id)
                               ->orderBy('id', 'desc')
                               ->get();

         $data['response_types']=Response_types::all();                      

        //echo '<pre>'.print_r($questions,1) .'</pre>';
        return view('questionedit', $data );                       

	}

	public function radioresponses(Request $request){
         
         $question_id = Input::get('question');
         $radioresponses=Radioresponses::where('question_id',$question_id)
                                         ->get(); 

         $mydata=[];
             
  
            if($radioresponses){
              foreach ($radioresponses as $key) {   
                       # code...
                      array_push( $mydata, array($key->response));
                       }
                   }else{
                             $mydata = 'noresult';
                     }                                 

         //echo '<pre>'.print_r($radioresponses,1) .'</pre>';
         echo json_encode($mydata);

		}


    public function radioresponsesupdate(Request $request){

       $myquest_id = Input::get('quest_id');
       $myquestion = Input::get('question');
       $number_of_responses = Input::get('number_of_responses');
       $response_type= Input::get('answer_type');

       //echo $myquest_id;
       //echo $myquestion;
       //echo $number_of_responses;
       if($myquest_id=='new'){
       $question= new Question;
       $question->question= $myquestion;
       $question->response_type_id=$response_type;
       $question->client_id=$request->user()->id;
       $question->save();
       $myquest_id=$question->id;
       }else{
       $question=Question::find($myquest_id);
       $question->question= $myquestion;
       $question->response_type_id=$response_type;
       $question->client_id=$request->user()->id;
       $question->save();
       }
       $affectedRows = Radioresponses::where("question_id", '=', $myquest_id)->delete();

       for ($i=1; $i < $number_of_responses; $i++) { 
         # code...
        $h="radior".$i;
         $mystring= Input::get($h);
         //echo $mystring;
         if($mystring!=null){
          $updateresponses=new Radioresponses; 
          $updateresponses->response=$mystring;
          $updateresponses->question_id=$myquest_id;
          $updateresponses->save();
         }

       }

       echo json_encode("Youur survey Question has been sucessifully submitted");
   
    }

    public function checkresponses(Request $request){
         
         $question_id = Input::get('question');
         $radioresponses=Checkresponses::where('question_id',$question_id)
                                         ->get(); 

         
         
         $mydata=[];
             
  
            if($radioresponses){
              foreach ($radioresponses as $key) {   
                       # code...
                      array_push( $mydata, array($key->response));
                       }
                   }else{
                             $mydata = 'noresult';
                     }                                 

         //echo '<pre>'.print_r($radioresponses,1) .'</pre>';
         echo json_encode($mydata);

    }


    public function checkresponsesupdate(Request $request){

       $myquest_id = Input::get('quest_id');
       $myquestion = Input::get('question');
       $number_of_responses = Input::get('number_of_responses');
       $response_type= Input::get('answer_type');

       //echo $myquest_id;
       //echo $myquestion;
       //echo $number_of_responses;

       if($myquest_id=='new'){
       $question= new Question;
       $question->question= $myquestion;
       $question->response_type_id=$response_type;
       $question->client_id=$request->user()->id;
       $question->save();
       $myquest_id=$question->id;
       }else{
       $question=Question::find($myquest_id);
       $question->question= $myquestion;
       $question->response_type_id=$response_type;
       $question->client_id=$request->user()->id;
       $question->save();
       }

       $affectedRows = Checkresponses::where("question_id", '=', $myquest_id)->delete();

       for ($i=1; $i < $number_of_responses; $i++) { 
         # code...
        $h="checkbox".$i;
         $mystring= Input::get($h);
         //echo $mystring;
         if($mystring!=null){
          $updateresponses=new Checkresponses; 
          $updateresponses->response=$mystring;
          $updateresponses->question_id=$myquest_id;
          $updateresponses->save();
         }

       }

       echo json_encode("Youur survey Question has been sucessifully submitted");
   
    }

     public function slideresponses(Request $request){
         
         $question_id = Input::get('question');
         $radioresponses=Slider_responses::where('question_id',$question_id)
                                         ->get(); 

         
         
         $mydata=[];
             
  
            if($radioresponses){
              foreach ($radioresponses as $key) {   
                       # code...
                      array_push( $mydata, array($key->minimum_value,$key->maximum_value,$key->steps));
                       }
                   }else{
                             $mydata = 'noresult';
                     }                                 

         //echo '<pre>'.print_r($radioresponses,1) .'</pre>';
         echo json_encode($mydata);

    }

     public function ratingresponses(Request $request){
         
         $question_id = Input::get('question');
         $radioresponses=Rating_bar_responses::where('question_id',$question_id)
                                         ->get(); 

         
         
         $mydata=[];
             
  
            if($radioresponses){
              foreach ($radioresponses as $key) {   
                       # code...
                    $mydata= array($key->number_of_stars,$key->steps);
                       }
                   }else{
                             $mydata = 'noresult';
                     }                                 

         //echo '<pre>'.print_r($radioresponses,1) .'</pre>';
         echo json_encode($mydata);

    }

  function rattingbarresponseupdate(Request $request){
             $myquest_id = Input::get('quest_id');
             $myquestion = Input::get('question');
             $response_type= Input::get('answer_type');
             $ratting_steps = Input::get('ratting_steps');
             $number_of_stars = Input::get('number_of_stars');

            if($myquest_id=='new'){
       $question= new Question;
       $question->question= $myquestion;
       $question->response_type_id=$response_type;
       $question->client_id=$request->user()->id;
       $question->save();
       $myquest_id=$question->id;
       }else{
       $question=Question::find($myquest_id);
       $question->question= $myquestion;
       $question->response_type_id=$response_type;
       $question->client_id=$request->user()->id;
       $question->save();
       }
            $affectedRows = Rating_bar_responses::where("question_id", '=', $myquest_id)->delete();

            $rattingbar_response= new Rating_bar_responses;
            $rattingbar_response->question_id=$myquest_id;
            $rattingbar_response->maximum_value=$number_of_stars;
            //$rattingbar_response->steps=$ratting_steps;
            $rattingbar_response->save();

            echo json_encode("Youur survey Question has been sucessifully submitted");
            
  }
  
  function slidingbaresponsesupdate(Request $request){
             $myquest_id = Input::get('quest_id');
             $myquestion = Input::get('question');
             $response_type= Input::get('answer_type');
             $maximum_value = Input::get('maximum_value');
             $minimum_value = Input::get('minimum_value');
             $sliding_bar_steps = Input::get('sliding_bar_steps');

            if($myquest_id=='new'){
       $question= new Question;
       $question->question= $myquestion;
       $question->response_type_id=$response_type;
       $question->client_id=$request->user()->id;
       $question->save();
       $myquest_id=$question->id;
       }else{
       $question=Question::find($myquest_id);
       $question->question= $myquestion;
       $question->response_type_id=$response_type;
       $question->client_id=$request->user()->id;
       $question->save();
       }

            $affectedRows = Slider_responses::where("question_id", '=', $myquest_id)->delete();

            $slider_response =new Slider_responses;
            $slider_response->question_id=$myquest_id;
            $slider_response->minimum_value= $minimum_value;
            $slider_response->maximum_value= $maximum_value;
            $slider_response->steps=$sliding_bar_steps;
            $slider_response->save();

            echo json_encode("Youur survey Question has been sucessifully submitted");
  }


  function newquestion(){
    $data['response_types']=Response_types::all(); 
    return view('questionnew',$data);
  }

  function deletequestions(Request $request){
     $myquest_id = Input::get('quest_id');
    //$myquest_id="got here";
 
        DB::connection()->transaction(function() use($myquest_id){
        $a = Slider_responses::where('question_id', '=', $myquest_id)->delete(); // Delete all photos for user
        $user = Radioresponses::where('question_id', '=', $myquest_id)->delete(); // Delete users
        $a = Rating_bar_responses::where('question_id', '=', $myquest_id)->delete(); // Delete all photos for user
        $a = Checkresponses::where('question_id', '=', $myquest_id)->delete(); // Delete all photos for user
        //$a = Slider_responses::where('user_id', '=', $myquest_id)->delete(); // Delete all photos for user
        $questions = Question::where('id','=',$myquest_id)->delete();
                               

        //DB::connection()->pdo->commit();

       echo json_encode($myquest_id);

    });
    
    
  }
}
