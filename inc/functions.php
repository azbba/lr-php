<?php

/**
 * Helper functions 
*/

function form_errors( array $errors ) {
	if ( !empty( $errors ) ) {
		echo '<div class="errors-container mt-3">';
		foreach ( $errors as $error ) {
			?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<?php echo $error; ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php
		}
		echo '</div>';
	}
}