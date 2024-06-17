$(document).ready(function () {
    const selectSeccional = $('#seccional');
    const selectMunicipio = $('#municipio');
    const selectParroquia = $('#parroquia');

    console.log(geograficos, "geo")

    $('.cargoPublicoCheck').on('change', function() {
        let idCol = $(this).attr('data-col');
        if ($(this).val() == "si") {
            $('#'+idCol).removeClass('d-none');
        } else {
            $('#'+idCol).addClass('d-none');
            $(`#${idCol} input`).val('');
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

    console.log(uniqueEstados, "uniqueEstados")


    $('#seccional').on('change', function() {
        const estado = $(this).val();
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

    $('.tipo_cargo').on('change', function (e) {
        let idCol = $(this).attr('data-col');
        if ($(this).val() == 5) {
            $('#'+idCol).parent().removeClass('d-none');
            $('#'+idCol).prop('disabled', false).trigger('change');
            $('#'+idCol+'buro').parent().removeClass('d-none');
            $('#'+idCol+'buro').prop('disabled', false).trigger('change');
        } else {
            $('#'+idCol).parent().addClass('d-none');
            $('#'+idCol).prop('disabled', true).trigger('change');
            $('#'+idCol+'buro').parent().addClass('d-none');
            $('#'+idCol+'buro').prop('disabled', true).trigger('change');
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

    $('.cedula').keyup(function (e) {
        let cedula = $(this).val();

        cedula = cedula.replace(/\./g, '');

        let cedulaFormateada = cedula.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        $(this).val(cedulaFormateada);
    });

    $('.cedula').change(function (e) {
        let ci = $(this).val().replace(/\./g, ''), currentCiInp = $(this).attr('data-count');

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

                            $(`.member${currentCiInp} .nombre`).val(nombres);
                            $(`.member${currentCiInp} .apellido`).val(apellidos);
                            $(`.member${currentCiInp} .genero`).val(genero).trigger('change');
                            $(`.member${currentCiInp} .fecha`).val(fecha_formateada);
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
