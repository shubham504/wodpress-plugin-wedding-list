<?php

function menu_gift_update() {
    global $wpdb;
	 if (isset($_POST['update'])) {
    $table_name = $wpdb->prefix . "gift_list";
    $id = $_GET["id"];
    $wedding_id = $_POST["wedding_id"];
	//$gift = $_POST["gift"];
	$description = $_POST["description"];
	$price = $_POST["price"];
	$posted_on = date("d-m-Y");
	$lastupdate_date = date("d-m-Y");
	
	$tmp_name = $_FILES["gift"]["name"];
		
		// file move
				 if ( ! function_exists( 'wp_handle_upload' ) ) {
					 require_once( ABSPATH . 'wp-admin/includes/file.php' );
				 }
				 $uploadedfile = $_FILES['gift'];
				 $upload_overrides = array( 'test_form' => false );
				 $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
				
				 
		// file db
				$path_array = wp_upload_dir(); // normal format start
				$file_name   =   pathinfo($tmp_name ,PATHINFO_FILENAME).".".pathinfo($tmp_name ,PATHINFO_EXTENSION);  
				$imgtype     =   strtolower(pathinfo($tmp_name,PATHINFO_EXTENSION));   
				$targetpath        =   $path_array['baseurl']."/".$file_name;
				//move_uploaded_file($tmp_name, $targetpath );
	
//update

        $wpdb->update(
                $table_name, //table
                array('wedding_id' => $wedding_id, //data
					  'gift' => $tmp_name, //data
					'description' => $description, //data
					'price' => $price,
					'post_date' => $posted_on, //data
					'lastupdate_date' => $lastupdate_date), //data
                array('id' => $id), //where
                array('%s'), //data format
                array('%s') //where format
        );
    }

    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Gifts </h2>
 <?php
 $id = $_GET["id"];
 
        global $wpdb;
        $table_name = $wpdb->prefix."gift_list";

        $row = $wpdb->get_results("SELECT * from $table_name where id=$id");
		  foreach ($row as $rows) { ?>
       
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
               <table class='wp-list-table widefat fixed'>
				<tr>
                    <th class="ss-th-width">Wedding Name</th>
                    <td>
					
							<select class="dropdown" id="mydropdown" name="wedding_name" title="My Dropdown">
							<?php
									global $wpdb;
									$gtable_name = $wpdb->prefix."wedding_list";
									$grows = $wpdb->get_results("SELECT * from $gtable_name");
									foreach ($grows as $value) {
											echo '<option value='.$value->id.'>'.$value->wedding_name.'</option>';
									}
							?>
							</select>
					</td>
                </tr>
                
                <tr>
                    <th class="ss-th-width">Gift Image</th>
                    <td><input type="file" name="upload_attachment[]" class="files" size="50" multiple="multiple" />
						<?php wp_nonce_field( 'upload_attachment', 'my_image_upload_nonce' ); ?></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Price</th>
                    <td><input type="text" name="price"  class="ss-field-width" value="<?php echo $rows->price; ?>" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Description</th>
                    <td><input type="text" name="description"  class="ss-field-width" value="<?php echo $rows->description; ?>" /></td>
                </tr>
				
				
				
            </table>
                <input type='submit' name="update" value='update' class='button'> &nbsp;&nbsp;
                
            </form>
     
    </div>
		 <?php }
}