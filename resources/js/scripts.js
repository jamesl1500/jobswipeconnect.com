$(document).ready(function() {
    // CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // If alert exists, fade it out after 5 seconds
    if ($('.alert').length) {
        setTimeout(function() {
            $('.alert').fadeOut();
        }, 5000);
    }

    // Alert
    function Alert(message) {
        var alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">' + message + '</div>';

        $('.alert-hold').html(alert);
        $('.alert').fadeIn();

        setTimeout(function() {
            $('.alert').fadeOut();
        }, 5000);
    }

    /**
     * Navigation Dropdown
     * -------------------
     * This script is used to handle the navigation dropdown on the top right of the page.
     */
    $('.h-dropdown').click(function() {
        $('.header-dropdown').toggleClass('hidden');
    });

    /**
     * Dashboard form | Open/close bottom form
     * ----------------------------------
     * When clicks or starts typing in the form, it will open the bottom form.
     */
    $("#dashboard-post").on('click', function() {
        $(this).css('height', '100px');
        $(".content-creator-bottom").removeClass('hidden');
    });

    // When user clicks out of the form, it will close the bottom form
    $(document).click(function(e) {
        if (!$(e.target).closest('.dashboard-content-creator').length) {
            $(".content-creator-bottom").addClass('hidden');
            $("#dashboard-post").css('height', '50px');
        }
    });


    /**
     * Edit Resume Form
     * ----------------
     * This script is used to handle the edit resume form on profiles.
     * It will handle the form submission and make an AJAX request to the server.
     * If the request is successful, it will update the resume content on the page.
     */
    $('#edit-resume-form').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var data = form.serialize();

        $.ajax({
            url: url,
            method: method,
            data: data,
            success: function(response) {
                $('#resume-content').html(response);
                $('#edit-resume-modal').modal('hide');
            },
            error: function(response) {
                console.log(response);
            }
        });

        return false;
    });

    /**
     * Delete Experience
     * ------------------
     * This script is used to handle the delete experience button on profiles.
     */
    $('.delete-experience').click(function(e) {
        e.preventDefault();

        var action = $(this).data('action');
        var expid = $(this).data('expid');

        if (confirm('Are you sure you want to delete this experience?')) 
        {
            $.ajax({
                url: action,
                method: 'DELETE',
                data: { expid: expid },
                success: function(response) {
                    $('#exp-' + expid).remove();

                    // Show alert
                    Alert('Experience deleted successfully.');
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

        return false;
    });

    /**
     * Delete Education
     * ------------------
     * This script is used to handle the delete education button on profiles.
     */
        $('.delete-education').click(function(e) {
            e.preventDefault();
    
            var action = $(this).data('action');
            var eduid = $(this).data('eduid');
    
            if (confirm('Are you sure you want to delete this education?')) 
            {
                $.ajax({
                    url: action,
                    method: 'DELETE',
                    data: { eduid: eduid },
                    success: function(response) {
                        $('#edu-' + eduid).remove();
    
                        // Show alert
                        Alert('Education deleted successfully.');
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            }
    
            return false;
        });
});
