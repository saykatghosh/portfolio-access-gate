<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Leads {

	public function render() {

		$search = isset( $_GET['s'] )
			? sanitize_text_field( wp_unslash( $_GET['s'] ) )
			: '';

		$page = isset( $_GET['paged'] )
			? max( 1, absint( $_GET['paged'] ) )
			: 1;

		$per_page = 20;

		$rows = PAG_Leads_Table::get_data(
			$search,
			$page,
			$per_page
		);

		$total = PAG_Leads_Table::total( $search );

		$total_pages = (int) ceil( $total / $per_page );

		?>

		<div class="wrap pag-dashboard">

			<?php PAG_Leads_Toolbar::render(); ?>

			<div class="pag-box">

				<div class="pag-toolbar">

					<form
						method="get"
						class="pag-search-form">

						<input
							type="hidden"
							name="page"
							value="pag-leads">

						<input
							type="search"
							name="s"
							value="<?php echo esc_attr( $search ); ?>"
							placeholder="Search by name, email or page...">

						<button
							type="submit"
							class="button">

							Search

						</button>

					</form>

				</div>

				<table class="pag-table">

					<thead>

						<tr>

							<th>Name</th>

							<th>Email</th>

							<th>Type</th>

							<th>Page</th>

							<th>Date</th>

							<th width="90">Action</th>

						</tr>

					</thead>

					<tbody>

					<?php if ( ! empty( $rows ) ) : ?>

						<?php foreach ( $rows as $lead ) : ?>

							<tr>

								<td>

									<div class="pag-user">

										<?php
										PAG_Leads_Components::avatar(
											$lead->full_name
										);
										?>

										<div>

											<strong>

												<?php echo esc_html( $lead->full_name ); ?>

											</strong>

											<br>

											<small>

												ID #<?php echo esc_html( $lead->id ); ?>

											</small>

										</div>

									</div>

								</td>

								<td>

									<div>

										<strong>

											<?php echo esc_html( $lead->email ); ?>

										</strong>

										<br>

										<span class="pag-domain">

											<?php echo esc_html( $lead->email_domain ); ?>

										</span>

									</div>

								</td>

								<td>

									<?php
									PAG_Leads_Components::email_badge(
										$lead->email_domain
									);
									?>

								</td>

								<td>

									<?php echo esc_html( $lead->page_title ); ?>

								</td>

								<td>

									<?php echo esc_html( $lead->created_at ); ?>

								</td>

								<td>

									<a
										class="button button-small"
										href="<?php echo esc_url(
											admin_url(
												'admin.php?page=pag-view-lead&id=' . absint( $lead->id )
											)
										); ?>">

										View

									</a>

								</td>

							</tr>

						<?php endforeach; ?>

					<?php else : ?>

						<tr>

							<td colspan="6">

								No leads found.

							</td>

						</tr>

					<?php endif; ?>

					</tbody>

				</table>

				<?php if ( $total_pages > 1 ) : ?>

					<div class="tablenav">

						<div class="tablenav-pages">

							<?php

							echo wp_kses_post(

								paginate_links(

									array(

										'base'      => add_query_arg(
											'paged',
											'%#%'
										),

										'format'    => '',

										'current'   => $page,

										'total'     => $total_pages,

										'prev_text' => '&laquo;',

										'next_text' => '&raquo;',

									)

								)

							);

							?>

						</div>

					</div>

				<?php endif; ?>

			</div>

		</div>

		<?php

	}

}