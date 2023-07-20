<div class="wrap">
    <h1 class="wp-heading-inline">Add VIP Plan</h1>
    <form id="vip-plan-form" method="post" action="<?php echo($_SERVER["PHP_SELF"]) . "?page=vipmember-settings"; ?>">
        <?php wp_nonce_field( 'add_vip_plan_action', 'add_vip_plan_nonce' ); ?>
        <input type="hidden" name="action" value="add_vip_plan_submit">

        <div class="form-group">
            <label for="title">Title:</label>
            <input class="form-control" type="text" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="day">Day (number):</label>
            <input class="form-control" type="number" id="day" name="day" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
