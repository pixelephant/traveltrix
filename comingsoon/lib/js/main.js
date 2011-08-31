function isValidEmailAddress(emailAddress) {
var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
return pattern.test(emailAddress);
}

$(document).ready( function () {
	
	$("#more a").click(function(){
		$("#more-text").slideDown();
		return false;
	});
	
	$("form").submit(function(e){
		e.preventDefault();
		var $this = $(this);
		var mail = $this.find(".email").val();
		var $error = $this.find(".error");
		var $msg = $this.find(".msg");
		var $b = $this.find("input[type='submit']");
		$b.attr('disabled', 'disabled');
		if(mail == ""){
			$error.empty().append("A mező kitöltése kötelező.");
			$b.removeAttr('disabled');
			return;
		}
		else if(!isValidEmailAddress(mail)){
			$error.empty().append("Érvénytelen cím.");
			$b.removeAttr('disabled');
			return;
		}
		else{
			$.post("lib/php/process.php",{
				"val" : $this.serialize()
			},function(resp){
				if(resp == "ok"){
					$msg.append("Köszönjük.");
				}
				else{
					$msg.append("Hiba történt. Kérjük próbálja újra.")
				}
				$b.removeAttr('disabled');
				$(".error").empty();
			});
		}
		$b.removeAttr('disabled');
		return false;
	});	
	
});