<?php
function lapizzaria_options() {
	add_menu_page('La Pizzaria', 'La Pizzaria Options', 'administrator', 'lapizzaria_options',
	'lapizzaria_adjustments', '', 20 ); 

	add_submenu_page('lapizzaria_options', 'Reservations', 'Reservations', 'administrator',
	'lapizzaria_reservations','lapizzaria_reservations' );
}
add_action('admin_menu', 'lapizzaria_options');

function lapizzaria_settings() {

	// Google Maps Group
	register_setting('lapizzaria_options_gmaps', 'lapizzaria_gmap_latitude');
	register_setting('lapizzaria_options_gmaps', 'lapizzaria_gmap_longitude');
	register_setting('lapizzaria_options_gmaps', 'lapizzaria_gmap_zoom');
	register_setting('lapizzaria_options_gmaps', 'lapizzaria_gmap_apikey');

	//Information Group
	register_setting('lapizzaria_options_info', 'lapizzaria_location');
	register_setting('lapizzaria_options_info', 'lapizzaria_phonenumber');
}
add_action('init', 'lapizzaria_settings');

function lapizzaria_adjustments() { ?>
	<div class="wrap">
		<h1>La Pizzaria Adjustments</h1>
		<form action="options.php" method="post">
			<?php
				settings_fields('lapizzaria_options_gmaps');
				do_settings_sections('lapizzaria_options_gmaps');
			?>
			<h2>Google Maps</h2>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">Latitude: </th>
					<td>
						<input type="text" name="lapizzaria_gmap_latitude" value="<?php echo esc_attr( get_option('lapizzaria_gmap_latitude') ); ?>">
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Longitude: </th>
					<td>
						<input type="text" name="lapizzaria_gmap_longitude" value="<?php echo esc_attr( get_option('lapizzaria_gmap_longitude') ); ?>">
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Zoom Level: </th>
					<td>
						<input type="number" min="12" max="21" name="lapizzaria_gmap_zoom" value="<?php echo esc_attr( get_option('lapizzaria_gmap_zoom') ); ?>">
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">API Key: </th>
					<td>
						<input type="text" name="lapizzaria_gmap_apikey" value="<?php echo esc_attr( get_option('lapizzaria_gmap_apikey') ); ?>">
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
		
		<form action="options.php" method="post">
			<?php
				settings_fields('lapizzaria_options_info');
				do_settings_sections('lapizzaria_options_info');
			?>
			<h2>Other Adjustments</h2>

			<table class="form-table">
				<tr valign="top">
					<th scope="row">Address: </th>
					<td>
						<input type="text" name="lapizzaria_location" value="<?php echo esc_attr( get_option('lapizzaria_location') ); ?>">
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Phone Number: </th>
					<td>
						<input type="text" name="lapizzaria_phonenumber" value="<?php echo esc_attr( get_option('lapizzaria_phonenumber') ); ?>">
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
<?php }

function lapizzaria_reservations() { ?>
	<div class="wrap">
		<h1>Reservations</h1>
		<table class="wp-list-table widefat striped">
			<thead>
				<tr>
					<th class="manage-column">ID</th>
					<th class="manage-column">Name</th>
					<th class="manage-column">Date of Reservation</th>
					<th class="manage-column">Email</th>
					<th class="manage-column">Phone Number</th>
					<th class="manage-column">Message</th>
					<th class="manage-column">Delete</th>
				</tr>
			</thead>

			<tbody>
				<?php
					global $wpdb;
					$table = $wpdb->prefix . 'reservations';
					$reservations = $wpdb->get_results("SELECT * FROM $table", ARRAY_A);
					foreach($reservations as $reservation): ?>
						<tr>
							<td><?php echo $reservation['id']; ?></td>
							<td><?php echo $reservation['name']; ?></td>
							<td><?php echo $reservation['date']; ?></td>
							<td><?php echo $reservation['email']; ?></td>
							<td><?php echo $reservation['phone']; ?></td>
							<td><?php echo $reservation['message']; ?></td>
							<td>
								<a href="#" class="remove_reservation" data-reservation="<?php echo $reservation['id']; ?>">Delete</a>
							</td>
						</tr>

					<?php endforeach; ?>
				?>
			</tbody>
		</table>
	</div>
<?php }

?>