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
            <h3>HASIL PEMERIKSAAN SPIROMETRI</h3>
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

    <h3>HASIL BACAAN</h3>

    <table class="table-container-bawah">
        <tr>
            <td style="width: 40px">I.</td>
            <td style="height: 40px">Kesan</td>
        </tr>
        <tr>
            <td></td>
            <td style="text-align: justify; border: 1px solid #000; padding: 8px;" >
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam nisi illum odit ipsam sequi et nam expedita itaque, atque ab!
            </td>
        </tr>
        <tr>
            <td style="width: 40px">II.</td>
            <td style="height: 40px">Kesimpulan</td>
        </tr>
        <tr>
            <td></td>
            <td style="text-align: justify; border: 1px solid #000; padding: 8px;" >
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum vitae nesciunt consequatur architecto perspiciatis molestiae neque nemo sint, earum mollitia.
            </td>
        </tr>
        <tr>
            <td style="width: 40px">III.</td>
            <td style="height: 40px">Saran</td>
        </tr>
        <tr>
            <td></td>
            <td style="text-align: justify; border: 1px solid #000; padding: 8px;" >
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Hic quos provident dignissimos magni ad enim nihil magnam beatae ea necessitatibus?
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
