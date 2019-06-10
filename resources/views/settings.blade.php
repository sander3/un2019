@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 my-5">
            <p class="lead">Helpline settings</p>

            <form method="POST" action="{{ route('settings.index') }}">
                @csrf

                <div class="form-group row">
                    <label for="url" class="col-sm-4 col-form-label">{{ __('Article URL') }}</label>

                    <div class="col-md-6">
                        <input id="url" type="text" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" value="{{ old('url', 'https://www.who.int/features/qa/71/en/') }}" required autofocus>

                        @if ($errors->has('url'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-8">
            <ul class="pipeline">
                <li class="invisible">
                    FetchArticleHtml
                    <span class="invisible">.</span>
                    <span class="invisible">.</span>
                    <span class="invisible">.</span>
                </li>
                <li class="invisible">
                    ConvertArticleHtmlToContent
                    <span class="invisible">.</span>
                    <span class="invisible">.</span>
                    <span class="invisible">.</span>
                </li>
                <li class="invisible">ConvertArticleContentToText</li>
                <li class="invisible">
                    ConvertTextToSpeech
                    <span class="invisible">.</span>
                    <span class="invisible">.</span>
                    <span class="invisible">.</span>
                </li>
            </ul>
        </div>
    </div>
    @if (session('status') === 'success')
        <div class="row justify-content-center vh-100 bg-light" id="phonenumber">
            <div class="col-md-8 my-5">
                <p class="lead">Phone number</p>

                <h1>
                    📱
                    <a href="tel:+31612345678" class="stretched-link">+31 6 12345678</a>
                </h1>
            </div>
        </div>
    @endif
</div>
@endsection
