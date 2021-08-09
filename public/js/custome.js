$(function() {
    // setTimeout() function will be fired after page is loaded
    // it will wait for 5 sec. and then will fire
    // $("#successMessage").hide() function
    setTimeout(function() {
        $(".alert").hide()
    }, 2500);
});

// $(document).ready(function() {
//     $('.js-example-basic-multiple').select2({
//         placeholder: 'Select Subjects',
//         width : '100%'
//     });
// });


$(document).ready(function() {

    // add data
    $(document).on('click', '#submit', function(e){
        e.preventDefault();
        let base_url = $('body').attr('data-url');
        let form_url = $('.allform').attr('form-url');
        let form_data = $('.allform').serialize(); 
        // alert(base_url);
        $(".alert").remove();
        adddata(base_url,form_url,form_data);

    });

// update data
    $(document).on('click', '#update', function(e){
        e.preventDefault();
        let base_url = $('body').attr('data-url');
        let form_url = $('.allform').attr('update-url');
        let form_data = $('.allform').serialize(); 
        // alert(base_url+form_url+form_data);
        $(".alert").remove();
        updatedata(base_url,form_url,form_data);

    });

    // delete data
    $(document).on('click', '.btn-del-user', function(e){
        e.preventDefault();
        let base_url = $('body').attr('data-url');
        let form_url = $(this).attr('delete-url');
        let data_id = $(this).attr('data-id');
        // return alert(base_url+form_url+data_id);
        deletedata(base_url,form_url,data_id);
    });
    // $('.btn-del-user').click(function(e){
    //     e.preventDefault();
    //     let base_url = $('body').attr('data-url');
    //     let form_url = $(this).attr('delete-url');
    //     let data_id = $(this).attr('data-id');
    //     return alert(base_url+form_url+data_id);
    //     deletedata(base_url,form_url);
    // });

    // add data function
    function adddata(base_url,form_url,form_data){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        Swal.fire({
            title: 'Please Wait !',
            html: 'data Saveing...',// add html attribute if you want or remove
            showConfirmButton: false,
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });    
        $.ajax({
            type: 'POST',
            url: base_url + form_url,
            data : form_data,
            dataType: 'json',
            success: function(response){
                swal.close();
                // alert(response.success)
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
                        $('#userform')[0].reset();
                    }else{
                        window.location = '/admin/users/list';
                    }
                  })
                // 
            },
            error : function(errors){
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
    function updatedata(base_url,form_url,form_data){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        Swal.fire({
            title: 'Please Wait !',
            html: 'data Saveing...',// add html attribute if you want or remove
            showConfirmButton: false,
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });    
        $.ajax({
            type: 'POST',
            url: base_url + form_url,
            data : form_data,
            dataType: 'json',
            success: function(response){
                swal.close();
                // alert(response.success)
                Swal.fire({
                    icon: 'success',
                    title: response.success,
                });
                window.location = '/admin/users/list';

                
            },
            error : function(errors){
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
    function deletedata(base_url,form_url,data_id){

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
                    success: function(response){
                       
                        // Swal.fire({
                        //     icon: 'success',
                        //     title: response.success,
                        //     showButton: false,  
                        // });
                        location.reload();
                        
                    }
                });

            }else{

                Swal.fire({
                    icon: 'success',
                    title: 'Data Not Deleted !',
                });

            }
          })

        

    }

});