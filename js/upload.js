/*
***************** IMPRESSUM *******************
Studiengang:	MultiMediaTechnology
fhs-nummer:		fhs34789
Zweck:			Basisquaifikation 1 (QPT1)
Autor:			Ludwig Schamböck
*/
$(function(){

    var ul = $('#upload ul');

    $('#drop a').click(function(){
       // öffnet orderverzeichnis wenn click
        $(this).parent().find('input').click();
    });

    
    $('#upload').fileupload({

        // Element bekommt hochzuladene Dateien
        dropZone: $('#drop'),

       // Dateien kommen in die Upload-Schlange
        add: function (e, data) {

            var ladebalken = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#66CC66" data-angleOffset=-125 data-linecap=round data-displayPrevious=true data-readOnly="1"/><p></p><span></span></li>');

            // fügt Namen und Größe hinzu
            ladebalken.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

            // Datei zu <ul> 
            data.context = ladebalken.appendTo(ul);

            // knob plugin
            ladebalken.find('input').knob();

            // cancel
            ladebalken.find('span').click(function(){

                if(ladebalken.hasClass('working')){
                    jqXHR.abort();
                }

                ladebalken.fadeOut(function(){
                    ladebalken.remove();
                });

            });

            
            var jqXHR = data.submit();
        },

        progress: function(e, data){

            // zeigt die Prozent des uploads
            var progress = parseInt(data.loaded / data.total * 100, 10);

            
            data.context.find('input').val(progress).change();

            if(progress == 100){
                data.context.removeClass('working');
            }
        },

        fail:function(e, data){
            // wenn fehler
            data.context.addClass('error');
        }

    });


    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // rechnet Größe um
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

       
        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }

});