DROP TYPE IF EXISTS ya_tidak;
CREATE TYPE "ya_tidak" AS ENUM (
  'ya',
  'tidak'
);

DROP TYPE IF EXISTS kategori_usaha;
CREATE TYPE "kategori_usaha" AS ENUM (
  'usaha_kecil',
  'usaha_non_kecil'
);

DROP TYPE IF EXISTS kategori_dipa;
CREATE TYPE "kategori_dipa" AS ENUM (
  'pra_dipa',
  'dipa'
);

DROP TABLE IF EXISTS "ref_metode_pengadaan";
CREATE TABLE "ref_metode_pengadaan" (
  "kode_metode_pengadaan" int2 PRIMARY KEY,
  "metode_pengadaan" varchar
);

DROP TABLE IF EXISTS "ref_jenis_pengadaan";
CREATE TABLE "ref_jenis_pengadaan" (
  "kode_jenis_pengadaan" int,
  "jenis_pengadaan" varchar
);

DROP TABLE if EXISTS "ref_rup";
CREATE TABLE "ref_rup" (
  "kode_rup" serial PRIMARY KEY,
  "no_rup" varchar,
  "kode_unit" varchar(20),
  "nama_paket" varchar,
  "lokasi" varchar,
  "detail_lokasi" varchar,
  "tahun_anggaran" int,
  "uraian_pekerjaan" varchar,
  "spesifikasi_pekerjaan" varchar,
  "jml_pagu" decimal,
  "volume_pekerjaan" varchar,
  "satuan_volume" varchar,
  "prod_dalam_negri" ya_tidak,
  "kategori_usaha" kategori_usaha,
  "kategori_dipa" kategori_dipa,
  "no_izin_thn_jamak" varchar,
  "kode_metode_pengadaan" int2,
  "kode_jenis_pengadaan" int2,
  "tgl_renc_pemilihan_awal" date,
  "tgl_renc_pemilihan_akhir" date,
  "tgl_renc_pelaksanaan_awal" date,
  "tgl_renc_pelaksanaan_akhir" date,
  "tgl_renc_pemanfaatan_awal" date,
  "tgl_renc_pemanfaatan_akhir" date,
  "ucr" varchar,
  "uch" varchar,
  "udcr" timestamptz,
  "udch" timestamptz
);