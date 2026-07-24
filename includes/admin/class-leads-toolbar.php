<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Leads_Toolbar {

	public static function render() {

		?>

		<div class="pag-box">

			<div class="pag-toolbar">

				<div>

					<h2>

						Leads

					</h2>

					<p>

						Manage captured business leads.

					</p>

				</div>

				<div class="pag-toolbar-actions">

					<a
						href="<?php echo esc_url( admin_url( 'admin.php?page=pag-settings' ) ); ?>"
						class="button">

						Settings

					</a>

					<form
						method="post"
						action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">

						<?php wp_nonce_field( 'pag_export_csv' ); ?>

						<input
							type="hidden"
							name="action"
							value="pag_export_csv">

						<button
							type="submit"
							class="button button-primary">

							Export CSV

						</button>

					</form>

				</div>

			</div>

		</div>

		<?php

	}

}