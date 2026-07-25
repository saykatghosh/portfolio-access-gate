<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Leads_Toolbar {

	/**
	 * Render leads toolbar.
	 */
	public static function render() {

		?>

		<div class="pag-box">

			<div class="pag-toolbar">

				<div class="pag-toolbar-content">

					<h2>

						<?php esc_html_e( 'Leads', 'portfolio-access-gate' ); ?>

					</h2>

					<p>

						<?php esc_html_e(
							'Manage captured business leads.',
							'portfolio-access-gate'
						); ?>

					</p>

				</div>

				<div class="pag-toolbar-actions">

					<a
						href="<?php echo esc_url( admin_url( 'admin.php?page=pag-settings' ) ); ?>"
						class="button"
					>

						<?php esc_html_e(
							'Settings',
							'portfolio-access-gate'
						); ?>

					</a>

					<form
						method="post"
						action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"
					>

						<?php

						wp_nonce_field(
							'pag_export_csv',
							'pag_export_nonce'
						);

						?>

						<input
							type="hidden"
							name="action"
							value="pag_export_csv"
						>

						<button
							type="submit"
							class="button button-primary"
							aria-label="<?php esc_attr_e(
								'Export leads as CSV',
								'portfolio-access-gate'
							); ?>"
						>

							<?php esc_html_e(
								'Export CSV',
								'portfolio-access-gate'
							); ?>

						</button>

					</form>

				</div>

			</div>

		</div>

		<?php

	}

}