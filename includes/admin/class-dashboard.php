<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Dashboard {

	public function render() {

		$stats   = PAG_Dashboard_Analytics::stats();
		$domains = PAG_Domain_Analyzer::top_domains( 5 );
		$pages   = PAG_Dashboard_Analytics::top_pages( 5 );
		$recent  = PAG_Dashboard_Analytics::recent( 5 );

		?>

		<div class="wrap pag-dashboard">

			<div class="pag-dashboard-header">

				<div>

					<h1 class="pag-title">

						Portfolio Access Gate

					</h1>

					<p class="pag-subtitle">

						Monitor your protected portfolio performance.

					</p>

				</div>

			</div>

			<div class="pag-dashboard-cards">

				<?php

				PAG_Dashboard_Components::card(
					'👥',
					'Total Leads',
					$stats['total'],
					'primary'
				);

				PAG_Dashboard_Components::card(
					'📅',
					'Today',
					$stats['today'],
					'success'
				);

				PAG_Dashboard_Components::card(
					'📈',
					'Last 7 Days',
					$stats['week'],
					'info'
				);

				PAG_Dashboard_Components::card(
					'🏢',
					'Companies',
					PAG_Domain_Analyzer::unique_domains(),
					'warning'
				);

				?>

			</div>

			<?php PAG_Dashboard_Components::quick_actions(); ?>

			<?php PAG_Dashboard_Chart::render(); ?>

			<div class="pag-grid">

				<div class="pag-box">

					<?php

					PAG_Dashboard_Components::section(
						'Top Company Domains',
						'Most active business domains.'
					);

					?>

					<table class="pag-table">

						<thead>

							<tr>

								<th>Domain</th>

								<th width="90">Leads</th>

							</tr>

						</thead>

						<tbody>

						<?php if ( ! empty( $domains ) ) : ?>

							<?php foreach ( $domains as $domain ) : ?>

								<tr>

									<td>

										<span class="pag-badge">

											<?php echo esc_html( $domain->email_domain ); ?>

										</span>

									</td>

									<td>

										<?php echo esc_html( $domain->total ); ?>

									</td>

								</tr>

							<?php endforeach; ?>

						<?php else : ?>

							<tr>

								<td colspan="2">

									No data available.

								</td>

							</tr>

						<?php endif; ?>

						</tbody>

					</table>

				</div>

				<div class="pag-box">

					<?php

					PAG_Dashboard_Components::section(
						'Top Protected Pages',
						'Highest converting pages.'
					);

					?>

					<table class="pag-table">

						<thead>

							<tr>

								<th>Page</th>

								<th width="90">Leads</th>

							</tr>

						</thead>

						<tbody>

						<?php if ( ! empty( $pages ) ) : ?>

							<?php foreach ( $pages as $page ) : ?>

								<tr>

									<td>

										<?php echo esc_html( $page->page_title ); ?>

									</td>

									<td>

										<?php echo esc_html( $page->total ); ?>

									</td>

								</tr>

							<?php endforeach; ?>

						<?php else : ?>

							<tr>

								<td colspan="2">

									No data available.

								</td>

							</tr>

						<?php endif; ?>

						</tbody>

					</table>

				</div>

			</div>

			<div class="pag-box">

				<?php

				PAG_Dashboard_Components::section(
					'Recent Leads',
					'Latest captured business leads.'
				);

				?>

				<table class="pag-table">

					<thead>

						<tr>

							<th>Name</th>

							<th>Email</th>

							<th>Page</th>

							<th width="170">Date</th>

						</tr>

					</thead>

					<tbody>

					<?php if ( ! empty( $recent ) ) : ?>

						<?php foreach ( $recent as $lead ) : ?>

							<tr>

								<td><?php echo esc_html( $lead->full_name ); ?></td>

								<td><?php echo esc_html( $lead->email ); ?></td>

								<td><?php echo esc_html( $lead->page_title ); ?></td>

								<td><?php echo esc_html( $lead->created_at ); ?></td>

							</tr>

						<?php endforeach; ?>

					<?php else : ?>

						<tr>

							<td colspan="4">

								No leads found.

							</td>

						</tr>

					<?php endif; ?>

					</tbody>

				</table>

			</div>

		</div>

		<?php

	}

}