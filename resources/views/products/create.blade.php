@extends('layout.app')

@section('main')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card mt-3 p-3">
                    <form action="/products/store" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{old('name')}}"/>
                            @if($errors->has('name'))
                            <p style="color: red">{{ $errors -> first('name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="" cols="10" rows="4" class="form-control">{{old('description')}}</textarea>
                            @if($errors->has('description'))
                            <p style="color: red">{{ $errors -> first('description') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" alt="" class="form-control"/>
                            @if($errors->has('image'))
                            <p style="color: red">{{ $errors -> first('image') }}</p>
                            @endif
                        </div>

                        <button type="submit" class=" mt-3 btn btn-dark">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection