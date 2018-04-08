/*|
 *| jQuery Modal AJAX
 *| Author: Noel Garcia
 *|
 */

$(document).on('click', '.delete', function() {
    GET($(this).attr('data-link'));
})
$(document).on('click', '.edit', function() {
    GET($(this).attr('data-link'));
})
$(document).on('click', '.display', function() {
    GET($(this).attr('data-link'));
})
$(document).on('click', '.create', function() {
    GET($(this).attr('data-link'));
})
$(document).on('click', '.update', function() {
    GET($(this).attr('data-link'));
})
$(document).on('click', '.destroy', function() {
    $.ajax({
        async: true,
        type: 'get',
        url: baseURL + $(this).attr('data-link'),
        success: function(response) {
            window.location = response;
        }
    })
})
$(document).on('click', '.save', function() {
    POST($('#ModalForm').serializeArray(), $(this).attr('data-link'));
})

function GET(dataLink) {
    $.ajax({
        async: true,
        type: 'get',
        url: baseURL + dataLink,
        success: function(response) {
            $('.content').append(response);
        }
    })
}

function POST(postData, dataLink) {
    $.ajax({
        async: true,
        type: 'post',
        url: baseURL + dataLink,
        data: postData,
        success: function(response) {
            window.location = response;
        }
    })
}