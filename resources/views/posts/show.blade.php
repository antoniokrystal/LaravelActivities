@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a class="btn button btn-info" href="/posts">Back</a>
            <br><br>
            <div class="card">
                <div class="card-header">View Post</div>

                <div class="card-body">
                    <form>
                        @csrf

                        <div class="form-group row">
                            <label for="Title" class="col-md-4 col-form-label text-md-right">Title</label>
                            <div class="col-md-6">
                                <input id="Title" type="text" class="form-control" name="Title" disabled value={{ $post->Title }}>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Description" class="col-md-4 col-form-label text-md-right">Description</label>
                            <div class="col-md-6">
                                <textarea id="Description" type="text" class="form-control" name="Description" disabled >{{ $post->Description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Description" class="col-md-4 col-form-label text-md-right">Image</label>
                            <div class="col-md-6">
                                
                                @if ($post->img)

                                 <img height="185" src="{{ asset('/storage/img/'.$post->img) }} ">
                              @else
                                  No image available
                                 @endif

                            </div>
                        </div>


                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection