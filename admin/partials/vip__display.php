<?php
    if(isset($_GET["tab"])) {
        $active_tab = $_GET["tab"];
    } else $active_tab = 'plans';
?>

<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
<h4>manage vip plugin</h4>

<div class="wrap">
    <div class="nav-tab-wrapper">
        <a href="?page=vipmember-settings&tab=plans" class="nav-tab <?php echo $active_tab == "plans" ? "nav-tab-active" : "" ?>">Plans</a>
        <a href="?page=vipmember-settings&tab=create-plan" class="nav-tab <?php echo $active_tab == "create-plan" ? "nav-tab-active" : "" ?>">Create Plan</a>
    </div>

    <?php
        switch ($active_tab ) {
            case "plans":
            {
                require_once VIP_DIR . 'admin/partials/vip__display.plans.php';
                return;
            }
            case "create-plan":
            {
                require_once VIP_DIR . 'admin/partials/vip__display.create.php';
                break;
            }
        }
    ?>
</div>