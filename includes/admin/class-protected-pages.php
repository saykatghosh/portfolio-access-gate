<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Protected_Pages {

	public function render() {

		// Save Settings
		if ( isset( $_POST['pag_save_pages'] ) ) {

			if (
				! isset( $_POST['pag_nonce'] ) ||
				! wp_verify_nonce( $_POST['pag_nonce'], 'pag_save_protected_pages' )
			) {
				wp_die( 'Security check failed.' );
			}

			$selected = array();

			if ( isset( $_POST['protected_pages'] ) ) {
				$selected = array_map( 'absint', $_POST['protected_pages'] );
			}

			update_option( 'pag_protected_pages', $selected );

			echo '<div class="notice notice-success is-dismissible"><p>Protected Pages Saved Successfully.</p></div>';
		}

		$pages = get_pages();

		$saved = get_option(
			'pag_protected_pages',
			array()
		);

		?>

		<div class="wrap">

			<h1>Protected Pages</h1>

			<p>Select the pages you want to protect.</p>

			<hr>

			<form method="post">

				<?php wp_nonce_field(
					'pag_save_protected_pages',
					'pag_nonce'
				); ?>

				<table class="widefat striped">

					<thead>

						<tr>

							<th width="60">Select</th>

							<th>Page Name</th>

							<th width="100">ID</th>

						</tr>

					</thead>

					<tbody>

					<?php if ( ! empty( $pages ) ) : ?>

						<?php foreach ( $pages as $page ) : ?>

							<tr>

								<td>

									<input
										type="checkbox"
										name="protected_pages[]"
										value="<?php echo esc_attr( $page->ID ); ?>"
										<?php checked(
											in_array(
												$page->ID,
												$saved,
												true
											)
										); ?>
									>

								</td>

								<td>

									<?php echo esc_html( $page->post_title ); ?>

								</td>

								<td>

									<?php echo esc_html( $page->ID ); ?>

								</td>

							</tr>

						<?php endforeach; ?>

					<?php else : ?>

						<tr>

							<td colspan="3">

								No Pages Found.

							</td>

						</tr>

					<?php endif; ?>

					</tbody>

				</table>

				<p style="margin-top:20px;">

					<input
						type="submit"
						name="pag_save_pages"
						class="button button-primary"
						value="Save Protected Pages">

				</p>

			</form>

		</div>

		<?php

	}

}