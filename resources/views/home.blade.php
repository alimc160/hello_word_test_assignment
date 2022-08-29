@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Landing Page') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="post" action="{{route('search.prediction')}}" name="search_prediction_form">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" aria-describedby="emailHelp"
                                       placeholder="Enter your name">
                            </div>
                            <button type="submit" id="search_prediction_btn" class="btn btn-primary mt-2">Submit</button>
                        </form>
                        @if (session()->has('link'))
                            <div class="col-12 mt-2">
                                <p>You search link: <a target="_blank" href="{{session()->get('link')}}">Link</a></p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.getElementById('search_prediction_btn').addEventListener('click',function (){
            this.setAttribute('disabled','disabled');
            document.getElementsByName('search_prediction_form')[0].submit();
        });
    </script>
@endsection
