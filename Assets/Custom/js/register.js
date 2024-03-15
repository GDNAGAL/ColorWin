$(document).ready(function(){
    
    $("#registerForm").on("submit",function(e){
        e.preventDefault()
        $("#modal").modal('show')
        $.ajax({
            type: "POST",
            data: data,
            url: ApiURL + '/Product/addProduct',
            headers: {
                'Authorization': 'Bearer ' + getCookie('Token')
            },
            contentType: false,       
            cache: false,             
            processData:false,
            success: function(responseData){
                $('#addProductForm')[0].reset();
                $("#AddProductModal").modal('hide')
                loadingButton("#ProductSaveButton", "Save Changes")
                Swal.fire({
                    title: "Success",
                    text: responseData.Message,
                    icon: "success",
                });
                getProductList()
            },
            error : function(err){
                loadingButton("#ProductSaveButton", "Save Changes")
                Swal.fire({
                    title: "Failed",
                    text: err.responseJSON.Message,
                    icon: "error",
                });
            }
        });
    })
})