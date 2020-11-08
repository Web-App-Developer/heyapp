$(document).ready(function(){

	//show question edit modal
	$(".showQuestionEditModal").on("click", function(){
		var modalID = $(this).attr('modalid')
		$("#edit_ques_modal_"+modalID).modal("show")
	})
})