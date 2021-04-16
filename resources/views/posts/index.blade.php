@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- create a new post --}}
            <a class="btn button btn-info" href="/posts/create">Create New</a>
            <br><br>
            <div class="card">       
                <div class="card-body">
                    <table class="table">
                        <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Title </th>
                                    <th> Description </th>
                                    <th> Actions </th>
                                    <th>  </th>
                                    <th>  </th>
                                </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                              <tr>
                                    <td> {{ $post->id }} </td>
                                    <td> {{ $post->Title }} </td>
                                    <td> {{ $post->Description }} </td>
                                    <td> <a class="btn button btn-primary" href="/posts/{{$post->id}}">View</a></td>
                                    <td> <a class="btn button btn-success" href="/posts/{{$post->id}}/edit">Edit</a></td>
                                    <td> 
                                        <form method="POST" action=" {{ route('posts.destroy', $post->id)}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection