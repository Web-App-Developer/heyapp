$(document).ready(function(){
    //add media
    $('#__add_media_btn__').on('click', function(){
        $('#_media_input__').click();
    })
    
    //if value changed of input
    $('#_media_input__').on('change', function(){
        if($(this).val() !== ""){
            $('#__add_media_btn__').hide()
            $('#__media_submit_btn__').show()
        }else{
            $('#__add_media_btn__').show()
            $('#__media_submit_btn__').hide()
        }
    });
    
    //submit media form
	$("#media_uploading_form__").on('submit', function(e){
		e.preventDefault();
		var form = $(this);
		var url = form.attr('action');
		var type = form.attr('method');

		var form_data = form.serialize();
		//alert(form_data);

		$.ajax({
			url: url,
			data: new FormData(this),
			method: type,
			dataType: 'JSON',
			contentType: false,
			cache: false,
			processData:false,
			beforeSend:function(){
			    $("#media_uploading_form__ #__media_submit_btn__").attr('disabled', true)
			},
			success: function(response){
			    $("#media_uploading_form__ #__media_submit_btn__").attr('disabled', false);
                $("#media_uploading_form__ #__media_submit_btn__").hide();
                $("#media_uploading_form__ #__add_media_btn__").show();
                
				if(response.success === true){
				    $("#__media_updates_modal__ #diplay_media_path_").html(response.get_media)
				    $("#__media_updates_modal__").modal('show')
				}else{
				    alert('Something not right...');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
			    $("#media_uploading_form__ #__media_submit_btn__").attr('disabled', false);
                $("#media_uploading_form__ #__media_submit_btn__").hide();
                $("#media_uploading_form__ #__add_media_btn__").show();
                
                  if (jqXHR.status == 422) {
                      alert('SORRY\n\n'+jqXHR.responseText)
                  } else {
                      alert('SORRY\n\nUnknown Error Occured')
                  }
            },
            complete:function(){
                $("#media_uploading_form__ #__media_submit_btn__").attr('disabled', false);
                $("#media_uploading_form__ #__media_submit_btn__").hide();
                $("#media_uploading_form__ #__add_media_btn__").show();
            }
		});

	});
})