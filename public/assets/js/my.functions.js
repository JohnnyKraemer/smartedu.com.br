function capitalize(txt) {
    if (txt == null || txt.length == 0) return "";
    txt = txt.toLowerCase();
    return txt.replace(/(^|\s)([a-z])/g, function (m, p1, p2) {
        return p1 + p2.toUpperCase();
    });
};

function removeAccents(txt) {
    txt = txt.toLowerCase();
    txt = txt.replace(new RegExp('[ÁÀÂÃ]', 'gi'), 'a');
    txt = txt.replace(new RegExp('[ÉÈÊ]', 'gi'), 'e');
    txt = txt.replace(new RegExp('[ÍÌÎ]', 'gi'), 'i');
    txt = txt.replace(new RegExp('[ÓÒÔÕ]', 'gi'), 'o');
    txt = txt.replace(new RegExp('[ÚÙÛ]', 'gi'), 'u');
    txt = txt.replace(new RegExp('[Ç]', 'gi'), 'c');
    return txt;
}

function alterState(state, id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "" + state + "/" + id,
        type: "POST",
        success: function (result) {
            notification('Sucesso ao fazer a alteração!', 'success');
        },
        error: function (result) {
            notification('Erro ao fazer a alteração!', 'danger');
        }
    });
}