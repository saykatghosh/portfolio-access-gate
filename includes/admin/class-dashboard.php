<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Dashboard {

	public function render() {

		$stats = PAG_Dashboard_Analytics::stats();

		$pages = PAG_Dashboard_Analytics::top_pages();

		$recent = PAG_Dashboard_Analytics::recent();

		?>

		<div class="wrap">

			<h1>Portfolio Access Gate</h1>

			<div class="pag-dashboard-cards">

				<div class="pag-card">

					<span>Total Leads</span>

					<h2><?php echo esc_html( $stats['total'] ); ?></h2>

				</div>

				<div class="pag-card">

					<span>Today</span>

					<h2><?php echo esc_html( $stats['today'] ); ?></h2>

				</div>

				<div class="pag-card">

					<span>Last 7 Days</span>

					<h2><?php echo esc_html( $stats['week'] ); ?></h2>

				</div>

				<div class="pag-card">

					<span>Last 30 Days</span>

					<h2><?php echo esc_html( $stats['month'] ); ?></h2>

				</div>

			</div>

			<div class="pag-dashboard-grid">

				<div class="pag-box">

					<h2>Top Protected Pages</h2>

					<table class="widefat striped">

						<thead>

						<tr>

							<th>Page</th>

							<th width="100">Leads</th>

						</tr>

						</thead>

						<tbody>

						<?php if ( $pages ) : ?>

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

									No Data

								</td>

							</tr>

						<?php endif; ?>

						</tbody>

					</table>

				</div>

				<div class="pag-box">

					<h2>Recent Activity</h2>

					<table class="widefat striped">

						<thead>

						<tr>

							<th>Name</th>

							<th>Email</th>

							<th>Date</th>

						</tr>

						</thead>

						<tbody>

						<?php if ( $recent ) : ?>

							<?php foreach ( $recent as $lead ) : ?>

								<tr>

									<td>

										<?php echo esc_html( $lead->full_name ); ?>

									</td>

									<td>

										<?php echo esc_html( $lead->email ); ?>

									</td>

									<td>

										<?php echo esc_html( $lead->created_at ); ?>

									</td>

								</tr>

							<?php endforeach; ?>

						<?php else : ?>

							<tr>

								<td colspan="3">

									No Activity

								</td>

							</tr>

						<?php endif; ?>

						</tbody>

					</table>

				</div>

			</div>

		</div>

		<style>

		.pag-dashboard-cards{

			display:grid;

			grid-template-columns:repeat(4,1fr);

			gap:20px;

			margin:25px 0;

		}

		.pag-card{

			background:#fff;

			border:1px solid #dcdcde;

			border-radius:14px;

			padding:25px;

		}

		.pag-card span{

			display:block;

			color:#6b7280;

			font-size:14px;

		}

		.pag-card h2{

			margin:10px 0 0;

			font-size:34px;

		}

		.pag-dashboard-grid{

			display:grid;

			grid-template-columns:1fr 1fr;

			gap:25px;

		}

		.pag-box{

			background:#fff;

			border:1px solid #dcdcde;

			border-radius:14px;

			padding:20px;

		}

		.pag-box h2{

			margin-top:0;

			margin-bottom:18px;

		}

		@media(max-width:1200px){

			.pag-dashboard-cards{

				grid-template-columns:repeat(2,1fr);

			}

		}

		@media(max-width:768px){

			.pag-dashboard-cards{

				grid-template-columns:1fr;

			}

			.pag-dashboard-grid{

				grid-template-columns:1fr;

			}

		}

		</style>

		<?php

	}

}