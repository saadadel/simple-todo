$(document).ready(function () {
    renderAllTasks();

    // Add Task Listener
    $('#add-btn').click(function (e) { 
        e.preventDefault();

        addTask();
    });

    // Edit Task Listener
    // Add Task Listener
    $('#edit-btn').click(function (e) {
        e.preventDefault();

        editTask();
    });
    $(document).on('click', '.task-edit', function(){
        $('#editModal input[name=id]').val($(this).data('id'));
        $('#editModal input[name=title]').val($(this).data('title'));
        $('#editModal textarea[name=description]').val($(this).data('desc'));
        $('#editModal select[name=status]').val($(this).data('status'));
    });

    // Delete Task Listener
    $(document).on("click", ".task-del", function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                deleteTask(this);
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                );
            }
        })
    });

});
function renderAllTasks() 
{ 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "get",
        url: "/",
        success: function (response) {
            console.log(response);
            var todo_cards = '', in_cards = '', done_cards = '';
            $.each(response, function (indexInArray, valueOfElement) { 
                card_data = `
                    <div class='card mb-2' style='width: 100%;'>
                            <div class='card-body'>
                                <h5 class='card-title'>`+ valueOfElement.title + `</h5>
                                <p class='card-text'>`+ valueOfElement.description +`</p>
                                <a href='#' class='card-link text-primary task-edit' data-id='`+valueOfElement.id+`' data-title='`+ valueOfElement.title + `' data-desc='` + valueOfElement.description +`' data-status='`+valueOfElement.status+`' data-toggle='modal' data-target='#editModal'>Edit</a>
                                <a href='javascript:void(0)' class='card-link text-danger task-del' data-id='`+valueOfElement.id+`'>Delete</a>
                            </div>
                    </div >
                `
                 switch (valueOfElement.status) {
                     case 'todo':
                         todo_cards += card_data;
                         break;

                     case 'in-progress':
                         in_cards += card_data;
                         break;

                     case 'done':
                         done_cards += card_data;
                         break;
                 }
            });
            $('.todo .cards').html(todo_cards);
            $('.in-progress .cards').html(in_cards);
            $('.done .cards').html(done_cards);
        }
    });
}

function addTask() 
{
    var form_data = $('#add-form').serialize();
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: "task",
        data: form_data,
        success: function (response) {
            $('#editModal').removeClass('show'); $('body').removeClass('modal-open'); $('.modal-backdrop').remove();
            toastr.success(response.message);
            renderAllTasks();
        },
        error: function (data) {
            var errors = data.responseJSON;
            $.each(errors.errors, function (indexInArray, valueOfElement) { 
                toastr.error(valueOfElement);
            });
            // Render the errors with js ...
        }
    });
}

function editTask()
{
    var form_data = $('#edit-form').serialize();
    var task_id = $('#edit-form input[name=id]').val();
    console.log(form_data);
    console.log(task_id);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "PUT",
        url: "/task/" + task_id,
        data: form_data,
        success: function (response) {
            $('#editModal').removeClass('show');$('body').removeClass('modal-open'); $('.modal-backdrop').remove();
            toastr.success(response.message);
            renderAllTasks();
        },
        error: function (data) {
            var errors = data.responseJSON;
            $.each(errors.errors, function (indexInArray, valueOfElement) {
                toastr.error(valueOfElement);
            });
            // Render the errors with js ...
        }
    });
}

function deleteTask(task_card) {
    var task_id = $(task_card).data('id');

    console.log(task_id);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: "/task/" + task_id,
        success: function (response) {
            $(task_card).closest('.card').remove();
            toastr.success(response.message);
            // renderAllTasks();
        },
        error: function (data) {
            var errors = data.responseJSON;
            $.each(errors.errors, function (indexInArray, valueOfElement) {
                toastr.error(valueOfElement);
            });
            // Render the errors with js ...
        }
    });
}