@extends('layouts.base') @section('title', 'Usuários') @section('content')
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Criar Usuário
                    </h3>
                </div>
            </div>
        </div>
        <!--begin::Form-->
        <form class="m-form m-form--fit m-form--label-align-right" id="form_create" action="{{ url('/admin/user') }}"
              method="POST">
            {{ csrf_field() }}
            <div class="m-portlet__body">
                <div class="m-form__content">
                    <div class="m-alert m-alert--icon alert alert-danger m--hide" role="alert" id="form_create_msg">
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
                        <div class="m-alert m-alert--icon alert alert-danger" role="alert" id="form_create_msg">
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
                    <label class="col-form-label col-lg-3 col-sm-12">Nome * </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input type="text" class="form-control m-input" name="name" id="name" value="{{ old('name')}}"
                               placeholder="Seu e-mail">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-form-label col-lg-3 col-sm-12">E-mail *</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input type="text" class="form-control m-input" name="email" id="email"
                               value="{{ old('email')}}" placeholder="Seu e-mail">
                        <span class="m-form__help">
						Forneça um email válido.
					</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-form-label col-lg-3 col-sm-12">Cargo *</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select class="form-control m-bootstrap-select m_selectpicker" name="position_id"
                                id="position_id">
                            <option value="">
                                Selecione
                            </option>
                            @foreach($positions as $position)
                                @if ($position->id == old('position_id'))
                                    <option selected value="{{$position->id}}">
                                        {{$position->name}}
                                    </option>
                                @else
                                    <option value="{{$position->id}}">
                                        {{$position->name}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <span class="m-form__help">
						Selecione um cargo.
					</span>
                    </div>
                </div>
            <!--
			<div class="form-group m-form__group row">
			<label class="col-form-label col-lg-3 col-sm-12">Status *</label>
			<div class="col-lg-6 col-md-9 col-sm-12">
			<select class="form-control m-bootstrap-select m_selectpicker" name="status" id="status">
			<option value="">
			Selecione
		</option>
		<option {{ old('status') == 1 ? 'selected="selected"' : '' }} value="1">
		Ativo
	</option>
	<option {{ old('status') == 2 ? 'selected="selected"' : '' }} value="2">
	Desativado
</option>
</select>
<span class="m-form__help">
Selecione um status de usuário.
</span>
</div>
</div>
-->
                <div class="form-group m-form__group row">
                    <label class="col-form-label col-lg-3 col-sm-12">Campus *</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select class="form-control m-bootstrap-select m_selectpicker" name="campus_id" id="campus_id">
                            <option value="">
                                Selecione
                            </option>
                            @foreach($campus as $campu)
                                <option value="{{$campu->id}}">
                                    {{$campu->name}}
                                </option>
                            @endforeach
                        </select>
                        <span class="m-form__help">
                            Selecione um cargo.
                        </span>
                    </div>
                </div>
                <input type="hidden" id="objects" name="objects" value="{{$courses}}">
                <div class="form-group m-form__group row m--hide div_course" id="div_course" name="div_course">
                    <label class="col-form-label col-lg-3 col-sm-12">Curso *</label>
                </div>
                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div>
                <div class="form-group m-form__group row">
                    <label class="col-form-label col-lg-3 col-sm-12">Senha *</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input type="password" class="form-control m-input" name="password" id="password"
                               value="{{ old('password')}}" placeholder="Sua senha">
                        <span class="m-form__help">
			A senha deve ter no mínimo 6 caracteres.
		</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-form-label col-lg-3 col-sm-12">Confirmação da Senha *</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input type="password" class="form-control m-input" name="confirm_password"
                               id="confirm_password" value="{{ old('confirm_password')}}"
                               placeholder="Sua senha">
                        <span class="m-form__help">
			Digite novamente a senha.
		</span>
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
                        Tem certeza que deseja cancelar a criação?<br> Todas as alterações serão perdidas.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                    <a href="{{ url('admin/user') }}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->
@endsection @section('scripts')
    <script src="<?php echo asset('assets/demo/default/custom/components/forms/widgets/bootstrap-select.js') ?>"
            type="text/javascript"></script>
    <script>

        $("#position_id").change(function () {
            var position_id = document.getElementById("position_id").value;
            if (position_id == 2 || position_id == 3) {
                $("#campus_id").change();
            } else {
                var div = document.getElementById('div_select');
                if (typeof(div) != 'undefined' && div != null) {
                    $("#div_select").remove();
                    var alert = $('#div_course');
                    alert.addClass('m--hide').show();
                }
            }
        });
        $("#campus_id").change(function () {
            var position_id = document.getElementById("position_id").value;
            if (position_id == 2 || position_id == 3) {
                var id = $(this).val();

                var objects = document.getElementById("objects").value;
                var dataJSONArray = JSON.parse(objects);

                var div = document.getElementById('div_select');
                if (typeof(div) != 'undefined' && div != null) {
                    $("#div_select").remove();
                }

                var div_select = document.createElement("div");
                div_select.setAttribute("class", "col-lg-6 col-md-9 col-sm-12");
                div_select.setAttribute("name", "div_select");
                div_select.setAttribute("id", "div_select");

                var select = document.createElement("select");
                select.setAttribute("class", "form-control m-bootstrap-select m_selectpicker");
                select.setAttribute("name", "courses[]");
                select.setAttribute("id", "courses");
                select.setAttribute('multiple', 'multiple');

                dataJSONArray.forEach(function (item) {
                    if (item.campus_id == id) {
                        console.log(item.name);
                        var option;
                        option = document.createElement("option");
                        option.setAttribute("value", item.id);

                        option.innerHTML = item.name;
                        select.appendChild(option);
                    }
                });
                div_course.appendChild(div_select);
                div_select.appendChild(select);
                $('.m_selectpicker').selectpicker();

                var alert = $('#div_course');
                alert.removeClass('m--hide').show();
                mApp.scrollTo(alert, -200);
            }
        });

        $(document).ready(function () {

            $("#form_create").validate({
                // define validation rules
                rules: {
                    name: {
                        required: true,
                        minlength: 6,
                        maxlength: 191
                    },
                    email: {
                        required: true,
                        email: true,
                        minlength: 6,
                        maxlength: 191
                    },
                    position_id: {
                        required: true
                    },
                    campus_id: {
                        required: true
                    },
                    courses: {
                        required: true
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 20
                    },
                    confirm_password: {
                        equalTo: "#password",
                        required: true,
                        minlength: 6,
                        maxlength: 20
                    }
                },
                messages: {
                    name: {
                        required: "O nome é obrigatório.",
                        minlength: "O nome deve ter no mínimo 6 caracteres.",
                        maxlength: "O nome deve ter no máximo 191 caracteres.",
                    },
                    email: {
                        required: "O email é obrigatório",
                        email: "Por favor, informe um endereço de email válido",
                        minlength: "O email deve ter no mínimo 6 caracteres.",
                        maxlength: "O email deve ter no máximo 191 caracteres.",
                    },
                    position_id: {
                        required: "O cargo é obrigatório."
                    },
                    status: {
                        required: "O status é obrigatório."
                    },
                    password: {
                        required: "A senha é obrigatória.",
                        minlength: "A senha deve ter no mínimo 6 caracteres.",
                        maxlength: "A senha deve ter no máximo 20 caracteres.",
                    },
                    confirm_password: {
                        required: "A confirmação de senha é obrigatória.",
                        minlength: "A senha deve ter no mínimo 6 caracteres.",
                        maxlength: "A senha deve ter no máximo 20 caracteres.",
                        equalTo: "As senhas devem ser iguais."
                    }
                },

                //display error alert on form submit
                invalidHandler: function (event, validator) {
                    var alert = $('#form_create_msg');
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
