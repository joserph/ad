$(document).ready(function () {
    // let municipios = [], parroquias = [];
    // $('#municipio').prop('disabled', true).trigger('change');
    // $('#parroquia').prop('disabled', true).trigger('change');

    // $.ajax({
    //     url: urlFetchScopeData,
    //     type: "GET",
    //     dataType: "json",
    //     success: function(data) {
    //         console.log(data);
    //         municipios = data.municipios;
    //         parroquias = data.parroquias;
    //         $('#municipio').prop('disabled', false).trigger('change');
    //         $('#parroquia').prop('disabled', false).trigger('change');
    //     },
    //     error: function(jqXHR, textStatus, errorThrown) {
    //         console.error("Error en la solicitud: " + textStatus, errorThrown);
    //     }
    // });

    const selectSeccional = $('#seccional');
    const selectMunicipio = $('#municipio');
    const selectParroquia = $('#parroquia');
    console.log(responseData);
    /*const selectBuro = $('#buro');
    const opcionesBuro = JSON.parse(window.opcionesBuro);
    const opcionesBuroSecFemenina = JSON.parse(window.opcionesBuroSecFemenina);
    const opcionesBuroSecCultura = JSON.parse(window.opcionesBuroSecCultura);
    const opcionesBuroSecAgraria = JSON.parse(window.opcionesBuroSecAgraria);
    const opcionesBuroSecAsusntosMunicipales = JSON.parse(window.opcionesBuroSecAsusntosMunicipales);
    const opcionesBuroSecEducacion = JSON.parse(window.opcionesBuroSecEducacion);
    const opcionesBuroSecJuvenil = JSON.parse(window.opcionesBuroSecJuvenil);
    const opcionesBuroSecSindical = JSON.parse(window.opcionesBuroSecSindical);
    const opcionesBuroSecProfesionalesYTecnicos = JSON.parse(window.opcionesBuroSecProfesionalesYTecnicos);*/

    //console.log($('#cargo').val());

    if($('#cargo').val() !== ''){
        let cargo = $('#cargo').val();
        //console.log($('#cargo').val() + 'lalalalala');
        if(cargo == 0){
            console.log('agraria - ' + $('#buro_sec_agraria').val());
            $('#buro_sec_agraria').parent().removeClass('d-none');
            $('#buro_sec_agraria').prop('disabled', false).trigger('change');
        }else if(cargo == 1){
            $('#buro_sec_asuntos_municipales').parent().removeClass('d-none');
            $('#buro_sec_asuntos_municipales').prop('disabled', false).trigger('change');
        }else if(cargo == 2){
            $('#buro_sec_cultura').parent().removeClass('d-none');
            $('#buro_sec_cultura').prop('disabled', false).trigger('change');
        }else if(cargo == 3){
            $('#buro_sec_educacion').parent().removeClass('d-none');
            $('#buro_sec_educacion').prop('disabled', false).trigger('change');
        }else if(cargo == 4){
            $('#buro_sec_femenina').parent().removeClass('d-none');
            $('#buro_sec_femenina').prop('disabled', false).trigger('change');
        }else if(cargo == 5){
            $('#buro_sec_juvenil').parent().removeClass('d-none');
            $('#buro_sec_juvenil').prop('disabled', false).trigger('change');
        }else if(cargo == 6){
            $('#buro_sec_sindical').parent().removeClass('d-none');
            $('#buro_sec_sindical').prop('disabled', false).trigger('change');
        }else if(cargo == 7){
            $('#buro_sec_profesionales_y_tecnico').parent().removeClass('d-none');
            $('#buro_sec_profesionales_y_tecnico').prop('disabled', false).trigger('change');
        }
    }

    $('#alcance').on('change', function (e) {
        setAlcanceFields($(this).val());
    });

    const setAlcanceFields = (val) => {
        $('#seccional').prop('disabled', false).trigger('change');
        $('#municipio').prop('disabled', false).trigger('change');
        $('#parroquia').prop('disabled', false).trigger('change');
        console.log(val);
        if (val == "nacional") {

            $('#seccional').parent().addClass('d-none');
            $('#municipio').parent().addClass('d-none');
            $('#parroquia').parent().addClass('d-none');
            $('#seccional').prop('disabled', true).trigger('change');
            $('#municipio').prop('disabled', true).trigger('change');
            $('#parroquia').prop('disabled', true).trigger('change');

        } else if (val == "seccional") {
            console.log('____FFFF----');
            $('#seccional').parent().removeClass('d-none');
            $('#municipio').parent().addClass('d-none');
            $('#parroquia').parent().addClass('d-none');
            $('#municipio').prop('disabled', true).trigger('change');
            $('#parroquia').prop('disabled', true).trigger('change');

        } else if (val == "municipal") {

            $('#seccional').parent().removeClass('d-none');
            $('#municipio').parent().removeClass('d-none');
            $('#parroquia').parent().addClass('d-none');
            $('#parroquia').prop('disabled', true).trigger('change');

        } else if (val == "parroquial") {

            $('#seccional').parent().removeClass('d-none');
            $('#municipio').parent().removeClass('d-none');
            $('#parroquia').parent().removeClass('d-none');

        }
    }

    $('.cargoPublicoCheck').on('change', function() {
        if ($(this).val() == "si") {
            $('#cargo_pub').removeClass('d-none');
        } else {
            $('#cargo_pub').addClass('d-none');
            //$('#cargo_pub input').val('');
        }
    });

    const getUniqueOptions = (data, key) => {
        return [...new Map(data.map(item => [item[key], item])).values()];
    }

    const uniqueEstados = getUniqueOptions(geograficos, 'estado');
    uniqueEstados.forEach(geo => {
        let estadoSinEdo = geo.estado.replace('EDO. ', '');
        let option = new Option(estadoSinEdo, geo.estado);
        selectSeccional.append(option);
    });

    $('#seccional').on('change', function() {
        //console.log('____FFFF----');
        const estado = $(this).val();
        //console.log(estado, "estado")
        const filteredMunicipios = geograficos.filter(geo => geo.estado == estado);
        //console.log(filteredMunicipios, "filteredMunicipios")
        const uniqueMunicipios = getUniqueOptions(filteredMunicipios, 'municipio');
        //console.log(uniqueMunicipios)
        selectMunicipio.empty().append('<option value="">Seleccionar</option>');
        if(responseData){
            uniqueMunicipios.forEach(geo => {
                let option = new Option(geo.municipio, geo.municipio);
                if(geo.municipio == responseData.municipio){
                    option.setAttribute('selected', true);
                }
                selectMunicipio.append(option);
            });
        }else{
            uniqueMunicipios.forEach(geo => {
                let option = new Option(geo.municipio, geo.municipio);
                selectMunicipio.append(option);
            });
        }
        
        selectParroquia.empty().append('<option value="">Seleccionar</option>');
        selectMunicipio.trigger('change');
    });

    $('#municipio').on('change', function() {
        const municipio = $(this).val();
        const filteredParroquias = geograficos.filter(geo => geo.municipio == municipio);
        const uniqueParroquias = getUniqueOptions(filteredParroquias, 'parroquia');

        selectParroquia.empty().append('<option value="">Seleccionar</option>');
        if(responseData){
            uniqueParroquias.forEach(geo => {
                // console.log(geo.parroquia)
                let option = new Option(geo.parroquia, geo.parroquia);
                if(geo.parroquia == responseData.parroquia){
                    option.setAttribute('selected', true);
                }
                //console.log(option, " -item")
                selectParroquia.append(option);
            });
        }else{
            uniqueParroquias.forEach(geo => {
                let option = new Option(geo.parroquia, geo.parroquia);
                selectParroquia.append(option);
            });
        }
        
    });

    selectSeccional.trigger('change');
    selectMunicipio.trigger('change');

    // $('#seccional').on('change', function() {
    //     const seccionalId = $(this).val();
    //     const municipiosFilter = municipios.filter(municipio => municipio.seccional_id == seccionalId);

    //     selectMunicipio.empty();
    //     selectMunicipio.prepend('<option value="" selected>Seleccionar</option>');

    //     municipiosFilter.forEach(municipio => {
    //         let option = new Option(municipio.nombre, municipio.id, false, false);
    //         selectMunicipio.append(option);
    //     });
    //     selectMunicipio.trigger('change');
    // });

    // $('#municipio').on('change', function() {
    //     const municipioId = $(this).val();
    //     const parroquiasFilter = parroquias.filter(parroquia => parroquia.municipio_id == municipioId);

    //     selectParroquia.empty();
    //     selectParroquia.prepend('<option value="" selected>Seleccionar</option>');

    //     parroquiasFilter.forEach(parroquia => {
    //         let option = new Option(parroquia.nombre, parroquia.id, false, false);
    //         selectParroquia.append(option);
    //     });
    //     selectParroquia.trigger('change');
    // });

    $('#tipo_cargo').on('change', function (e) {
        
        if ($(this).val() == 5) {
            console.log($(this).val() + ' ----')
            $('#cargo').parent().removeClass('d-none');
            $('#cargo').prop('disabled', false).trigger('change');
            $('#buro').parent().removeClass('d-none');
            $('#buro').prop('disabled', false).trigger('change');
        }
        //  else {
        //     console.log('--diferente a 5--')
        //     $('#cargo').parent().addClass('d-none');
        //     $('#cargo').prop('disabled', true).trigger('change');
        //     $('#buro').parent().addClass('d-none');
        //     $('#buro').prop('disabled', true).trigger('change');

        // }
    });

    $('#cargo').on('change', function (e){
        console.log($(this).val());
        if($(this).val() == 0){
            $('#buro_sec_agraria').parent().removeClass('d-none');
            $('#buro_sec_agraria').prop('disabled', false).trigger('change');
            $('#buro_sec_asuntos_municipales').parent().addClass('d-none');
            $('#buro_sec_asuntos_municipales').prop('disabled', true).trigger('change');
            $('#buro_sec_cultura').parent().addClass('d-none');
            $('#buro_sec_cultura').prop('disabled', true).trigger('change');
            $('#buro_sec_educacion').parent().addClass('d-none');
            $('#buro_sec_educacion').prop('disabled', true).trigger('change');
            $('#buro_sec_femenina').parent().addClass('d-none');
            $('#buro_sec_femenina').prop('disabled', true).trigger('change');
            $('#buro_sec_juvenil').parent().addClass('d-none');
            $('#buro_sec_juvenil').prop('disabled', true).trigger('change');
            $('#buro_sec_sindical').parent().addClass('d-none');
            $('#buro_sec_sindical').prop('disabled', true).trigger('change');
            $('#buro_sec_profesionales_y_tecnico').parent().addClass('d-none');
            $('#buro_sec_profesionales_y_tecnico').prop('disabled', true).trigger('change');
        }else if($(this).val() == 1){
            $('#buro_sec_asuntos_municipales').parent().removeClass('d-none');
            $('#buro_sec_asuntos_municipales').prop('disabled', false).trigger('change');
            $('#buro_sec_agraria').parent().addClass('d-none');
            $('#buro_sec_agraria').prop('disabled', true).trigger('change');
            $('#buro_sec_cultura').parent().addClass('d-none');
            $('#buro_sec_cultura').prop('disabled', true).trigger('change');
            $('#buro_sec_educacion').parent().addClass('d-none');
            $('#buro_sec_educacion').prop('disabled', true).trigger('change');
            $('#buro_sec_femenina').parent().addClass('d-none');
            $('#buro_sec_femenina').prop('disabled', true).trigger('change');
            $('#buro_sec_juvenil').parent().addClass('d-none');
            $('#buro_sec_juvenil').prop('disabled', true).trigger('change');
            $('#buro_sec_sindical').parent().addClass('d-none');
            $('#buro_sec_sindical').prop('disabled', true).trigger('change');
            $('#buro_sec_profesionales_y_tecnico').parent().addClass('d-none');
            $('#buro_sec_profesionales_y_tecnico').prop('disabled', true).trigger('change');
        }else if($(this).val() == 2){
            $('#buro_sec_cultura').parent().removeClass('d-none');
            $('#buro_sec_cultura').prop('disabled', false).trigger('change');
            $('#buro_sec_agraria').parent().addClass('d-none');
            $('#buro_sec_agraria').prop('disabled', true).trigger('change');
            $('#buro_sec_asuntos_municipales').parent().addClass('d-none');
            $('#buro_sec_asuntos_municipales').prop('disabled', true).trigger('change');
            $('#buro_sec_educacion').parent().addClass('d-none');
            $('#buro_sec_educacion').prop('disabled', true).trigger('change');
            $('#buro_sec_femenina').parent().addClass('d-none');
            $('#buro_sec_femenina').prop('disabled', true).trigger('change');
            $('#buro_sec_juvenil').parent().addClass('d-none');
            $('#buro_sec_juvenil').prop('disabled', true).trigger('change');
            $('#buro_sec_sindical').parent().addClass('d-none');
            $('#buro_sec_sindical').prop('disabled', true).trigger('change');
            $('#buro_sec_profesionales_y_tecnico').parent().addClass('d-none');
            $('#buro_sec_profesionales_y_tecnico').prop('disabled', true).trigger('change');
        }else if($(this).val() == 3){
            $('#buro_sec_educacion').parent().removeClass('d-none');
            $('#buro_sec_educacion').prop('disabled', false).trigger('change');
            $('#buro_sec_agraria').parent().addClass('d-none');
            $('#buro_sec_agraria').prop('disabled', true).trigger('change');
            $('#buro_sec_asuntos_municipales').parent().addClass('d-none');
            $('#buro_sec_asuntos_municipales').prop('disabled', true).trigger('change');
            $('#buro_sec_cultura').parent().addClass('d-none');
            $('#buro_sec_cultura').prop('disabled', true).trigger('change');
            $('#buro_sec_femenina').parent().addClass('d-none');
            $('#buro_sec_femenina').prop('disabled', true).trigger('change');
            $('#buro_sec_juvenil').parent().addClass('d-none');
            $('#buro_sec_juvenil').prop('disabled', true).trigger('change');
            $('#buro_sec_sindical').parent().addClass('d-none');
            $('#buro_sec_sindical').prop('disabled', true).trigger('change');
            $('#buro_sec_profesionales_y_tecnico').parent().addClass('d-none');
            $('#buro_sec_profesionales_y_tecnico').prop('disabled', true).trigger('change');
        }else if($(this).val() == 4){
            $('#buro_sec_femenina').parent().removeClass('d-none');
            $('#buro_sec_femenina').prop('disabled', false).trigger('change');
            $('#buro_sec_agraria').parent().addClass('d-none');
            $('#buro_sec_agraria').prop('disabled', true).trigger('change');
            $('#buro_sec_asuntos_municipales').parent().addClass('d-none');
            $('#buro_sec_asuntos_municipales').prop('disabled', true).trigger('change');
            $('#buro_sec_cultura').parent().addClass('d-none');
            $('#buro_sec_cultura').prop('disabled', true).trigger('change');
            $('#buro_sec_educacion').parent().addClass('d-none');
            $('#buro_sec_educacion').prop('disabled', true).trigger('change');
            $('#buro_sec_juvenil').parent().addClass('d-none');
            $('#buro_sec_juvenil').prop('disabled', true).trigger('change');
            $('#buro_sec_sindical').parent().addClass('d-none');
            $('#buro_sec_sindical').prop('disabled', true).trigger('change');
            $('#buro_sec_profesionales_y_tecnico').parent().addClass('d-none');
            $('#buro_sec_profesionales_y_tecnico').prop('disabled', true).trigger('change');
        }else if($(this).val() == 5){
            $('#buro_sec_juvenil').parent().removeClass('d-none');
            $('#buro_sec_juvenil').prop('disabled', false).trigger('change');
            $('#buro_sec_agraria').parent().addClass('d-none');
            $('#buro_sec_agraria').prop('disabled', true).trigger('change');
            $('#buro_sec_asuntos_municipales').parent().addClass('d-none');
            $('#buro_sec_asuntos_municipales').prop('disabled', true).trigger('change');
            $('#buro_sec_cultura').parent().addClass('d-none');
            $('#buro_sec_cultura').prop('disabled', true).trigger('change');
            $('#buro_sec_educacion').parent().addClass('d-none');
            $('#buro_sec_educacion').prop('disabled', true).trigger('change');
            $('#buro_sec_femenina').parent().addClass('d-none');
            $('#buro_sec_femenina').prop('disabled', true).trigger('change');
            $('#buro_sec_sindical').parent().addClass('d-none');
            $('#buro_sec_sindical').prop('disabled', true).trigger('change');
            $('#buro_sec_profesionales_y_tecnico').parent().addClass('d-none');
            $('#buro_sec_profesionales_y_tecnico').prop('disabled', true).trigger('change');
        }else if($(this).val() == 6){
            $('#buro_sec_sindical').parent().removeClass('d-none');
            $('#buro_sec_sindical').prop('disabled', false).trigger('change');
            $('#buro_sec_agraria').parent().addClass('d-none');
            $('#buro_sec_agraria').prop('disabled', true).trigger('change');
            $('#buro_sec_asuntos_municipales').parent().addClass('d-none');
            $('#buro_sec_asuntos_municipales').prop('disabled', true).trigger('change');
            $('#buro_sec_cultura').parent().addClass('d-none');
            $('#buro_sec_cultura').prop('disabled', true).trigger('change');
            $('#buro_sec_educacion').parent().addClass('d-none');
            $('#buro_sec_educacion').prop('disabled', true).trigger('change');
            $('#buro_sec_femenina').parent().addClass('d-none');
            $('#buro_sec_femenina').prop('disabled', true).trigger('change');
            $('#buro_sec_juvenil').parent().addClass('d-none');
            $('#buro_sec_juvenil').prop('disabled', true).trigger('change');
            $('#buro_sec_profesionales_y_tecnico').parent().addClass('d-none');
            $('#buro_sec_profesionales_y_tecnico').prop('disabled', true).trigger('change');
        }else if($(this).val() == 7){
            $('#buro_sec_profesionales_y_tecnico').parent().removeClass('d-none');
            $('#buro_sec_profesionales_y_tecnico').prop('disabled', false).trigger('change');
            $('#buro_sec_agraria').parent().addClass('d-none');
            $('#buro_sec_agraria').prop('disabled', true).trigger('change');
            $('#buro_sec_asuntos_municipales').parent().addClass('d-none');
            $('#buro_sec_asuntos_municipales').prop('disabled', true).trigger('change');
            $('#buro_sec_cultura').parent().addClass('d-none');
            $('#buro_sec_cultura').prop('disabled', true).trigger('change');
            $('#buro_sec_educacion').parent().addClass('d-none');
            $('#buro_sec_educacion').prop('disabled', true).trigger('change');
            $('#buro_sec_femenina').parent().addClass('d-none');
            $('#buro_sec_femenina').prop('disabled', true).trigger('change');
            $('#buro_sec_juvenil').parent().addClass('d-none');
            $('#buro_sec_juvenil').prop('disabled', true).trigger('change');
            $('#buro_sec_sindical').parent().addClass('d-none');
            $('#buro_sec_sindical').prop('disabled', true).trigger('change');
        }
    });

    

    /*$('#cargo').on('change', function (e) {
        console.log('___cargo____');
        selectBuro.empty();
        selectBuro.prepend('<option value="" selected>Seleccionar</option>');
        console.log($(this).val())
        
        if ($(this).val() == 0) { // ? SECRETARIA AGRARIA

            opcionesBuroSecAgraria.forEach(function(op, indice) {
                let option = new Option(op.value, op.key, false, false);
                selectBuro.append(option);
            });

            opcionesBuro.forEach(function(op, indice) {
                let option = new Option(op.value, op.key, false, false);
                selectBuro.append(option);
            });

            selectBuro.trigger('change');

        } else if ($(this).val() == 1) { // ? SECRETARIA ASUNTOS MUNICIPALES

            opcionesBuroSecAsusntosMunicipales.forEach(function(op, indice) {
                let option = new Option(op.value, op.key, false, false);
                selectBuro.append(option);
            });

            opcionesBuro.forEach(function(op, indice) {
                let option = new Option(op.value, op.key, false, false);
                selectBuro.append(option);
            });

            selectBuro.trigger('change');

        } else if ($(this).val() == 2) { // ? SECRETARIO CULTURA

            opcionesBuroSecCultura.forEach(function(op, indice) {
                let option = new Option(op.value, op.key, false, false);
                
                selectBuro.append(option);
                //console.log(selectBuro);
            });

            opcionesBuro.forEach(function(op, indice) {
                let option = new Option(op.value, op.key, false, false);
                selectBuro.append(option);
                //console.log(option);
            });

            selectBuro.trigger('change');

        } else if ($(this).val() == 3) { // ? SECRETARIO DE EDUCAION

            opcionesBuroSecEducacion.forEach(function(op, indice) {
                let option = new Option(op.value, op.key, false, false);
                
                selectBuro.append(option);
                //console.log(selectBuro);
            });

            opcionesBuro.forEach(function(op, indice) {
                let option = new Option(op.value, op.key, false, false);
                selectBuro.append(option);
                //console.log(option);
            });

            selectBuro.trigger('change');

        } else if ($(this).val() == 4) { // ? SECRETARIA FEMENINA

            opcionesBuroSecFemenina.forEach(function(op, indice) {
                let option = new Option(op.value, op.key, false, false);
                selectBuro.append(option);
            });

            opcionesBuro.forEach(function(op, indice) {
                let option = new Option(op.value, op.key, false, false);
                selectBuro.append(option);
            });

            selectBuro.trigger('change');
        } else if ($(this).val() == 5) { // ? SECRETARIA JUVENIL

            opcionesBuroSecJuvenil.forEach(function(op, indice) {
                let option = new Option(op.value, op.key, false, false);
                selectBuro.append(option);
            });

            opcionesBuro.forEach(function(op, indice) {
                let option = new Option(op.value, op.key, false, false);
                selectBuro.append(option);
            });

            selectBuro.trigger('change');
        } else if ($(this).val() == 6) { // ? SECRETARIA SINDICAL

            opcionesBuroSecSindical.forEach(function(op, indice) {
                let option = new Option(op.value, op.key, false, false);
                selectBuro.append(option);
            });

            opcionesBuro.forEach(function(op, indice) {
                let option = new Option(op.value, op.key, false, false);
                selectBuro.append(option);
            });

            selectBuro.trigger('change');
        } else if ($(this).val() == 7) { // ? SECRETARIA PROFESIONALES Y TECNICOS

            opcionesBuroSecProfesionalesYTecnicos.forEach(function(op, indice) {
                let option = new Option(op.value, op.key, false, false);
                selectBuro.append(option);
            });

            opcionesBuro.forEach(function(op, indice) {
                let option = new Option(op.value, op.key, false, false);
                selectBuro.append(option);
            });

            selectBuro.trigger('change');
        } 
    });*/

    $('#cedula').keyup(function (e) {
        let cedula = $(this).val();
        
        cedula = cedula.replace(/\./g, '');
        
        let cedulaFormateada = cedula.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        
        $(this).val(cedulaFormateada);
        //console.log($(this).val(cedulaFormateada));
    });

    $('#cedula').change(function (e) {
        let ci = $(this).val().replace(/\./g, '');
        //console.log(ci);
        if (ci.trim() !== '' && ci.trim().length > 6) {
            $.blockUI({
                message: $('#loading-message'),
                css: {
                    display: 'block',
                    width: '200px',
                    top: '50%',
                    left: '50%',
                    transform: 'translate(-50%, -50%)',
                    border: 'none',
                    padding: '0',
                    backgroundColor: 'white',
                    borderRadius: '10px'
                },
                overlayCSS: {
                    backgroundColor: 'rgba(0, 0, 0, 0.5)'
                }
            });

            $('#nombre').attr('readonly', false);
            $('#apellido').attr('readonly', false);

            $.ajax({
                url: urlFetchCiData,
                type: "POST",
                dataType: "json",
                data: {
                    ci: ci
                },
                success: function(data) {
                    console.log(data);
                    if (!data.error) {
                        if (data.info.length > 0) {
                            let nombres = data.info[4] + ' ' + data.info[5],
                            apellidos = data.info[2] + ' ' + data.info[3],
                            fecha_nacimiento = data.info[7],
                            genero = data.info[6] == 'M' ? 'hombre' : 'mujer',
                            fecha_formateada = fecha_nacimiento.replace(/-/g, '/');

                            $('#nombre').val(nombres).attr('readonly', true);
                            $('#apellido').val(apellidos).attr('readonly', true);
                            $('#genero').val(genero).trigger('change');
                            $('#fecha_nacimiento').val(fecha_formateada);
                        }
                    } else {
                        toastr.error(data.error, "Ups!", {
                            progressBar: true,
                        });
                    }
                    $.unblockUI();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error en la solicitud: " + textStatus, errorThrown);
                    $.unblockUI();
                    toastr.error(textStatus, "Ups!", {
                        progressBar: true,
                    });
                }
            });
        }
    });

});
