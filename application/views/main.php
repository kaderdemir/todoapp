<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

	<script type="text/javascript">
		var api_url = "<?php echo base_url("api/") ?>";
	</script>

	<style type="text/css">
		.scroll::-webkit-scrollbar-track
		{
			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
			border-radius: 10px;
			background-color: #F5F5F5;
		}

		.scroll::-webkit-scrollbar
		{
			width: 12px;
			background-color: #F5F5F5;
		}

		.scroll::-webkit-scrollbar-thumb
		{
			border-radius: 10px;
			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
			background-color: #198754;
		}
	</style>

</head>
<body>

	<div class="container">
		<div class="row"> 
			
			<div class="col-sm-6">

				<div class="col-sm">
					<div class="starter-template text-center py-5 px-3">
						<button type="button" class="btn btn-primary get_data">Get API Data</button>
					</div>

					<div class="starter-template text-center mt-4 ">
						<button id="call" type="button" class="btn btn-primary">Show Project Time</button>
					</div> 
				</div>

				<div class="starter-template text-center py-5 px-3">
					<label>Provider</label>
					<select class="form-select provider-select" disabled="disabled"  aria-label="Default select example">
						<option selected>Please Call API Data First</option> 
					</select>
				</div>

				<div class="starter-template text-center ">
					<label>Developer</label>
					<select class="form-select developer-select"   aria-label="Default select example">
						<option selected>Dev Data First</option>
					</select>
				</div> 

				<div class="row mt-4">
					<button id="calldev" type="button" class="btn btn-primary">Get Task (Weekly)</button>
				</div>

				
			</div>
			<div class="col-sm-6">
				<div class="row response mt-4 scroll" style="height:550px;overflow: auto;">

				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript"> 

		$(".get_data").on("click",function(){ 
			$.get( api_url, { func: "getApiData" } )
			.done(function( data ) {  
				if (data) {
					$.get( api_url, { func: "getProviders" } )
					.done(function( data ) {  
						data = JSON.parse(data);
						var html='<option value="false">Select Provider (for Filtering)</option>';
						$.each(data,function( index, item ) {
							html+='<option value="'+item.provider_name+'">'+item.provider_name+'</option>';
						});
						$(".provider-select").html(html);
						$(".provider-select").prop("disabled",false);
						$(".response").html('');
						alert("API Data Loaded");
					});
				} 
			});
		});

		$.get( api_url, { func: "getDevelop" } )
		.done(function( data ) {
			data = JSON.parse(data);
			var html="";
			$.each(data,function(index, item) {
				html+='<option value="'+item.difficulty+'">'+item.developer_name+'</option>';
			});
			$(".developer-select").html(html);
			$(".developer-select").prop("disabled",false);
		}); 

		$.get( api_url, { func: "getProviders" } )
		.done(function( data ) {  
			data = JSON.parse(data);
			var html='<option value="false">Select Provider (for Filtering)</option>';
			$.each(data,function( index, item ) {
				html+='<option value="'+item.provider_name+'">'+item.provider_name+'</option>';
			});
			$(".provider-select").html(html);
			$(".provider-select").prop("disabled",false); 
		});




		$("#call").on("click",function(){
			$.get( api_url, { func: "calcTime", data: $(".provider-select option:selected").val() } )
			.done(function( data ) {
				if (data != "false") {
					data = JSON.parse(data);
					$(".response").html('Total Hour : '+data.total_hour.toFixed(2)+"<br>"+'Total Week : '+data.total_week.toFixed(2));
				}else {
					$(".response").html('Please Call API Data');
				}
				
			});
		})


		$("#calldev").on("click",function(){
			$.get( api_url, { func: "getDevelopers", dev: $(".developer-select option:selected").val() } )
			.done(function( data ) {
				if (data != "false") {
					data = JSON.parse(data);
					var html = ""; 
					$(".response").html("");
					$.each(data,function(i,items) {
						html += '<div class="list-group"><button type="button" class="list-group-item list-group-item-action active bg-success">Week '+(i+1)+'</button>';
						html += '<table class="table"> <tbody>';
						$.each(items,function(j,item){
						//html += '<button type="button" class="list-group-item list-group-item-action">'+item.title+'</button>';
						html += '<tr> <td>'+item.provider_name+'</td> <td>'+item.title+'</td> <td>'+item.time+' Hour</td> </tr>';
					});
						html += '</tbody></table></div>'; 
					}) 
					$(".response").append(html);
				}
				else {
					$(".response").html('Please Call API Data');
				}
				
			});
		})

	</script>

</body>
</html>