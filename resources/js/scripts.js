import Echo from "laravel-echo"

var busy = false;

/**
 * Pusher
 */
const pusher_app_key = process.env.MIX_PUSHER_APP_KEY;
const pusher_app_cluster = process.env.MIX_PUSHER_APP_CLUSTER;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: pusher_app_key,
    cluster: pusher_app_cluster,
    encrypted: true,
});

// Listen for messages
var conversation = document.querySelector('#conversation_uid');

if(conversation){
    // Scroll to bottom
    var objDiv = document.getElementById("conversations-right-body");
    objDiv.scrollTop = objDiv.scrollHeight;

    // Listen for new messages
    window.Echo.private('conversation.' + conversation.value).listen('MessagePosted', (e) => {
        console.log(e);
        // Append new message
        $('#conversations-right-body').append("message");

        // Scroll to bottom
        var objDiv = document.getElementById("conversations-right-body");
        objDiv.scrollTop = objDiv.scrollHeight;
    });

    /**
     * Send message function
     * 
     * @param {int} id
     * @param {string} content
     */
    const sendMessage = (id, content) => {
        if(busy) return false;

        busy = true;

        if(id != '' && content != ''){
            $.ajax({
                url: '/messages/send',
                type: 'POST',
                data: {
                    conversation_uid: id,
                    message: content,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result){
                    $('#conversations-right-body').append(result.html);

                    // Scroll to bottom
                    var objDiv = document.getElementById("conversations-right-body");
                    objDiv.scrollTop = objDiv.scrollHeight;

                    // Empty textarea
                    $('#message-textarea').val('');
                    busy = false;
                }
            });
        } else {
            alert('Invalid message');
            busy = false;
        }
    }

    document.querySelector('#message-form').addEventListener('submit', event => {
        event.preventDefault();

        const conversation_id = document.querySelector('#conversation_uid').value;
        const content = document.querySelector('#message-textarea').value;

        sendMessage(conversation_id, content);
    });
}

// Conversation ajax functions

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

    /**
     * Edit Experience modal; Open modal and fill form
     * ----------------
     * This script is used to handle the edit experience form on profiles.
     * 
     * When the user clicks the edit button, it will open the modal with the form.
     * When the user submits the form, it will make an AJAX request to the server.
     */
    $('.edit-experience').click(function(e) {
        e.preventDefault();

        var action = $(this).data('action');
        var expid = $(this).data('expid');

        $.ajax({
            url: action,
            method: 'GET',
            data: { expid: expid },
            success: function(response) {
                console.log(response);
                // Update the modal with the form
                // For each key update it's corresponding input field 
                for (var key in response.data) {
                    $('#edit-experience-form').find('input[id="exp_edit_' + key + '"]').val(response.data[key]);

                    if (key == 'description') {
                        $('#edit-experience-form').find('textarea[id="exp_edit_' + key + '"]').val(response.data[key]);
                    }

                    if (key == 'is_current_job' || key == 'employment_type') {
                        $('#edit-experience-form').find('input[id="exp_edit_' + key + '"]').prop('checked', response.data[key]);
                    }
                }     
                $('#edit-experience-modal').modal('show');
            },
            error: function(response) {
                console.log(response);
            }
        });

        return false;
    });

    /**
     * Draggable experience list items
     * ----------------
     * This script is used to handle the draggable experience list items on profiles.
     */
    $( ".sortable" ).sortable({
        update: function(event, ui) {
            var data = $(this).sortable('serialize');
            var action = $(this).data('action');

            $.ajax({
                data: data,
                type: 'POST',
                url: action,
                success: function(response) {
                    // Show alert
                    Alert('Experience order updated successfully.');
                }
            });
        }
    });

    /**
     * Change role form toggle
     * ----------------
     * When someone presses the change role radio button, it will submit the form.
     */
    $('input[type=radio][name=role]').change(function() {
        $('#change-role-form').submit();
    });

    /**
     * Change role form submit
     * ----------------
     * When the user submits the change role form, it will make an AJAX request to the server.
     */
    $('#change-role-form').submit(function(e) {
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
                // Show alert
                Alert('Role changed successfully.');
                window.location.reload();
            },
            error: function(response) {
                console.log(response);
            }
        });

        return false;
    });

    /**
     * Delete Post
     * ----------------
     * This script is used to handle the delete post button on posts.
     */
    $('.delete-post').click(function(e) {
        e.preventDefault();

        var action = $(this).attr('href');
        var postid = $(this).data('post_id');

        if (confirm('Are you sure you want to delete this post?')) 
        {
            $.ajax({
                url: action,
                method: 'DELETE',
                data: { postid: postid },
                success: function(response) {
                    $('#post-' + postid).remove();

                    // Show alert
                    Alert('Post deleted successfully.');
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

        return false;
    });

    /**
     * Like Post
     * ----------------
     * This script is used to handle the like post button on posts.
     */
    $('.post-like-btn').click(function(e) {
        e.preventDefault();

        var action = $(this).attr('href');
        var postid = $(this).data('post_id');

        $.ajax({
            url: action,
            method: 'POST',
            data: { postid: postid },
            success: function(response) {
                $("#post-like-btn-" + postid).addClass('hidden');
                $("#post-unlike-btn-" + postid).removeClass('hidden');

                // Likes count
                if(response.likes_count === 1) {
                    $("#post-likes-count-" + postid).text(response.likes_count + ' Like');
                }else{
                    $("#post-likes-count-" + postid).text(response.likes_count + ' Likes');
                }
            },
            error: function(response) {
                console.log(response);
            }
        });

        return false;
    });

    /**
     * Unlike Post
     */
    $('.post-unlike-btn').click(function(e) {
        e.preventDefault();

        var action = $(this).attr('href');
        var postid = $(this).data('post_id');

        $.ajax({
            url: action,
            method: 'DELETE',
            data: { postid: postid },
            success: function(response) {
                $("#post-like-btn-" + postid).removeClass('hidden');
                $("#post-unlike-btn-" + postid).addClass('hidden');

                // Likes count
                if(response.likes_count === 1) {
                    $("#post-likes-count-" + postid).text(response.likes_count + ' Like');
                }else{
                    $("#post-likes-count-" + postid).text(response.likes_count + ' Likes');
                }
            },
            error: function(response) {
                console.log(response);
            }
        });

        return false;
    });

    /**
     * Comment Post
     * ----------------
     * This script is used to handle the comment textarea when someone presses enter or return.
     *    
     */
    $('.comment-textarea').keypress(function(e) {
        if (e.which == 13) {
            e.preventDefault();

            var form = $(this).closest('form');

            // Submit the form
            form.submit();
        }
    });

    /**
     * Comment Post
     * ----------------
     * This script is used to handle the comment post button on posts.
     */
    $('.post-comment-form').submit(function(e) {
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
                if(response.comments_count === 1) {
                    $("#post-comments-count-" + response.post_id).text(response.comments_count + ' Comment');
                } else {
                    $("#post-comments-count-" + response.post_id).text(response.comments_count + ' Comments');
                }
                
                // Update the comments section
                $('#post-comments-' + response.post_id).html(response.comments);

                // Clear the textarea
                form.find('input[type="text"]').val('');
            },
            error: function(response) {
                console.log(response);
            }
        });

        return false;
    });

    /**
     * Matchmaker tab toggle
     * ----------------
     * This script is used to handle the matchmaker tab toggle for job posters.
     */
    $('.matchmaker-tab').click(function(e) {
        e.preventDefault();

        var tab = $(this).data('tab');

        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        // Hide all tabs
        $('.matchmaker-tab-content').addClass('hidden');

        // Show the selected tab
        $('#matchmaker-tab-' + tab).removeClass('hidden');  
    });

    /** 
     * Opened modal logic
     * ----------------
     * This script is used to handle the opened modal logic.
     */
    let openModalId = sessionStorage.getItem('openModalId');

    if (openModalId) {
        $("#" + openModalId).modal('show');
    }

    $('.modal').on('show.bs.modal', function() {
        let modalId = $(this).attr('id');
        sessionStorage.setItem('openModalId', modalId);
    });

    $('.modal').on('hidden.bs.modal', function() {
        sessionStorage.removeItem('openModalId');
    });
});
