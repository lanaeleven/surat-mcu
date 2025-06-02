<div style="width: 100%; margin-bottom: 90px">
    <table style="border-collapse: collapse; float: left;">
        <tr>
            <td>Nomor</td>
            <td>:</td>
            <td>{{ $noSurat }}</td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td>:</td>
            <td>1 Bendel</td>
        </tr>
        <tr>
            <td>Hal</td>
            <td>:</td>
            <td>{{ $hal }}</td>
        </tr>
    </table>

    <table style="border-collapse: collapse; float: right;">
        <tr>
            <td style="padding-right: 3; border-bottom: 1px solid black">Banjarbaru, </td>
            <td style="padding-right: 3; border-bottom: 1px solid black">{{ $tanggalHijriyahHari }}</td>
            <td style="padding-right: 3; border-bottom: 1px solid black">{!! $tanggalHijriyahBulan !!}</td>
            <td style="border-bottom: 1px solid black">{{ $tanggalHijriyahTahun }} H</td>
        </tr>
        <tr>
            <td></td>
            <td style="padding-right: 3">{{ $tanggalPemeriksaanHari }}</td>
            <td style="padding-right: 3">{{ $tanggalPemeriksaanBulan }}</td>
            <td>{{ $tanggalPemeriksaanTahun }} M</td>
        </tr>
    </table>
</div>