{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
    @lang('base.api.index.header')
@endsection

@section('content-header')
    <h1>@lang('base.api.index.header')<small>@lang('base.api.index.header_sub')</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">@lang('strings.home')</a></li>
        <li class="active">@lang('navigation.account.api_access')</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">@lang('base.api.index.list')</h3>
                <div class="box-tools">
                    <a href="{{ route('account.api.new') }}"><button class="btn btn-primary btn-sm">Create New</button></a>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>@lang('strings.public_key')</th>
                            <th>@lang('strings.memo')</th>
                            <th class="text-center hidden-sm hidden-xs">@lang('strings.created')</th>
                            <th class="text-center hidden-sm hidden-xs">@lang('strings.expires')</th>
                            <th></th>
                        </tr>
                        @foreach ($keys as $key)
                            <tr>
                                <td><code>{{ $key->token }}</code></td>
                                <td>{{ $key->memo }}</td>
                                <td class="text-center hidden-sm hidden-xs">
                                    {{ (new Carbon($key->created_at))->toDayDateTimeString() }}
                                </td>
                                <td class="text-center hidden-sm hidden-xs">
                                    @if(is_null($key->expires_at))
                                        <span class="label label-default">@lang('strings.never')</span>
                                    @else
                                        {{ (new Carbon($key->expires_at))->toDayDateTimeString() }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="#delete" class="text-danger" data-action="delete" data-attr="{{ $key->token }}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $(document).ready(function() {
        $('[data-action="delete"]').click(function (event) {
            var self = $(this);
            event.preventDefault();
            swal({
                type: 'error',
                title: 'Revoke API Key',
                text: 'Once this API key is revoked any applications currently using it will stop working.',
                showCancelButton: true,
                allowOutsideClick: true,
                closeOnConfirm: false,
                confirmButtonText: 'Revoke',
                confirmButtonColor: '#d9534f',
                showLoaderOnConfirm: true
            }, function () {
                $.ajax({
                    method: 'DELETE',
                    url: Router.route('account.api.revoke', { key: self.data('attr') }),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).done(function (data) {
                    swal({
                        type: 'success',
                        title: '',
                        text: 'API Key has been revoked.'
                    });
                    self.parent().parent().slideUp();
                }).fail(function (jqXHR) {
                    console.error(jqXHR);
                    swal({
                        type: 'error',
                        title: 'Whoops!',
                        text: 'An error occured while attempting to revoke this key.'
                    });
                });
            });
        });
    });
    </script>
@endsection
