<?php 
    $result = null;
	if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
		$username = sanitize_text_field($_POST['user_login']);
		$email = sanitize_text_field($_POST['email']);
        $phoneNumber = sanitize_text_field($_POST['phoneNumber']);
		$pass1 = sanitize_text_field($_POST['pass1']);
		$pass2 = sanitize_text_field($_POST['pass2']);

		if($pass1 != $pass2) return "Password is Wrong";

		$user_data = array(
			"user_login" => apply_filters( "pre_user_login" , $username),
			"user_pass" => apply_filters( "pre_user_pass" , $pass1),
			"email" => apply_filters( "pre_user_email" , $email),
		);

	    $user_id = wp_insert_user($user_data);
		if(is_wp_error($user_id)) {
			$result = array(
                "type" => "error",
                "message" => $user_id
            );
		} else {
            add_user_meta( $user_id, "vip__phoneNumber", $phoneNumber);
			$result = array(
                "type" => "success",
                "message" => "user created successfully!"
            );
		}
	}
?>
<div class="wrap">
<h1 id="add-new-user">Add VIP User</h1>

<?php if(!$result) { ?>
    <div class="message notice inline notice-warning notice-alt">
        <p>if a user currently available in users list , never create it again . 
        <a href="http://localhost/refactorist" class="update-link" >update that user VIP package</a>.</p>
    </div>
<?php } elseif($result["type"] == "success") { ?>
    <div class="message-success notice inline notice-success notice-alt">
        <p><?php echo $result["message"] ?></p> 
    </div>
<?php } elseif($result["type"] == "error") { ?>
    <div class="message notice inline notice-error notice-alt">
        <p><?php echo $result["message"] ?></p> 
    </div>
<?php } ?>

<form action="<?php echo($_SERVER["PHP_SELF"]) . "?page=add-user"; ?>" method="POST">
    <table class="form-table" role="presentation">
        <tbody>
            <tr class="form-field form-required">
                <th scope="row"><label for="user_login">Username <span class="description">(required)</span></label></th>
                <td><input name="user_login" type="text" id="user_login" value="" aria-required="true" autocapitalize="none" autocorrect="off" autocomplete="off" maxlength="60"></td>
            </tr>
            <tr class="form-field form-required">
                <th scope="row"><label for="email">Email <span class="description">(required)</span></label></th>
                <td><input name="email" type="email" id="email" value=""></td>
            </tr>
            <tr class="form-field form-required">
                <th scope="row"><label for="phoneNumber">PhoneNumber <span class="description"></span></label></th>
                <td><input name="phoneNumber" type="phone"></td>
            </tr>
            <tr class="form-field form-required user-pass1-wrap">
                <th scope="row">
                    <label for="pass1">
                        Password <span class="description hide-if-js">(required)</span>
                    </label>
                </th>
                <td>
                    <button type="button" id="wp-generate-pw" class="button wp-generate-pw">Generate password</button>
                    <div class="wp-pwd">
                        <span class="password-input-wrapper">
                            <input type="text" name="pass1" id="pass1" class="regular-text" autocomplete="new-password" spellcheck="false" data-reveal="1" data-pw="xwpR#1fEqA47u2O*VBnkmK#7" aria-describedby="pass-strength-result">
                        </span>
                    </div>
                </td>
            </tr>
            <tr class="form-field form-required user-pass2-wrap">
                <th scope="row"><label for="pass2">Repeat Password <span class="description">(required)</span></label></th>
                <td>
                <input type="password" name="pass2" id="pass2" autocomplete="new-password" spellcheck="false" aria-describedby="pass2-desc">
                <p class="description" id="pass2-desc">Type the password again.</p>
                </td>
            </tr>

            <tr class="form-field">
                <th scope="row">
                    <label for="vip__package">VIP Package Type</label></th>
                    <td><select name="vip__package" id="vip__package">  
                        <option selected="selected" value="1">1 Month</option>
                        <option selected="selected" value="2">3 Month</option>
                        <option selected="selected" value="3">6 Month</option>
                        <option selected="selected" value="4">12 Month</option>
                    </td>
            </tr>
		</tbody>
    </table>

	
	<p class="submit">
        <input type="submit" name="submit" id="createusersub" class="button button-primary" value="Add VIP User">
    </p>
</form>
</div>

<script>
    jQuery(document).ready(function() {
        jQuery('#wp-generate-pw').click(function() {
            jQuery('#pass1').val(generateRandomPassword(20));
        });

        function generateRandomPassword(length) {
            var charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var password = '';
            for (var i = 0; i < length; i++) {
            var randomIndex = Math.floor(Math.random() * charset.length);
            password += charset.charAt(randomIndex);
            }
            return password;
        }
    });
</script>