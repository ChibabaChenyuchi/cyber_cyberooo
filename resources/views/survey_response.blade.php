@extends('layouts.dashboard')
@section('section')

<?php //echo '<pre>'.print_r($questions,1) .'</pre>'; ?>
 
<div class="row">

          
			<div class="col-md-12">
				<div class="panel">
					 <div class="panel-heading">
						<div class="panel-title"><h4>SURVEY RESPONSE</h4></div>
					</div><!--.panel-heading-->

					<div class="panel-body">
                        
						<div class="overflow-table">

						    <table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
									        <thead>
									            <tr>
									                <th>Questions</th>
									                <th>Type</th>
									                <th>Option</th>
									                <th>Average</th>
									                
									            </tr>
									        </thead>
									        <tfoot>
									            <tr>
									                <th>Questions</th>
									                <th>Type</th>
									                <th>Option</th>
									                <th>Average</th>
									            </tr>
									        </tfoot>
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

		 $('#example').DataTable( {
                            "ajax": "survey_details_ajax",
                            //"data": msg.usage,
                            "columns": [
                                { "data": "question_text" },
                                { "data": "response_type" },
                                { "data": "options" },
                                { "data": "answer_text" },
                                
                            ],
                            "bDestroy": true
    				} ); 
	});
	

</script>



















@stop
