<div class="container">
	<form action="options.php" method="post" >
		
		<?php 

			settings_fields( "member_content_Highlights_2_Part" );
			do_settings_sections( "member_content_Highlights_2_Part" );
			submit_button("Save Changes");

		 ?>
	</form>
</div>