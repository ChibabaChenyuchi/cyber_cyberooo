<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Response_types;
use App\Question;
use App\Radioresponses;
use App\Checkresponses;
use App\Slider_responses;
use App\Rating_bar_response;

class clientQuestionsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($user_ID,$id)
	{
		//
	    // echo("USER ID".$user_ID);
	    // echo('QUESTION ID'.$id);
	     $questions = Question::where('client_id',$user_ID)
	               ->where('id',$id)
	               ->get();
	      //echo '<pre>'.print_r($questions,1) .'</pre>';  

	      if(isset($questions[0]->id)){

	      	if($questions[0]->response_type_id==4){
               $response=Checkresponses::where('question_id',$questions[0]->id)
                                             ->get();
               $i=0;
               $myresponse=[];
               foreach ($response as $key) {
                                             	# code...
               	array_push($myresponse, array('response['.$i.']' =>$key->response ));
               	$i++;
               	    	                                                 
               	                          }                              
               
               $data=array(
                       "message"=>"success",
                       "question"=> array(
                       	                  "question_id" => $questions[0]->id,
                       	                  "question_number"=>$questions[0]->question_number,
                       	                  "question"=>$questions[0]->question,
                       	                  "response_type"=>"check boxes", 
                       	                  "responses"=>$myresponse 
                       	                  ),
               	       "comments"=>"android client response"); 
               //echo '<pre>'.print_r($response,1) .'</pre>';  
               echo json_encode($data);  
	      	}
	      	
	      }else{
	      	//echo 'result empty';
	      	 $data=array("message"=>"failure",
	      	 	         "comment"=>"resource not found");
	      	 echo json_encode($data);
	      } 

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
