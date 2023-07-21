<div class="wrap">

    <div class="message notice inline notice-error notice-alt" id="error-section">
    </div>

    <h1 class="wp-heading-inline">Add VIP Plan</h1>

    <form id="vip-plan-form">
        <?php wp_nonce_field( 'add_vip_plan_action', 'add_vip_plan_nonce' ); ?>
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
    // my-ajax-script.js
    (function ($) {

        // Function to handle the form submission and make the AJAX call
        function handleFormSubmit() {
            const formData = {
                action: 'vip_plan_create', // The AJAX action name defined in Step 3
                title: $('#title').val(), // Replace 'title' with the actual input field ID
                description: $('#description').val(), // Replace 'description' with the actual input field ID
                day: $('#day').val(), // Replace 'day' with the actual input field ID
            };


            $("#submit-btn").text("Please Wait...")
            $("#submit-btn").prop("disabled" , true)

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: formData,
                success: function (response) {
                    if(!response?.success) {
                        const errors = response.data.map(error => `${error.message}`).toString()
                        console.log(errors)
                        $("#error-section").show()
                        $("#error-section").text(errors)
                        $("#submit-btn").text("Submit")
                        $("#submit-btn").prop("disabled" , false)
                    }
                    if(response?.data?.url) {
                        window.location.href = response.data?.url
                    }
                },
                error: function (error) {
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