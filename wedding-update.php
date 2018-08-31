<?php

function menu_wedding_update() {
    global $wpdb;
	 if (isset($_POST['update'])) {
    $table_name = $wpdb->prefix . "wedding_list";
    $id = $_GET["id"];
    $wedding_name = $_POST["wedding_name"];
	$groom_name = $_POST["groom_name"];
	$bride_name = $_POST["bride_name"];
	$marriage_date = $_POST["marriage_date"];
	$restaurant_Place = $_POST["restaurant_Place"];
	$username = $_POST["username"];
	$pass = $_POST["pass"];
	$email = $_POST["email"];
	$posted_on = date("d-m-Y");
	$latestupdate = date("d-m-Y");
	
//update

   
        $wpdb->update(
                $table_name, //table
                array('wedding_name' => $wedding_name, //data
					  'groom_name' => $groom_name, //data
					'bride_name' => $bride_name, //data
					'marriage_date' => $marriage_date,
					'restaurant_Place' => $restaurant_Place, //data
					'username' => $username,//data
					'pass' => $pass, //data
					'email' => $email,//data
					'post_date' => $posted_on, //data
					'lastupdate_date' => $latestupdate), //data
                array('id' => $id), //where
                array('%s'), //data format
                array('%s') //where format
        );
    }

    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Schools </h2>
 <?php
 $id = $_GET["id"];
 
        global $wpdb;
        $table_name = $wpdb->prefix . "wedding_list";

        $row = $wpdb->get_results("SELECT * from $table_name where id=$id");
		  foreach ($row as $rows) { ?>
       
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class='wp-list-table widefat fixed'>
                
                <tr>
                    <th class="ss-th-width">Wedding name</th>
                    <td><input type="text" name="wedding_name"  class="ss-field-width" value="<?php echo $rows->wedding_name; ?>" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Groom name</th>
                    <td><input type="text" name="groom_name"  class="ss-field-width" value="<?php echo $rows->groom_name; ?>" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Bride name</th>
                    <td><input type="text" name="bride_name"  class="ss-field-width" value="<?php echo $rows->bride_name; ?>" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Marriage date</th>
                    <td><input type="date" name="marriage_date" class="ss-field-width" value="<?php echo $rows->marriage_date; ?>" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Restaurant/Place</th>
                    <td><input type="text" name="restaurant_Place"  class="ss-field-width" value="<?php echo $rows->restaurant_Place; ?>" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Username</th>
                    <td><input type="text" name="username"  class="ss-field-width" value="<?php echo $rows->username; ?>" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Password</th>
                    <td><input type="password" name="pass"  class="ss-field-width" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Email</th>
                    <td><input type="email" name="email"  class="ss-field-width" value="<?php echo $rows->email; ?>" /></td>
                </tr>
				
            </table>
                <input type='submit' name="update" value='update' class='button'> &nbsp;&nbsp;
                
            </form>
     
    </div>
		 <?php }
}