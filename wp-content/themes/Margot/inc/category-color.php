<?php
/*
Based on plugin "gatespace add extra fields for category" by gatespace
Plugin URI: https://github.com/gatespace/gs-add-extra-fields-for-category
*/

/*
 * category edit form
 */

function margot_color_fields_edit( $term ) {
  $term_id   = $term->term_id;
  $term_meta = get_option( "term_$term_id" );
  $margot_color_df = of_get_option('margot_'. $term_id .'_style', '#333');
  $term_meta['textcolor'] = ( !empty( $term_meta['textcolor'] ) ) ? $term_meta['textcolor'] : "#FFF";
  $term_meta['bgcolor']   = ( !empty( $term_meta['bgcolor'] ) ) ? $term_meta['bgcolor'] : $margot_color_df;
?>
<tr>
  <th><label for="bgcolor"><?php _e( "Main Color", 'margot' ); ?></label></th>
  <td><input type="text" name="term_meta[bgcolor]" id="bgcolor" class="regular-text colordata" value="<?php echo esc_attr( $term_meta['bgcolor'] ); ?>" /><br></td>
</tr>
<tr>
  <th><label for="textcolor"><?php _e( "Menu Links Color", 'margot' ); ?></label></th>
  <td><input type="text" name="term_meta[textcolor]" id="textcolor" class="regular-text colordata" value="<?php echo esc_attr( $term_meta['textcolor'] ); ?>" /></td>
</tr>
<?php
  // nonce
  echo '<input type="hidden" name="margot_color_fields" id="margot_color_fields" value="' . wp_create_nonce( "my_margot_color_fields_add" ) . '" />';
}

add_action( 'category_edit_form_fields', 'margot_color_fields_edit' );

/*
 * category add form
 */
function margot_color_fields_add() {

?>
<div class="form-field">
  <label for="bgcolor"><?php _e( "Main Color", "margot"  ); ?></label>
  <input type="text" name="term_meta[bgcolor]" id="bgcolor" class="regular-text colordata" value="#666666" /><br>
  <label for="textcolor"><?php _e( "Menu Links Color", "margot" ); ?></label>
  <input type="text" name="term_meta[textcolor]" id="textcolor" class="regular-text colordata" value="#fff" /><br>

</div>

<?php
  // nonce
  echo '<input type="hidden" name="margot_color_fields" id="margot_color_fields" value="' . wp_create_nonce( "my_margot_color_fields_add" ) . '" />';
}
add_action( 'category_add_form_fields', 'margot_color_fields_add' );


/*
 * init wp color picker
 */

add_action( 'admin_enqueue_scripts', 'margot_enqueue_color_picker' );
function margot_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script('wp-color-picker' );
}


/*
 * save custom fields data
 */
function mrg_save_extra_fileds( $term_id ) {
  // wp_verify_nonce
    if( !isset( $_POST['margot_color_fields'] ) || !wp_verify_nonce( $_POST['margot_color_fields'], 'my_margot_color_fields_add' ) )
    return $term_id;

  // Check capabilities
  if ( !current_user_can( 'manage_categories', $term_id ) )
    return $term_id;

  // Save data
  if ( isset( $_POST['term_meta'] ) ) {
    $term_meta = get_option( "tax_$term_id" );
    $term_keys = array_keys( $_POST['term_meta'] );
      foreach ( $term_keys as $key ) {
        if ( isset( $_POST['term_meta'][$key] ) ) {
          $term_meta[$key] = $_POST['term_meta'][$key];
        }
      }
    update_option( "term_$term_id", $term_meta );
  }
}
add_action ( 'created_term', 'mrg_save_extra_fileds');
add_action ( 'edited_term', 'mrg_save_extra_fileds');
