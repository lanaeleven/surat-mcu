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
            /* margin-left: 40px; */
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
            noSurat="{{ $gizi->noSurat }}"
            hal="Surat Keterangan Kesehatan"
            tanggalHijriyahHari="{{ $tanggalHijriyahHari }}" 
            tanggalHijriyahBulan="{{ $tanggalHijriyahBulan }}"
            tanggalHijriyahTahun="{{ $tanggalHijriyahTahun }}"
            tanggalPemeriksaanHari="{{ $tanggalPemeriksaanHari }}" 
            tanggalPemeriksaanBulan="{{ $tanggalPemeriksaanBulan }}"
            tanggalPemeriksaanTahun="{{ $tanggalPemeriksaanTahun }}"
            ></x-lampiran-dan-tanggal>

            <h3>SURAT KETERANGAN HASIL PEMERIKSAAN GIZI</h3>
            <p>Diterangkan bersama ini bahwa:</p>
            <table class="table-container-atas">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $pasien->nama }}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>{{ $tanggalLahir }}</td>
        </tr>
        <tr>
            <td>Usia</td>
            <td>:</td>
            <td>{{ $umur }} tahun</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $pasien->jenisKelamin }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $pasien->alamat }}</td>
        </tr>
        <tr>
            <td>Tanggal Pemeriksaan</td>
            <td>:</td>
            <td>{{ $tanggalPemeriksaan }}</td>
        </tr>
        <tr>
            <td>Nomor RM</td>
            <td>:</td>
            <td>{{ $pasien->noRM }}</td>
        </tr>
    </table>

    <br>

    <h3>STATUS KESEHATAN GIZI ANDA SAAT INI</h3>

    <b>Ditemukan:</b>
            <table class="table-container-garis-tengah">
        <tr>
            <td style="border-right: 1px solid #000;">Tinggi Badan :</td>
            <td style="border-right: 1px solid #000;">Denyut Nadi :</td>
            <td style="border-right: 1px solid #000;">Tekanan Darah :</td>
            <td>SPO2 :</td>
        </tr>
        <tr>
            <td style="border-right: 1px solid #000; border-bottom: 1px solid #000;"><b>{{ $gizi->tinggiBadan }} cm</b></td>
            <td style="border-right: 1px solid #000; border-bottom: 1px solid #000;"><b>{{ $gizi->denyutNadi }} x/menit</b></td>
            <td style="border-right: 1px solid #000; border-bottom: 1px solid #000;"><b>{{ $gizi->tekananDarah }} mmHg</b></td>
            <td style="border-bottom: 1px solid #000;"><b>{{ $gizi->spo2 }} %</b></td>
        </tr>
        <tr>
            <td style="border-right: 1px solid #000;">Berat Badan :</td>
            <td style="border-right: 1px solid #000;">Frekuensi Nafas :</td>
            <td style="border-right: 1px solid #000;">Suhu Badan :</td>
            <td>IMT :</td>
        </tr>
        <tr>
            <td style="border-right: 1px solid #000;"><b>{{ $gizi->beratBadan }} kg</b></td>
            <td style="border-right: 1px solid #000;"><b>{{ $gizi->frekuensiNafas }} x/menit</b></td>
            <td style="border-right: 1px solid #000;"><b>{{ $gizi->suhuBadan }} <span>&deg;</span>C</b></td>
            <td><b>{{ $gizi->imt }} kg/m<sup>2</sup></b></td>
        </tr>
    </table>
    
    <br>

    <b>Hasil BIA :</b>
    <p style="text-align: justify">
        {!! nl2br(e($gizi->hslBIA)) !!}
    </p>
    
    <table class="table-status-gizi">
        <tr>
            <td style="width: 150px">
                <b>Status Gizi</b>
            </td>
            <td>
                :
            </td>
            <td style="width: 100px">
                a. Normal
            </td>
            <td>
                @if ($gizi->statusGizi == "Normal")
                    <img src="conteng.png" width="15px" alt="">
                @else
                    <img src="unconteng.png" width="15px" alt="">
                @endif
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                b. Obesitas
            </td>
            <td>
                @if ($gizi->statusGizi == "Obesitas")
                    <img src="conteng.png" width="15px" alt="">
                @else
                    <img src="unconteng.png" width="15px" alt="">
                @endif
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                b. Gizi Kurang
            </td>
            <td>
                @if ($gizi->statusGizi == "Gizi Kurang")
                    <img src="conteng.png" width="15px" alt="">
                @else
                    <img src="unconteng.png" width="15px" alt="">
                @endif
            </td>
        </tr>
    </table>

    <br>

    <b>Rekomendasi Terapi Gizi Medik :</b>
    <p style="text-align: justify">
        {!! nl2br(e($gizi->rekomTerapiGizi)) !!}
    </p>

    <br>

    <b>REKOMENDASI / SARAN :</b>
    <p style="text-align: justify">
        {!! nl2br(e($gizi->saran)) !!}
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
                {{ $dokter->nama }}
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
