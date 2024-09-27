<?php

$query = "TRUNCATE TABLE ref_rup";
$dbNew->query($query);
echo $query . PHP_EOL;

$query = "SELECT * FROM tbl_rup_ut ORDER BY id_rup_ut ASC";
$res = $dbOld->query($query);

while ($obj = $dbOld->fetch_object($res))
{
    $kode_rup = $obj->id_rup_ut;
    $no_rup = $obj->nomor_rup_ut;
    $kode_unit = $obj->kode_unit;
    $nama_paket = $dbNew->escape_string($obj->nama_paket);
    $lokasi = $obj->lokasi;
    $detail_lokasi = $dbNew->escape_string($obj->detail_lokasi);
    $tahun_anggaran = $obj->tahun_anggaran;

    $uraian_pekerjaan = $dbNew->escape_string($obj->uraian_pekerjaan);

    $spesifikasi_pekerjaan = $dbNew->escape_string($obj->spesifikasi_pekerjaan);
    $jml_pagu = $obj->jumlah_pagu;
    $volume_pekerjaan = $obj->volume_pekerjaan;
    $satuan_volume = $obj->satuan;

    $prod_dalam_negri = $obj->produk_dalam_negeri;

    $kategori_usaha = $obj->usaha;
    if ($kategori_usaha == 'kecil') {
        $kategori_usaha = 'usaha_kecil';
    }
    elseif ($kategori_usaha == 'non-kecil') {
        $kategori_usaha = 'usaha_non_kecil';
    }

    $kategori_dipa = $obj->pra_dipa;
    if ($kategori_dipa == 'ya') {
        $kategori_dipa = 'pra_dipa';
    }
    elseif ($kategori_dipa == 'tidak') {
        $kategori_dipa = 'dipa';
    }
   
    $no_izin_thn_jamak = $dbNew->escape_string($obj->izin_tahun_jamak);

    $arrMetodePengadaan = [
        'Pembelian Langsung' => 1,
        'Pengadaan Langsung' => 2,
        'Penunjukan Langsung' => 3,
        'Quotation' => 4,
        'Tender' => 5
    ];
    $kode_metode_pengadaan = $arrMetodePengadaan[$obj->metode_pengadaan];

    $arrJenisPengadaan = [
        'Barang' => 1,
        'Konstruksi' => 2,
        'Jasa Konsultansi' => 3,
        'Jasa Lainnya' => 4
    ];
    $kode_jenis_pengadaan = $arrJenisPengadaan[$obj->jenis_pengadaan];

    $tgl_renc_pemilihan_awal = convertToFirstDayOfMonth($obj->rencana_pemilihan);
    $tgl_renc_pemilihan_awal = prepareString($dbNew, $tgl_renc_pemilihan_awal);

    $tgl_renc_pemilihan_akhir = convertToLastDayOfMonth($obj->rencana_pemilihan_akhir);
    $tgl_renc_pemilihan_akhir = prepareString($dbNew, $tgl_renc_pemilihan_akhir);

    $tgl_renc_pelaksanaan_awal = convertToFirstDayOfMonth($obj->rencana_pelaksanaan);
    $tgl_renc_pelaksanaan_awal = prepareString($dbNew, $tgl_renc_pelaksanaan_awal);

    $tgl_renc_pelaksanaan_akhir = convertToLastDayOfMonth($obj->rencana_pelaksanaan_akhir);
    $tgl_renc_pelaksanaan_akhir = prepareString($dbNew, $tgl_renc_pelaksanaan_akhir);

    $tgl_renc_pemanfaatan_awal = convertToFirstDayOfMonth($obj->rencana_pemanfaatan);
    $tgl_renc_pemanfaatan_awal = prepareString($dbNew, $tgl_renc_pemanfaatan_awal);

    $tgl_renc_pemanfaatan_akhir = convertToLastDayOfMonth($obj->rencana_pemanfaatan_akhir);
    $tgl_renc_pemanfaatan_akhir = prepareString($dbNew, $tgl_renc_pemanfaatan_akhir);

    $ucr = 'NULL';
    $uch = 'NULL';
    $udcr = $obj->created_at;
    $udch = $obj->updated_at;

    // $query = "INSERT INTO ref_rup (kode_rup, no_rup, kode_unit, nama_paket, lokasi, detail_lokasi, tahun_anggaran, uraian_pekerjaan, spesifikasi_pekerjaan, jml_pagu, volume_pekerjaan, satuan_volume, prod_dalam_negri, kategori_usaha, kategori_dipa, no_izin_thn_jamak, kode_metode_pengadaan, kode_jenis_pengadaan, tgl_renc_pemilihan_awal, tgl_renc_pemilihan_akhir, tgl_renc_pelaksanaan_awal, tgl_renc_pelaksanaan_akhir, tgl_renc_pemanfaatan_awal, tgl_renc_pemanfaatan_akhir, ucr, uch, udcr, udch)
    $query = "INSERT INTO ref_rup (kode_rup, no_rup, kode_unit, nama_paket, lokasi, detail_lokasi, tahun_anggaran, uraian_pekerjaan, spesifikasi_pekerjaan, jml_pagu, volume_pekerjaan, satuan_volume, prod_dalam_negri, kategori_usaha, kategori_dipa, no_izin_thn_jamak, kode_metode_pengadaan, kode_jenis_pengadaan, tgl_renc_pemilihan_awal, tgl_renc_pemilihan_akhir, tgl_renc_pelaksanaan_awal, tgl_renc_pelaksanaan_akhir, tgl_renc_pemanfaatan_awal, tgl_renc_pemanfaatan_akhir, ucr, uch, udcr, udch)
    VALUES (
        $kode_rup,
        '$no_rup',
        '$kode_unit',
        '$nama_paket',
        '$lokasi',
        '$detail_lokasi',
        $tahun_anggaran,
        '$uraian_pekerjaan',
        '$spesifikasi_pekerjaan',
        $jml_pagu,
        '$volume_pekerjaan',
        '$satuan_volume',
        '$prod_dalam_negri',
        '$kategori_usaha',
        '$kategori_dipa',
        '$no_izin_thn_jamak',
        $kode_metode_pengadaan,
        $kode_jenis_pengadaan,
        $tgl_renc_pemilihan_awal,
        $tgl_renc_pemilihan_akhir,
        $tgl_renc_pelaksanaan_awal,
        $tgl_renc_pelaksanaan_akhir,
        $tgl_renc_pemanfaatan_awal,
        $tgl_renc_pemanfaatan_akhir,
       '$ucr',
        '$uch',
        '$udcr',
        '$udch'
    )";

    $dbNew->query($query);

    echo 'nama_paket: ' . $nama_paket . PHP_EOL;
}
