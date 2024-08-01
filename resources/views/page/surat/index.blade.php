@extends('template')
@section('page')

<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Kategori Surat</th>
            <th scope="col">User</th>
            <th scope="col">Staff</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $data as $d )
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $d->nama_kategori }}</td>
            <td>{{ $d->nama_mahasiswa }}</td>
            <td>{{ $d->nama_staff }}</td>
            @if( $d->status_approve == 1)
                <td>Approve</td>
            @else
                <td>Belum Approve</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
