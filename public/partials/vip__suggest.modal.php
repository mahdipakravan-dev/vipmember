<div id="vip-member-modal" class="vip-member-modal">

<!-- Modal content goes here -->
    <div class="modal-wrapper">
        <div>
            <h2>Hello <?php echo $user->display_name; ?> 👋</h2>
            <h3 style="margin : 20px 0 20px 0;">Join our VIP Membership!</h3>
            <p>Upgrade to VIP and enjoy exclusive benefits.</p>

            <button style="margin-top : 10px; width : 100%;">See Plans</button>
        </div>
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
        display: none;
    }

    .modal-wrapper {
        width: 100%;
        height: 100%;
        display: grid;
        place-items: center;
    }
</style>

<script>
    // JavaScript/jQuery code for the modal
    // jQuery(document).ready(function($) {
    //     if(true || !getStorage("__ls__options")) {
    //         $('#vip-member-modal').show();
    //         setStorate("__ls__options" , "SHIR")
    //     } else {
    //     }
    // });
</script>