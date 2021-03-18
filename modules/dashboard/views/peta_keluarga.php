<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<html>

<head>
    <style type="text/css">
        .tg-wrap {
            width: 95%;
            margin: 0 auto;
        }

        .tg,
        .fam {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }

        .tg td {
            font-family: Arial, sans-serif;
            font-size: 13px;
            overflow: hidden;
            padding: 0px;
            word-break: normal;
        }

        .tg th {
            font-family: Arial, sans-serif;
            font-size: 13px;
            font-weight: normal;
            overflow: hidden;
            padding: 0px;
            word-break: normal;
        }

        .tg .tg-0lax {
            text-align: center;
            vertical-align: top;
            text-align: center;
        }

        .tg-0lax.left{
            width: 30%;
        }
        .tg-0lax.right{
            width: 70%;
        }

        @media screen and (max-width: 767px) {
            .tg {
                width: 95% !important;
            }

            .tg col {
                width: auto !important;
            }

            .tg-wrap {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

        }

        /* family */
        .fam tr td,
        .fam tr th {
            text-align: center;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <div class="tg-wrap">
        <table class="tg">
            <tbody>
                <tr>
                    <td class="tg-0lax left">
                        <!-- data keluarga -->
                        <table class="fam">
                            <tr style="background-color: cyan;">
                                <th style="width:10%; padding:3px; font-weight:bold;">No</th>
                                <th style="width:20%; padding:3px; font-weight:bold;">No KK</th>
                                <th style="width:50%; padding:3px; font-weight:bold;">Nama KK</th>
                                <th style="width:20%; padding:3px; font-weight:bold;">No RUMAH</th>
                            </tr>
                            <?php $no = 1;
                            foreach ($keluarga as $kel) : ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td style="color:royalblue"><?= $kel->no_kk ?></td>
                                    <td><?= $kel->nama_kk ?></td>
                                    <td style="color:red"><?= $kel->no_rumah ?></td>
                                </tr>
                            <?php $no++;
                            endforeach ?>
                        </table>
                    </td>
                    <td class="tg-0lax right">
                        <!-- data peta -->
                        <div style="text-align: center;">
                            <h2><?= $peta->peta_title ?></h2>
                            <h3>RT: <?= $peta->rt ?>, DUSUN/ RW : <?= $peta->dusun ?>/ <?= $peta->rw ?></h3>
                        </div>
                        <img src="<?= base_url('/assets/dist/img/peta/' . $peta->peta_img) ?>" height="400px" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>