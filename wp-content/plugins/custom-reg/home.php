<?php
    if($_POST['save_option']){
        global $wpdb;
        $wpdb->update('wp_options',array('option_value'=>$_POST['option_value']),array('option_name'=>$_POST['option_name']));

    }
    $options_keys = ['singup_email_all','singup_email_employer','singup_email_candidate'];
    $options_value = get_options_value($options_keys);
?>

<div class="custom-reg">
    <div class="info">
        <b>{email}</b> - User Email<br>
        <b>{password}</b> - User Password
    </div>
    <form action="index.php?page=vapy" class="form" method="POST">
        <h2>Register Email (All):</h2>
        <input type="hidden" name="option_name" value="singup_email_all">
        <?wp_editor($options_value['singup_email_all'], 'option_value_all', array('textarea_name'=>'option_value','textarea_rows'=>7,'media_buttons'=>true));?>
        <button type="submit" name="save_option" value="true" class="save">Save</button>
    </form>
    <form action="index.php?page=vapy" class="form" method="POST">
        <h2>Register Email (Employer):</h2>
        <input type="hidden" name="option_name" value="singup_email_employer">
        <?wp_editor($options_value['singup_email_employer'], 'option_value_empl', array('textarea_name'=>'option_value','textarea_rows'=>7,'media_buttons'=>true));?>
        <button type="submit" name="save_option" value="true" class="save">Save</button>
    </form>
    <form action="index.php?page=vapy" class="form" method="POST">
        <h2>Register Email (Candidate):</h2>
        <input type="hidden" name="option_name" value="singup_email_candidate">
        <?wp_editor($options_value['singup_email_candidate'], 'option_value_cand', array('textarea_name'=>'option_value','textarea_rows'=>7,'media_buttons'=>true));?>
        <button type="submit" name="save_option" value="true" class="save">Save</button>
    </form>
</div>
