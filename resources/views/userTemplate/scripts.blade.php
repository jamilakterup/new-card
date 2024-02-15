<!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
@vite(['resources/js/app.js'])

<script src="https://kit.fontawesome.com/fa7aad7aa2.js" crossorigin="anonymous"></script>


<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js">
</script>


<!-- All Jquery -->
<script src="{{asset('assets/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
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
    var imagePath = '';
    var c = document.getElementById("myCanvas");
    var ctx = c.getContext("2d");
    var imgEl = document.createElement("img");
    var fields = null;

    
    Livewire.on('getCardData', function(data){
        if(data[0]){
            fields = data[0];

            ctx.clearRect(0, 0, c.width, c.height);

            ctx.drawImage(imgEl,0,0,204.095,323.53);

            fillAllFields(fields, ctx);
            
        }
    }); 

    Livewire.on('loadCanvasImage', function(data){
        imagePath = data[0];
        
        imgEl.src = '/storage/'+imagePath
        ctx.drawImage(imgEl,0,0,204.095,323.53);

        fillAllFields(fields, ctx);
    }); 
});

function fillAllFields(fields, ctx){

    fields.forEach(item => {
        let nam = item.field_value;
        let font = `${item.font_type} ${item.font_size}px ${item.font_family}`;
        ctx.font = font;
        ctx.fillText(nam, item.x_pos, item.y_pos);
    });
}

</script>