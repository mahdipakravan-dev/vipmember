<?php
    if(isset($_GET["tab"])) {
        $active_tab = $_GET["tab"];
    } else $active_tab = '1';
?>

<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
<h4>manage vip plugin</h4>

<div class="wrap">
    <div class="nav-tab-wrapper">
        <a href="?page=ls&tab=1" class="nav-tab <?php echo $active_tab == "1" ? "nav-tab-active" : "" ?>">Developer Section</a>
        <a href="?page=ls&tab=2" class="nav-tab <?php echo $active_tab == "2" ? "nav-tab-active" : "" ?>">Customer Section</a>
    </div>

    <?php
        if($active_tab == "1") { 
            require_once VIP_DIR . 'admin/partials/vip__display.main.php';
        } if($active_tab == "2") {
            echo "OOPS";
        }
    ?>
</div>