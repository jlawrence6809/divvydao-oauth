<div>
<?php
	if(isAuthed()){
		echo '<p>This is a list of json encoded mattermost users:</p><div>'.makeMattermostRequest('api/v4/users').'</div>';
	}else{
		echo '<p>Once you are authorized this page will display some example api output</p>';
	}
?>
</div>
