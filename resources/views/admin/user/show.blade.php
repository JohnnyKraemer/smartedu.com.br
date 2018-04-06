@extends('layouts.base')
@section('title', 'Usuário')

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
        <div class="col-xl-5 col-lg-5">
            <div class="m-portlet m-portlet--full-height  ">
                <div class="m-portlet__body">
                    <div class="m-card-profile">
                        <div class="m-card-profile__title m--hide">
                            Perfil do Usuário
                        </div>
                        <div class="m-card-profile__pic">
                            <div class="m-card-profile__pic-wrapper">
                                <img src="<?php echo asset('assets/images/user/all.jpg') ?>"
                                     alt="{{$object->name}}">
                            </div>
                        </div>
                        <div class="m-card-profile__details">
                            <span class="m-card-profile__name">
                                {{ucwords(strtolower($object->name))}}
                            </span>
                            <br/>
                            <a href="" class="m-card-profile__email m-link">
                                {{$object->position->name}}
                            </a>
                        </div>
                    </div>
                    <div class="m-portlet__body-separator"></div>
                    <div class="m-widget1 m-widget1--paddingless">
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">
                                        Situação:
                                    </h3>
                                </div>
                                <div class="col m--align-right">
                                    @if($object->status != 1)
                                        <span class="m-widget1__number m--font-success">
                                            Desativo
                                        </span>
                                    @else
                                        <span class="m-widget1__number m--font-success">
                                            Ativo
                                        </span>
                                    @endif
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
                                        Email:
                                    </label>
                                    <label for="example-text-input" class="col-7 col-form-label"
                                           style="text-align: left; font-weight: bold;">
                                        {{$object->email}}
                                    </label>
                                </div>
                                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-5 col-form-label"
                                           style="text-align: left;">
                                        Campus:
                                    </label>

                                    <label for="example-text-input" class="col-7 col-form-label"
                                           style="text-align: left; font-weight: bold;">
                                        @if($object->courses == "-")
                                            -
                                        @else
                                            {{$object->campus->name}}
                                        @endif
                                    </label>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-5 col-form-label"
                                           style="text-align: left;">
                                        Cursos:
                                    </label>
                                    <label for="example-text-input" class="col-7 col-form-label"
                                           style="text-align: left; font-weight: bold;">
                                        @if($object->courses == "-")
                                            -
                                        @else
                                            @foreach ($object->courses as $object)
                                                - {{$object->name}} <br/>
                                            @endforeach
                                        @endif
                                    </label>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="{{ url('/admin/user/'.$object->id.'/edit') }}"
                                               class="btn btn-accent m-btn m-btn--air m-btn--custom">
                                                Alterar Senha
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ url('/admin/user/'.$object->id.'/edit') }}"
                                               class="btn btn-accent m-btn m-btn--air m-btn--custom">
                                                Alterar Perfil
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
