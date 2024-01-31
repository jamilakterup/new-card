<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{asset('asstes/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('assets/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/app-style-switcher.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('assets/js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{asset('assets/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('assets/js/custom.js')}}"></script>

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js">
</script>
<!-- swal -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- AJAX ADD -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>




<!-- Custom JS -->



<!-- Image preview -->
<script>
    //todo:Front image preview
        $(document).on('change','#front_image', function() {
            if (this.files && this.files[0]) {
                let img = document.querySelector('.front_image_preview');
                img.onload = () =>{
                    URL.revokeObjectURL(img.src);
                }
                img.src = URL.createObjectURL(this.files[0]);
                document.querySelector(".front_image_preview").files = this.files;
                document.querySelector(".front_image_preview").classList.remove('d-none');
            }
        });

            //todo:Back image preview
            $(document).on('change','#back_image', function() {
            if (this.files && this.files[0]) {
                let img = document.querySelector('.back_image_preview');
                img.onload = () =>{
                    URL.revokeObjectURL(img.src);
                }
                img.src = URL.createObjectURL(this.files[0]);
                document.querySelector(".back_image_preview").files = this.files;
                document.querySelector(".back_image_preview").classList.remove('d-none');
            }
        });
</script>




<!-- Delete with swal -->
<script>
    function deleteRow(formId){
    $form=$(`#${formId}`);

    Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
    })
    .then((result) => {
    if (result.isConfirmed) {
        Swal.fire({
        title: "Deleted!",
        text: "Your file has been deleted.",
        icon: "success"
        });

        $form.submit();
    }
    });
}
    
</script>