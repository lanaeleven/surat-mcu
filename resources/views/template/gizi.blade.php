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
        <table class="table-container-nomor">
            <tr>
                <td>Nomor</td>
                <td>:</td>
                <td>JRG/234/RNYN/4566</td>
                <td style="text-align: right;">Banjarbaru, 5 Rabiul Awal 1446 H</td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>:</td>
                <td>1 Bendel</td>
                <td style="text-align: right;">20 Juli 2024 M</td>
            </tr>
            <tr>
                <td>Hal</td>
                <td>:</td>
                <td>Surat Keterangan Kesehatan</td>
                <td></td>
            </tr>
        </table>
        <br>
            <h3>SURAT KETERANGAN HASIL PEMERIKSAAN GIZI</h3>
            <p>Diterangkan bersama ini bahwa:</p>
            <table class="table-container-atas">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>Dwight Schrute</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>26 Mei 1986</td>
        </tr>
        <tr>
            <td>Usia</td>
            <td>:</td>
            <td>40 tahun</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>Laki-laki</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>Jalan A Yani KM 10,2</td>
        </tr>
        <tr>
            <td>Tanggal Pemeriksaan</td>
            <td>:</td>
            <td>18 Juli 2024</td>
        </tr>
        <tr>
            <td>Nomor RM</td>
            <td>:</td>
            <td>357690586</td>
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
            <td style="border-right: 1px solid #000; border-bottom: 1px solid #000;">170 <b>cm</b></td>
            <td style="border-right: 1px solid #000; border-bottom: 1px solid #000;">60 <b>x/menit</b></td>
            <td style="border-right: 1px solid #000; border-bottom: 1px solid #000;">170/80 <b>mmHg</b></td>
            <td style="border-bottom: 1px solid #000;">70 <b>%</b></td>
        </tr>
        <tr>
            <td style="border-right: 1px solid #000;">Berat Badan :</td>
            <td style="border-right: 1px solid #000;">Frekuensi Nafas :</td>
            <td style="border-right: 1px solid #000;">Suhu Badan :</td>
            <td>IMT :</td>
        </tr>
        <tr>
            <td style="border-right: 1px solid #000;">70 <b>kg</b></td>
            <td style="border-right: 1px solid #000;">20 <b>x/menit</b></td>
            <td style="border-right: 1px solid #000;">25 <b><span>&deg;</span>C</b></td>
            <td>55 <b>kg/m<sup>2</sup></b></td>
        </tr>
    </table>
    
    <br>

    <b>Hasil BIA :</b>
    <p style="text-align: justify">Lorem </p>
    
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
                |_|
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                b. Obesitas
            </td>
            <td>
                |_|
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                b. Gizi Kurang
            </td>
            <td>
                |_|
            </td>
        </tr>
    </table>

    <br>

    <b>Rekomendasi Terapi Gizi Medik :</b>
    <p style="text-align: justify">Lorem </p>

    <br>

    <b>REKOMENDASI / SARAN :</b>
    <p style="text-align: justify"> </p>

    <br><br>

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
                dr. Vegapunk
            </td>
        </tr>
        <tr>
            <td>
                356878778
            </td>
        </tr>
    </table>

        </main>
    </body>
</html>
