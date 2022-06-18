document.addEventListener( 'DOMContentLoaded', function() {
    var location = this.location.pathname
    if(location == '/'){
        var splide1 = new Splide( '.splide',{
            perPage : 3,
            type : 'slide',
            rewind : false,
            gap : '1vw',
            pagination : false
        } );

        var splide2 = new Splide( '.splide2',{
            perPage : 3,
            type : 'slide',
            rewind : false,
            gap : '1vw',
            pagination : false
        } );

        splide1.mount();
        splide2.mount();
    }

    if(location == '/pretraga' || location == '/' || location == '/pretraga/prikaz'){
        let proizvodjac = document.getElementById('proizvodjac')
        let modeli = document.getElementById('model')
        proizvodjac.onchange = () =>{
            let id = proizvodjac.value;
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')
                }
            });
            $.ajax({
                type : "GET",
                url : window.location.origin + (location == '/' || location == '/pretraga/prikaz' || location =='/pretraga' ? '/pretraga' : "" || location == '/auto-oglasi/dodaj' ? '/pretraga' : "") + "/model/" + id,
                data : { id : id},
                dataType : "json",
                success : (data) => {
                    console.log(data)
                    modeli.innerHTML = "";
                             modeli.innerHTML = "<option value='0'>Izaberi model</option>"
                             modeli.disabled = false;
                             for(let model of data){
                                 modeli.innerHTML += `<option value="${model.id}">${model.naziv}</option>`
                             }
                },
                error : (err) => {
                    console.log(err.responseText)
                }
            })
            // $.ajax({
            //     type: "GET",
            //     url: window.location.href + "/modeli",
            //      data : { id: id},
            //     dataType: "json",
            //     success: function(podaci){
            //         modeli.innerHTML = "";
            //         modeli.innerHTML = "<option value='0'>Izaberi model</option>"
            //         modeli.disabled = false;
            //         for(let model of podaci){
            //             modeli.innerHTML = `<option value="${model.id}">${model.naziv}</option>`
            //         }
            //     }
            //
            // })
        }

    }
    if(location.lastIndexOf('/auto-oglasi/prikaz/') != -1){
       var main =  new Splide( '#image-carousel', {
            arrows: false,
        } ).mount();
       var thumbnails =  new Splide( '#thumbnail-carousel', {
            fixedWidth: 100,
            arrows: false,
            pagination: false,
            focus      : 'start',
            isNavigation: true,
            breakpoints: {
                600: {
                    fixedWidth : 60,
                    fixedHeight: 44,
                },
            },
        } ).mount();

        main.sync( thumbnails );
        main.mount();
        thumbnails.mount();
    }
    if(location == '/auto-oglasi/dodaj' || location.indexOf('/auto-oglasi/izmena/') != -1 ){
        console.log('ajax')
        let proizvodjac = document.getElementById('proizvodjac')
        let modeli = document.getElementById('model')
        proizvodjac.onchange = () => {
            let id = proizvodjac.value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: window.location.origin + "/auto-oglasi/model/" + id,
                data: {id: id},
                dataType: "json",
                success: (data) => {
                    console.log(data)
                    modeli.innerHTML = "";
                    modeli.innerHTML = "<option value='0'>Izaberi model</option>"
                    modeli.disabled = false;
                    for (let model of data) {
                        modeli.innerHTML += `<option value="${model.id}">${model.naziv}</option>`
                    }
                },
                error: (err) => {
                    console.log(err.responseText)
                }
            })
        }
        let add = document.getElementById('add');

        let clone = `<div class="input-group control-group" >
                        <input type="file" name="slika[]" class="form-control">
                        <div class="input-group-btn">
                            <button class="btn btn-success remove" type="button">Remove</button>
                        </div>
                    </div>`

        add.addEventListener('click', function () {
            let div = document.getElementById('increment')
            $(add).after($(clone));
        })

        $("body").on("click", ".remove", function () {
            $(this).parents('.control-group').remove();
        });

    }
} );
