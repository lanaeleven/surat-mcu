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
                margin-bottom: 2cm;
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
                padding-top: 3px;
                padding-bottom: 3px;
                vertical-align: top;
            }

            .table-container-atas td:nth-child(1) {
                text-align: left;
                width: 230px;
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
            <h3>SURAT KETERANGAN SCREENING -- NAMA PEMERIKSAAN --</h3>
            Yang bertanda tangan di bawah ini:
            <table class="table-container-atas">
        <tr>
            <td>Nama/Name</td>
            <td>:</td>
            <td>-- NAMA DOKTER PEMERIKSA --</td>
        </tr>
        <tr>
            <td>Jabatan/Profesion</td>
            <td>:</td>
            <td>-- DOKTER SPESIALIS --</td>
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

    Dengan ini menyatakan bahwa:
            <table class="table-container-atas">
        <tr>
            <td>Nama/Name</td>
            <td>:</td>
            <td>-- NAMA PASIEN --</td>
        </tr>
        <tr>
            <td>TTL/Date Of Birth</td>
            <td>:</td>
            <td>-- TEMPAT, TANGGAL LAHIR PASIEN --</td>
        </tr>
        <tr>
            <td>Umur/Age</td>
            <td>:</td>
            <td>-- UMUR PASIEN --</td>
        </tr>
        <tr>
            <td>Alamat/Address</td>
            <td>:</td>
            <td>-- ALAMAT PASIEN --</td>
        </tr>
        <tr>
            <td>Nomor RM</td>
            <td>:</td>
            <td>-- NOMOR RM PASIEN --</td>
        </tr>
    </table>

    <br>
    
    <br>

    <p>Kondisi Klinis :</p>
    <p style="text-align: justify">-- HASIL PEMERIKSAAN -- </p>
    <p style="text-align: justify">
        Berdasarkan hasil pemeriksaan kesehatan Fungsi Liver yang telah dilakukan saat ini, maka dapat disimpulkan bahwa saudara/i -- NAMA PASIEN -- memiliki kondisi kesehatan -- JENIS SCREENING -- yang <span style="color: red">SEHAT/TIDAK SEHAT</span> (hasil pemeriksaan terlampir).
    </p>
    <p>Demikian surat keterangan ini dibuat agar dapat dipergunakan sebagai mana mestinya. Terima kasih.</p>

    <br><br>

    <table class="table-container-ttd">
        <tr>
            <td>
                Banjarbaru, -- TANGGAL PEMERIKSAAN --
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