$(function() {

    setTimeout(function() {
        $(".alert").hide()
    }, 2500);
});

$(document).ready(function() {
    $('.js-example-basic-single').select2({
        multiple: true,
        placeholder: 'Select Subjects',
        width: 'resolve',
        allowClear: true,
        maximumSelectionLength: 5
    });
});

function updateTextInput(val) {
    document.getElementById('ageshow').innerHTML = val;
}






$(document).ready(function() {

    // add data
    $(document).on('click', '#submit', function(e) {
        e.preventDefault();
        let base_url = $('body').attr('data-url');
        let form_url = $('.allform').attr('form-url');
        let form_data = $('.allform').serializeArray();
        // return alert(base_url + form_url + form_data);
        $(".alert").remove();
        adddata(base_url, form_url, form_data);

    });

    // edit data
    $(document).on('click', '.btn-edit', function(e) {
        e.preventDefault();
        let base_url = $('body').attr('data-url');
        let form_url = $(this).attr('edit-url');
        let data_id = $(this).attr('data-id');
        // return alert(base_url + form_url + data_id);
        let edit_url = base_url + form_url + data_id;
        // $(".alert").remove(); 
        // window.location = edit_url;
        editdata(edit_url);
    });




    // update data
    $(document).on('click', '#update', function(e) {
        e.preventDefault();
        let base_url = $('body').attr('data-url');
        let form_url = $('.allform').attr('update-url');
        let form_data = $('.allform').serialize();
        // alert(base_url+form_url+form_data);
        $(".alert").remove();
        updatedata(base_url, form_url, form_data);

    });

    // delete data
    $(document).on('click', '.btn-del', function(e) {
        e.preventDefault();
        let base_url = $('body').attr('data-url');
        let form_url = $(this).attr('delete-url');
        let data_id = $(this).attr('data-id');
        // return alert(base_url+form_url+data_id);
        deletedata(base_url, form_url, data_id);
    });





    // add data function
    function adddata(base_url, form_url, form_data) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        Swal.fire({
            title: 'Please Wait !',
            html: 'data Saveing...', // add html attribute if you want or remove
            showConfirmButton: false,
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
        console.log(form_data);
        $.ajax({
            type: 'POST',
            url: base_url + form_url,
            data: form_data,
            dataType: 'json',

            success: function(response, textStatus, jqXHR) {
                // console.log('textStatus', textStatus);
                // console.log('jqXHR', jqXHR.status);
                swal.close();
                // alert(response.success)
                if (jqXHR.status == 200) {
                    Swal.fire({
                        title: response.success,
                        text: "Are you sure to enter data again ?",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('.allform')[0].reset();
                        } else {
                            window.location = '/admin/' + $('input[name="module_name"]').val() + '/list';
                        }
                    })
                }
                // 
            },
            error: function(errors) {
                swal.close();
                // var err = JSON.parse(errors);
                // console.log(errors.responseJSON['errors']['email'][0]);
                let err = errors.responseJSON['errors'];
                $.each(err, function(propName, propVal) {
                    $('[name=' + propName + ']').after('<p style="color: red" class="alert"><i class="fas fa-exclamation-circle"></i> ' + propVal + '</p>');
                    console.log(propName, propVal);
                });
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        });
    }

    // update data function
    function updatedata(base_url, form_url, form_data) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        Swal.fire({
            title: 'Please Wait !',
            html: 'data Saveing...', // add html attribute if you want or remove
            showConfirmButton: false,
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
        $.ajax({
            type: 'POST',
            url: base_url + form_url,
            data: form_data,
            dataType: 'json',
            success: function(response) {
                swal.close();
                // alert(response.success)
                Swal.fire({
                        icon: 'success',
                        title: response.success,
                    })
                    .then(function() {
                        // window.location = '/admin/users/list';
                        window.location = '/admin/' + $('input[name="module_name"]').val() + '/list';
                    });

            },
            error: function(errors) {
                swal.close();
                // var err = JSON.parse(errors);
                // console.log(errors.responseJSON['errors']['email'][0]);
                let err = errors.responseJSON['errors'];
                $.each(err, function(propName, propVal) {
                    $('[name=' + propName + ']').after('<p style="color: red" class="alert"><i class="fas fa-exclamation-circle"></i> ' + propVal + '</p>');
                    console.log(propName, propVal);
                });
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        });
    }


    // delete data function
    function deletedata(base_url, form_url, data_id) {

        // return alert(base_url,form_url,data_id);
        Swal.fire({
            title: 'Confirmation',
            text: "Are you sure to delete data ?",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'GET',
                    url: base_url + form_url + data_id,
                    dataType: 'json',
                    success: function(response) {
                        $('[data-id="' + data_id + '"]').closest('tr').remove();
                        Swal.fire({
                            icon: 'success',
                            title: response.success,
                            showButton: false,
                        });
                        // location.reload();
                    }
                });

            } else {

                Swal.fire({
                    icon: 'success',
                    title: 'Data Not Deleted !',
                });

            }
        })
    }


    function editdata(edit_url) {
        $.ajax({
            type: 'GET',
            url: edit_url,
            dataType: 'json',
            success: function(response) {
                response.html;
                // alert(response.data.address)
                // console.log(response);
                // window.location = '/admin/students/add' + response.data;
                // $(document).find('.allform >  [name = "firstname"]').val(response.data.firstname);
                // let form_details = $('.allform');
                // console.log(form_details);


                // $('[data-id="' + data_id + '"]').closest('tr').remove();
                // Swal.fire({
                //     icon: 'success',
                //     title: response.success,
                //     showButton: false,
                // });
                // location.reload();
            }
        });
    }


    // $(window).load(function() {

    // if (document.URL == "/car-driving.html") {
    //     overlay.show();
    //     overlay.appendTo(document.body);
    //     $('.popup').show();
    //     return false;
    // }
    // alert(document.URL);
    // $.ajax({
    //     type: 'GET',
    //     url: 'admin/students/edit/16',
    //     dataType: 'json',
    //     success: function(response) {
    //         alert(response)
    //         $(document).find('.allform >  [name = "firstname"]').val(response.data.firstname);

    //     }
    // });
    // });




    $('#users_data').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('body').attr('data-url') + '/admin/users/show',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'firstname', name: 'firstname' },
            { data: 'lastname', name: 'lastname' },
            { data: 'email', name: 'email' },
            { data: 'mobile', name: 'Mobile' },
            { data: 'role_name', name: 'role_name' },
            //  orderable: false, searchable: false property
            // { data: 'status', name: 'status' },
            {
                data: 'status',
                name: 'status',
                "render": function(data, type, row) {
                    // console.log(data);
                    // console.log(type);
                    // console.log(row);
                    return (row.password == null ? '<i class="fas fa-circle" style="color: red"></i>' : '<i class="fas fa-circle" style="color: green"></i>');

                },

                orderable: false,
                searchable: false
            },
            { data: 'action', name: 'action', orderable: false, searchable: false },
            //  { data: 'class="badge bg-danger"', name: 'test',orderable: false, searchable: false },
        ]
    });

    sem_data();

    function sem_data() {
        $('#semesters_data').DataTable({
            processing: true,
            serverSide: true,
            ajax: $('body').attr('data-url') + '/admin/semesters/show',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'semestername', name: 'semestername' },
                // { data: 'status', name: 'status' },
                // { data: 'action', name: 'action', orderable: false },
                // { data: 'action', name: 'action', orderable: false },
                {
                    data: 'status',
                    name: 'status',
                    "render": function(data, type, row) {
                        console.log(data);
                        console.log(type);
                        console.log(row);
                        return '<input type="checkbox" class="sem-check" data-id="' + row.id + '" name="semester-check" ' + (row.is_active == 'active' ? 'checked' : '') + ' />';
                    },

                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    "render": function(data, type, row) {
                        // console.log(data);
                        // console.log(type);
                        // console.log(row);
                        return '<a type="button" " href="/admin/semesters/edit/' + row.id + '" class="btn btn-warning mr-3">Edit</a><a type="button" delete-url="/admin/semesters/delete/" data-id="' + row.id + '" href="/admin/semesters/delete/" class="btn-del btn btn-danger">Delete</a>';
                    },

                    orderable: false,
                    searchable: false
                },
            ],

        });
    }


    $('#subjects_data').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('body').attr('data-url') + '/admin/subjects/show',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'subjectname', name: 'subjectname' },
            { data: 'type', name: 'type' },
            { data: "semestername", name: 'semester' },
            { data: 'faculty', name: 'faculty' },

            // {
            //     data: 'is_active',
            //     'render': function(data, type, full, meta) {
            //         return '<input type="checkbox" name="id[]"';
            //     }
            // },
            {
                data: 'status',
                name: 'status',
                "render": function(data, type, row) {
                    // console.log(data);
                    // console.log(type);
                    // console.log(row);
                    return '<input type="checkbox" class="sub-check" data-id="' + row.id + '" name="subject-check" ' + (row.is_active == 'active' ? 'checked' : '') + ' />';
                },

                orderable: false,
                searchable: false
            },
            // { data: 'action', name: 'action', orderable: false },
            {
                data: 'action',
                name: 'action',
                "render": function(data, type, row) {
                    return '<a type="button" " href="/admin/subjects/edit/' + row.id + '" class="btn btn-warning mr-3">Edit</a><a type="button" delete-url="/admin/subjects/delete/" data-id="' + row.id + '" href="/admin/subjects/delete/" class="btn-del btn btn-danger">Delete</a>';
                },

                orderable: false,
                searchable: false
            },
        ]
    });

    $('#students_data').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: $('body').attr('data-url') + '/admin/students/show',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'firstname', name: 'firstname' },
            { data: 'lastname', name: 'lastname' },
            { data: "email", name: 'email' },
            { data: 'address', name: 'address' },
            { data: 'dateofbirth', name: 'dateofbirth' },
            { data: 'passingyear', name: 'passingyear' },
            { data: 'semester', name: 'semester' },
            { data: 'subjects', name: 'subjects' },
            { data: 'age', name: 'age' },
            { data: 'action', name: 'action' },
        ]
    });



    // semester change
    $(document).on('change', '.sem-check', function(e) {
        var id = $(this).attr('data-id');
        if (this.checked) {
            var val = 'yes';
        } else {
            var val = 'no';
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/change_semester_status',
            data: {
                val: val,
                id: id,
            },
            success: function(response) {
                console.log(response);
                Swal.fire(response.success);
            },
            error: function(errors) {

            }
        });

    });





    // subject change

    $(document).on('change', '.sub-check', function(e) {
        var id = $(this).attr('data-id');
        if (this.checked) {
            var val = 'yes';
        } else {
            var val = 'no';
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/change_subject_status',
            data: {
                val: val,
                id: id,
            },
            success: function(response) {
                console.log(response);
                Swal.fire(response.success);
            },
            error: function(errors) {

            }
        });

    });









});

// one file !
// one file !
// one file !