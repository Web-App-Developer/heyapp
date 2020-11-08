$(document).ready(function(){

	$("#convertMP3_form").on("submit", function(e){
		e.preventDefault();
		var form = $(this);
		var url = form.attr('action');
		var type = form.attr('method');

		var form_data = form.serialize();		 

		$.ajax({
			url: url,
			data: form_data,
			method: type,
			dataType: 'JSON',
			cache: false,
			success: function(response){
				//console.log(response)
			    console.log(response.data.status)

			    if (response.data.status === "waiting" || response.data.status === "processing") {
			    	let jobID = response.data.id
			    	$("#videoConvertingProgress_modal").modal("show")
			    	//now delete my own server video file
			    	setTimeout(deleteMyVideoNow, 10000, jobID);
			    
			    }else if(response.data.status === "finished"){
			    	//first time-ei task finished
			    	console.log('WOW!! Job instantly finished!')
			    	
			    	let myResult = response.data.tasks[0].result;
					let arrayKey;
					for(keyFirst in myResult) { 
						arrayKey = myResult[keyFirst]
					}
					//console.log(arrayKey)
					//console.log(arrayKey[0].url)
					
					let videDownloadURL = arrayKey[0].url;
					if (videDownloadURL !== "") {
						$("#converted_mp3_download_option #converted_mp3_link").val(videDownloadURL)
						$("#show_converted_success_msg").html("<p style='color:green; font-weight:bold; text-align:center'>Video Converted Successfully</p>")
						$("#converted_mp3_download_option").show()
					}else{
						alert('We are sorry, something wrong')
						window.location.reload(true)
					}

			    }else{
			    	//error
			    	console.log("Error in instantly -")
			    	$("#videoConvertingProgress_modal").modal("hide")
			    	swal('Sorry', 'Something went wrong! please try again later.', 'info')
			    	.then(response=>{
			    		window.location.reload(true)
			    	})
			    }
			},
			error: function (jqXHR, textStatus, errorThrown) {
                $("#videoConvertingProgress_modal").modal("hide")
                swal('Sorry', 'Something not right!!', 'info')
		    	.then(response=>{
		    		window.location.reload(true)
		    	})
            }
		});
	})


	//delete video file from my server & check video status on thirparty
	function deleteMyVideoNow(jobID){
		//get videoID of saved our database
		let videoID = $("#video_uniq_id").val();
		
		if(videoID !== "" && jobID !== ""){
			//check converting status & delete my video
			let checkValue = videoID;
			check_status_and_delete(checkValue, jobID)
		}else{
			swal("Sorry", "We can't process your video now! please try again.", 'info')
			.then(response=>{
				window.location.reload(true)
			})
		}
	}


	function check_status_and_delete(checkValue, jobID){
		$.ajax({
			url: "/convert/mp3-converter/check-job-status/"+checkValue+'/'+jobID,
			method: "GET",
			dataType: 'JSON',
			cache: false,
			success: function(response){
				//console.log(response)
				//let taskStatus = response.data.tasks;
			    //console.log(response.data.tasks[0].result)
			    //console.log(taskStatus)
			    
			    if (response.data.status === "finished") {
			    	console.log("WOW! Job finished in first round!")

			    	let myResult = response.data.tasks[0].result;
					let arrayKey;
					for(keyFirst in myResult) { 
						arrayKey = myResult[keyFirst]
					}
					//console.log(arrayKey)
					//console.log(arrayKey[0].url)
					let videDownloadURL = arrayKey[0].url;
					if (videDownloadURL !== "") {
						$("#converted_mp3_download_option #converted_mp3_link").val(videDownloadURL)
						$("#show_converted_success_msg").html("<p style='color:green; font-weight:bold; text-align:center'>Video Converted Successfully</p>")
						$("#converted_mp3_download_option").show()
					}else{
						alert('We are sorry, something wrong')
						window.location.reload(true)
					}

			    }else if(response.data.status === "processing" || response.data.status === "waiting"){
			    	let job_id = response.data.id;
			    	setTimeout(checkStatusOnlyContinuesly, 15000, job_id);
			    }else{
			    	//error
			    	console.log("Error in first round time")
			    	$("#videoConvertingProgress_modal").modal("hide")
	                swal('Sorry', 'Video converting error, please try again!', 'info')
			    	.then(response=>{
			    		window.location.reload(true)
			    	})
			    }
			    
			},
			error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 422) {
                  	console.log("Job ID Not Found!!")
                  	swal('Sorry', jqXHR.responseText, 'info')
                  	.then(response=>{
                  		window.location.reload(true)
                  	})
                }else if (jqXHR.status == 401) {
                  	swal('Sorry', jqXHR.responseText, 'info')
                  	.then(response=>{
                  		window.location.reload(true)
                  	})
                }else{
                	swal('Sorry', 'Something went wrong!', 'info')
	                .then(response=>{
	                	window.location.reload(true)
	                })
                }
                
            }
		});
	}


	//check second time try
	function checkStatusOnlyContinuesly(jobID){
		$.ajax({
			url: "/convert/mp3-converter/checking-job-status-ongoing/"+jobID,
			method: "GET",
			dataType: 'JSON',
			cache: false,
			success: function(response){
				console.log(response)
			    
			    if (response.data.status === "finished") {
			    	//clear interval 
			    	console.log('Job finished in second round!')
			    	
			    	let myResult = response.data.tasks[0].result;
					let arrayKey;
					for(keyFirst in myResult) { 
						arrayKey = myResult[keyFirst]
					}
					//console.log(arrayKey)
					//console.log(arrayKey[0].url)
					let videDownloadURL = arrayKey[0].url;
					if (videDownloadURL !== "") {
						$("#converted_mp3_download_option #converted_mp3_link").val(videDownloadURL)
						$("#show_converted_success_msg").html("<p style='color:green; font-weight:bold; text-align:center'>Video Converted Successfully</p>")
						$("#converted_mp3_download_option").show()
					}else{
						alert('We are sorry, something wrong')
						window.location.reload(true)
					}


			    }else if(response.data.status === "processing" || response.data.status === "waiting"){
			    	//try last round
			    	let job_id = response.data.id;
			    	setTimeout(checkLastTime, 25000, job_id);
			    
			    }else{
			    	//error
			    	console.log('Error in second round time')
			    	$("#videoConvertingProgress_modal").modal("hide")
	                swal('Sorry', 'Video converting error, please try again!', 'info')
			    	.then(response=>{
			    		window.location.reload(true)
			    	})
			    }
			    
			},
			error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 422) {
                  	console.log("Job ID Not Found!!")
                  	swal('Sorry', jqXHR.responseText, 'info')
                  	.then(response=>{
                  		window.location.reload(true)
                  	})
                }else if (jqXHR.status == 401) {
                  	swal('Sorry', jqXHR.responseText, 'info')
                  	.then(response=>{
                  		window.location.reload(true)
                  	})
                }else{
                	swal('Sorry', 'Something went wrong!', 'info')
	                .then(response=>{
	                	window.location.reload(true)
	                })
                }
                
            }
		});
	}



	//last time try
	function checkLastTime(jobID){
		$.ajax({
			url: "/convert/mp3-converter/checking-job-status-ongoing/"+jobID,
			method: "GET",
			dataType: 'JSON',
			cache: false,
			success: function(response){
				console.log(response)
			    
			    if (response.data.status === "finished") {
			    	//clear interval 
			    	console.log('Job finished in second round!')
			    	
			    	let myResult = response.data.tasks[0].result;
					let arrayKey;
					for(keyFirst in myResult) { 
						arrayKey = myResult[keyFirst]
					}
					//console.log(arrayKey)
					//console.log(arrayKey[0].url)
					let videDownloadURL = arrayKey[0].url;
					if (videDownloadURL !== "") {
						$("#converted_mp3_download_option #converted_mp3_link").val(videDownloadURL)
						$("#show_converted_success_msg").html("<p style='color:green; font-weight:bold; text-align:center'>Video Converted Successfully</p>")
						$("#converted_mp3_download_option").show()
					}else{
						alert('We are sorry, something wrong')
						window.location.reload(true)
					}

			    }else if(response.data.status === "processing" || response.data.status === "waiting"){
			    	//stopped the trying to converting
			    	console.log('Stopped trying')
			    	$("#videoConvertingProgress_modal").modal("hide")
	                swal('Sorry', 'We have try a lots time, please try again to convert!', 'info')
			    	.then(response=>{
			    		window.location.reload(true)
			    	})
			    
			    }else{
			    	//error
			    	console.log('Error in third round time')
			    	$("#videoConvertingProgress_modal").modal("hide")
	                swal('Sorry', 'Video converting error, please try again!', 'info')
			    	.then(response=>{
			    		window.location.reload(true)
			    	})
			    }
			    
			},
			error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 422) {
                  	console.log("Job ID Not Found!!")
                  	swal('Sorry', jqXHR.responseText, 'info')
                  	.then(response=>{
                  		window.location.reload(true)
                  	})
                }else if (jqXHR.status == 401) {
                  	swal('Sorry', jqXHR.responseText, 'info')
                  	.then(response=>{
                  		window.location.reload(true)
                  	})
                }else{
                	swal('Sorry', 'Something went wrong!', 'info')
	                .then(response=>{
	                	window.location.reload(true)
	                })
                }
                
            }
		});
	}
	
	
	//delete all temporary videos from folder - delete every day once
	function executeOnloadDocument(){
// 	    $.ajax({
// 	        url: "/delete-all-temporary-files/now,
// 			method: "GET",
// 			dataType: 'JSON',
// 			cache: false,
// 			success: function(response){
			    
// 			}
	        
// 	    })
	}
})	