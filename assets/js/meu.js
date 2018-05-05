function initTable(exportar, pesquisa, texto, selecionar, ocultas) {
    var table;
    var buttons = [{
        extend: 'print',
        text: 'Imprimir',
        className: 'btn waves-effect waves-light btn-secondary',
        exportOptions: {columns: ':visible'},
        autoPrint: true,
        customize: function (win) {
            $(win.document.body).find('table').addClass('display').css('font-size', '9px');
            $(win.document.body).find('tr:nth-child(odd) td').each(function (index) {
                $(this).css('background-color', '#D0D0D0');
            });
            $(win.document.body).find('h1').css('text-align', 'center');
        }
    },
        {
            extend: 'copy',
            text: 'Copiar',
            className: 'btn waves-effect waves-light btn-success',
            exportOptions: {columns: ':visible'}
        },
        {
            extend: 'colvis',
            className: 'btn waves-effect waves-light btn-secondary',
            text: 'Colunas',
            columnText: function (dt, idx, title) {
                return (idx + 1) + ': ' + title;
            }
        },
    ];

    if (exportar) {
        var buttons = [
            {
                extend: 'print',
                text: 'Imprimir',
                className: 'btn waves-effect waves-light btn-secondary',
                exportOptions: {columns: ':visible'},
                autoPrint: true,
                customize: function (win) {
                    $(win.document.body).find('table').addClass('display').css('font-size', '9px');
                    $(win.document.body).find('tr:nth-child(odd) td').each(function (index) {
                        $(this).css('background-color', '#D0D0D0');
                    });
                    $(win.document.body).find('h1').css('text-align', 'center');
                }
            },
            {
                extend: 'copy',
                text: 'Copiar',
                className: 'btn waves-effect waves-light btn-secondary',
                exportOptions: {columns: ':visible'}
            },
            {
                extend: 'excelHtml5',
                className: 'btn waves-effect waves-light btn-secondary',
                exportOptions: {columns: ':visible'}
            },
            {
                extend: 'pdfHtml5',
                className: 'btn waves-effect waves-light btn-secondary',
                exportOptions: {columns: ':visible'},
                //download: 'open'
            },
            {
                extend: 'colvis',
                className: 'btn waves-effect waves-light btn-secondary',
                text: 'Colunas visiveis',
                columnText: function (dt, idx, title) {
                    return (idx + 1) + ': ' + title;
                }
            },
        ];
    }


    table = $('#table').DataTable({
        responsive: true,
        dom: 'Bfrtlp',
        colReorder: true,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todas"]],
        buttons: {
            buttons: buttons
        },
        select: true,
        columnDefs: [{
            targets: ocultas,
            visible: false
        }],
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
        initComplete: function () {
            if (pesquisa) {
                var text = texto;
                var list = selecionar;

                table.columns().eq(0).each(function (index) {
                    var column = table.column(index);
                    if (text.find(function (obj) {
                            return obj === index;
                        }) != null) {
                        var select = $('<input type="text" class="form-control m-input" placeholder="Pesquisar" />')
                            .appendTo($(column.footer()).empty());
                        $('input', column.footer()).on('keyup change', function () {
                            if (column.search() !== this.value) {
                                column.search(this.value).draw();
                            }
                        });
                    } else if (list.find(function (obj) {
                            return obj === index;
                        }) != null) {
                        var select = $('<select class="form-control"><option value="">Todos</option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });
                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    }
                });
            }
        }
    });
    return table;
}

