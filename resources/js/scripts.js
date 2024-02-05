$(document).ready(function() {
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

