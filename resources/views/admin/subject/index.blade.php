@extends('layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>Subjects</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Subjects</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <a href="{{ route('subject.create') }}" class="btn btn-primary float-end">New Subject</a>
                        <h5 class="card-header-title">Subject List</h5>

                    </div>
                    <div class="card-body">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Subject Code</th>
                                    <th scope="col">Subject Title</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 1;
                                @endphp
                                @forelse ($subjects as $subject)
                                    <tr>
                                        <td> {{ $count++ }} </td>
                                        <td>{{ $subject->subject_code }}</td>
                                        <td>{{ $subject->subject_title }}</td>
                                        <td>
                                            <div style="display: flex; gap: 10px;">
                                                <a href="{{ route('subject.edit', $subject->id) }}" class="btn btn-success">Edit</a>
                                                <form action="{{ route('subject.delete', $subject->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="deleteConfirm(event)" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <td><h3>NO SUBJECT FOUND</h3></td>
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
