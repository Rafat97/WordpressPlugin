<div class="container">
	<form action="options.php" method="post" >
		
		<?php 

			settings_fields( 'homeTrotting_api_setting' );
			do_settings_sections( 'homeTrotting_api_setting' );
			submit_button("Save Changes");

		 ?>
	</form>
</div>
<br>
<br>

?>