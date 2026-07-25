<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Popup_Builder {

	public function render() {

		?>

		<div class="wrap pag-popup-builder-wrap">

			<div class="pag-builder-header">

				<div>

					<h1 class="wp-heading-inline">

						Popup Builder

					</h1>

					<p>

						Create and customize your popup visually.

					</p>

				</div>

				<div class="pag-builder-header-actions">

					<button
						type="button"
						class="button">

						Reset

					</button>

					<button
						type="button"
						class="button">

						Preview

					</button>

					<button
						type="button"
						class="button button-primary">

						Save Changes

					</button>

				</div>

			</div>

			<?php

			include PAG_PLUGIN_PATH .
				'resources/views/popup-builder/builder.php';

			?>

		</div>

		<?php

	}

}