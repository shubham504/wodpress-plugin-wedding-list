<?php

function add_wedding() {
    $id = $_POST["id"];
    
    //insert
    if (isset($_POST['insert'])) {
		$wedding_name = $_POST["wedding_name"];
		$groom_name = $_POST["groom_name"];
		$bride_name = $_POST["bride_name"];
		$marriage_date = $_POST["marriage_date"];
		$restaurant_Place = $_POST["restaurant_Place"];
		$username = $_POST["username"];
		$pass = $_POST["pass"];
		$email = $_POST["email"];
		$post_date = date("d-m-Y");
		$last_update = date("d-m-Y");
		
        global $wpdb;
        $table_name = $wpdb->prefix . "wedding_list";


        $wpdb->insert(
                $table_name, //table
                array('wedding_name' => $wedding_name,
					 'groom_name' => $groom_name,
					 'bride_name' => $bride_name,
					 'marriage_date' => $marriage_date,
					 'restaurant_Place' => $restaurant_Place,
					 'username' => $username,
					 'pass' => $pass,
					 'email' => $email,
					 'post_date' => $post_date,
					 'lastupdate_date' => $last_update,
					 ), //data
                array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s') //data format			
        );
        $message.="New Wedding List Inserted";
		
		
		$to = $email;
		$subject = 'The subject';
		$body = '<html ><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>

</head>
<body style="margin: 0px; background-color: #FFFFFF; font-size: 14px; color: #444444; font-family: Verdana, Helvetica, Arial, sans-serif;">
<table style="border-collapse:collapse;margin:10px 0; width:100%;">
<tbody><tr>
<td>
<center>
<table style="border-collapse:collapse;width: 500px; margin: 0 auto; border: 1px dotted #CECECE; background: #F4F3F4;">
<tbody>
<tr>
<td>
<table id="site" style="width:100%;padding: 30px; text-align: center; background-color: #21759B; color: #FFFFFF;">
<tbody>

<tr><td style="text-align: center;font-size: 160%; font-weight: 600;">L artedeifioriSG</td></tr>

</tbody>
</table>


<table id="ordervars" style="width:100%;margin: 5px 0 30px 0; border-bottom: 1px dotted #cecece;">
<tbody>

<tr><td colspan="2" style="text-align: center;">'.$wedding_name.'</td></tr>

<tr><td style="width: 50%; white-space:nowrap; text-align: right; padding:2px;">Username :  </td><td style="padding: 2px; word-break: break-word;;">'.$username.'</td></tr>

<tr><td style="width: 50%; white-space:nowrap; text-align: right; padding:2px;">Password :  </td><td style="padding: 2px; word-break: break-word;;">'.$pass.'</td></tr>

<tr><td colspan="2" style="text-align:center; font-weight:bold; padding:3px"><a href="http://lartedeifiorisg.it/lista-sposi/">Clik here to access your Wedding list.</a></td></tr>

</tbody>
</table>


<table id="customer" style="width:100%;margin: 20px 0;">
<thead>
<tr>
<th colspan="2" style="">
&copy; all right reserved 2017.
</th>
</tr>
</thead>


</table>



</td>
</tr>
</tbody>
</table>
</center>
</td>
</tr>
</tbody></table>



</body></html>';
					
		$headers = array('Content-Type: text/html; charset=UTF-8');
 
		wp_mail( $to, $subject, $body, $headers );
		
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/wedding-list/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New Wedding</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            
            <table class='wp-list-table widefat fixed'>
                
                <tr>
                    <th class="ss-th-width">Wedding name</th>
                    <td><input type="text" name="wedding_name"  class="ss-field-width" required /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Groom name</th>
                    <td><input type="text" name="groom_name"  class="ss-field-width" required /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Bride name</th>
                    <td><input type="text" name="bride_name"  class="ss-field-width" required /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Marriage date</th>
                    <td><input type="date" name="marriage_date" class="ss-field-width" required /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Restaurant/Place</th>
                    <td><input type="text" name="restaurant_Place"  class="ss-field-width" required /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Username</th>
                    <td><input type="text" name="username"  class="ss-field-width" required /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Password</th>
                    <td><input type="password" name="pass"  class="ss-field-width" required /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Email</th>
                    <td><input type="email" name="email"  class="ss-field-width" required /></td>
                </tr>
				
            </table>
            <input type='submit' name="insert" value='Save' class='button'>
        </form>
    </div>
    <?php
}