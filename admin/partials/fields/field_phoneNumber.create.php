<h2>Vip Section</h2>
<table class="form-table" role="presentation">
    <tbody>
        <tr id="vip__phoneNumber" class="user-pass1-wrap">
            <th><label for="vip__phoneNumber">Phone number</label></th>
            <td>
                <input 
                    type="text" 
                    name="vip__phoneNumber" 
                    id="vip__phoneNumber" 
                    value="<?php echo get_user_meta( $user->ID, "vip__phoneNumber", true ); ?>" 
                    placeholder="phone number : " 
                    class="regular-text ltr"
                    required
                >
            </td>
        </tr>
    </tbody>
</table>