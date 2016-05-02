@extends('layouts.dashboard')
@section('section')

<?php //echo '<pre>'.print_r($questions,1) .'</pre>'; ?>
 
<div class="row">
       
           <div class="col-md-10"></div>
            <div class="col-md-2">
                <button type="button" class="btn btn-primary btn-outline" onclick="location.href = '{{URL::to('newquestion')}}';"><i class="fa fa-plus"></i>Add New</button>
            </div>
			<div class="col-md-12">
				<div class="panel">
					<!-- <div class="panel-heading">
						<div class="panel-title"><h4>BASIC DATA TABLE</h4></div>
					</div><!--.panel-heading-->

					<div class="panel-body">
                        
						<div class="overflow-table">
						<table class="display datatables-basic">
							<thead>
								<tr>
									<th class="col-md-8">Questions</th>
									<th>Type</th>
									<th>Edit</th>
									
								</tr>
							</thead>
                    
							<tfoot>
								<tr>
									<th class="col-md-8">Questions</th>
									<th>Type</th>
									<th>Edit</th>
									
								</tr>
							</tfoot>
                             
							<tbody>
							@foreach ($questions as $question)
								<tr>
									<td class="col-md-8"> {{ $question->question }}</td>
									<td>{{ $question->response_type }}</td>
									<td><button    onclick="location.href = '{{URL::to('editquestion',$question->id)}}';"  class="btn btn-primary btn-xs dt-edit"><span class="glyphicon glyphicon-pencil">{{ 'EDIT'}}</span></button><button class="btn btn-danger btn-xs dt-delete" onclick="deleteQN({{$question->id}})"><span class="glyphicon glyphicon-trash">DELETE</span></button></td>
									
								</tr>
							@endforeach	

								
							</tbody>
						</table>
						</div><!--.overflow-table-->

					</div><!--.panel-body-->
				</div><!--.panel-->
			</div><!--.col-md-12-->
		</div><!--.row-->

<!-- <div class="row">
	<div class="col-sm-12">
	    <div class="col-sm-4">
		  @section ('cotable_panel_title','Coloured Table')
		</div>
		<div class="col-sm-6">
		</div>
		<div class="col-sm-2">
		@section ('cotable_panel_text','Add')
		</div>
		@section ('cotable_panel_body')
		
         
		


		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div> -->

<script type="text/javascript">

$(document).ready(function () {
		
		TablesDataTables.init();
	});

function deleteQN(e){
   var request = $.ajax({
                                    url: "/deletequestions",
                                    type: "GET",
                                    data: {quest_id : e},
                                    dataType: "html"
                                    });

                               request.done(function(msg) {
                                   
                               	window.location.replace('{{URL::to('/');}}');
                                   alert(masg);

                               })

                           }


</script>



















@stop
