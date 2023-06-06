@extends('layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>Class</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Class</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <a href="{{ route('class.create') }}" class="btn btn-primary float-end">New Class</a>
                        <h5 class="card-header-title">Class List</h5>

                    </div>
                    <div class="card-body">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Course Year & Section</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 1;
                                @endphp
                                @forelse ($class as $row)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ strtoupper($row->course . '-' . $row->year . $row->section) }}</td>
                                        <td>
                                            <div style="display: flex; gap: 10px;">
                                                <a href="{{ route('class.edit', $row->id) }}" class="btn btn-success">Edit</a>
                                                <form action="{{ route('class.delete', $row->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="deleteConfirm(event)" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        window.deleteConfirm = function(e) {
            e.preventDefault();
            var form = e.target.form;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
            })
        }
    </script>
@endsection
