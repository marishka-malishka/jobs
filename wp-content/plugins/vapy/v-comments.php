<?php
	global $wpdb;
	if($_GET['add_comment']){
		$wpdb->query('INSERT INTO '.$wpdb->prefix.'galleryhome () VALUES ()');
		echo "<script>window.location.assign('admin.php?page=vapy')</script>";
	}
	if($_POST['delete_comment'])$wpdb->query('DELETE FROM '.$wpdb->prefix.'galleryhome WHERE id='.$_POST['id']);
	if($_POST['save_comment']){
		$wpdb->query('UPDATE '.$wpdb->prefix.'galleryhome SET content="'.$_POST['slider_content'].'" 
											  WHERE id="'.$_POST['id'].'"');
		if($_FILES['slider_image']['error'] == 0){ 
			$dir_file = WP_CONTENT_DIR."/uploads/".'slider_image_'.time().'_'._en($_FILES['slider_image']['name']); 
			$url_file = WP_CONTENT_URL."/uploads/".'slider_image_'.time().'_'._en($_FILES['slider_image']['name']); 
			move_uploaded_file($_FILES['slider_image']['tmp_name'], $dir_file); 
			$wpdb->query("UPDATE ".$wpdb->prefix."galleryhome SET image='".$url_file."' WHERE id=".$_POST['id']); 
		}
	}
	
?>
<div id="comments">
	<a href="admin.php?page=vapy&add_comment=true" class="add_comment">Add new slide</a>
	<?$res = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'galleryhome');?>
	<?php foreach ($res as $slide): ?>
	<div class="item">
		<a href="" class="open_button">
			<?=$slide->id;?>
		</a>
		<form class="content" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?=$slide->id;?>">
			<div class="photo">
				<div class="image">
					<img src="<?=$slide->image?>" alt="">
				</div>
				<input type="file" class="file" name="slider_image">
			</div>
			<div class="text">
				<?wp_editor($slide->content, 'slider_content_'.$slide->id, array('textarea_name'=>'slider_content','textarea_rows'=>1,'media_buttons'=>false));?>
			</div>
			<div class="clr"></div>
			<div class="options">
				<input type="submit" name="save_comment" value="Save">
				<?if($slide->id!=1):?><input type="submit" name="delete_comment" value="Delete"><?endif;?>
			</div>
		</form>
	</div>
	<?php endforeach ?>
</div>