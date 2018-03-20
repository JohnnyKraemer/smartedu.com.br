@extends('layouts.admin') @section('title', 'Situação do Aluno') @section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="row align-items-center" style="margin-top: 15px;">
                <div class="col-md-9">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Situação do Aluno
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-15">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="form-group m-form__group row align-items-center">
                            <div class="col-md-3">
                                <div class="m-input-icon m-input-icon--left">
                                    <input type="text" class="form-control m-input m-input--solid"
                                           placeholder="Pesquisa..." id="m_form_search">
                                    <span class="m-input-icon__icon m-input-icon__icon--left">
									<span>
										<i class="la la-search"></i>
									</span>
								</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end: Search Form -->

            <!--begin: Datatable -->
            <div class="m_datatable" id="local_data"></div>
            <input type="hidden" id="objects" name="objects" value="{{$objects}}">
            <!--end: Datatable -->
        </div>
    </div>

@endsection @section('scripts')
    <script>

        $(document).ready(function () {
            var objects = document.getElementById("objects").value;
            var dataJSONArray = JSON.parse(objects);

            console.log(dataJSONArray);

            var datatable = $('.m_datatable').mDatatable({
                // datasource definition
                data: {
                    type: 'local',
                    source: dataJSONArray,
                    pageSize: 10,
                    saveState: {
                        cookie: false,
                        webstorage: false
                    },
                },

                // layout definition
                layout: {
                    theme: 'default', // datatable theme
                    class: '', // custom wrapper class
                    scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                    height: 450, // datatable's body's fixed height
                    footer: false // display/hide footer
                },
                cookie: false,
                // column sorting(refer to Kendo UI)
                sortable: true,

                // column based filtering(refer to Kendo UI)
                filterable: false,

                pagination: true,

                // inline and bactch editing(cooming soon)
                // editable: false,

                // columns definition
                columns: [{
                    field: "id",
                    title: "#",
                    width: 40,
                    //sortable: false,
                    selector: false,
                    textAlign: 'center',
                    sortable: 'asc',
                }, {
                    field: "situation_long",
                    title: "Situação Completa",
                    width: 200,
                    template: function (row) {
                        if (row.situation_long == null) {
                            return "-";
                        } else {
                            return row.situation_long;
                        }
                    }
                }, {
                    field: "situation_short",
                    title: "Situação Resumida",
                    filterable: true,
                    template: function (row) {
                        var situation_short = {
                            'Evadido': {
                                'title': 'Evadido',
                                'class': 'm-badge--danger'
                            },
                            'Não Evadido': {
                                'title': 'Não Evadido',
                                'class': ' m-badge--success'
                            },
                            'Formado': {
                                'title': 'Formado',
                                'class': ' m-badge--success'
                            }, 'Outro': {
                                'title': 'Outros',
                                'class': ' m-badge--info'
                            }
                        };
                        if (row.situation_short == null) {
                            return "-";
                        } else {
                            //return row.situation_short;
                            return '<span class="m-badge ' + situation_short[row.situation_short].class + ' m-badge--wide">' + situation_short[row.situation_short].title + '</span>';
                        }
                    }
                }, {
                    field: "description",
                    title: "Descrição",
                    filterable: true,
                    width: 200,
                    template: function (row) {
                        if (row.description == null) {
                            return "-";
                        } else {
                            return row.description;
                        }
                    }
                }, {
                    field: "Ações",
                    width: 70,
                    title: "Ações",
                    sortable: false,
                    filterable: false,
                    overflow: 'visible',
                    template: function (row) {
                        return '\
						<a href="situation/' + row.id + '/edit" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Editar">\
                            <i class="la la-edit"></i>\
                        </a>\
					';
                    }
                }]
            });

            var query = datatable.getDataSourceQuery();
            $('#m_form_search').on('keyup', function (e) {
                datatable.search($(this).val().toLowerCase());
            }).val(query.generalSearch);

        });
    </script>
@endsection
