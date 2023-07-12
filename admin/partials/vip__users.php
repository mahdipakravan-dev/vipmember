<?php
    if(isset($_GET["tab"])) {
        $active_tab = $_GET["tab"];
    } else $active_tab = '1';

    var_dump($active_tab , $active_tab == "1");
?>

<div class="wrap">
    <div class="nav-tab-wrapper">
        <a href="?page=ls&tab=1" class="nav-tab <?php echo $active_tab == "1" ? "nav-tab-active" : "" ?>">Developer Section</a>
        <a href="?page=ls&tab=2" class="nav-tab <?php echo $active_tab == "2" ? "nav-tab-active" : "" ?>">Customer Section</a>
    </div>

    <?php
        if($active_tab == "1") {
    ?>
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <form action="options.php" method="post">
            </form>
    <?php
        } if($active_tab == "2") {
    ?>
            <h1>Manage Something else</h1>
            <form action="options.php" method="post">
            </form>
    <?php
        }
    ?>
</div>