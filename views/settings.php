<script>



	jQuery(document).ready(function(){



		jQuery('input[name="quantity_random"]').change(function(){

			if(jQuery(this).is(':checked'))

				jQuery('input[name="quantity"]').attr('disabled', '');

			else

				jQuery('input[name="quantity"]').removeAttr('disabled');

		});



		jQuery('input[name="speed_random"]').change(function(){

			console.log('ok');

			if(jQuery(this).is(':checked'))

				jQuery('input[name="speed"]').attr('disabled', '');

			else

				jQuery('input[name="speed"]').removeAttr('disabled');

		});



	});



</script>

<h2>Light Particles settings</h2>

<form action="" method="post" class="wpp_form">



	<?php wp_nonce_field( 'wpp_settings' ); ?>	

	<label>Particles quantity: </label>

	<input type="text" name="quantity" value="<?php echo esc_attr($quantity) ?>" <?php echo ($quantity == 0 ? 'disabled' : '') ?> /> (1 to 100) or random <input type="checkbox" name="quantity_random" value="1" <?php echo ($quantity == 0 ? 'checked="checked"' : '') ?> /><br />

	<br />

	<label>Particles speed: </label>

	<input type="text" name="speed" value="<?php echo esc_attr($speed) ?>" <?php echo ($speed == 0 ? 'disabled' : '') ?> /> (1 to 10) or random <input type="checkbox" name="speed_random" value="1" <?php echo ($speed == 0 ? 'checked="checked"' : '') ?> /><br />

	<label>Opacity: </label>

	<input type="range" id="opacity" name="opacity" min="0.1" max="1.0" step="0.1" value="<?php echo esc_attr($opacity) ?>" /><br />

	<label>Display on: </label>

	<select name="display_on">

		<option value="0">Everywhere</option>

		<?php $pages = get_pages();

		foreach($pages as $page)

			echo '<option value="'.esc_attr($page->ID).'" '.($display_on == $page->ID ? 'selected="selected"' : '').'>'.($page->post_parent != 0 ? '-- ' : '').esc_html($page->post_title).'</option>';

		?>

	</select><br />

	<input type="image" src="<?php echo esc_url(plugins_url('images/save.png', dirname(__FILE__))) ?>" />



</form>

<hr />

<p><strong>You need more options? Look at Light Particles Pro:</strong></p>

<a href="https://www.info-d-74.com/en/produit/light-particles-pro-plugin-wordpress-2/" target="_blank"><img src="<?php echo esc_url(plugins_url('images/pro_version.png', dirname(__FILE__))) ?>" /></a>