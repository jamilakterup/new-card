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
    function getFormData(form){
        event.preventDefault();
        let data = $(form).serialize();
        let formData = new URLSearchParams(data);
        let fieldName = '';
        let fieldType = '';
        let fieldValue = '';
        let fontSize = '';
        let fontType = '';
        let fontFamily = '';

        for(const [key, value] of formData.entries()){
             if (key === 'field-name' && value !== '') {
                fieldName = value;
            } else if (key === 'type' && value !== '') {
                fieldType = value;
            } else if (key === 'field-value' && value !== '') {
                fieldValue = value;
            } else if (key === 'font-size' && value !== '') {
                fontSize = value;
            } else if (key === 'font-type' && value !== '') {
                fontType = value;
            } else if (key === 'font-family' && value !== '') {
                fontFamily = value;
            }
        }
        

        $('#field-table').append(`
            <div class='row my-2'>
                <div class="col-4 text-start d">${fieldName}</div>
                <div class="col-3">
                    <input type="number" id="xPosition" name="xPos" value="0" class="form-control"
                        placeholder="X-Axiss">
                </div>
                <div class="col-3">
                    <input type="number" id="yPosition" name="yPos" value="0" class="form-control"
                        placeholder="Y-Axiss">
                </div>
                <div class="col-2 my-auto">
                    <i class="fa-solid fa-trash-can"></i>
                </div>        
            </div>
        `);

        form.reset();

       

        let nam=fieldValue;
        let xPos=130;
        let yPos=180;
        let font= `${fontType} ${fontSize}px ${fontFamily}`;
        var c = document.getElementById("myCanvas");
        var ctx = c.getContext("2d");
        ctx.font = font;
        ctx.fillText(nam,xPos,yPos);
    } 



    document.addEventListener('livewire:init', function() {

        Livewire.hook('morph.updated', ({ el, component }) => {

            Livewire.hook('morph.updated', ({ el, component }) => {

                document.querySelectorAll('.form-outline').forEach(outline => {
                    new mdb.Input(outline).init()
                });
            })
        })
    })

</script>