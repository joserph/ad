// const { method } = require("lodash");

$(document).ready(function () {
    
    const selectSeccional = $('#seccional');
    const selectMunicipio = $('#municipio');
    const selectParroquia = $('#parroquia');
    // console.log(centros_votaciones);
    
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

    $('.cedula').keyup(function (e) {
        let cedula = $(this).val();

        cedula = cedula.replace(/\./g, '');

        let cedulaFormateada = cedula.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        
        $(this).val(cedulaFormateada);
    });

    $('.cedula').change(function (e) {
        let ci = $(this).val().replace(/\./g, ''), currentCiInp = $(this).attr('data-count');
        
        if (ci.trim() !== '' && ci.trim().length > 6) {
            console.log(ci)
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
                            cod_centro_v = data.info[11];
                            // BUSCAR CENTRO DE VOTACION
                            
                            urlCentro = '/centro_votacion/'+ cod_centro_v;
                            console.log(urlCentro);
                            var centro = '';
                            $.ajax({
                                url: urlCentro,
                                method: 'GET',
                                data: {
                                    ci: ci
                                }
                            }).done(function(res){
                                centro = JSON.parse(res);
                                $(`.member${currentCiInp} .nombre`).val(nombres);
                                $(`.member${currentCiInp} .apellido`).val(apellidos);
                                $(`.member${currentCiInp} .genero`).val(genero).trigger('change');
                                $(`.member${currentCiInp} .fecha`).val(fecha_formateada);
                                if(centro.nombre_centro){
                                    $(`.member${currentCiInp} .centro_votacion`).val(centro.nombre_centro);
                                }else{
                                    $(`.member${currentCiInp} .centro_votacion`).val('NO TIENE CENTRO DE VOTACION');
                                }
                                
                            })
                            // console.log(centro);
                            
                            
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
