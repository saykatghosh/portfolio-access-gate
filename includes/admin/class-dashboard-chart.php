<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PAG_Dashboard_Chart {

	/**
	 * Render dashboard chart.
	 */
	public static function render() {

		$chart = PAG_Chart_Data::last_days( 7 );

		$max = 1;

		foreach ( $chart as $item ) {

			if ( $item['value'] > $max ) {
				$max = $item['value'];
			}

		}

		$points = array();

		foreach ( $chart as $index => $item ) {

			$x = 40 + ( $index * 100 );

			$y = 180 - ( ( $item['value'] / $max ) * 140 );

			$points[] = $x . ',' . $y;

		}

		?>

		<div class="pag-box">

			<h2>Lead Analytics (Last 7 Days)</h2>

			<svg
				viewBox="0 0 700 220"
				width="100%"
				height="220">

				<polyline
					fill="none"
					stroke="#6366f1"
					stroke-width="4"
					points="<?php echo esc_attr( implode( ' ', $points ) ); ?>" />

				<?php foreach ( $chart as $index => $item ) :

					$x = 40 + ( $index * 100 );

					$y = 180 - ( ( $item['value'] / $max ) * 140 );

					?>

					<circle
						cx="<?php echo esc_attr( $x ); ?>"
						cy="<?php echo esc_attr( $y ); ?>"
						r="5"
						fill="#6366f1" />

					<text
						x="<?php echo esc_attr( $x ); ?>"
						y="<?php echo esc_attr( $y - 12 ); ?>"
						text-anchor="middle"
						font-size="12">

						<?php echo esc_html( $item['value'] ); ?>

					</text>

					<text
						x="<?php echo esc_attr( $x ); ?>"
						y="205"
						text-anchor="middle"
						font-size="12">

						<?php echo esc_html( $item['label'] ); ?>

					</text>

				<?php endforeach; ?>

			</svg>

		</div>

		<?php

	}

}