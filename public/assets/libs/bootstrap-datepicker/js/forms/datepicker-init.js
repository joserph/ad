// Date Picker
$.fn.datepicker.dates['es'] = {
    days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
    daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
    daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sá"],
    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
    today: "Hoy",
    clear: "Limpiar",
    format: 'yyyy-mm-dd',
    titleFormat: "MM yyyy",
    weekStart: 0,
};

jQuery(".mydatepicker, #datepicker, .input-group.date").datepicker({
    format: 'yyyy/mm/dd',
    autoclose: true,
    todayHighlight: true,
    language: 'es',
    placeholder: 'Selecciona una fecha'

});

jQuery("#datepicker-autoclose").datepicker({
    format: 'yyyy/mm/dd',
    autoclose: true,
    todayHighlight: true,
    language: 'es'
});

jQuery("#date-range").datepicker({
    format: 'yyyy/mm/dd',
    toggleActive: true,
    language: 'es'
});
jQuery("#datepicker-inline").datepicker({
    format: 'yyyy/mm/dd',
    todayHighlight: true,
    language: 'es'
});
