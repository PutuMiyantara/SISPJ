'
<html>

<head>
    <style>
    @page {
        size: auto;
        odd-header-name: html_myHeader1;
        odd-footer-name: html_myFooter1;
    }
    </style>
</head>

<body>
    <htmlpageheader name="myHeader1" style="display:none">
        <div style="text-align: center; border-bottom: 2px solid #000000; font-weight: bold; font-size: 10pt;">
            <table style="margin:auto">
                <tr>
                    <td style="width: 4cm">Tahun Anggaran</td>
                    <td>: 2022</td>
                    <td style="width: 2cm"></td>
                    <td>Rekening Bank</td>
                    <td>: 1234567890</td>
                </tr>
                <tr>
                    <td>Kode Rekening</td>
                    <td>: 2 . 17 . 3 .30 . 03 . 2 . 02 . 5 . 1 . 02 . 01 . 01 . 0027</td>
                    <td></td>
                    <td>NPWP</td>
                    <td>: 1234567890</td>
                </tr>
                <tr>
                    <td>Nomor</td>
                    <td>: 111</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </htmlpageheader>
    <htmlpagefooter name="myFooter1" style="display:none">
        <table width="100%">
            <tr>
                <td width="33%">
                    <span style="font-weight: bold; font-style: italic;">{DATE j-m-Y}</span>
                </td>
                <td width="33%" align="center" style="font-weight: bold; font-style: italic;">
                    {PAGENO}/{nbpg}
                </td>
                <td width="33%" style="text-align: right;">
                    My document
                </td>
            </tr>
        </table>
    </htmlpagefooter>
    <htmlpagefooter name="myFooter2" style="display:none">
        <table width="100%">
            <tr>
                <td width="33%">My document</td>
                <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                <td width="33%" style="text-align: right;">{DATE j-m-Y}</td>
            </tr>
        </table>
    </htmlpagefooter>
    <htmlpagecontent>
        test
    </htmlpagecontent>
</body>

</html>'