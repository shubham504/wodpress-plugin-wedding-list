<?php

function gifts_list() {
	
	$path_array   = wp_upload_dir();
	$targetpath        =   $path_array['url']."/".$file_name;
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/wedding-list/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Gift List&nbsp;&nbsp;</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=add_gifts'); ?>" class="button">Add New</a>
            </div>
            <br class="clear">
        </div>
	
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "gift_list";

        $rows = $wpdb->get_results("SELECT * from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts' id="gift_list_all">
            <tr>
                <th class="manage-column ss-list-width">Gift Image</th>
				<th class="manage-column ss-list-width">Price</th>
                <th class="manage-column ss-list-width">Wedding name</th>
				<th class="manage-column ss-list-width">Description</th>
				<th class="manage-column ss-list-width">Posted on/ Last Updated</th>
				<th class="manage-column ss-list-width">Action</th>
				
            </tr>
				

            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><img src="<?php echo $row->gift; ?>" style="width: 100%;"></td>
					<td class="manage-column ss-list-width"><?php echo $row->price; ?></td>
					<td class="manage-column ss-list-width"><?php

global $wpdb;
        $table_namew = $wpdb->prefix."wedding_list";

        $rowss = $wpdb->get_results("SELECT wedding_name from $table_namew where id=$row->wedding_id");
foreach ($rowss as $rowqq) {echo $rowqq->wedding_name;}


					 ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->description; ?></td>
					<td class="manage-column ss-list-width"><?php echo $row->post_date; ?>/ <?php echo $row->lastupdate_date; ?></td>
					
                    <td><!--<a href="<?php //echo admin_url('admin.php?page=menu_gift_update&id='.$row->id); ?>" class='button'>Update</a> -->
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

  $table = $wpdb->prefix . "gift_list";

  $id = $_POST['idd'];
  $wpdb->query($wpdb->prepare("DELETE FROM $table WHERE id = %s", $id));

}
?>