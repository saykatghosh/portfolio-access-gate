<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Settings {

	public function render() {

		$options = PAG_Settings_Manager::get();

		?>

		<div class="wrap">

			<h1>Portfolio Access Gate Settings</h1>

			<form method="post" action="options.php">

				<?php

				settings_fields( 'pag_settings_group' );

				?>
				<?php settings_errors(); ?>

				

				<div class="pag-settings-wrap">

					<div class="pag-settings-card">

						<h2>General</h2>

						<table class="form-table">

							<tr>

	<th>Cookie Duration</th>

	<td>

		<div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">

			<div>

				<input
					type="number"
					min="0"
					max="720"
					style="width:90px;"
					name="<?php echo esc_attr( PAG_Settings_Manager::OPTION_NAME ); ?>[cookie_hours]"
					value="<?php echo esc_attr( $options['cookie_hours'] ); ?>">

				<p class="description">Hours</p>

			</div>

			<div>

				<input
					type="number"
					min="0"
					max="59"
					style="width:90px;"
					name="<?php echo esc_attr( PAG_Settings_Manager::OPTION_NAME ); ?>[cookie_minutes]"
					value="<?php echo esc_attr( $options['cookie_minutes'] ?? 0 ); ?>">

				<p class="description">Minutes</p>

			</div>

		</div>

		<p class="description">
			Set how long visitors can access protected pages after verification.
		</p>

	</td>

</tr>

							<tr>

								<th>Remember Access</th>

								<td>

									<label>

										<input
											type="checkbox"
											name="<?php echo esc_attr( PAG_Settings_Manager::OPTION_NAME ); ?>[remember_access]"
											value="1"
											<?php checked( $options['remember_access'], 1 ); ?>>

										Enable

									</label>

								</td>

							</tr>

							<tr>

								<th>Redirect Type</th>

								<td>

									<select
										name="<?php echo esc_attr( PAG_Settings_Manager::OPTION_NAME ); ?>[redirect_type]">

										<option value="reload" <?php selected( $options['redirect_type'], 'reload' ); ?>>

											Reload Current Page

										</option>

										<option value="custom" <?php selected( $options['redirect_type'], 'custom' ); ?>>

											Redirect URL

										</option>

									</select>

								</td>

							</tr>

							<tr>

								<th>Redirect URL</th>

								<td>

									<input
										type="url"
										class="regular-text"
										name="<?php echo esc_attr( PAG_Settings_Manager::OPTION_NAME ); ?>[redirect_url]"
										value="<?php echo esc_attr( $options['redirect_url'] ); ?>">

								</td>

							</tr>

						</table>

					</div>

					<div class="pag-settings-card">

						<h2>Email Validation</h2>

						<table class="form-table">

							<tr>

								<th>Block Free Email</th>

								<td>

									<label>

										<input
											type="checkbox"
											name="<?php echo esc_attr( PAG_Settings_Manager::OPTION_NAME ); ?>[block_free_email]"
											value="1"
											<?php checked( $options['block_free_email'], 1 ); ?>>

										Enable

									</label>

								</td>

							</tr>

							<tr>

								<th>Block Temporary Email</th>

								<td>

									<label>

										<input
											type="checkbox"
											name="<?php echo esc_attr( PAG_Settings_Manager::OPTION_NAME ); ?>[block_temp_email]"
											value="1"
											<?php checked( $options['block_temp_email'], 1 ); ?>>

										Enable

									</label>

								</td>

							</tr>

							<tr>

								<th>MX Validation</th>

								<td>

									<label>

										<input
											type="checkbox"
											name="<?php echo esc_attr( PAG_Settings_Manager::OPTION_NAME ); ?>[mx_validation]"
											value="1"
											<?php checked( $options['mx_validation'], 1 ); ?>>

										Enable

									</label>

								</td>

							</tr>

						</table>

					</div>

					<div class="pag-settings-card">

						<h2>Privacy</h2>

						<table class="form-table">

							<tr>

								<th>Collect IP Address</th>

								<td>

									<label>

										<input
											type="checkbox"
											name="<?php echo esc_attr( PAG_Settings_Manager::OPTION_NAME ); ?>[collect_ip]"
											value="1"
											<?php checked( $options['collect_ip'], 1 ); ?>>

										Enable

									</label>

								</td>

							</tr>

							<tr>

								<th>Collect User Agent</th>

								<td>

									<label>

										<input
											type="checkbox"
											name="<?php echo esc_attr( PAG_Settings_Manager::OPTION_NAME ); ?>[collect_user_agent]"
											value="1"
											<?php checked( $options['collect_user_agent'], 1 ); ?>>

										Enable

									</label>

								</td>

							</tr>

						</table>

					</div>

				</div>

				<?php submit_button( 'Save Settings' ); ?>

			</form>

		</div>

		<style>

		.pag-settings-wrap{

			display:grid;
			grid-template-columns:repeat(auto-fit,minmax(420px,1fr));
			gap:24px;
			margin-top:25px;

		}

		.pag-settings-card{

			background:#fff;
			border:1px solid #dcdcde;
			border-radius:12px;
			padding:25px;

		}

		.pag-settings-card h2{

			margin:0 0 20px;

		}

		.pag-settings-card table{

			margin:0;

		}

		</style>

		<?php

	}

}