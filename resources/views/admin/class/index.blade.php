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
                        <form action="{{ route('class.deleteSelectedClass') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th><button type="submit" onclick="deleteMultipleConfirm(event)" class="btn btn-danger"><i class="bi bi-trash"></i></button></th>
                                        <th scope="col">#</th>
                                        <th scope="col">Course Year & Section</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 1;
                                    @endphp

                                    @foreach ($class as $row)
                                        <tr>
                                            <td><input type="checkbox" value="{{ $row->id }}" id="laman" name="deleteClasses[]" style="cursor: pointer">
                                            </td>
                                            <td>{{ $count++ }}</td>
                                            <td>{{ strtoupper($row->course . '-' . $row->year . $row->section) }}</td>
                                            <td>
                                                <div style="display: flex; gap: 10px;">
                                                    <a href="{{ route('class.edit', $row->id) }}"
                                                        class="btn btn-success">Edit</a>
                                                    <form action="{{ route('class.delete', $row->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="deleteConfirm(event)"
                                                            class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
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
    <script>
        window.deleteMultipleConfirm = function(e) {
            e.preventDefault();
            var form = e.target.form;
            var id = laman;

            Swal.fire({
                title: 'Are you sure you want to delete selected class?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    if(id != '') {
                        form.submit();
                    } 
                }
            })
        }
    </script>
@endsection
