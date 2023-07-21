<div class="wrap">
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
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="day">Day (number):</label>
            <input class="form-control" type="number" id="day" name="day" required>
        </div>

        <button type="submit" class="btn btn-primary" id="submit-btn">Submit</button>
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
            // $("#submit-btn").prop("disabled" , true)

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: formData,
                success: function (response) {
                    // Handle the AJAX response here (e.g., show a success message, reload the page, etc.)
                    console.log('AJAX response:', response);
                },
                error: function (error) {
                    // Handle AJAX error (if any)
                    console.error('AJAX error:', error);
                },
            });
        }

        // Wait for the document to be ready
        $(document).ready(function () {
            // Add event listener to the form submission
            $('#vip-plan-form').on('submit', function (event) {
                event.preventDefault(); // Prevent the default form submission behavior
                handleFormSubmit(); // Call the function to handle the AJAX request
            });
        });
    })(jQuery);

</script>