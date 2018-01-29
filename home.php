<div>
<?php
	if(isAuthed()){
		echo '<p>Welcome '.json_decode(makeMattermostRequest('api/v4/users/me'))->username.'!</p>';
	}else{
		echo '<p>Once you are authorized this page should welcome you by name.</p>';
	}
?>
</div>
