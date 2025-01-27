<div class="card">
    <div class="card-body">
        <h5 class="card-title">Peringkat</h5>

        <!-- Default Table -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Poin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peringkats as $data)
                        @if (auth()->user()->id == $data['id'])
                            <tr class="table-primary">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->total_points }}</td>
                            </tr>
                        @else
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->total_points }}</td>
                            </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="text-center">
            @if (auth()->user()->role == 'mahasiswa')
                <a href="{{ route('mahasiswa.peringkat.index') }}" class="card-title" style="font-size: 14px">Lihat
                    Selengkapnya</a>
            @elseif(auth()->user()->role == 'dosen')
                <a href="{{ route('dosen.peringkat.index') }}" class="card-title" style="font-size: 14px">Lihat
                    Selengkapnya</a>
            @endif
        </div>

        <!-- End Default Table Example -->
    </div>
</div>
