$(document).ready(function(){

	//search products
	$("#searchProductInput_").on('keyup', function(){
		//get products
		let searchKey = $(this).val();
		if (!$(this).val()) {
			$("#render__data").html('')
			return;
		}
	    if (searchKey !== "") {
	    	$.ajax({
		        url:"/vendor/ajax-get-deals-product/fetch?search_key="+searchKey,
		        method:'GET',
		        cache:false,
		        success:function(response){
		            $("#render__data").html(response)
		        },
		        error: function (jqXHR, textStatus, errorThrown) {
		            if (jqXHR.status === 404) {
		                $("#render__data").html(jqXHR.responseText)
		            }else if (jqXHR.status === 422) {
		                let string_to_obj = JSON.parse(jqXHR.responseText)
	                  	//console.log(string_to_obj.field)
                  		$("input[name="+string_to_obj.field+"]").addClass('border-danger-alert');
                  		$("input[name="+string_to_obj.field+"]").siblings('.place-error--msg').html(string_to_obj.msg);
	                  	

                  	
		            }else if (jqXHR.status === 401) {
		                alert('Sorry\n'+ jqXHR.responseText)
		                //window.location.reload(true)
		            }else{
		                alert('Sorry\n Something unknown problem')
		                //window.location.reload(true)
		            }

		        }
		    })
	    
	    }else{
	    	return false;
	    }


	})


	$("#render__data").on('click', "ul li", function(){
		let productID = $(this).attr('getproductid')
		let getTitle = $(this).attr('gettitle')
		
		$("#set__productID").val(productID)
		$("#searchProductInput_").val(getTitle)
		$("#render__data .auto-complete-wrapper").html('')
	})



	

})





//remove form validation error
function removeErrorLevels(getThis, type){
	if (type === "input") {
		getThis.removeClass('border-danger-alert')
		getThis.siblings('.place-error--msg').html('')
		return;
	}

	if (type === "id__") {
		console.log('yes this is id')
		return;
	}
	console.log('yes outside')
	
}