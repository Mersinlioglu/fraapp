
	
	var checkboxes = $('.beforeFlightForm input[type=checkbox]');

	$(document).ready(function(){
		//Deactivate all checkboxes
		checkboxes.each(function(index){
			$(this).prop('disabled', true);
		});
		//Activate first checkbox
		checkboxes.first().prop('disabled', false);
	});

	//On click
	checkboxes.click(function(){

		$(this).prop('disabled', true);

		//Create Date Now
		var dateNow = new Date();
		var unixTimestampNow = Math.round(dateNow/1000);
		var displayTime = dateNow.getHours() + ':' + dateNow.getMinutes() + ':' + dateNow.getSeconds();
		
		//Set checked up time
		$(this).next().val(unixTimestampNow);
		
		//Set display time
		$(this).closest('tr').children().last().text(displayTime);

		//Activate next checkbox			
		var nextRow = $(this).closest('tr').next();
		nextRow.find('input[type="checkbox"]').prop('disabled', false);

	});

	function areAllCheckBoxesChecked(){
		var valid = true;
		// $('.beforeFlightForm input[type=checkbox]').each(function(index){
		$('input[type=checkbox]').each(function(index){
			if(!$(this).is(':checked')){
				valid = false;
				// continue;
			}
		});
		return valid;
	}