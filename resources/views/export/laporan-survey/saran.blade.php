<table>
    <thead>
    <tr>
        <th style="background: #3C8DBC; color: #ffffff; text-align: center;">No.</th>
        @foreach($category->formulirs as $item)
            <th style="background: #3C8DBC; color: #ffffff; text-align: center;">{{ $item->label }}</th>
        @endforeach
        <th style="background: #3C8DBC; color: #ffffff; text-align: center;">Pesan / Saran</th>
        <th style="background: #3C8DBC; color: #ffffff; text-align: center;">Waktu</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($sarans as $saran)
        <tr>
            <th>{{ $loop->iteration }}</th>
            @foreach ($saran->evaluasiRekap->evaluasiDatas as $data)
                <td>
                    @if (strpos($data->isi, ';') !== false)
                        <ul>
                            @foreach (explode(';', $data->isi) as $list)
                                <li>{{ $list }}</li>
                            @endforeach
                        </ul>
                    @else
                        {{ $data->isi }}
                    @endif
                </td>
            @endforeach
            <td class="bg-info">{{ $saran->saran ?? '-' }}</td>
            <td>{{ Carbon\Carbon::parse($saran->created_at)->isoFormat('D MMMM Y') }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="4">Tidak ada data.</td>
        </tr>
    @endforelse
    </tbody>
</table>
