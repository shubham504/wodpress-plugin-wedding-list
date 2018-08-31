<?php
function sinetiks_weddings_list() {
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/style-admin.css" rel="stylesheet" />
	<h1 style="padding:15px 15px; background: #0073aa; color: #fff;" > Wedding List by Inventive Infosys</h1>
	<p style="padding:5px 15px;border-bottom: solid 1px rgba(70, 64, 64, 0.38);">This plugin used for wedding gifts and provide wedding places ,groom, Bride, and date. for more details visit: <a href="http://www.inventiveinfosys.com" target="blank">Inventive Infosys</a> or email us: info@inventiveinfosys.com    </p>
	<div class="short_code_details">
	   <p style="font-size: 18px;">Shortcode :</p>
			<input style="width:  30% !important; padding: 4px;" id="short_code_help" type="text" value="[login_form]" disabled>
	   	
	</div>
	
    <div class="wrap">
        <h2>Wedding List&nbsp;&nbsp;</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=add_wedding'); ?>" class="button">Add New</a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "wedding_list";

        $rows = $wpdb->get_results("SELECT * from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts' id="wedding_list_all">
            <tr>
                <th class="manage-column ss-list-width">Wedding name</th>
				<th class="manage-column ss-list-width">Groom name</th>
                <th class="manage-column ss-list-width">Bride name</th>
				<th class="manage-column ss-list-width">Marriage date</th>
                <th class="manage-column ss-list-width">Restaurant Place</th>
				<th class="manage-column ss-list-width">Email</th>
                <th class="manage-column ss-list-width">Posted on/ Last Updated</th>
				<th class="manage-column ss-list-width">Action</th>
				
            </tr>
				

            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->wedding_name; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->groom_name; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->bride_name; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->marriage_date; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->restaurant_Place; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->email; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->post_date; ?>/ <?php echo $row->lastupdate_date; ?></td>
					
                    <td><a href="<?php echo admin_url('admin.php?page=menu_wedding_update&id='.$row->id); ?>" class='button'>Update</a>
					<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
					<input  name="idd" type="hidden" value="<?php echo $row->id; ?>" />
					<input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('Do you want to delete')"></td>
					
					</form>
			   </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}

if ($_POST['delete']) {
	global $wpdb;

  $table = $wpdb->prefix . "wedding_list";

  $id = $_POST['idd'];
  $wpdb->query($wpdb->prepare("DELETE FROM $table WHERE id = %s", $id));

}
?>