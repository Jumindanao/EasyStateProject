@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Property Page</h4>
        </div>
        <div class="card-body">
            <style>
                table th,
                table td {
                    padding: 10px;
                }
            </style>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Original Price</th>
                        <th>Selling Price</th>
                        <th>Image</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->prodname }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->original_price }} php</td>
                            <td>{{ $item->selling_price }} php</td>
                            <td>
                                <img src="{{ asset('assets/uploads/products/' . $item->image) }}" class="cate-image"
                                    alt="no image">
                            </td>
                            <td>
                                <a href="{{ url('editprod/' . $item->id) }}" class="btn btn-primary">Edit</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
