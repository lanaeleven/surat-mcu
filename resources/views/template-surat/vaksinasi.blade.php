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
            
            /* .table-wrapper {
                width: 100%;
            } */

            .table-container-nomor {
            /* width: 100%; */
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
            noSurat="{{ $vaksinasi->noSurat }}" 
            hal="Surat Keterangan Kesehatan"
            tanggalHijriyahHari="{{ $tanggalHijriyahHari }}" 
            tanggalHijriyahBulan="{{ $tanggalHijriyahBulan }}"
            tanggalHijriyahTahun="{{ $tanggalHijriyahTahun }}"
            tanggalPemeriksaanHari="{{ $tanggalPemeriksaanHari }}" 
            tanggalPemeriksaanBulan="{{ $tanggalPemeriksaanBulan }}"
            tanggalPemeriksaanTahun="{{ $tanggalPemeriksaanTahun }}"
            ></x-lampiran-dan-tanggal>

            <h3>SURAT KETERANGAN VAKSINASI</h3>
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

    <br>

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
            <td>{{ $pasien->tempatLahir }}, {{ $tanggalLahir }} ({{ $umur }} tahun)</td>
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

    <p>
        Telah melakukan <b>{{ $vaksinasi->jenisVaksin }}</b>, pada tanggal {{ $tanggalPemeriksaanHari }} {{ $tanggalPemeriksaanBulan }} {{ $tanggalPemeriksaanTahun }} di RSI Sultan Agung Banjarbaru. Surat Keterangan ini digunakan untuk: {{ $vaksinasi->tujuanVaksin }}.
    </p>


    <table class="table-container-ttd">
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
