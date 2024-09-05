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
            <td style="padding-right: 3">Banjarbaru, </td>
            <td style="padding-right: 3">{{ $tanggalHijriyahHari }}</td>
            <td style="padding-right: 3">{{ $tanggalHijriyahBulan }}</td>
            <td>{{ $tanggalHijriyahTahun }} H</td>
        </tr>
        <tr>
            <td></td>
            <td style="padding-right: 3">{{ $tanggalPemeriksaanHari }}</td>
            <td style="padding-right: 3">{{ $tanggalPemeriksaanBulan }}</td>
            <td>{{ $tanggalPemeriksaanTahun }} M</td>
        </tr>
    </table>
</div>