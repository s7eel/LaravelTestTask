@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add an article</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Title</label>
                                <div class="col-md-6">
                                    @if(!$article)
                                        <input id="title" type="text" class="form-control" name="title"
                                               value="{{ old('title') }}" required autofocus>
                                    @else
                                        <input id="title" type="text" class="form-control" name="title"
                                               value="{{ $article->title }}" required autofocus>
                                    @endif
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    @if(!$article)
                                        <textarea id="description" type="text" class="form-control" name="description"
                                                  required></textarea>
                                    @else
                                        <textarea id="description" type="text" class="form-control" name="description"
                                                  required>{{ $article->description }}</textarea>
                                    @endif
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ $button }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
