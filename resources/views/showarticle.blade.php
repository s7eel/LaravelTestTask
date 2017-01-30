@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Articles</div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">
                                <tr class="warning">
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Author name</th>
                                    <th>Creation date</th>
                                    @if (!Auth::guest())
                                        @if ($article->user_id == Auth::id())
                                            <th>Actions</th>
                                        @endif
                                    @endif
                                </tr>
                                <tr>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->description }}</td>
                                    <td>{{ $article->user->name }}</td>
                                    <td>{{ $article->created_at }}</td>
                                    @if (!Auth::guest())
                                        @if ($article->user_id == Auth::id())
                                            <td>
                                                <a href="/delete/{{ $article->id }}">
                                                    <button type="submit" class="btn btn-primary btn-danger">
                                                        Delete
                                                    </button>
                                                </a>
                                                <a href="/edit/{{ $article->id }}">
                                                    <button type="submit" class="btn btn-primary">
                                                        Edit
                                                    </button>
                                                </a>
                                            </td>
                                        @endif
                                    @endif
                                </tr>
                           </table>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <a href="{{ url('/') }}">
                                <button class="btn btn-primary">
                                    Main page
                                </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
