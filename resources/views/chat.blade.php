@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Messenger</div>
                    <div id="app" class="card-body">

{{--                        <messenger :user="{{ auth()->user() }}">--}}
{{--                            <chat></chat>--}}
{{--                        </messenger>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
