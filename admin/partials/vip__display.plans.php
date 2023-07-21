<div class="wrap">

    <h1 class="wp-heading-inline">Plans of VipMember</h1>
    <a href="#" class="page-title-action">Create Plan</a>
    <br>
    <div class="d-flex justify-content-center" id="loading">
        <div class="spinner-border" role="status">
        </div>
    </div>
    <table class="table table-bordered mt-2" id="plans-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Expiration (day)</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>

        </tr>
        </tbody>
    </table>
</div>

<script>
    (function ($) {
        $(document).ready(function () {
            const data = {
                action: 'vip_plan_getMany',
            };

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: data,
                beforeSend: function () {
                    $("#loading").removeClass('d-none');
                },
                success: function (response) {
                    $("#loading").addClass('d-none');
                    if (response.success) {
                        const $tableBody = $('#plans-table tbody');

                        // Clear any existing rows in the table body
                        $tableBody.empty();

                        // Create and append table rows and cells based on the response data
                        response.data.data.forEach(plan => {
                            const $row = $('<tr>');
                            $row.append($('<td>').text(plan.id));
                            $row.append($('<td>').text(plan.title));
                            $row.append($('<td>').text(plan.description));
                            $row.append($('<td>').text(plan.day));
                            $row.append($('<td class="d-flex justify-content-center">').html(`
                                <div class="dashicons-before dashicons-edit-large mx-2"></div>
                                <div class="dashicons-before dashicons-no"></div>
`                           ));
                            $tableBody.append($row);
                        });                    } else {
                        console.error('Error:', response.data.message);
                    }
                },
                error: function (error) {
                    console.error('AJAX error:', error);
                },
            });
        });
    })(jQuery);

</script>