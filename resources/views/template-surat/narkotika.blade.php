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
                width: 150px;
            }

            .table-container-atas td:nth-child(2) {
                text-align: center;
                width: 2px;
            }

            .table-container-atas td:nth-child(3) {
                text-align: left;
            }

            .table-container-garis-tengah {
                width: 100%;
                border-collapse: collapse;
            }

            .table-container-garis-tengah td {
                vertical-align: top;
                padding: 4px;
            }

            .table-container-garis-tengah td:nth-child(1) {
                text-align: left;
                width: 4%;
            }
            
            .table-container-garis-tengah td:nth-child(2) {
                text-align: left;
                width: 32%;
            }

            .table-container-garis-tengah td:nth-child(3) {
                text-align: left;
                width: 32%;
            }

            .table-container-garis-tengah td:nth-child(4) {
                text-align: left;
                width: 32%;
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
                <td>{{ $narkotika->noSurat }}</td>
                <td style="text-align: right;">Banjarbaru, {{ $tanggalHijriyah }} H</td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>:</td>
                <td>1 Bendel</td>
                <td style="text-align: right;">{{ $tanggalPemeriksaan }} M</td>
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
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td>{{ $narkotika->pekerjaanPasien }}</td>
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

    <p>Saat ini telah dilakukan pemeriksaan penggunaan narkotika dengan metode:</p>
            <table class="table-container-garis-tengah">
        <tr>
            <td><b>1.</b></td>
            <td colspan="3">Wawancara klinis menggunakan <b>DAST-10 / ASSIST</b> dengan hasil: {{ $narkotika->hslWawancara }}</td>
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
            <td></td>
            <td style="border-right: 1px solid #000; border-bottom: 1px solid #000;">
                @if ($narkotika->coccaine) Positif / <del>Negatif</del> @else <del>Positif</del> / Negatif @endif
            </td>
            <td style="border-right: 1px solid #000; border-bottom: 1px solid #000;">
                @if ($narkotika->methamphetamine) Positif / <del>Negatif</del> @else <del>Positif</del> / Negatif @endif
            </td>
            <td style="border-bottom: 1px solid #000;">
                @if ($narkotika->morphin) Positif / <del>Negatif</del> @else <del>Positif</del> / Negatif @endif
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="border-right: 1px solid #000;">Marijuana :</td>
            <td style="border-right: 1px solid #000;">Benzodiazepines :</td>
            <td>Amphetamine :</td>
        </tr>
        <tr>
            <td></td>
            <td style="border-right: 1px solid #000;">
                @if ($narkotika->marijuana) Positif / <del>Negatif</del> @else <del>Positif</del> / Negatif @endif
            </td>
            <td style="border-right: 1px solid #000;">
                @if ($narkotika->benzodiazepines) Positif / <del>Negatif</del> @else <del>Positif</del> / Negatif @endif
            </td>
            <td>
                @if ($narkotika->amphetamine) Positif / <del>Negatif</del> @else <del>Positif</del> / Negatif @endif
            </td>
        </tr>
        <tr>
            <td><b>3.</b></td>
            <td colspan="3">Pemeriksaan fisik dengan hasil saat ini @if ($narkotika->kesimpulan) DITEMUKAN / <del>TIDAK DITEMUKAN</del> @else <del>DITEMUKAN</del> / TIDAK DITEMUKAN @endif tanda-tanda menggunakan narkoba</td>
        </tr>
    </table>
    
    <br>

    <p style="text-align: justify;">
        Berdasarkan data terperiksa tersebut diatas dapat disimpulkan bahwa saat ini <b> @if ($narkotika->kesimpulan) TERINDIKASI / <del>TIDAK TERINDIKASI</del> @else <del>TERINDIKASI</del> / TIDAK TERINDIKASI @endif </b> menggunakan narkotika sesuai dengan hasil pemeriksaan pada saat surat keterangan ini diterbitkan. 
    </p>
    <p style="text-align: justify;">
        Surat Keterangan ini digunakan untuk : <b> {{ $narkotika->keperluanSurat }} </b> 
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
