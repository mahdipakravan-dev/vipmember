<?php 
    echo "SEXY";
?>
<div id="vip-member-modal" class="vip-member-modal">
<!-- Modal content goes here -->
    <div>
        <h2>Join our VIP Membership!</h2>
        <p>Upgrade to VIP and enjoy exclusive benefits.</p>
    </div>
    
</div>

<style>
    /* CSS styles for the modal */
    .vip-member-modal {
        position: fixed;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        background-color: rgba(0,0,0,0.8);
        color: #fff;
        z-index: 2;
        display: grid;
        place-items: center;
    }
</style>

<script>
    // JavaScript/jQuery code for the modal
    jQuery(document).ready(function($) {
        // Show the modal
        $('#vip-member-modal').show();
    });
</script>