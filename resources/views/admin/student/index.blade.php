@extends('layouts.base')
@section('title', 'Aluno')

@section('stylesheets')
    <style>
        label {
            padding-top: 0 !important;
        }

        .m-form__group {
            padding-top: 0px !important;
            padding-bottom: 0px !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title" style="width: 100%;">
                            <span class="m-portlet__head-icon m--hide">
                              <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text" style="text-align: left; width: 70px;">
                                Aluno:
                            </h3>
                            <h3 class="m-portlet__head-text" style="text-align: left; width: 80%;">
                                <select class="form-control m-select2" id="m_select2_1" name="param"
                                        onchange="location = './'+this.value;">
                                    @foreach($students as $student)
                                        @if($student->id == $object->id)
                                            <option value="{{$student->id}}" selected>
                                                {{$student->code}} - {{ucwords(strtolower($student->name))}}
                                                - {{$student->course_name}}
                                            </option>
                                        @else
                                            <option value="{{$student->id}}">
                                                {{$student->code}} - {{ucwords(strtolower($student->name))}}
                                                - {{$student->course_name}}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-5 col-lg-5">
            <div class="m-portlet m-portlet--full-height  ">
                <div class="m-portlet__body">
                    <div class="m-card-profile">
                        <div class="m-card-profile__title m--hide">
                            Perfil do Estudante
                        </div>
                        <div class="m-card-profile__pic">
                            <div class="m-card-profile__pic-wrapper">
                                <img src="<?php echo asset('assets/images/user/all.jpg') ?>" alt="">
                            </div>
                        </div>
                        <div class="m-card-profile__details">
                            <span class="m-card-profile__name">
                                {{ucwords(strtolower($object->name))}}
                            </span>
                            <br/>
                            <a href="" class="m-card-profile__email m-link">
                                {{$object->course}}
                            </a>
                            <br/>
                            <a href="" class="m-card-profile__email m-link">
                                {{$object->campus}}
                            </a>
                        </div>
                    </div>
                    <div class="m-portlet__body-separator"></div>
                    <div class="m-widget1 m-widget1--paddingless">
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">
                                        Probabilidade de Evasão:
                                    </h3>
                                </div>
                                <div class="col m--align-right">
                                    @if($object->prob_evaded == null)
                                        <span class="m-widget1__number m--font-brand">
                                             Não Consta
                                        </span>
                                    @else
                                        @if($object->prob_evaded > 70)
                                            <span class="m-widget1__number m--font-danger">
                                             {{$object->prob_evaded}} %
                                            </span>
                                        @elseif($object->prob_evaded > 40 && $object->prob_evaded < 70)
                                            <span class="m-widget1__number m--font-danger">
                                             {{$object->prob_evaded}} %
                                            </span>
                                        @else
                                            <span class="m-widget1__number m--font-brand">
                                             {{$object->prob_evaded}} %
                                            </span>
                                        @endif
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">
                                        Situação:
                                    </h3>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-success">
                                        {{$object->situation->situation_long}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7 col-lg-8">
            <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-tools">
                        <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary"
                            role="tablist">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link active show" data-toggle="tab"
                                   href="#m_user_profile_tab_1" role="tab" aria-selected="true">
                                    <i class="flaticon-share m--hide"></i>
                                    Perfil
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2"
                                   role="tab" aria-selected="false">
                                    Enem
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="m-portlet__head-tools">
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active show" id="m_user_profile_tab_1">
                        <form class="m-form m-form--fit m-form--label-align-right">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-5 col-form-label"
                                           style="text-align: left;">
                                        Nome completo:
                                    </label>
                                    <label for="example-text-input" class="col-7 col-form-label"
                                           style="text-align: left; font-weight: bold;">
                                        {{ucwords(strtolower($object->name))}}
                                    </label>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-5 col-form-label"
                                           style="text-align: left;">
                                        Código:
                                    </label>
                                    <label for="example-text-input" class="col-7 col-form-label"
                                           style="text-align: left; font-weight: bold;">
                                        {{$object->code}}
                                    </label>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-5 col-form-label"
                                           style="text-align: left;">
                                        Data de Nascimento:
                                    </label>
                                    <label for="example-text-input" class="col-7 col-form-label"
                                           style="text-align: left; font-weight: bold;">
                                        {{$object->birth_date}}
                                    </label>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-5 col-form-label"
                                           style="text-align: left;">
                                        Idade de Ingresso:
                                    </label>
                                    <label for="example-text-input" class="col-7 col-form-label"
                                           style="text-align: left; font-weight: bold;">
                                        {{$object->age}}
                                    </label>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-5 col-form-label"
                                           style="text-align: left;">
                                        Gênero:
                                    </label>
                                    <label for="example-text-input" class="col-7 col-form-label"
                                           style="text-align: left; font-weight: bold;">
                                        {{$object->genre}}
                                    </label>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-5 col-form-label"
                                           style="text-align: left;">
                                        Cidade:
                                    </label>
                                    <label for="example-text-input" class="col-7 col-form-label"
                                           style="text-align: left; font-weight: bold;">
                                        {{$object->municipality}} - {{$object->state}}
                                    </label>
                                </div>
                                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-5 col-form-label"
                                           style="text-align: left;">
                                        Ingresso:
                                    </label>
                                    <label for="example-text-input" class="col-7 col-form-label"
                                           style="text-align: left; font-weight: bold;">
                                        {{$object->semester_ingress}} / {{$object->year_ingress}}
                                    </label>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-5 col-form-label"
                                           style="text-align: left;">
                                        Forma de Ingresso:
                                    </label>
                                    <label for="example-text-input" class="col-7 col-form-label"
                                           style="text-align: left; font-weight: bold;">
                                        {{$object->type_ingress}}
                                    </label>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-5 col-form-label"
                                           style="text-align: left;">
                                        Cota:
                                    </label>
                                    <label for="example-text-input" class="col-7 col-form-label"
                                           style="text-align: left; font-weight: bold;">
                                        {{$object->quota}}
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="m_user_profile_tab_2">
                        <form class="m-form m-form--fit m-form--label-align-right">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-5 col-form-label"
                                           style="text-align: left;">
                                        Enem Humanas:
                                    </label>
                                    <label for="example-text-input" class="col-7 col-form-label"
                                           style="text-align: left; font-weight: bold;">
                                        @if($object->enem_human == null)
                                            Não Consta
                                        @else
                                            {{$object->enem_human}}
                                        @endif
                                    </label>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-5 col-form-label"
                                           style="text-align: left;">
                                        Enem Linguagem:
                                    </label>
                                    <label for="example-text-input" class="col-7 col-form-label"
                                           style="text-align: left; font-weight: bold;">
                                        @if($object->enem_language == null)
                                            Não Consta
                                        @else
                                            {{$object->enem_language}}
                                        @endif
                                    </label>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-5 col-form-label"
                                           style="text-align: left;">
                                        Enem Matemática:
                                    </label>
                                    <label for="example-text-input" class="col-7 col-form-label"
                                           style="text-align: left; font-weight: bold;">
                                        @if($object->enem_math == null)
                                            Não Consta
                                        @else
                                            {{$object->enem_math}}
                                        @endif
                                    </label>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-5 col-form-label"
                                           style="text-align: left;">
                                        Enem Natureza:
                                    </label>
                                    <label for="example-text-input" class="col-7 col-form-label"
                                           style="text-align: left; font-weight: bold;">
                                        @if($object->enem_nature == null)
                                            Não Consta
                                        @else
                                            {{$object->enem_nature}}
                                        @endif
                                    </label>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-5 col-form-label"
                                           style="text-align: left;">
                                        Enem Redação:
                                    </label>
                                    <label for="example-text-input" class="col-7 col-form-label"
                                           style="text-align: left; font-weight: bold;">
                                        @if($object->enem_redaction == null)
                                            Não Consta
                                        @else
                                            {{$object->enem_redaction}}
                                        @endif
                                    </label>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-5 col-form-label"
                                           style="text-align: left;">
                                        Nota Final SISU:
                                    </label>

                                    <label for="example-text-input" class="col-7 col-form-label"
                                           style="text-align: left; font-weight: bold;">
                                        @if($object->sisu == null)
                                            Não Consta
                                        @else
                                            {{$object->sisu}}
                                        @endif
                                    </label>
                                </div>
                                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Detalhes por Semestre Cursado - {{ucwords(strtolower($object->name))}}
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <table id="table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th></th>
                    <th>CR</th>
                    <th>Disc. Aprovadas</th>
                    <th>Disc. Consignadas</th>
                    <th>Disc. Matriculadas</th>
                    <th>Disc. Rep. Freq.</th>
                    <th>Disc. Rep. Nota</th>
                    <th>Idade</th>
                    <th>Período</th>
                    <th>Situação</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($details as $object)
                    <tr>
                        <td>{{$object->loading_period}}</td>
                        <td>{{$object->coefficient}}</td>
                        <td>{{$object->disciplines_approved}}</td>
                        <td>{{$object->disciplines_consigned}}</td>
                        <td>{{$object->disciplines_matriculate}}</td>
                        <td>{{$object->disciplines_reprovated_frequency}}</td>
                        <td>{{$object->disciplines_reprovated_note}}</td>
                        <td>{{$object->age_situation}}</td>
                        <td>{{$object->period}}</td>
                        <td>{{$object->situation->situation_long}}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            var ocultas = null;
            var texto = [0];
            var selecionar = [1, 2];
            var table = initTable(true, false, texto, selecionar, ocultas);

            $('#m_select2_1').select2({
                placeholder: "Selecione"
            });
        });
    </script>
@endsection
