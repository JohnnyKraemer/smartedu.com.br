@extends('layouts.base') @section('title', 'Situção do Aluno') @section('content')
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Editar Situção do Aluno
                    </h3>
                </div>
            </div>
        </div>
        <!--begin::Form-->
        <form class="m-form m-form--fit m-form--label-align-right" id="form_edit"
              action="{{url('admin/situation', [$object->id])}}" method="POST">
            <input type="hidden" name="_method" value="PUT"> {{ csrf_field() }}
            <div class="m-portlet__body">
                <div class="m-form__content">
                    <div class="m-alert m-alert--icon alert alert-danger m--hide" role="alert" id="form_edit_msg">
                        <div class="m-alert__icon">
                            <i class="la la-warning"></i>
                        </div>
                        <div class="m-alert__text">
                            *É necessário preencher todos os campos obrigatórios.
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-close="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="m-alert m-alert--icon alert alert-danger" role="alert" id="form_edit_msg">
                            <div class="m-alert__icon">
                                <i class="la la-warning"></i>
                            </div>
                            <div class="m-alert__text">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="m-alert__close">
                                <button type="button" class="close" data-close="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-form-label col-lg-3 col-sm-12">Situação Completa</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input type="text" class="form-control m-input" name="situation_long" id="situation_long"
                               placeholder="Situação Completa"
                               value="{{$object->situation_long}}" disabled="disabled">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-form-label col-lg-3 col-sm-12">Situação Resumida *</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select class="form-control m-bootstrap-select m_selectpicker" name="situation_short"
                                id="situation_short">
                            <option value="">
                                Selecione
                            </option>
                            <option {{ old('situation_short', $object->situation_short) == 'Evadido' ? 'selected="selected"' : '' }} value="Evadido">
                                Evadido
                            </option>
                            <option {{ old('situation_short', $object->situation_short) == 'Não Evadido' ? 'selected="selected"' : '' }} value="Não Evadido">
                                Não Evadido
                            </option>
                            <option {{ old('situation_short', $object->situation_short) == 'Formado' ? 'selected="selected"' : '' }} value="Formado">
                                Formado
                            </option>
                            <option {{ old('situation_short', $object->situation_short) == 'Outro' ? 'selected="selected"' : '' }} value="Outro">
                                Outro
                            </option>
                        </select>
                        <span class="m-form__help">
						Selecione uma situação resumida.
					</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-form-label col-lg-3 col-sm-12">Descrição * </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input type="text" class="form-control m-input" name="description" id="description"
                               placeholder="Descrição"
                               value="{{$object->description}}">
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions">
                    <div class="row">
                        <div class="col-lg-9 ml-lg-auto">
                            <button data-toggle="modal" data-target="#modal_cancel" type="reset"
                                    class="btn btn-secondary"> Cancel
                            </button>
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>

    <!--begin::Modal-->
    <div class="modal fade" id="modal_cancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Cancelar
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						&times;
					</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Tem certeza que deseja cancelar a edição?<br> Todas as alterações serão perdidas.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                    <a href="{{ url('admin/situation') }}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="object" name="object" value="{{$object}}">

    <!--end::Modal-->
@endsection @section('scripts')
    <script src="<?php echo asset('assets/demo/default/custom/components/forms/widgets/bootstrap-select.js') ?>"
            type="text/javascript"></script>
    <script>

        $(document).ready(function () {
            $("#form_edit").validate({
                // define validation rules
                rules: {
                    situation_long: {
                        required: true,
                    },
                    situation_short: {
                        required: true,
                    },
                    description: {
                        required: true
                    }
                },
                messages: {
                    situation_long: {
                        required: "A situação completa é obrigatória.",
                    },
                    situation_short: {
                        required: "A situação resumida é obrigatória",
                    },
                    description: {
                        required: "A descrição é obrigatória."
                    }
                },

                //display error alert on form submit
                invalidHandler: function (event, validator) {
                    var alert = $('#form_edit_msg');
                    alert.removeClass('m--hide').show();
                    mApp.scrollTo(alert, -200);
                },

                submitHandler: function (form) {
                    form[0].submit(); // submit the form
                }
            });
        });

    </script>
@endsection
