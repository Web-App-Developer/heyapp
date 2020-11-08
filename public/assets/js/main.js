$(document).ready(function(){
	//option
	$(".selectOption_").on('change', function(){
		let ID = $(this).attr('getformid')
		if ($(this).val() === "Bachelor" || $(this).val() === "Master") {
			$(".wapper_").addClass('d-none')
			$("#"+ID + $(this).val() + " ." + $(this).val() + "--warpper").removeClass('d-none')
		}else{
			$(".wapper_").addClass('d-none')
		}
		
	})


	//set email
	$(".get_fullNameVal").on('keyup', function(){
		let getFromID = $(this).attr('getformid')
		let value = $(this).val()
		$("#"+getFromID+"Bachelor .set_full_name_val").val(value)
		$("#"+getFromID+"Master .set_full_name_val").val(value)
	})



	//form submit
    $(".myForm__").on('submit', function(e){
        e.preventDefault()
        let formID = $(this).attr('id');
        let url = $(this).attr('action');
        let type = $(this).attr('method');
        let form_data = $(this).serialize();
        formSubmitted(formID, url, type, form_data);
    })
    

})






function formSubmitted(formID, url, type, form_data){
		$.ajax({
			url: url,
			data: new FormData(document.getElementById(formID)),
			method: type,
			dataType: 'JSON',
			contentType: false,
			cache: false,
			processData:false,
			beforeSend:function(){

				$("#form_processing_gif").show()
				$("#"+formID +"button[type=submit]").attr('disabled', true)
			},
			success: function(response){
				$("#form_processing_gif").hide()
				$("#"+formID +"button[type=submit]").attr('disabled', false)
				if (response.success === true) {
					alert("Success!\n"+response.msg)
					window.location.reload(true)
				}else{
					alert("Something went wrong...")
					window.location.reload(true)
				}
									
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$("#form_processing_gif").hide()
				$("#"+formID +"button[type=submit]").attr('disabled', false)

				if (jqXHR.status === 422) {
                  	let string_to_obj = JSON.parse(jqXHR.responseText)                  	
                  	if ($("#alerModal .msgbox").length) {
                  		$("#alerModal .msgbox").html('<p>SORRY - '+string_to_obj.msg+'</p>')
                  		$("#alerModal").modal('show')
                  	}else{
                  		alert("SORRY\n"+string_to_obj.msg)
                  	}
                  	
                  	
                }else if (jqXHR.status === 500) {
                  	alert('Sorry\n'+ jqXHR.responseText)
                  	//window.location.reload(true)
                }else if (jqXHR.status === 404) {
                  	alert('Sorry\n'+ jqXHR.responseText)
                }else{
                  	alert('Sorry\n Something unknown problem')
                  	//window.location.reload(true)
                }

            },
            complete:function(){
            	$("#form_processing_gif").hide()
				$("#"+formID +"button[type=submit]").attr('disabled', false)
            }
        });
}