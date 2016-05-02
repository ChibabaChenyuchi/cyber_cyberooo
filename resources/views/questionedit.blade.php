@extends('layouts.dashboard')
@section('page_heading','Edit Question')
@section('section')
    <div class="col-sm-12">

    <div class="col-md-9" style="padding-bottom: 15px;">
                             
                             </div>

    <div class="col-md-3" style="padding-bottom: 15px;">
                                  <button type="button" class="btn btn-primary btn-light-green btn-ripple" style="float: right;" onclick="history.back(-1);"><i class="fa fa-back"></i> &lt;&lt; Back
                          </button>
    </div>
      <!-- <form role="form"> -->
      {{ Form::open( array(
               'URL' => 'home',
               'method' => 'post',
               'id' => 'form-add-setting'
      ) ) }}
        <div class="row">
             <div class="col-lg-6">
             <h2> Edit Question</h2>
                <div id="message_div" style='padding-bottom: 15px;'></div>
                    @foreach ($question as $quest)
                     <div class="form-group">
                           <label>Question</label>
                           <input hidden value="{{$quest->id}}" name="quest_id" id="question_id"/>
                           <textarea class="form-control" id="question" name="question" rows="3">{{$quest->question}}</textarea>
                     </div>


                     
                     <div class="form-group">
                            <label>Response type</label>
                              <select id="answer_type" name="answer_type"  onchange="changeFunction()" value="{{$quest->response_type_id}}" class="form-control">
                                 
                                 @foreach ($response_types as $response_type)
                                   <option '@if ($response_type->type_id == $quest->response_type_id) selected @endif'  value='{{$response_type->type_id}}'>{{$response_type->response_type}}</option>
                                 @endforeach 
                               <!--   <option>2</option>
                                 <option>3</option>
                                 <option>4</option>
                                 <option>5</option> -->
                               </select>
                     </div>
                   @endforeach 
              
       <!-- <p>For complete documentation, please visit <a href="http://getbootstrap.com/css/#forms">Bootstrap's Form Documentation</a>.</p>-->
    </div>
    <div class="col-lg-6">
        <h2>Responses</h2>
             <div class="form-group" id="radioresponses">
                <label>Radio Buttons</label>


                <span id="myradios"></span>
                <span id="cloneradios"></span>
                <span id="myedits"></span>
                <span id="cloneedits"></span>
                
                <!-- <button type="button" class="btn btn-primary btn-circle"><i class="fa fa-plus"> Add Response</i></button>  -->
                <div class="col-lg-5">
                </div>
                <div class="col-lg-2">
                 <button type="button" onclick="radioClone()" class="btn btn-primary btn-circle    btn-lg   "><i class="fa fa-plus"></i></button> 
                </div>
                <div class="col-lg-5">
                </div>
<!--            
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>Radio 1
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Radio 2
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">Radio 3
                    </label>
                </div> -->
                <!-- <button onclick="submitradioresponseQuestion()" type="button" class="btn btn-primary">Primary</button> -->
                
                <br></br>
                <div style="padding-top: 15px;">
                   <button  onclick="submitradioresponseQuestion()" type="button" class="btn btn-primary    btn-lg btn-block   ">Submit</button> 
               </div>   

            </div>

              <div class="form-group" id="rattingbar">
                   <div>
                      <label>Number Of Steps</label>
                      <input type="number" class="form-control" name="number_of_stars" id="number_of_stars">
                   </div>

                  <!--  <div>
                      <label>Maximum Value</label>
                      <input type="number" class="form-control">
                   </div> -->
                   
                   <div>
                      <label>step</label>
                      <input type="number" class="form-control" name="ratting_steps" id="ratting_steps">
                   </div>
                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                  <div style="padding-top: 15px;">
                     <button  onclick="submitrattingbarresponseQuestion()" type="button" class="btn btn-primary    btn-lg btn-block   ">Submit</button> 
                  </div> 
            </div>


              <div class="form-group" id="slidingbar">
                   <div>
                      <label>Minimum Value</label>
                      <input type="number" class="form-control" name="minimum_value" id="minimum_value">
                   </div>

                   <div>
                      <label>Maximum Value</label>
                      <input type="number" class="form-control" name="maximum_value" id="maximum_value">
                   </div>
                   
                   <div>
                      <label>step</label>
                      <input type="number" class="form-control" name="sliding_bar_steps" id="sliding_bar_steps">
                   </div>
                    <!-- <p class="help-block">Example block-level help text here.</p> -->
                    <div style="padding-top: 15px;">
                     <button  onclick="submitslidingbarresponseQuestion()" type="button" class="btn btn-primary    btn-lg btn-block   ">Submit</button> 
                  </div> 
            </div>

            <!-- <div class="form-group" id="checkbox">
                <label>Checkboxes</label>

                <span id="mychecks"></span>
                <span id="clonechecks"></span>
                <span id="myeditschecks"></span>
                <span id="cloneeditschecks"></span>
                

                <div class="col-lg-5">
                </div>
                <div class="col-lg-2">
                 <button type="button" onclick="checksClone()" class="btn btn-primary btn-circle    btn-lg   "><i class="fa fa-plus"></i></button> 
                </div>
                <div class="col-lg-5">
                </div>
                <div>
                   <button  onclick="submitcheckresponseQuestion()" type="button" class="btn btn-primary    btn-lg btn-block   ">Submit</button> 
               </div>
            </div>
 -->

           <div class="form-group" id="checkbox">
                <label>Checkboxes</label>


                <span id="mychecks"></span>
                <span id="clonechecks"></span>
                <span id="myeditschecks"></span>
                <span id="cloneeditschecks"></span>
                

                <div class="col-lg-5">
                </div>
                <div class="col-lg-2">
                 <button type="button" onclick="checksClone()" class="btn btn-primary btn-circle    btn-lg   "><i class="fa fa-plus"></i></button> 
                </div>
                <div class="col-lg-5">
                </div>

                
                <br></br>
                <div style="padding-top: 15px;">
                   <button  onclick="submitcheckresponseQuestion()" type="button" class="btn btn-primary    btn-lg btn-block ">Submit</button> 
               </div>   

            </div>

    </div>    
</div>
</form>
</div>           
           
            
@stop

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function () {
		//Pleasure.init();
		//Layout.init();
		//TablesDataTables.init();
     
    $("#checkbox").hide();
		$("#radioresponses").hide();
		$("#rattingbar").hide();
    $("#slidingbar").hide();
    changeFunction();
	});

var radiodata;
var radiodata1;
var  checkdata;
var  checkdata1;
var j=0; //radio button index identifier
var radiofirstclone;
var checkfirstclone;
var k=0;//checkbox button index identifier

function changeFunction(){

			   var x = document.getElementById("answer_type").value;
			   var questionnumber = document.getElementById("question_id").value;
			  //var spanDump = document.getElementById('daterange');
    	      //var mydaterange =spanDump.innerHTML;
               //alert(x);
               if(x==1){

                              var request = $.ajax({
                                    url: "radioresponses",
                                    type: "POST",
                                    data: {question : questionnumber},
                                    dataType: "html"
                                    });

                               request.done(function(msg) {
                                        // alert(msg);
                                        radiofirstclone=null;
                                        if(msg!="noresult"){
                                          var myStringArray = JSON.parse(msg);
                                          if(radiodata==null){
                                          for(var i=0; i< myStringArray.length; i++){
                                            //alert(myStringArray[i]);
                                           j=i+1;
                                           
                                             
                                              radiodata = '<div class="radio"><label> <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>'+myStringArray[i]+'</label></div>';
                                              radiodata1 ='<div class="form-group"><label>option '+j+' </label><input class="form-control" name="radior'+j+'" id="res_'+j+'" value="'+myStringArray[i]+'"></div>';
                                             document.getElementById('myradios').innerHTML += radiodata;
                                             document.getElementById('myedits').innerHTML += radiodata1;
                                          }
                                        }
                                        }
                                        
                                $("#radioresponses").show();
                                $("#rattingbar").hide();
                                $("#checkbox").hide();
                                $("#slidingbar").hide();

                                     	  
                               	   });
                               request.fail(function(jqXHR, textStatus) {
                                         alert( "Request failed: " + textStatus );
                                   });
                                

               }
               if(x==2){

            $("#radioresponses").hide();
		        $("#rattingbar").hide();
		        $("#checkbox").hide();
            $("#slidingbar").hide();

               }

               if(x==3){

                 var request = $.ajax({
                                    url: "rattingeresponses",
                                    type: "POST",
                                    data: {question : questionnumber},
                                    dataType: "JSON"
                                    });

                                   request.done(function(msg) {

                                      //alert(msg);
                                       if(msg!="noresult"){
                                      document.getElementById("number_of_stars").value=msg[0];
                                      document.getElementById("ratting_steps").value=msg[1];
                                       }
                                    });

                                    request.fail(function(jqXHR, textStatus) {
                                         alert( "Request failed: " + textStatus );
                                   });

                                       $("#rattingbar").show();
                                       $("#radioresponses").hide();
                                       $("#checkbox").hide();
                                       $("#slidingbar").hide();

              
               
               }

               if(x==4){

                //Check box responses fetch
                   var request = $.ajax({
                                    url: "checkresponses",
                                    type: "POST",
                                    data: {question : questionnumber},
                                    dataType: "html"
                                    });

                               request.done(function(msg) {
                                        // alert(msg);
                                        checkfirstclone=null;
                                        if(msg!="noresult"){
                                          var myStringArray = JSON.parse(msg);
                                          if(radiodata==null){
                                          for(var i=0; i< myStringArray.length; i++){
                                            //alert(myStringArray[i]);
                                           k=i+1;
                                           
                                             
                                              checkdata = '<div class="checkbox"><label> <input type="checkbox" name="optionscheckbox" id="optionscheckbox1" value="checkboxoption1" checked>'+myStringArray[i]+'</label></div>';
                                              checkdata1 ='<div class="form-group"><label>option '+k+' </label><input class="form-control" name="checkbox'+k+'" id="checkboxres_'+k+'" value="'+myStringArray[i]+'"></div>';
                                             document.getElementById('mychecks').innerHTML += checkdata;
                                             document.getElementById('myeditschecks').innerHTML += checkdata1;
                                          }
                                        }
                                        }
                                        
                                          
                                   });
                               request.fail(function(jqXHR, textStatus) {
                                         alert( "Request failed: " + textStatus );
                                   });

                                  $("#radioresponses").hide();
                                  $("#rattingbar").hide();
                                  $("#checkbox").show();
                                  $("#slidingbar").hide();


               }
                if(x==5){
                                  var request = $.ajax({
                                    url: "slideresponses",
                                    type: "POST",
                                    data: {question : questionnumber},
                                    dataType: "html"
                                    });

                                   request.done(function(msg) {

                                     // alert(msg);
                                      if(msg!="noresult"){
                                     document.getElementById("minimum_value").value=msg[0];
                                     document.getElementById("maximum_value").value=msg[1];
                                     document.getElementById("sliding_bar_steps").value=msg[2];
                                        }
                                    });

                                    request.fail(function(jqXHR, textStatus) {
                                         alert( "Request failed: " + textStatus );
                                   });

                                  $("#radioresponses").hide();
                                  $("#rattingbar").hide();
                                  $("#checkbox").hide();
                                  $("#slidingbar").show();   
                       
                }
		};

function radioClone(){

  
    if(radiofirstclone!=null){
    var previousvalue = document.getElementById("clone"+j+"").value;
    radiodata = '<div class="radio"><label> <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>'+previousvalue+'</label></div>';
    radiodata1 ='<div class="form-group"><label>option '+j+' </label><input class="form-control" name="radior'+j+'" id="res_'+j+'" value="'+previousvalue+'"></div>';
    document.getElementById('myradios').innerHTML += radiodata;
    document.getElementById('myedits').innerHTML += radiodata1;
    }
    radiofirstclone=1;
    j=j+1;
    var clonedata = '<div class="radio"><label> <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>'+""+'</label></div>';
    var clonedata1 ='<div class="form-group"><label>option '+j+' </label><input class="form-control" id="clone'+j+'" value="'+""+'"></div>';
    document.getElementById('cloneradios').innerHTML = clonedata;
    document.getElementById('cloneedits').innerHTML = clonedata1;

};

function submitradioresponseQuestion(){

 var postdata;
 var question_number = document.getElementById("question_id").value;
 var que_stion = document.getElementById("question").value;


 var data_arr = $('input[id^="res_"]').serialize();
 var data_arr1 = $('input[id="question_id"]').serialize();
 var data_arr2 = $('select[id="answer_type"]').serialize();
 var data_arr3 = $('textarea[id="question"]').serialize();
 var data_arr4 = "number_of_responses="+j;

 var data= data_arr4+'&'+data_arr3+'&'+data_arr2+'&'+data_arr1+'&'+data_arr;
 jQuery('#message_div').append("<div class='alert alert-success text-center' >Please Wait</div>");
                              $("#message_div").show();
                    var request = $.ajax({
                                    url: "radioresponsesupdate",
                                    type: "POST",
                                    data: data,
                                    dataType: "html"
                                    });



                         request.done(function(msg){

                             //alert(msg);
                             document.getElementById("message_div").innerHTML = "";
                             $("#message_div").hide();
                             jQuery('#message_div').append("<div class='alert alert-success text-center' >"+msg+"!</div>");
                             $("#message_div").show();
                         });  

                          request.fail(function(jqXHR, textStatus) {
                                         alert( "Request failed: " + textStatus );
                          }); 

                                      
       };


 function checksClone(){
    //clone checkboxes
  
    if(checkfirstclone!=null){
    var previousvalue = document.getElementById("checkclone"+k+"").value;
    checkdata = '<div class="checkbox"><label> <input type="checkbox" name="optionscheckbox" id="optionscheckbox1" value="checkbox1" checked>'+previousvalue+'</label></div>';
    checkdata1 ='<div class="form-group"><label>option '+k+' </label><input class="form-control" name="checkbox'+k+'" id="checkbox_res_'+k+'" value="'+previousvalue+'"></div>';
    document.getElementById('mychecks').innerHTML +=  checkdata;
    document.getElementById('myeditschecks').innerHTML +=  checkdata1;
    }
    checkfirstclone=1;
    k=k+1;
    var clonedata = '<div class="checkbox"><label> <input type="checkbox" name="optionsRadios" id="optionsRadios1" value="option1" checked>'+""+'</label></div>';
    var clonedata1 ='<div class="form-group"><label>option '+k+' </label><input class="form-control" id="checkclone'+k+'" value="'+""+'"></div>';
    document.getElementById('clonechecks').innerHTML = clonedata;
    document.getElementById('cloneeditschecks').innerHTML = clonedata1;

};

function submitcheckresponseQuestion(){

 var postdata;
 var question_number = document.getElementById("question_id").value;
 var que_stion = document.getElementById("question").value;


 var data_arr = $('input[id^="checkbox_res_"]').serialize();
 var data_arr1 = $('input[id="question_id"]').serialize();
 var data_arr2 = $('select[id="answer_type"]').serialize();
 var data_arr3 = $('textarea[id="question"]').serialize();
 var data_arr4 = "number_of_responses="+k;

 var data= data_arr4+'&'+data_arr3+'&'+data_arr2+'&'+data_arr1+'&'+data_arr;
jQuery('#message_div').append("<div class='alert alert-success text-center' >Please Wait</div>");
                              $("#message_div").show();
                    var request = $.ajax({
                                    url: "checkresponsesupdate",
                                    type: "POST",
                                    data: data,
                                    dataType: "html"
                                    });



                         request.done(function(msg){

                             //alert(msg);
                              document.getElementById("message_div").innerHTML = "";
                             $("#message_div").hide();
                             jQuery('#message_div').append("<div class='alert alert-success text-center' >"+msg+"!</div>");
                             $("#message_div").show();
                         });  

                          request.fail(function(jqXHR, textStatus) {
                                         alert( "Request failed: " + textStatus );
                          }); 

                                      
       };
      
function submitrattingbarresponseQuestion(){

 var data_arr = $('input[id="number_of_stars"]').serialize();
 var data_arr1 = $('input[id="question_id"]').serialize();
 var data_arr2 = $('select[id="answer_type"]').serialize();
 var data_arr3 = $('textarea[id="question"]').serialize();
 var data_arr4 = $('input[id="ratting_steps"]').serialize();

 var data= data_arr4+'&'+data_arr3+'&'+data_arr2+'&'+data_arr1+'&'+data_arr;
 
 jQuery('#message_div').append("<div class='alert alert-success text-center' >Please Wait</div>");
                              $("#message_div").show();
                    var request = $.ajax({
                                    url: "rattingbarresponseupdate",
                                    type: "POST",
                                    data: data,
                                    dataType: "html"
                                    });



                         request.done(function(msg){

                             //alert(msg);
                              document.getElementById("message_div").innerHTML = "";
                             $("#message_div").hide();
                             jQuery('#message_div').append("<div class='alert alert-success text-center' >"+msg+"!</div>");
                             $("#message_div").show();
                         });  

                          request.fail(function(jqXHR, textStatus) {
                                         alert( "Request failed: " + textStatus );
                          }); 

}
            
function submitslidingbarresponseQuestion(){

 var data_arr = $('input[id="minimum_value"]').serialize();
 var data_arr1 = $('input[id="question_id"]').serialize();
 var data_arr2 = $('select[id="answer_type"]').serialize();
 var data_arr3 = $('textarea[id="question"]').serialize();
 var data_arr4 = $('input[id="maximum_value"]').serialize();
 var data_arr5 = $('input[id="sliding_bar_steps"]').serialize();

jQuery('#message_div').append("<div class='alert alert-success text-center' >Please Wait</div>");
                              $("#message_div").show();
 var data= data_arr4+'&'+data_arr3+'&'+data_arr2+'&'+data_arr1+'&'+data_arr+'&'+data_arr5;

                    var request = $.ajax({
                                    url: "slidingbaresponsesupdate",
                                    type: "POST",
                                    data: data,
                                    dataType: "html"
                                    });



                         request.done(function(msg){

                             //alert(msg);
                            document.getElementById("message_div").innerHTML = "";
                             $("#message_div").hide();
                             jQuery('#message_div').append("<div class='alert alert-success text-center' >"+msg+"!</div>");
                             $("#message_div").show();
                         });  

                          request.fail(function(jqXHR, textStatus) {
                                         alert( "Request failed: " + textStatus );
                          }); 

}
</script>