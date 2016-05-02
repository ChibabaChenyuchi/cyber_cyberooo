@extends('layouts.dashboard')
@section('page_heading','Settings')
@section('section')

              	<div class="col-sm-6">
				    <div class="main_pic">
					  	<a href="#">
					  	   <img src="http://alexas.com/alexas_dev/uploads/profiles/profile_photos/2048x2048/photo_album_fbIP9dvxo5Tv20160429132112.jpeg" id="image"  height="160" width="160">
					  	</a>
					</div>
			    </div>
           
   

				<div class="col-sm-6">
					<label>Please upload your logo</label>
						<div id="message_div1"></div>
						   <div id="full_element" >
						        <input type="file"  id="dstv_full_image" onchange="dstv_full_image_function()" name="dstv_full_image" class="ssb" required="required" accept='image/*'>
						</div>
				</div>

<script type="text/javascript">
	$(document).ready(function () {
		
		TablesDataTables.init();
	});

function dstv_full_image_function(){
	var e;
	var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("dstv_full_image").files[0]);
        
        oFReader.onloadend = function() {
        	            var canvas= document.createElement('canvas');
                        canvas.id     = "CursorLayer";
                        canvas.width  = 160;
                        canvas.height = 160;
                        canvas.style.zIndex   = 8;
                        canvas.style.position = "absolute";
                        canvas.style.border   = "1px solid";
                        //declare canvas context
                        var ctx = canvas.getContext("2d");
                       
                        var img = new Image();
                        img.onload = function() {
                        ctx.drawImage(img, 0 ,0, 160, 160);
                        var dataURL=canvas.toDataURL();
			                 $("#full_element").hide();
                                   document.getElementById("message_div1").innerHTML = "";
                                     $("#message_div1").hide()
                                   jQuery('#message_div1').append("<div class='alert alert-info text-center' >"+"Loading ...."+"</div>");
                                   $("#message_div1").show();            
			                        var request = $.ajax({
			                                    url: "settings_picture_save",
			                                    type: "POST",
			                                    data: {quest_id : dataURL},
			                                    dataType: "html"
			                                    });

			                               request.done(function(msg) {
			                                document.getElementById("message_div1").innerHTML = "";
		                                     $("#message_div1").hide();
			                               	  if (msg=='"done"') {
			                               	  	jQuery('#message_div1').append("<div class='alert alert-success text-center' >"+"Logo uploaded successfully"+"</div>");
			                                        $("#message_div1").show();
			                                        $("#full_element").show();
			                                        //document.getElementById("image").src=this.result; 

			                               	  }else{
			                               	  	jQuery('#message_div1').append("<div class='alert alert-danger text-center' >"+"Image upload failed please try again"+"</div>");
			                                        $("#message_div1").show();
			                                         $("#full_element").show();
			                                          
			                                       // $('#save').val()='Save & Continue';
			                                         document.getElementById("dstv_full_image").value = "";
			                                         document.getElementById("image").src="";

			                               	  }
			                                   
			                               	//window.location.replace('{{URL::to('/');}}');
			                                  // alert(masg);

			                               })
			                           }
                           img.src =this.result;
                }


            oFReader.onload = function (oFREvent) {

             //some other action eg 
            document.getElementById("image").src = oFREvent.target.result;
        };
     

   

         }

</script>
@stop

