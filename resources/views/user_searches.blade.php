@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('User Search Predictions') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <p>Name : {{$response['name']}}</p>
                            </div>
                            <div class="col-4">
                                <p>Age : {{$response['age']}}</p>
                            </div>
                            <div class="col-4">
                                <p>Gender : {{$response['gender']}}</p>
                            </div>
                            <div class="col-12">
                                <h4>Countries</h4>
                                @if($response->countries->count() > 0)
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Country ID</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($response->countries as $key => $country)
                                            <tr>
                                                <th scope="row">{{++$key}}</th>
                                                <td>{{$country['country_id']}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>No country found againt this name</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
