<div class="wrap">
<h2>Comments Box</h2>

<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>
<?php settings_fields('wpfacebookpostcomments'); ?>

<table class="form-table">

<tr valign="top">
<th scope="row">Comment Box Width (pixels):</th>
<td><input type="text" name="box_width" value="<?php echo get_option('box_width'); ?>" /></td>
</tr>
<tr valign="top">
<th scope="row">Number of Comments to show:</th>
<td><input type="text" name="number_of_comments" value="<?php echo get_option('number_of_comments'); ?>" /></td>
</tr>
</table>

<input type="hidden" name="action" value="update" />

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>