<?php 
if(session_id() == '')
     session_start();

add_action('wp_enqueue_scripts', 'wedding_callback_for_setting_up_scripts');
function wedding_callback_for_setting_up_scripts() {
    wp_register_style( 'prefix-style', plugins_url('style-admin.css', __FILE__) );
    wp_enqueue_style( 'prefix-style' );
    
    
    
global $wpdb;
if(isset($_POST['user_submit'])) 
{ 

$user=$_POST['username'];
$pass=$_POST['password'];


    $table_name = $wpdb->prefix . "wedding_list";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "select * from $table_name where username='$user' and pass='$pass'";
	 if($wpdb->get_results($sql))
	 {
		
		 $_SESSION['user_check']=$_POST['username'];
		$message="";
		
	 }
	 else
	 { echo '<script>alert("Wrong email or password");</script>';
		 //$message="Wrong email or password";
	 }  

	
}    
   
}





function login() { 
 if(empty($_SESSION['user_check'])){	?>



<div id="login_wedding">

<div class="main_wedding_login">
			<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" class="wp_wedding_login">
			    <p class="title">Log in</p>
				<div class="username">
					<label for="user_login">User name: </label>
					<input type="text" name="username" value="" size="20" id="user_login" tabindex="11" />
				</div>
				<div class="password">
					<label for="user_pass">Password: </label>
					<input type="password" name="password" value="" size="20" id="user_pass" tabindex="12" />
				</div>
				<div class="login_fields">
				    <input type="submit" id="login_list" name="user_submit" value="<?php _e('Login'); ?>" tabindex="14" class="user-submit" />
				
				</div>
				
			</form>
		<?php if(isset($_POST['user_submit'])) 
{ 	echo $message;}  ?>
</div>		
	
</div>
<?php }else{
	
       $userid=$_SESSION['user_check'];
					
					
?><form name="new user" method="post" action="" style="
    margin:  auto;
    text-align: center;
    padding: 25px;
">
										<input type="submit" name="logout_profile" value="Logout" />
										
</form>


<?php
global $wpdb;
        $table_name1 = $wpdb->prefix .'wedding_list';
		$sql1 = "select * from $table_name1 where username='$userid'";
		$rowss = $wpdb->get_results($sql1);
			foreach ($rowss as $rowqq) { 
			?> 
			
	
	           
     <div class="main_card" style="
    border-bottom: solid 1px #ccc;
    padding-bottom: 10px;
">
      <?php 
    	            $path_array   = wp_upload_dir();
	                $targetpath   =   $path_array['url']."/".$file_name;
                		$table_name2 = $wpdb->prefix.'gift_list';
                		$sql2 = "select * from $table_name2 where wedding_id=".$rowqq->id;
                		$roww = $wpdb->get_results($sql2);
                		foreach ($roww as $rowww) {	
                         ?>	
						 <div style="width:100%;float:left">
    	  <div class="gift_image">
    	        <img src="<?php echo $rowww->gift; ?>" style="width: 100%;">
          </div>
	    <div class="wedding_feilds">	
			<div id="profile">

				<div class="wedding_name_title">
				
					<b>Wedding list name: &nbsp; <?php echo $rowqq->wedding_name; ?></b>
					<p><?php echo $rowww->description; ?></p>
					<b><p>$<?php echo $rowww->price; ?></p></b>
					
					
					<?php 
					if($rowww->status==null)
					{?>
							<form name="book" method="post" action="">
									<input type="hidden" name="gift_id" value="<?php echo $rowww->id; ?>">
									<input type="submit" name="book_gift" value="Reserve" />
									
							</form>
					<?php }else{
						echo '<input type="submit"  style="background: #d8d8d8;" name="book_gift" value="Reserved" disabled/>';
					} ?>
				</div>
			
			
			</div>		
	
	    </div>
	   </div>
	
	
										<?php
					

			}?>
			</div>
	
			<?php
	
}?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.12';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-share-button" data-href="http://www.lartedeifiorisg.it/lista-sposi/" data-layout="button" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.lartedeifiorisg.it%2Flista-sposi%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Click to share on Facebook</a></div>









<?php }?>

<?php } 
add_shortcode( 'login_form', 'login' );



if(isset($_POST['logout_profile'])) 
{
    session_destroy ();
	 ?>
	<script>location.href="<?php echo $current_url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>"</script>
	<?php
}

if(isset($_POST['book_gift'])) 
{
	$g_id=$_POST['gift_id'];
	$table_name = $wpdb->prefix . "gift_list";
$wpdb->update(
                $table_name, //table
                array('status' => 1), //data
                array('id' => $g_id), //where
                array('%s'), //data format
                array('%s') //where format
        );

}
?>