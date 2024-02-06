<!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
@vite(['resources/js/app.js'])

<script src="https://kit.fontawesome.com/fa7aad7aa2.js" crossorigin="anonymous"></script>


<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js">
</script>


<!-- All Jquery -->
<script src="{{asset('asstes/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

{{-- front end js --}}

<script>
    // to make input field outline visible
    document.addEventListener('livewire:init', function() {
        Livewire.hook('morph.updated', ({ el, component }) => {
                document.querySelectorAll('.form-outline').forEach(outline => {
                    new mdb.Input(outline).init();
                });
        })
    })




    document.addEventListener('livewire:init', () => {
    Livewire.on('getFrontCardData', function(data){
        var c = document.getElementById("myCanvas");
        var ctx = c.getContext("2d");

        ctx.clearRect(0, 0, c.width, c.height);

        data[0].forEach(item => {
            console.log(item)
            let nam = item.field_value;
            let font = `${item.font_type} ${item.font_size}px ${item.font_family}`;
            
            ctx.font = font;
            ctx.fillText(nam, item.x_pos, item.y_pos);
        });
    }); 
});

</script>