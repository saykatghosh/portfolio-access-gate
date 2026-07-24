<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Dashboard_Status {

	/**
	 * Render system status.
	 */
	public static function render() {

		?>

		<div class="pag-box">

			<?php

			PAG_Dashboard_Components::section(
				'System Status',
				'Current plugin health.'
			);

			?>

			<table class="pag-table">

				<tbody>

					<tr>

						<td>Plugin</td>

						<td><span class="pag-badge">Active</span></td>

					</tr>

					<tr>

						<td>Database</td>

						<td><span class="pag-badge">Connected</span></td>

					</tr>

					<tr>

						<td>Security</td>

						<td><span class="pag-badge">Enabled</span></td>

					</tr>

					<tr>

						<td>Cookie</td>

						<td><span class="pag-badge">Enabled</span></td>

					</tr>

					<tr>

						<td>AJAX</td>

						<td><span class="pag-badge">Working</span></td>

					</tr>

					<tr>

						<td>Version</td>

						<td><strong><?php echo esc_html( PAG_VERSION ); ?></strong></td>

					</tr>

				</tbody>

			</table>

		</div>

		<?php

	}

}