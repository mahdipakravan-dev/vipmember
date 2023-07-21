<?php $ajax_nonce = wp_create_nonce( "create-plan" ); ?>
<div class="wrap">

    <div class="message notice inline notice-error notice-alt" id="error-section">
    </div>

    <h1 class="wp-heading-inline">Add VIP Plan</h1>

    <form id="vip-plan-form">
        <input type="hidden" name="action" value="add_vip_plan_submit">

        <div class="form-group">
            <label for="title">Title:</label>
            <input class="form-control" type="text" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="day">Day (number):</label>
            <input class="form-control" type="number" id="day" name="day" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2" id="submit-btn">Submit</button>
    </form>
</div>

<script>
    (function ($) {
        function handleFormSubmit() {
            const formData = {
                action: 'vip_plan_create',
                title: $('#title').val(),
                description: $('#description').val(),
                day: $('#day').val(),
                security: '<?php echo $ajax_nonce; ?>',
            };


            $("#submit-btn").text("Please Wait...")
            $("#submit-btn").prop("disabled" , true)

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: formData,
                success: function (response) {
                    console.log(response)
                    if(!response?.success) {
                        $("#error-section").show()
                        $("#error-section").text(response.data.map(error => `${error.message}`).toString())
                        $("#submit-btn").text("Submit")
                        $("#submit-btn").prop("disabled" , false)
                    }
                    if(response?.data?.redirect_url) {
                        window.location.href = response.data?.redirect_url
                    }
                },
                error: function (error) {
                    $("#error-section").show()
                    $("#error-section").text(error.responseText)
                    $("#submit-btn").text("Submit")
                    $("#submit-btn").prop("disabled" , false)
                },
            });
        }

        $(document).ready(function () {
            $("#error-section").hide()

            $('#vip-plan-form').on('submit', function (event) {
                event.preventDefault();
                handleFormSubmit();
            });
        });
    })(jQuery);

</script>