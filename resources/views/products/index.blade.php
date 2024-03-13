@extends('layout.app')

@section('main')
    <div class="container">
        <div class="text-end">
            <a href="products/create" class="btn btn-dark mt-3">Add Blog</a>
        </div>
        {{-- display database data --}}
        <table class="table table-hover mt-5 justify-content-center text-center">
            <thead>
                <tr>
                  <th scope="col">S.NO</th>
                  <th scope="col">Name</th>
                  <th scope="col">Image</th>
                  {{-- <th scope="col"></th> --}}
                </tr>
              </thead>
              <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$loop->index +1}}</td>
                        <td><a href="products/{{$product->id}}/show" class="text-dark text-decoration-none">{{$product->name}}</a></td>
                        <td>
                            <img src="products/{{$product->image}}" alt="" srcset="" class="rounded-circle" width="30" height="30"/>
                        </td>
                        <td>
                            <a href="products/{{$product->id}}/edit" class="btn btn-dark btn-md">Edit</a>
                            {{-- <a href="products/{{$product->id}}/delete" class="btn btn-danger btn-md">delete</a> --}}

                            <form action="products/{{$product->id}}/delete" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-md">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
              </tbody>
        </table>
    </div>
@endsection