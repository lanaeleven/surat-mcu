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
                width: 25%;
            }

            .table-container-atas td:nth-child(2) {
                text-align: center;
                width: 1%;
            }

            .table-container-atas td:nth-child(3) {
                text-align: left;
            }

            .table-tanda {
                border-collapse: collapse;
            }

            .table-tanda td {
                /* border: 1px solid black; */
            }

            .table-keterangan {
                border-collapse: collapse;
            }

            .table-keterangan td {
                border: 1px solid black;
                padding: 10px;
            }

            hr {
            border: none; /* Menghilangkan border default */
            height: 2px; /* Mengatur tinggi dari garis */
            background-color: black; /* Mengatur warna garis */
            }

            .table-container-bawah td {
                /* padding: 10px; */
                /* border: 1px solid #000; */
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
            <h3>PEMERIKSAAN DOKTER GIGI</h3>
            <table class="table-container-atas">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>Michael</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>2 Juli 1979</td>
        </tr>
        <tr>
            <td>Usia</td>
            <td>:</td>
            <td>34 tahun</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>Laki-laki</td>
        </tr>
        <tr>
            <td>Tanggal MCU</td>
            <td>:</td>
            <td>18 Juli 2024</td>
        </tr>
    </table>

    <br>

    <h3>ONTOGRAM IDENTIFIKASI</h3>

    <img src="" alt="">

    <p>Keterangan tanda-tanda :</p>
    <table class="table-tanda">
        <tr>
            <td style="width: 120px;">O berlubang</td>
            <td>:</td>
            <td style="width: 150px;">karies</td>
            <td style="width: 120px;">O hitam</td>
            <td>:</td>
            <td>Tambalan</td>
        </tr>
        <tr>
            <td>V</td>
            <td>:</td>
            <td>sisa akar</td>
            <td>Kotak</td>
            <td>:</td>
            <td>Gigi tiruan</td>
        </tr>
        <tr>
            <td>X</td>
            <td>:</td>
            <td>gigi yang hilang</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <p>Keterangan :</p>
    <table class="table-tanda">
        <tr>
            <td style="width: 130px">Karang gigi</td>
            <td style="width: 100px">Rahang atas</td>
            <td>:</td>
            <td>
                Ada / Tidak Ada
            </td>
        </tr>
        <tr>
            <td></td>
            <td>Rahang bawah</td>
            <td>:</td>
            <td>
                Ada / Tidak Ada
            </td>
        </tr>
        <tr>
            <td colspan="2">Jumlah Decay/ gigi berlubang</td>
            <td>:</td>
            <td>-- JUMLAH DECAY --</td>
        </tr>
        <tr>
            <td colspan="2">Jumlah Missing/ gigi yang hilang</td>
            <td>:</td>
            <td>-- JUMLAH MISSING --</td>
        </tr>
        <tr>
            <td colspan="2">Jumlah Filling/ gigi tambalan</td>
            <td>:</td>
            <td>-- JUMLAH Filling --</td>
        </tr>
        <tr>
            <td colspan="2">Jumlah sisa akar</td>
            <td>:</td>
            <td>-- JUMLAH sisa akar --</td>
        </tr>
        <tr>
            <td colspan="2">Pemeriksaan jaringan lunak</td>
            <td>:</td>
            <td>-- Pemeriksaan jaringan lunak --</td>
        </tr>
        <tr>
            <td colspan="2">Lainnya</td>
            <td>:</td>
            <td>-- Lainnya --</td>
        </tr>
    </table>

    <br><br>

    <table>
        <tr>
            <td style="width: 180px; vertical-align: top;"><b>Kesimpulan & Saran</b></td>
            <td style="vertical-align: top;">:</td>
            <td style="vertical-align: top; text-align: justify;">
                -- KESIMPULAN DAN SARAN -- Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, laudantium distinctio corrupti deserunt voluptas culpa, facere iusto velit quam asperiores possimus, facilis voluptatibus modi explicabo?
            </td>
        </tr>
    </table>

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
                2837548957
            </td>
        </tr>
    </table>

        </main>
    </body>
</html>
