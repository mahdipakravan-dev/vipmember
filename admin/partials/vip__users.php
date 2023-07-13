<?php 
    if(isset($_GET["action"]) && isset($_GET["id"]) && intval($_GET["id"])) {
        switch($_GET["action"]) {
            case "delete": {
                $delete_result = wp_delete_user($_GET["id"]);

                if($delete_result) {
                    $result = array(
                        "type" => "success",
                        "message" => "delete user successfully !"
                    );
                } else {
                    $result = array(
                        "type" => "error",
                        "message" => "error in deleting user !!"
                    );
                }
                break;
            }
            case "view": {
                break;
            }
            case "edit": {
                require_once VIP_DIR . 'admin/partials/vip__editUser.php';
                return;
                break;
            }
            case "update": {
                if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
                    $email = sanitize_text_field($_POST['email']);

                    $user_data = array(
                        "ID" => $_POST["ID"],
                        "user_email" => apply_filters( "pre_user_email" , $email),
                    );
            
                    $result = wp_update_user($user_data);
                    if(is_wp_error($result)) {
                        $result = array(
                            "type" => "error",
                            "message" => $result
                        );
                    } else {
                        $result = array(
                            "type" => "success",
                            "message" => "user created successfully!"
                        );
                    }
                }
                break;
            }
        }
    }
?>

<div class="wrap">
    <h1 class="wp-heading-inline">VIP Users</h1>
    <a href="admin.php?page=add-user" class="page-title-action">Add New</a>

    <hr class="wp-header-end">

    <?php if(!isset($result) || !$result) { ?>
        <div></div>
    <?php } elseif($result["type"] == "success") { ?>
        <div class="message-success notice inline notice-success notice-alt">
            <p><?php echo $result["message"] ?></p> 
        </div>
    <?php } elseif($result["type"] == "error") { ?>
        <div class="message notice inline notice-error notice-alt">
            <p><?php echo $result["message"] ?></p> 
        </div>
    <?php } ?>

    <ul class="subsubsub">
        <li class="all"><a href="edit.php?post_type=post" class="current" aria-current="page">All <span class="count">(1)</span></a> |</li>
        <li class="publish"><a href="edit.php?post_status=publish&amp;post_type=post">Published <span class="count">(1)</span></a></li>
    </ul>
    
    <table class="wp-list-table widefat fixed striped table-view-list posts">
        <header>
            <tr>
                <th id="cb" class="manage-column column-cb check-column">
                    <label class="screen-reader-text" for="cb-select-all-1">Select All</label>
                    <input id="cb-select-all-1" type="checkbox">
            </th>
                <th><a href="#">ID</a></th>
                <th><a href="#">username</a></th>
                <th><a href="#">email</a></th>
                <th><a href="#">display name</a></th>
            </tr>
        </header>

        <tbody>
            <?php 
                $users = get_users();
                foreach ($users as $key => $user):
            ?>
                <tr>
                    <th scope="row" class="check-column">	
                        <input id="cb-select-1" type="checkbox" name="post[]" value="<?php $user->ID; ?>">
                    </th>
                    <td>
                        <?php echo $user->ID; ?>
                    </td>
                    <td>
                        <?php echo $user->user_login; ?>
                        <div class="row-actions">
                            <span class="edit">
                                <a href="<?php echo $_SERVER["PHP_SELF"] . "?page=manage-users&action=edit" . "&id=" . $user->ID; ?>">Edit</a> | 
                            </span>
                            <span class="trash">
                                <a href="<?php echo $_SERVER["PHP_SELF"] . "?page=manage-users&action=delete" . "&id=" . $user->ID; ?>" class="submitdelete">Trash</a> | 
                            </span>
                            <span class="view">
                                <a href="<?php echo $_SERVER["PHP_SELF"] . "?page=manage-users&action=view" . "&id=" . $user->ID; ?>" rel="bookmark" aria-label="View “Hello world!”">View</a>
                            </span>
                        </div>
                    </td>
                    <td><?php echo $user->user_email; ?></td>
                    <td><?php echo $user->display_name; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
