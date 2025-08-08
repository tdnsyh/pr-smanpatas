@extends('layouts.admin')
@section('title', 'Preview Import Alumni')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-4">@yield('title')</h2>
            <form action="{{ route('admin.alumni.import') }}" method="POST">
                @csrf

                @foreach ($headers as $header)
                    <input type="hidden" name="headers[]" value="{{ $header }}">
                @endforeach

                @foreach ($rows as $i => $row)
                    @foreach ($row as $j => $value)
                        <input type="hidden" name="rows[{{ $i }}][]" value="{{ $value }}">
                    @endforeach
                @endforeach

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                @foreach ($headers as $header)
                                    <th>{{ $header }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)
                                <tr>
                                    @foreach ($row as $cell)
                                        <td>{{ $cell }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-success">Simpan ke Database</button>
                <a class="btn btn-outline-primary" href="{{ route('admin.alumni.index') }}">Kembali</a>
            </form>
        </div>
    </div>
@endsection
