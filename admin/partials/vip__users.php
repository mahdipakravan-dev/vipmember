<div class="wrap">
    <h1 class="wp-heading-inline">VIP Users</h1>
    <a href="admin.php?page=add-user" class="page-title-action">Add New</a>

    <hr class="wp-header-end">
    <ul class="subsubsub">
        <li class="all"><a href="edit.php?post_type=post" class="current" aria-current="page">All <span class="count">(1)</span></a> |</li>
        <li class="publish"><a href="edit.php?post_status=publish&amp;post_type=post">Published <span class="count">(1)</span></a></li>
    </ul>
    
    <table class="wp-list-table widefat fixed striped table-view-list posts">
        <header>
            <tr>
                <th><a href="#">ID</a></th>
                <th><a href="#">username</a></th>
                <th><a href="#">email</a></th>
                <th><a href="#">mobile</a></th>
            </tr>
        </header>

        <tbody>
            <?php 
                $users = get_users();
                foreach ($users as $key => $user):
            ?>
                <tr>
                    <td><?php echo $user->ID; ?></td>
                    <td><?php echo $user->user_login; ?></td>
                    <td><?php echo $user->user_email; ?></td>
                    <td><?php echo $user->display_name; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>