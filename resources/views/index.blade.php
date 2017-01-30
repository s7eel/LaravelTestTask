@extends('layouts.app')

@section('content')
    @if (Auth::guest())
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Authorization</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Username</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Login
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Articles</div>
                    <div class="panel-body">
                        @if (Auth::guest())
                           <table class="table table-bordered table-hover">
                                <tr class="warning">
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Author name</th>
                                    <th>Created at</th>
                                </tr>
                               @foreach($articles as $article)
                                <tr>
                                    <td><a href="/{{ $article->id }}">{{ $article->title }}</a></td>
                                    <td>{{ $article->description }}</td>
                                    <td>{{ $article->user->name }}</td>
                                    <td>{{ $article->created_at }}</td>
                                </tr>
                                @endforeach
                           </table>
                            {{ $articles->links() }}
                        <!-- Согласно ТЗ она вроде должна быть по пункту 1, но 1с говорит, что кнопки не должно быть-->
                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-8 col-md-offset-4">--}}
                                {{--<a href="{{ url('/register') }}">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Create ad--}}
                                {{--</button>--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        @else
                            <table class="table table-bordered table-hover">
                                <tr class="warning">
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Author name</th>
                                    <th>Created at</th>
                                    <th>Actions</th>
                                </tr>
                                @foreach($articles as $article)
                                    <tr>
                                        <td><a href="/{{ $article->id }}">{{ $article->title }}</a></td>
                                        <td>{{ $article->description }}</td>
                                        <td>{{ $article->user->name }}</td>
                                        <td>{{ $article->created_at }}</td>
                                        @if ($article->user_id == Auth::id())
                                        <td>
                                            <a href="delete/{{ $article->id }}">
                                                <button type="submit" class="btn btn-primary btn-danger">
                                                    Delete
                                                </button>
                                            </a>
                                            <a href="edit/{{ $article->id }}">
                                                <button type="submit" class="btn btn-primary">
                                                    Edit
                                                </button>
                                            </a>
                                        </td>
                                        @else
                                            <td></td>
                                        @endif
                                    </tr>
                                @endforeach
                            </table>
                                {{ $articles->links() }}
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <a href="/edit">
                                        <button class="btn btn-primary">
                                            Create ad
                                        </button>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
