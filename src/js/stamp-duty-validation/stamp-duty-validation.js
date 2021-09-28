( function( $, window, document, undefined ) {

	$("#stamp_duty_submit").click(function() {
			var propertyAmount = $('[name=property_value]').val();
			var propertyType = $('[name=property_type]').val();
			console.log(propertyType);
			var templateDirectory = $('input[name=template_directory]').val();
			proceed = true;

			if(propertyAmount=="") {
					$('input[name=property_value]').css('border-color','red');
					proceed = false;
			}

			if(propertyType=="") {
				$('input[name=propertyType]').css('border-color','red');
				proceed = false;
		}

			if(proceed){
					post_data = {
						'propertyType': propertyType,
						'propertyAmount':propertyAmount
					};
					$.post(
						templateDirectory + '/stamp-duty-calculator.php',
						post_data,
						function(response){
							if(response.type == 'error'){
									output = '<div class="error stamp-response">'+response.text+'</div>';
							}
							else{
									output = '<div class="success stamp-response">'+response.text+'</div>';
							}
							$("#stamp-result p").html(output);
					}, 'json');
	}
	return false;
	});
})(jQuery, window, document);
