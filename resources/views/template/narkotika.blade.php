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
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
            }

            .table-container-atas th, .table-container-atas td {
                /* border: 1px solid #000; */
                padding: 3px;
                vertical-align: top;
            }

            .table-container-atas td:nth-child(1) {
                text-align: left;
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
                <td>Surat Keterangan Hasil Pemeriksaan Narkotika</td>
                <td></td>
            </tr>
        </table>
        <br>
        <h3>SURAT KETERANGAN HASIL PEMERIKSAAN NARKOTIKA</h3>
            <p>Diterangkan bersama ini bahwa:</p>
            <table class="table-container-atas">
                <tr>
                    <td>No. Rekam Medis</td>
                    <td>:</td>
                    <td>1460467</td>
                </tr>
                <tr>
                    <td>Tanggal Pemeriksaan</td>
                    <td>:</td>
                    <td>2 Juli 2024</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>Michelle</td>
                </tr>
                <tr>
                    <td>Umur Pasien</td>
                    <td>:</td>
                    <td>23 Tahun</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>Perempuan</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>Jalan A Yani jm.17,14</td>
                </tr>
                <tr>
                    <td>Diagnosa Awal/Klinis</td>
                    <td>:</td>
                    <td>Paru-paru smile</td>
                </tr>
            </table>

    <br>

    <p>Saat ini telah dilakukan pemeriksaan penggunaan narkotika dengan metode:</p>
            <table class="table-container-garis-tengah">
        <tr>
            <td><b>1.</b></td>
            <td colspan="3">Wawancara klinis menggunakan <b>DAST-10 / ASSIST</b> dengan hasil: -- HASIL WAWANCARA --</td>
        </tr>
        <tr>
            <td><b>2.</b></td>
            <td colspan="3">Pemeriksaan urin saat ini menggunakan <b><i>rapid test/immune assay</i></b> 6 (enam) parameter dengan hasil :</td>
        </tr>
        <tr>
            <td></td>
            <td style="border-right: 1px solid #000;">Coccaine :</td>
            <td style="border-right: 1px solid #000;">Methamphetamine :</td>
            <td>Morphin :</td>
        </tr>
        <tr>
            <td style="border-right: 1px solid #000; border-bottom: 1px solid #000;">Positif / Negatif</td>
            <td style="border-right: 1px solid #000; border-bottom: 1px solid #000;">Positif / Negatif</td>
            <td style="border-bottom: 1px solid #000;">Positif / Negatif</td>
        </tr>
        <tr>
            <td style="border-right: 1px solid #000;">Marijuana :</td>
            <td style="border-right: 1px solid #000;">Benzodiazepines :</td>
            <td>Ampphetamine :</td>
        </tr>
        <tr>
            <td style="border-right: 1px solid #000;">Positif / Negatif</td>
            <td style="border-right: 1px solid #000;">Positif / Negatif</td>
            <td>Positif / Negatif</td>
        </tr>
    </table>
    
    <br>

    <p style="text-align: justify;">
        Saat ini dapat dinyatakan dalam keadaan berbadan <b>-- SEHAT/SAKIT/CACAT/TIDAK CACAT JASMANI --</b> 
    </p>
    <p style="text-align: justify;">
        Surat Keterangan Sehat ini digunakn sebagai : <b>-- KEPERLUAN SURAT --</b> 
    </p>
    <p style="text-align: justify;">
        Demikian surat keterangan ini agar dapat dipergunakan sebagaimana mestinya. Terima kasih.  
    </p>

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
