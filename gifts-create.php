<?php

function add_gifts() {
    $id = $_POST["id"];
   
    //insert
    if (isset($_POST['insert'])) {
		
		
		$price = $_POST["price"];
	$gift_fields = $_POST["gift"];
		$wedding_name = $_POST["wedding_name"];
		$description = $_POST["description"];
		$post_date = date("d-m-Y");
		$last_update = date("d-m-Y");
		$tmp_name = $_FILES["gift"]["name"];
		
		
				
				
				
				
		global $wpdb;
        $table_name = $wpdb->prefix . "gift_list";


        $wpdb->insert(
                $table_name, //table
                array('wedding_id' => $wedding_name,
					 'gift' => $gift_fields,
					 'description' => $description,
					 'price' => $price,
					 'post_date' => $post_date,
					 'lastupdate_date' => $last_update,
					 ), //data
                array('%s', '%s', '%s', '%s', '%s', '%s', '%s') //data format			
        );
        $message.="New Gift List Inserted";
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New Gift</h2>
		
		
		
		   <?php 
	// Save attachment ID
	if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['image_attachment_id'] ) ) :
		update_option( 'media_selector_attachment_id', absint( $_POST['image_attachment_id'] ) );
	endif;
	wp_enqueue_media();
	?>
		
		
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        
		
		
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
            
            <table class='wp-list-table widefat fixed'>
				<tr>
                    <th class="ss-th-width">Wedding Name</th>
                    <td>
					
							<select class="dropdown" id="mydropdown" name="wedding_name" title="My Dropdown">
							<?php
									global $wpdb;
									$table_name = $wpdb->prefix . "wedding_list";
									$rows = $wpdb->get_results("SELECT * from $table_name");
									foreach ($rows as $value) {
											echo '<option value="'.$value->id.'">'.$value->wedding_name.'</option>';
									}
							?>
							</select>
					</td>
                </tr>
                
                <tr>
                    <th class="ss-th-width">Gift Image</th>
                    <td>
                   
						<div class='image-preview-wrapper'>
						<input type="text" name="gift" id='image_attachment_id' class="ss-field-width" value="<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>" style="
    display:  none;
"/>
							<img id='image-preview'  src='<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>' height='100' >
						</div>
						
						<input id="upload_image_button"  type="file"   class="button" />
						
						
						
						
					</td>
                </tr>
				<tr>
                    <th class="ss-th-width">Price</th>
                    <td><input type="text" name="price"  class="ss-field-width" required /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Description</th>
                    <td><textarea name="description"  class="ss-field-width" rows="5" cols="70" required ></textarea></td>
                </tr>
				
				
				
            </table>
            <input type='submit' name="insert" value='Save' class='button'>
		   </form> 
    </div>
    <?php
}add_action( 'admin_footer', 'media_selector_print_scripts' );
function media_selector_print_scripts() {
	$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );
	 ?>
<script type='text/javascript'>
		jQuery( document ).ready( function( $ ) {
			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
			jQuery('#upload_image_button').on('click', function( event ){
				event.preventDefault();
				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					// Set the post ID to what we want
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
					// Open frame
					file_frame.open();
					return;
				} else {
					// Set the wp.media post id so the uploader grabs the ID we want when initialised
					wp.media.model.settings.post.id = set_to_post_id;
				}
				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select a image to upload',
					file: {
						text: 'Use this image',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});
				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();
					// Do something with attachment.id and/or attachment.url here
					$( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
					$( '#image_attachment_id' ).val( attachment.url );
					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});
					// Finally, open the modal
					file_frame.open();
			});
			// Restore the main ID when the add media button is pressed
			jQuery( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
		});
	</script>
<?php } ?>