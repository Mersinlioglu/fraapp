<form id="form-search-non-<?php echo $this->name ?>" method="POST" action="<?php echo $this->action; ?>">
<input id="non-<?php echo $this->name ?>" name="add-<?php echo $this->name ?>" type="text" placeholder="Suche.." autocomplete="off" style="float:left; color:grey; height:24px; margin-right:5px;"></input>
<button id="submit" class="btn disabled">Hinzufügen</button>
</form>

<script>
$(function() {
	var s = <?php echo $this->json; ?>;
	var input = $('#non-<?php echo $this->name ?>');
	input.typeahead({source:s});
	var submitButton = $('#submit');
	var form = $('#form-search-non-<?php echo $this->name ?>');
	var hiddenInput = $('#non-<?php echo $this->name ?>-hidden');

	form.submit(function() {
		if(submitButton.hasClass('disabled'))
			return false;
	});
	hiddenInput.change(function(){
		submitButton.removeClass('disabled').addClass('btn-primary');
	});
	input.keyup(function(e){
		if(e.keyCode!==13)	// 13 = enter
			submitButton.addClass('disabled').removeClass('btn-primary');
	});
});
</script>