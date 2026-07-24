<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Leads {

	public function render() {

		global $wpdb;

		$table = $wpdb->prefix . PAG_Leads_DB::TABLE;

		$results = $wpdb->get_results(
			"SELECT * FROM {$table} ORDER BY id DESC"
		);

		?>

		<div class="wrap">

			<h1 class="wp-heading-inline">Leads</h1>

			<form method="post"
				action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"
				style="float:right;margin-bottom:20px;">

				<?php wp_nonce_field( 'pag_export_csv' ); ?>

				<input type="hidden" name="action" value="pag_export_csv">

				<input type="submit"
					class="button button-primary"
					value="Export CSV">

			</form>

			<div style="clear:both;"></div>

			<form
				method="post"
				action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">

				<?php wp_nonce_field( 'pag_bulk_delete' ); ?>

				<input
					type="hidden"
					name="action"
					value="pag_bulk_delete">

				<p>

					<input
						type="submit"
						class="button button-secondary"
						value="Delete Selected"

						onclick="return confirm('Delete selected leads?');">

				</p>

				<table class="widefat striped">

					<thead>

					<tr>

						<th width="40">

							<input
								type="checkbox"
								id="pag-select-all">

						</th>

						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Domain</th>
						<th>Page</th>
						<th>IP</th>
						<th>Date</th>
						<th width="170">Action</th>

					</tr>

					</thead>

					<tbody>

					<?php if ( $results ) : ?>

						<?php foreach ( $results as $lead ) : ?>

							<tr>

								<td>

									<input
										type="checkbox"
										name="lead_ids[]"
										value="<?php echo esc_attr( $lead->id ); ?>">

								</td>

								<td><?php echo esc_html( $lead->id ); ?></td>
								<td><?php echo esc_html( $lead->full_name ); ?></td>
								<td><?php echo esc_html( $lead->email ); ?></td>
								<td><?php echo esc_html( $lead->email_domain ); ?></td>
								<td><?php echo esc_html( $lead->page_title ); ?></td>
								<td><?php echo esc_html( $lead->ip_address ); ?></td>
								<td><?php echo esc_html( $lead->created_at ); ?></td>

								<td>


									<a

										class="button button-small"

										href="<?php echo esc_url(

											admin_url(

												'admin.php?page=pag-leads&view=' . $lead->id

											)

										); ?>">

										View

									</a>

									&nbsp;

									<a
										class="button button-small button-link-delete"

										onclick="return confirm('Delete this lead?');"

										href="<?php echo esc_url(
											wp_nonce_url(
												admin_url(
													'admin-post.php?action=pag_delete_lead&lead_id=' . $lead->id
												),
												'pag_delete_lead'
											)
										); ?>">

										Delete

									</a>

								</td>

							</tr>

						<?php endforeach; ?>

					<?php else : ?>

						<tr>

							<td colspan="9">

								No Leads Found.

							</td>

						</tr>

					<?php endif; ?>

					</tbody>

				</table>

						<?php

						if ( isset( $_GET['view'] ) ) :

							$item = PAG_View_Lead::get(

								absint( $_GET['view'] )

							);

							if ( $item ) :

						?>

						<hr>

						<h2>Lead Details</h2>

						<table class="widefat striped">

						<tr>
						<th width="220">Full Name</th>
						<td><?php echo esc_html( $item->full_name ); ?></td>
						</tr>

						<tr>
						<th>Email</th>
						<td><?php echo esc_html( $item->email ); ?></td>
						</tr>

						<tr>
						<th>Domain</th>
						<td><?php echo esc_html( $item->email_domain ); ?></td>
						</tr>

						<tr>
						<th>Page</th>
						<td><?php echo esc_html( $item->page_title ); ?></td>
						</tr>

						<tr>
						<th>IP Address</th>
						<td><?php echo esc_html( $item->ip_address ); ?></td>
						</tr>

						<tr>
						<th>User Agent</th>
						<td><?php echo esc_html( $item->user_agent ); ?></td>
						</tr>

						<tr>
						<th>Created</th>
						<td><?php echo esc_html( $item->created_at ); ?></td>
						</tr>

						</table>

						<?php

							endif;

						endif;

						?>

			</form>

		</div>

		<script>

		document.addEventListener("DOMContentLoaded",function(){

			const all=document.getElementById("pag-select-all");

			if(!all){
				return;
			}

			all.addEventListener("change",function(){

				document.querySelectorAll("input[name='lead_ids[]']").forEach(function(item){

					item.checked=all.checked;

				});

			});

		});

		</script>

		<?php

	}

}