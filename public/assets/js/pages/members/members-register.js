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

    console.log(geograficos, "geo")

    $('#alcance').on('change', function (e) {
        setAlcanceFields($(this).val());
    });

    const setAlcanceFields = (val) => {
        $('#seccional').prop('disabled', false).trigger('change');
        $('#municipio').prop('disabled', false).trigger('change');
        $('#parroquia').prop('disabled', false).trigger('change');

        if (val == "nacional") {

            $('#seccional').parent().addClass('d-none');
            $('#municipio').parent().addClass('d-none');
            $('#parroquia').parent().addClass('d-none');
            $('#seccional').prop('disabled', true).trigger('change');
            $('#municipio').prop('disabled', true).trigger('change');
            $('#parroquia').prop('disabled', true).trigger('change');

        } else if (val == "seccional") {

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
            $('#cargo_pub input').val('');
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
        const estado = $(this).val();
        // console.log(estado, "estado")
        const filteredMunicipios = geograficos.filter(geo => geo.estado == estado);
        // console.log(filteredMunicipios, "filteredMunicipios")
        const uniqueMunicipios = getUniqueOptions(filteredMunicipios, 'municipio');

        selectMunicipio.empty().append('<option value="">Seleccionar</option>');
        uniqueMunicipios.forEach(geo => {
            let option = new Option(geo.municipio, geo.municipio);
            console.log(geo, "item")
            selectMunicipio.append(option);
        });
        selectParroquia.empty().append('<option value="">Seleccionar</option>');
        selectMunicipio.trigger('change');
    });

    $('#municipio').on('change', function() {
        const municipio = $(this).val();
        const filteredParroquias = geograficos.filter(geo => geo.municipio == municipio);
        const uniqueParroquias = getUniqueOptions(filteredParroquias, 'parroquia');

        selectParroquia.empty().append('<option value="">Seleccionar</option>');
        uniqueParroquias.forEach(geo => {
            let option = new Option(geo.parroquia, geo.parroquia);
            selectParroquia.append(option);
        });
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
        console.log($(this).val())
        if ($(this).val() == 5) {

            $('#cargo').parent().removeClass('d-none');
            $('#cargo').prop('disabled', false).trigger('change');
            $('#buro').parent().removeClass('d-none');
            $('#buro').prop('disabled', false).trigger('change');

        } else {

            $('#cargo').parent().addClass('d-none');
            $('#cargo').prop('disabled', true).trigger('change');
            $('#buro').parent().addClass('d-none');
            $('#buro').prop('disabled', true).trigger('change');

        }
    });

    const selectBuro = $('#buro');
    const opcionesBuro = JSON.parse(window.opcionesBuro);
    const opcionesBuroSecFemenina = JSON.parse(window.opcionesBuroSecFemenina);
    const opcionesBuroSecCultura = JSON.parse(window.opcionesBuroSecCultura);

    $('#cargo').on('change', function (e) {
        selectBuro.empty();
        selectBuro.prepend('<option value="" selected>Seleccionar</option>');

        if ($(this).val() == 4) { // ? SECRETARIA FEMENINA

            opcionesBuroSecFemenina.forEach(function(op, indice) {
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
            });

            opcionesBuro.forEach(function(op, indice) {
                let option = new Option(op.value, op.key, false, false);
                selectBuro.append(option);
            });

            selectBuro.trigger('change');

        }
    });

    $('#cedula').keyup(function (e) {
        let cedula = $(this).val();

        cedula = cedula.replace(/\./g, '');

        let cedulaFormateada = cedula.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        $(this).val(cedulaFormateada);
    });

    $('#cedula').change(function (e) {
        let ci = $(this).val().replace(/\./g, '');

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
