<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://mahesh-d.wisdmlabs.net
 * @since      1.0.0
 *
 * @package    Content_Calendar
 * @subpackage Content_Calendar/admin/partials
 */


// This file should primarily consist of HTML with a little bit of PHP. 

function my_form()
{

?> <h1 class="heading">Content Calender</h1>
	<form action="" method="POST" id="my-custom-form">

		<div>
			<label for="date">Date :</label>
			<input type="date" name="date" id="name" required />
		</div>

		<div>
			<label for="occasion">Occasion :</label>
			<input type="text" name="occasion" id="occasion" required />
		</div>

		<div>
			<label for="post-title">Post Title :</label>
			<input type="text" name="post-title" id="post-title" required />
		</div>

		<div>
			<label for="author">Author :</label>

			<select id="author" name="author">
				<?php
				$users = get_users();
				foreach ($users as $user) {
					echo '<option value="' . $user->ID . '">' . $user->display_name . '</option>';
				}
				?>
			</select>

		</div>

		<div>
			<label for="reviewer">Reviewer :</label>
			<select id="reviewer" name="reviewer">
				<?php
				$users = get_users(array('role__not_in' => array('administrator')));
				foreach ($users as $user) {
					echo '<option value="' . $user->ID . '">' . $user->display_name . '</option>';
				}
				?>
			</select>

		</div>

		<div>
			<?php submit_button('Submit'); ?>
		</div>

		<div id="success-message"></div>
		


	</form>
<?php


}


//To display data in table format
function display_table()
{
	?> <h1>Events</h1> <?php
    $calendar_data = get_option('my_plugin_options', array());
   
    $data_array = maybe_unserialize($calendar_data);

	//To sort data array by date
    usort($data_array, function($a, $b) {
        return strtotime($a['date']) - strtotime($b['date']);
    });
    
    echo '<table id="data_table">';
    echo '<thead><tr><th>Date</th><th>Occasion</th><th>Post Title</th><th>Author</th><th>Reviewer</th></tr></thead>';
    echo '<tbody>';

    foreach ($data_array as $item_array) {
        echo '<tr>';
        echo '<td>' . date("d-m-Y", strtotime($item_array['date'])) . '</td>';
        echo '<td>' . $item_array['occasion'] . '</td>';
        echo '<td>' . $item_array['post_title'] . '</td>';
        echo '<td>' . get_the_author_meta('display_name', $item_array['author']) . '</td>';
        echo '<td>' . get_the_author_meta('display_name', $item_array['reviewer']) . '</td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
}

