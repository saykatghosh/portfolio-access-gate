<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_View_Lead {

	public function render() {

		$id = isset( $_GET['id'] )
			? absint( $_GET['id'] )
			: 0;

		$lead = PAG_Leads_Table::get( $id );

		if ( ! $lead ) {

			echo '<div class="notice notice-error"><p>Lead not found.</p></div>';

			return;

		}

		?>

		<div class="wrap pag-dashboard">

			<div class="pag-dashboard-header">

				<div class="pag-dashboard-title">

					<span class="pag-overline">
						PORTFOLIO ACCESS GATE
					</span>

					<h1 class="pag-title">
						View Lead
					</h1>

					<p class="pag-subtitle">
						Lead information and submission details.
					</p>

				</div>

				<div class="pag-header-actions">

					<a
						class="button"
						href="<?php echo esc_url( admin_url( 'admin.php?page=pag-leads' ) ); ?>">

						← Back to Leads

					</a>

					<a
						class="button button-link-delete"
						onclick="return confirm('Delete this lead?');"
						href="<?php echo esc_url(
							wp_nonce_url(
								admin_url(
									'admin-post.php?action=pag_delete_lead&lead_id=' . absint( $lead->id )
								),
								'pag_delete_lead'
							)
						); ?>">

						Delete Lead

					</a>

				</div>

			</div>

			<div class="pag-box">

				<div class="pag-view-card">

					<div class="pag-view-top">

						<div class="pag-view-avatar">

							<?php echo esc_html( strtoupper( mb_substr( $lead->full_name, 0, 1 ) ) ); ?>

						</div>

						<div class="pag-view-info">

							<h2 class="pag-view-name">

								<?php echo esc_html( $lead->full_name ); ?>

							</h2>

							<p class="pag-view-email">

								<?php echo esc_html( $lead->email ); ?>

							</p>

						</div>

					</div>

					<div class="pag-view-grid">

						<div class="pag-view-item">

							<div class="pag-view-label">

								Lead ID

							</div>

							<div class="pag-view-value">

								#<?php echo esc_html( $lead->id ); ?>

							</div>

						</div>

						<div class="pag-view-item">

							<div class="pag-view-label">

								Email Domain

							</div>

							<div class="pag-view-value">

								<?php echo esc_html( $lead->email_domain ); ?>

							</div>

						</div>

						<div class="pag-view-item">

							<div class="pag-view-label">

								Protected Page

							</div>

							<div class="pag-view-value">

								<?php echo esc_html( $lead->page_title ); ?>

							</div>

						</div>

						<div class="pag-view-item">

							<div class="pag-view-label">

								Submitted On

							</div>

							<div class="pag-view-value">

								<?php echo esc_html( $lead->created_at ); ?>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

		<?php

	}

}