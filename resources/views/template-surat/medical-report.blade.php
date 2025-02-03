<html>
    <head>
        <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 3cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 1cm;
                font-family: 'Calibri', sans-serif;
                font-size: 14px;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 3cm;
            }

            h3 {
                text-align: center;
            }

            .table-container-nomor {
            width: 100%;
            border-collapse: collapse;
            }

            .table-container-nomor td {
                /* border: 1px solid #000; */
            }

            .table-container-atas {
            margin-left: 40px;
            border-collapse: collapse;
            }

            .table-container-atas th, .table-container-atas td {
                /* border: 1px solid #000; */
                padding: 3px;
                vertical-align: top;
            }

            .table-container-atas td:nth-child(1) {
                text-align: left;
                width: 200px;
            }

            .table-container-atas td:nth-child(2) {
                text-align: center;
            }

            .table-container-atas td:nth-child(3) {
                text-align: left;
            }

            .table-container-garis-tengah {
                width: 100%;
                border-collapse: collapse;
            }

            .table-container-garis-tengah td {
                width: 25%;
                padding: 4px;
            }

            .table-kategori {
                border-collapse: collapse;
                page-break-inside: avoid;
            }
            
            .table-kategori th, .table-kategori td, .table-kategori tr {
                page-break-inside: avoid;
            }
            
            .table-kategori th, .table-kategori td {
                border: 1px solid #000;
                padding: 5px;
            }

            .table-kategori td {
                border-collapse: collapse;
            }

            .table-kategori th {
                text-align: center;
            }

            .table-status-gizi {
            border-collapse: collapse;
            }

            .table-status-gizi td:nth-child(3) {
                color: red;
            }


            hr {
            border: none; /* Menghilangkan border default */
            height: 2px; /* Mengatur tinggi dari garis */
            background-color: black; /* Mengatur warna garis */
            }

            .table-container-ttd {
            page-break-inside: avoid;
            /* width: 150px; */
            float: right;
            border-collapse: collapse;
            }

            .table-container-ttd tr {
                page-break-inside: avoid;
            }

            .table-container-ttd td {
                page-break-inside: avoid;
                text-align: center;
                /* border: 1px solid #000; */
                padding: 3px;
            }

            /* .table-container-atas th {
                background-color: #f2f2f2;
            } */
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <img src="header.png" width="100%" height="100%"/>
        </header>

        <footer>
            <img src="footer.png" width="100%" height="100%"/>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
        
            <x-lampiran-dan-tanggal 
            noSurat="{{ $medicalReport->noSurat }}" 
            hal="Surat Keterangan Kesehatan"
            tanggalHijriyahHari="{{ $tanggalHijriyahHari }}" 
            tanggalHijriyahBulan="{{ $tanggalHijriyahBulan }}"
            tanggalHijriyahTahun="{{ $tanggalHijriyahTahun }}"
            tanggalPemeriksaanHari="{{ $tanggalPemeriksaanHari }}" 
            tanggalPemeriksaanBulan="{{ $tanggalPemeriksaanBulan }}"
            tanggalPemeriksaanTahun="{{ $tanggalPemeriksaanTahun }}"
            ></x-lampiran-dan-tanggal>

            <h3><u>MEDICAL REPORT</u></h3>
            <p>Yang bertanda tangan di bawah ini:</p>
            <table class="table-container-atas">
        <tr>
            <td>Nama/Name</td>
            <td>:</td>
            <td>{{ $dokter->nama }}</td>
        </tr>
        <tr>
            <td>Jabatan/Profesion</td>
            <td>:</td>
            <td>Dokter Umum</td>
        </tr>
        <tr>
            <td>Instansi/Office</td>
            <td>:</td>
            <td>RSI Sultan Agung Banjarbaru</td>
        </tr>
        <tr>
            <td>Alamat/Address</td>
            <td>:</td>
            <td>Jl. A.Yani KM 17.5 Kota Banjarbaru</td>
        </tr>
    </table>

    <p>Dengan ini menyatakan bahwa:</p>
            <table class="table-container-atas">
        <tr>
            <td>Nama/Name</td>
            <td>:</td>
            <td>{{ $pasien->nama }}</td>
        </tr>
        <tr>
            <td>TTL/Date Of Birth/ Umur/Age</td>
            <td>:</td>
            <td>{{ $pasien->tempatLahir }}, {{ $tanggalLahir }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin/Gender</td>
            <td>:</td>
            <td>{{ $pasien->jenisKelamin }}</td>
        </tr>
        <tr>
            <td>Alamat/Address</td>
            <td>:</td>
            <td>{{ $pasien->alamat }}</td>
        </tr>
        <tr>
            <td>Nomor RM</td>
            <td>:</td>
            <td>{{ $pasien->noRM }}</td>
        </tr>
    </table>

    <h3>STATUS KESEHATAN ANDA SAAT INI</h3>

    <b>Ditemukan:</b>
            <table class="table-container-garis-tengah">
        <tr>
            <td style="border-right: 1px solid #000;">Tinggi Badan :</td>
            <td style="border-right: 1px solid #000;">Denyut Nadi :</td>
            <td style="border-right: 1px solid #000;">Tekanan Darah :</td>
            <td>SPO2 :</td>
        </tr>
        <tr>
            <td style="border-right: 1px solid #000; border-bottom: 1px solid #000;"><b>{{ $medicalReport->tinggiBadan }} cm</b></td>
            <td style="border-right: 1px solid #000; border-bottom: 1px solid #000;"><b>{{ $medicalReport->denyutNadi }} x/menit</b></td>
            <td style="border-right: 1px solid #000; border-bottom: 1px solid #000;"><b>{{ $medicalReport->tekananDarah }} mmHg</b></td>
            <td style="border-bottom: 1px solid #000;"><b>{{ $medicalReport->spo2 }} %</b></td>
        </tr>
        <tr>
            <td style="border-right: 1px solid #000;">Berat Badan :</td>
            <td style="border-right: 1px solid #000;">Frekuensi Nafas :</td>
            <td style="border-right: 1px solid #000;">Suhu Badan :</td>
            <td>IMT :</td>
        </tr>
        <tr>
            <td style="border-right: 1px solid #000;"><b>{{ $medicalReport->beratBadan }} kg</b></td>
            <td style="border-right: 1px solid #000;"><b>{{ $medicalReport->frekuensiNafas }} x/menit</b></td>
            <td style="border-right: 1px solid #000;"><b>{{ $medicalReport->suhuBadan }}<span>&deg;</span>C</b></td>
            <td><b>{{ $medicalReport->imt }} kg/m<sup>2</sup></b></td>
        </tr>
    </table>
    
    <br>

    <b>Kondisi Klinis :</b>
    {{-- <p style="text-align: justify"> --}}
    <div style="text-align: justify; line-height: 1.6;">
        {!! $medicalReport->hslPemeriksaan !!}
    </div>
    {{-- </p> --}}
    

    <br>

    <table class="table-kategori">
        <tr>
            <th style="border-top: none; border-left: none;">Status</th>
            <th style="border-top: none;">Kategori</th>
            <th style="border-top: none; border-right: none; text-align: left">Catatan</th>
        </tr>
        <tr>
            <td rowspan="5" style="text-align: center; vertical-align: middle; border-left: none;">
                @if ($medicalReport->status == '1a' || $medicalReport->status == '1b' || $medicalReport->status == '2' || $medicalReport->status == '3a' || $medicalReport->status == '3b')
                    <mark>FIT</mark>
                @else
                    FIT
                @endif
            </td>
            <td style="text-align: center; vertical-align: middle;">
                @if ($medicalReport->status == '1a')
                    <mark>1a</mark>
                @else
                    1a
                @endif
            </td>
            <td style="border-right: none;">
                @if ($medicalReport->status == '1a')
                    <mark> Fit, tidak dijumpai problem kesehatan</mark>
                @else
                    Fit, tidak dijumpai problem kesehatan
                @endif
            </td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align: middle;">
                @if ($medicalReport->status == '1b')
                    <mark>1b</mark>
                @else
                    1b
                @endif
            </td>
            <td style="border-right: none;">
                @if ($medicalReport->status == '1b')
                    <mark>Fit, dijumpai problem kesehatan yang tidak serius</mark>
                @else
                    Fit, dijumpai problem kesehatan yang tidak serius
                @endif
            </td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align: middle;">
                @if ($medicalReport->status == '2')
                    <mark>2</mark>
                @else
                    2
                @endif
            </td>
            <td style="border-right: none;">
                @if ($medicalReport->status == '2')
                    <mark>Fit, dengan problem kesehatan yang dapat menjadi serius (kel. Risiko Ringan)</mark>
                @else
                    Fit, dengan problem kesehatan yang dapat menjadi serius (kel. Risiko Ringan)
                @endif
            </td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align: middle;">
                @if ($medicalReport->status == '3a')
                    <mark>3a</mark>
                @else
                    3a
                @endif
            </td>
            <td style="border-right: none;">
                @if ($medicalReport->status == '3a')
                    <mark>Dengan problem kesehatan yang dapat menjadi serius (kel. Risiko Sedang)</mark>
                @else
                    Dengan problem kesehatan yang dapat menjadi serius (kel. Risiko Sedang)
                @endif
            </td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align: middle;">
                @if ($medicalReport->status == '3b')
                    <mark>3b</mark>
                @else
                    3b
                @endif
            </td>
            <td style="border-right: none;">
                @if ($medicalReport->status == '3b')
                    <mark>Dengan problem kesehatan yang dapat menjadi serius (kel. Risiko Tinggi)</mark>
                @else
                    Dengan problem kesehatan yang dapat menjadi serius (kel. Risiko Tinggi)
                @endif
            </td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align: middle; border-left: none;">
                @if ($medicalReport->status == '4')
                    <mark>UNFIT</mark>
                @else
                    UNFIT
                @endif
            </td>
            <td style="text-align: center; vertical-align: middle;">
                @if ($medicalReport->status == '4')
                    <mark>4</mark>
                @else
                    4
                @endif
            </td>
            <td style="border-right: none;">
                @if ($medicalReport->status == '4')
                    <mark>Unfit, dengan keterbatasan fisik untuk melakukan pekerjaan secara Normal hanya untuk pekerjaan ringan</mark>
                @else
                    Unfit, dengan keterbatasan fisik untuk melakukan pekerjaan secara Normal hanya untuk pekerjaan ringan
                @endif
            </td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align: middle; border-left: none; border-bottom: none;">
                @if ($medicalReport->status == '5')
                    <mark>UNFIT</mark>
                @else
                    UNFIT
                @endif
            </td>
            <td style="text-align: center; vertical-align: middle; border-bottom: none;">
                @if ($medicalReport->status == '5')
                    <mark>5</mark>
                @else
                    5
                @endif
            </td>
            <td style="border-right: none; border-bottom: none;">
                @if ($medicalReport->status == '5')
                    <mark>Unfit, sedang sakit, perawatan rumah sakit atau dalam kondisi yang tidak memungkinkan untuk melakukan pekerjaan (Status izin sakit)</mark>
                @else
                    Unfit, sedang sakit, perawatan rumah sakit atau dalam kondisi yang tidak memungkinkan untuk melakukan pekerjaan (Status izin sakit)
                @endif
            </td>
        </tr>
    </table>

    <br>

    <b>REKOMENDASI / SARAN :</b>
    {{-- <p style="text-align: justify"> --}}
        <div style="text-align: justify; line-height: 1.6;">
        {!! $medicalReport->saran !!}
        </div>
    {{-- </p> --}}
    <p>Terima kasih atas kepercayaan Anda telah melakukan pemeriksaan kesehatan bersama Rumah Sakit Islam Sultan Agung Banjarbaru.</p>

    <table class="table-container-ttd">
        <tr>
            <td>
                Banjarbaru, {{ $tanggalPemeriksaan }}
            </td>
        </tr>
        <tr>
            <td>
                Dokter Pemeriksa
            </td>
        </tr>
        <tr>
            <td style="height: 70px">
                
            </td>
        </tr>
        <tr>
            <td>
                <b><u>{{ $dokter->nama }}</u></b>
            </td>
        </tr>
        <tr>
            <td>
                {{ $dokter->sip }}
            </td>
        </tr>
    </table>

        </main>
    </body>
</html>
