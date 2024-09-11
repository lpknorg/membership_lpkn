<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Kota;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Kota::get()->count() < 1) {
            Kota::insert(
                array(
                    [
                        "id" =>  276,
                        "kota" =>  "Ende",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  277,
                        "kota" =>  "Flores Timur",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  242,
                        "kota" =>  "Aceh Barat",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  243,
                        "kota" =>  "Aceh Barat Daya",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  244,
                        "kota" =>  "Aceh Besar",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  245,
                        "kota" =>  "Aceh Jaya",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  246,
                        "kota" =>  "Aceh Selatan",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  247,
                        "kota" =>  "Aceh Singkil",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  248,
                        "kota" =>  "Aceh Tamiang",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  249,
                        "kota" =>  "Aceh Tengah",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  250,
                        "kota" =>  "Aceh Tenggara",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  251,
                        "kota" =>  "Aceh Timur",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  252,
                        "kota" =>  "Aceh Utara",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  423,
                        "kota" =>  "Agam",
                        "id_provinsi" =>  32,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  273,
                        "kota" =>  "Alor",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  221,
                        "kota" =>  "Ambon",
                        "id_provinsi" =>  19,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  458,
                        "kota" =>  "Asahan",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  296,
                        "kota" =>  "Asmat",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  6,
                        "kota" =>  "Badung",
                        "id_provinsi" =>  1,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  157,
                        "kota" =>  "Balangan",
                        "id_provinsi" =>  13,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  184,
                        "kota" =>  "Balikpapan",
                        "id_provinsi" =>  15,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  253,
                        "kota" =>  "Banda Aceh",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  206,
                        "kota" =>  "Bandar Lampung",
                        "id_provinsi" =>  18,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  67,
                        "kota" =>  "Bandung",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  77,
                        "kota" =>  "Bandung Barat",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  378,
                        "kota" =>  "Banggai",
                        "id_provinsi" =>  29,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  379,
                        "kota" =>  "Banggai Kepulauan",
                        "id_provinsi" =>  29,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  380,
                        "kota" =>  "Banggai Laut",
                        "id_provinsi" =>  29,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  15,
                        "kota" =>  "Bangka",
                        "id_provinsi" =>  2,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  11,
                        "kota" =>  "Bangka Barat",
                        "id_provinsi" =>  2,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  10,
                        "kota" =>  "Bangka Selatan",
                        "id_provinsi" =>  2,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  14,
                        "kota" =>  "Bangka Tengah",
                        "id_provinsi" =>  2,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  112,
                        "kota" =>  "Bangkalan",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  2,
                        "kota" =>  "Bangli",
                        "id_provinsi" =>  1,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  79,
                        "kota" =>  "Banjar",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  158,
                        "kota" =>  "Banjar",
                        "id_provinsi" =>  13,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  159,
                        "kota" =>  "Banjarbaru",
                        "id_provinsi" =>  13,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  160,
                        "kota" =>  "Banjarmasin",
                        "id_provinsi" =>  13,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  98,
                        "kota" =>  "Banjarnegara",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  354,
                        "kota" =>  "Bantaeng",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  37,
                        "kota" =>  "Bantul",
                        "id_provinsi" =>  5,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  441,
                        "kota" =>  "Banyuasin",
                        "id_provinsi" =>  33,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  97,
                        "kota" =>  "Banyumas",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  113,
                        "kota" =>  "Banyuwangi",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  161,
                        "kota" =>  "Barito Kuala",
                        "id_provinsi" =>  13,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  170,
                        "kota" =>  "Barito Selatan",
                        "id_provinsi" =>  14,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  171,
                        "kota" =>  "Barito Timur",
                        "id_provinsi" =>  14,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  172,
                        "kota" =>  "Barito Utara",
                        "id_provinsi" =>  14,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  355,
                        "kota" =>  "Barru",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  199,
                        "kota" =>  "Batam",
                        "id_provinsi" =>  17,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  82,
                        "kota" =>  "Batang",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  59,
                        "kota" =>  "Batang Hari",
                        "id_provinsi" =>  8,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  114,
                        "kota" =>  "Batu",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  459,
                        "kota" =>  "Batu Bara",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  391,
                        "kota" =>  "Bau-Bau",
                        "id_provinsi" =>  30,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  71,
                        "kota" =>  "Bekasi",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  12,
                        "kota" =>  "Belitung",
                        "id_provinsi" =>  2,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  16,
                        "kota" =>  "Belitung Timur",
                        "id_provinsi" =>  2,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  274,
                        "kota" =>  "Belu",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  254,
                        "kota" =>  "Bener Meriah",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  336,
                        "kota" =>  "Bengkalis",
                        "id_provinsi" =>  26,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  143,
                        "kota" =>  "Bengkayang",
                        "id_provinsi" =>  12,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  25,
                        "kota" =>  "Bengkulu",
                        "id_provinsi" =>  4,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  29,
                        "kota" =>  "Bengkulu Selatan",
                        "id_provinsi" =>  4,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  24,
                        "kota" =>  "Bengkulu Tengah",
                        "id_provinsi" =>  4,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  32,
                        "kota" =>  "Bengkulu Utara",
                        "id_provinsi" =>  4,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  185,
                        "kota" =>  "Berau",
                        "id_provinsi" =>  15,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  297,
                        "kota" =>  "Biak Numfor",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  264,
                        "kota" =>  "Bima",
                        "id_provinsi" =>  22,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  460,
                        "kota" =>  "Binjai",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  200,
                        "kota" =>  "Bintan",
                        "id_provinsi" =>  17,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  255,
                        "kota" =>  "Bireuen",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  408,
                        "kota" =>  "Bitung",
                        "id_provinsi" =>  31,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  115,
                        "kota" =>  "Blitar",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  103,
                        "kota" =>  "Blora",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  44,
                        "kota" =>  "Boalemo",
                        "id_provinsi" =>  7,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  69,
                        "kota" =>  "Bogor",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  116,
                        "kota" =>  "Bojonegoro",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  409,
                        "kota" =>  "Bolaang Mongondow",
                        "id_provinsi" =>  31,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  410,
                        "kota" =>  "Bolaang Mongondow Selatan",
                        "id_provinsi" =>  31,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  411,
                        "kota" =>  "Bolaang Mongondow Timur",
                        "id_provinsi" =>  31,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  412,
                        "kota" =>  "Bolaang Mongondow Utara",
                        "id_provinsi" =>  31,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  392,
                        "kota" =>  "Bombana",
                        "id_provinsi" =>  30,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  117,
                        "kota" =>  "Bondowoso",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  356,
                        "kota" =>  "Bone",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  48,
                        "kota" =>  "Bone Bolango",
                        "id_provinsi" =>  7,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  186,
                        "kota" =>  "Bontang",
                        "id_provinsi" =>  15,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  298,
                        "kota" =>  "Boven Digoel",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  84,
                        "kota" =>  "Boyolali",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  99,
                        "kota" =>  "Brebes",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  424,
                        "kota" =>  "Bukittinggi",
                        "id_provinsi" =>  32,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  3,
                        "kota" =>  "Buleleng",
                        "id_provinsi" =>  1,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  357,
                        "kota" =>  "Bulukumba",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  194,
                        "kota" =>  "Bulungan",
                        "id_provinsi" =>  16,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  53,
                        "kota" =>  "Bungo",
                        "id_provinsi" =>  8,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  381,
                        "kota" =>  "Buol",
                        "id_provinsi" =>  29,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  222,
                        "kota" =>  "Buru",
                        "id_provinsi" =>  19,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  223,
                        "kota" =>  "Buru Selatan",
                        "id_provinsi" =>  19,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  393,
                        "kota" =>  "Buton",
                        "id_provinsi" =>  30,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  394,
                        "kota" =>  "Buton Selatan",
                        "id_provinsi" =>  30,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  395,
                        "kota" =>  "Buton Tengah",
                        "id_provinsi" =>  30,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  396,
                        "kota" =>  "Buton Utara",
                        "id_provinsi" =>  30,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  74,
                        "kota" =>  "Ciamis",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  62,
                        "kota" =>  "Cianjur",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  100,
                        "kota" =>  "Cilacap",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  22,
                        "kota" =>  "Cilegon",
                        "id_provinsi" =>  3,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  80,
                        "kota" =>  "Cimahi",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  61,
                        "kota" =>  "Cirebon",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  461,
                        "kota" =>  "Dairi",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  299,
                        "kota" =>  "Deiyai",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  462,
                        "kota" =>  "Deli Serdang",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  86,
                        "kota" =>  "Demak",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  9,
                        "kota" =>  "Denpasar",
                        "id_provinsi" =>  1,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  72,
                        "kota" =>  "Depok",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  425,
                        "kota" =>  "Dharmasraya",
                        "id_provinsi" =>  32,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  300,
                        "kota" =>  "Dogiyai",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  265,
                        "kota" =>  "Dompu",
                        "id_provinsi" =>  22,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  382,
                        "kota" =>  "Donggala",
                        "id_provinsi" =>  29,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  337,
                        "kota" =>  "Dumai",
                        "id_provinsi" =>  26,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  442,
                        "kota" =>  "Empat Lawang",
                        "id_provinsi" =>  33,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  275,
                        "kota" =>  "Ende",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  358,
                        "kota" =>  "Enrekang",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  324,
                        "kota" =>  "Fakfak",
                        "id_provinsi" =>  25,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  278,
                        "kota" =>  "Flores Timur",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  65,
                        "kota" =>  "Garut",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  256,
                        "kota" =>  "Gayo Lues",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  1,
                        "kota" =>  "Gianyar",
                        "id_provinsi" =>  1,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  47,
                        "kota" =>  "Gorontalo",
                        "id_provinsi" =>  7,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  46,
                        "kota" =>  "Gorontalo Utara",
                        "id_provinsi" =>  7,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  359,
                        "kota" =>  "Gowa",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  118,
                        "kota" =>  "Gresik",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  89,
                        "kota" =>  "Grobogan",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  33,
                        "kota" =>  "Gunung Kidul",
                        "id_provinsi" =>  5,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  173,
                        "kota" =>  "Gunung Mas",
                        "id_provinsi" =>  14,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  463,
                        "kota" =>  "Gunungsitoli",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  232,
                        "kota" =>  "Halmahera Barat",
                        "id_provinsi" =>  20,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  233,
                        "kota" =>  "Halmahera Selatan",
                        "id_provinsi" =>  20,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  234,
                        "kota" =>  "Halmahera Tengah",
                        "id_provinsi" =>  20,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  235,
                        "kota" =>  "Halmahera Timur",
                        "id_provinsi" =>  20,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  236,
                        "kota" =>  "Halmahera Utara",
                        "id_provinsi" =>  20,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  162,
                        "kota" =>  "Hulu Sungai Selatan",
                        "id_provinsi" =>  13,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  163,
                        "kota" =>  "Hulu Sungai Tengah",
                        "id_provinsi" =>  13,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  164,
                        "kota" =>  "Hulu Sungai Utara",
                        "id_provinsi" =>  13,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  464,
                        "kota" =>  "Humbang Hasundutan",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  338,
                        "kota" =>  "Indragiri Hilir",
                        "id_provinsi" =>  26,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  339,
                        "kota" =>  "Indragiri Hulu",
                        "id_provinsi" =>  26,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  60,
                        "kota" =>  "Indramayu",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  301,
                        "kota" =>  "Intan Jaya",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  41,
                        "kota" =>  "Jakarta Barat",
                        "id_provinsi" =>  6,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  40,
                        "kota" =>  "Jakarta Pusat",
                        "id_provinsi" =>  6,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  38,
                        "kota" =>  "Jakarta Selatan",
                        "id_provinsi" =>  6,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  42,
                        "kota" =>  "Jakarta Timur",
                        "id_provinsi" =>  6,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  39,
                        "kota" =>  "Jakarta Utara",
                        "id_provinsi" =>  6,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  52,
                        "kota" =>  "Jambi",
                        "id_provinsi" =>  8,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  302,
                        "kota" =>  "Jayapura",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  303,
                        "kota" =>  "Jayawijaya",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  119,
                        "kota" =>  "Jember",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  7,
                        "kota" =>  "Jembrana",
                        "id_provinsi" =>  1,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  360,
                        "kota" =>  "Jeneponto",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  94,
                        "kota" =>  "Jepara",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  120,
                        "kota" =>  "Jombang",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  325,
                        "kota" =>  "Kaimana",
                        "id_provinsi" =>  25,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  340,
                        "kota" =>  "Kampar",
                        "id_provinsi" =>  26,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  174,
                        "kota" =>  "Kapuas",
                        "id_provinsi" =>  14,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  144,
                        "kota" =>  "Kapuas Hulu",
                        "id_provinsi" =>  12,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  105,
                        "kota" =>  "Karanganyar",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  5,
                        "kota" =>  "Karangasem",
                        "id_provinsi" =>  1,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  68,
                        "kota" =>  "Karawang",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  201,
                        "kota" =>  "Karimun",
                        "id_provinsi" =>  17,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  465,
                        "kota" =>  "Karo",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  175,
                        "kota" =>  "Katingan",
                        "id_provinsi" =>  14,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  28,
                        "kota" =>  "Kaur",
                        "id_provinsi" =>  4,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  145,
                        "kota" =>  "Kayong Utara",
                        "id_provinsi" =>  12,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  108,
                        "kota" =>  "Kebumen",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  121,
                        "kota" =>  "Kediri",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  304,
                        "kota" =>  "Keerom",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  93,
                        "kota" =>  "Kendal",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  397,
                        "kota" =>  "Kendari",
                        "id_provinsi" =>  30,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  30,
                        "kota" =>  "Kepahiang",
                        "id_provinsi" =>  4,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  202,
                        "kota" =>  "Kepulauan Anambas",
                        "id_provinsi" =>  17,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  224,
                        "kota" =>  "Kepulauan Aru",
                        "id_provinsi" =>  19,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  426,
                        "kota" =>  "Kepulauan Mentawai",
                        "id_provinsi" =>  32,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  341,
                        "kota" =>  "Kepulauan Meranti",
                        "id_provinsi" =>  26,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  413,
                        "kota" =>  "Kepulauan Sangihe",
                        "id_provinsi" =>  31,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  361,
                        "kota" =>  "Kepulauan Selayar",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  43,
                        "kota" =>  "Kepulauan Seribu",
                        "id_provinsi" =>  6,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  414,
                        "kota" =>  "Kepulauan Siau Tagulandang Biaro (Sitaro)",
                        "id_provinsi" =>  31,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  237,
                        "kota" =>  "Kepulauan Sula",
                        "id_provinsi" =>  20,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  415,
                        "kota" =>  "Kepulauan Talaud",
                        "id_provinsi" =>  31,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  305,
                        "kota" =>  "Kepulauan Yapen",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  56,
                        "kota" =>  "Kerinci",
                        "id_provinsi" =>  8,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  146,
                        "kota" =>  "Ketapang",
                        "id_provinsi" =>  12,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  85,
                        "kota" =>  "Klaten",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  8,
                        "kota" =>  "Klungkung",
                        "id_provinsi" =>  1,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  398,
                        "kota" =>  "Kolaka",
                        "id_provinsi" =>  30,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  399,
                        "kota" =>  "Kolaka Timur",
                        "id_provinsi" =>  30,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  400,
                        "kota" =>  "Kolaka Utara",
                        "id_provinsi" =>  30,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  401,
                        "kota" =>  "Konawe",
                        "id_provinsi" =>  30,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  402,
                        "kota" =>  "Konawe Kepulauan",
                        "id_provinsi" =>  30,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  403,
                        "kota" =>  "Konawe Selatan",
                        "id_provinsi" =>  30,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  404,
                        "kota" =>  "Konawe Utara",
                        "id_provinsi" =>  30,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  165,
                        "kota" =>  "Kotabaru",
                        "id_provinsi" =>  13,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  416,
                        "kota" =>  "Kotamobagu",
                        "id_provinsi" =>  31,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  176,
                        "kota" =>  "Kotawaringin Barat",
                        "id_provinsi" =>  14,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  177,
                        "kota" =>  "Kotawaringin Timur",
                        "id_provinsi" =>  14,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  342,
                        "kota" =>  "Kuantan Singingi",
                        "id_provinsi" =>  26,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  147,
                        "kota" =>  "Kubu Raya",
                        "id_provinsi" =>  12,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  102,
                        "kota" =>  "Kudus",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  35,
                        "kota" =>  "Kulon Progo",
                        "id_provinsi" =>  5,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  76,
                        "kota" =>  "Kuningan",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  279,
                        "kota" =>  "Kupang",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  187,
                        "kota" =>  "Kutai Barat",
                        "id_provinsi" =>  15,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  188,
                        "kota" =>  "Kutai Kartanegara",
                        "id_provinsi" =>  15,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  189,
                        "kota" =>  "Kutai Timur",
                        "id_provinsi" =>  15,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  466,
                        "kota" =>  "Labuhanbatu",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  467,
                        "kota" =>  "Labuhanbatu Selatan",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  468,
                        "kota" =>  "Labuhanbatu Utara",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  443,
                        "kota" =>  "Lahat",
                        "id_provinsi" =>  33,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  178,
                        "kota" =>  "Lamandau",
                        "id_provinsi" =>  14,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  122,
                        "kota" =>  "Lamongan",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  207,
                        "kota" =>  "Lampung Barat",
                        "id_provinsi" =>  18,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  208,
                        "kota" =>  "Lampung Selatan",
                        "id_provinsi" =>  18,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  209,
                        "kota" =>  "Lampung Tengah",
                        "id_provinsi" =>  18,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  210,
                        "kota" =>  "Lampung Timur",
                        "id_provinsi" =>  18,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  211,
                        "kota" =>  "Lampung Utara",
                        "id_provinsi" =>  18,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  148,
                        "kota" =>  "Landak",
                        "id_provinsi" =>  12,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  469,
                        "kota" =>  "Langkat",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  306,
                        "kota" =>  "Lanny Jaya",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  17,
                        "kota" =>  "Lebak",
                        "id_provinsi" =>  3,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  31,
                        "kota" =>  "Lebong",
                        "id_provinsi" =>  4,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  280,
                        "kota" =>  "Lembata",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  257,
                        "kota" =>  "Lhokseumawe",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  427,
                        "kota" =>  "Lima Puluh Kota",
                        "id_provinsi" =>  32,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  203,
                        "kota" =>  "Lingga",
                        "id_provinsi" =>  17,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  266,
                        "kota" =>  "Lombok Barat",
                        "id_provinsi" =>  22,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  267,
                        "kota" =>  "Lombok Tengah",
                        "id_provinsi" =>  22,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  268,
                        "kota" =>  "Lombok Timur",
                        "id_provinsi" =>  22,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  269,
                        "kota" =>  "Lombok Utara",
                        "id_provinsi" =>  22,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  444,
                        "kota" =>  "Lubuk Linggau",
                        "id_provinsi" =>  33,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  123,
                        "kota" =>  "Lumajang",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  362,
                        "kota" =>  "Luwu",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  363,
                        "kota" =>  "Luwu Timur",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  364,
                        "kota" =>  "Luwu Utara",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  124,
                        "kota" =>  "Madiun",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  91,
                        "kota" =>  "Magelang",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  125,
                        "kota" =>  "Magetan",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  190,
                        "kota" =>  "Mahakam Ulu",
                        "id_provinsi" =>  15,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  75,
                        "kota" =>  "Majalengka",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  348,
                        "kota" =>  "Majene",
                        "id_provinsi" =>  27,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  365,
                        "kota" =>  "Makassar",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  281,
                        "kota" =>  "Malaka",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  126,
                        "kota" =>  "Malang",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  195,
                        "kota" =>  "Malinau",
                        "id_provinsi" =>  16,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  225,
                        "kota" =>  "Maluku Barat Daya",
                        "id_provinsi" =>  19,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  226,
                        "kota" =>  "Maluku Tengah",
                        "id_provinsi" =>  19,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  227,
                        "kota" =>  "Maluku Tenggara",
                        "id_provinsi" =>  19,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  228,
                        "kota" =>  "Maluku Tenggara Barat",
                        "id_provinsi" =>  19,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  349,
                        "kota" =>  "Mamasa",
                        "id_provinsi" =>  27,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  307,
                        "kota" =>  "Mamberamo Raya",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  308,
                        "kota" =>  "Mamberamo Tengah",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  350,
                        "kota" =>  "Mamuju",
                        "id_provinsi" =>  27,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  351,
                        "kota" =>  "Mamuju Tengah",
                        "id_provinsi" =>  27,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  352,
                        "kota" =>  "Mamuju Utara",
                        "id_provinsi" =>  27,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  417,
                        "kota" =>  "Manado",
                        "id_provinsi" =>  31,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  470,
                        "kota" =>  "Mandailing Natal",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  282,
                        "kota" =>  "Manggarai",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  283,
                        "kota" =>  "Manggarai Barat",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  284,
                        "kota" =>  "Manggarai Timur",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  326,
                        "kota" =>  "Manokwari",
                        "id_provinsi" =>  25,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  327,
                        "kota" =>  "Manokwari Selatan",
                        "id_provinsi" =>  25,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  309,
                        "kota" =>  "Mappi",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  366,
                        "kota" =>  "Maros",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  270,
                        "kota" =>  "Mataram",
                        "id_provinsi" =>  22,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  328,
                        "kota" =>  "Maybrat",
                        "id_provinsi" =>  25,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  471,
                        "kota" =>  "Medan",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  149,
                        "kota" =>  "Melawi",
                        "id_provinsi" =>  12,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  150,
                        "kota" =>  "Mempawah",
                        "id_provinsi" =>  12,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  51,
                        "kota" =>  "Merangin",
                        "id_provinsi" =>  8,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  310,
                        "kota" =>  "Merauke",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  212,
                        "kota" =>  "Mesuji",
                        "id_provinsi" =>  18,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  213,
                        "kota" =>  "Metro",
                        "id_provinsi" =>  18,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  311,
                        "kota" =>  "Mimika",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  418,
                        "kota" =>  "Minahasa",
                        "id_provinsi" =>  31,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  419,
                        "kota" =>  "Minahasa Selatan",
                        "id_provinsi" =>  31,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  420,
                        "kota" =>  "Minahasa Tenggara",
                        "id_provinsi" =>  31,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  421,
                        "kota" =>  "Minahasa Utara",
                        "id_provinsi" =>  31,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  127,
                        "kota" =>  "Mojokerto",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  383,
                        "kota" =>  "Morowali",
                        "id_provinsi" =>  29,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  384,
                        "kota" =>  "Morowali Utara",
                        "id_provinsi" =>  29,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  445,
                        "kota" =>  "Muara Enim",
                        "id_provinsi" =>  33,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  55,
                        "kota" =>  "Muaro Jambi",
                        "id_provinsi" =>  8,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  26,
                        "kota" =>  "Muko Muko",
                        "id_provinsi" =>  4,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  405,
                        "kota" =>  "Muna",
                        "id_provinsi" =>  30,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  406,
                        "kota" =>  "Muna Barat",
                        "id_provinsi" =>  30,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  179,
                        "kota" =>  "Murung Raya",
                        "id_provinsi" =>  14,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  446,
                        "kota" =>  "Musi Banyuasin",
                        "id_provinsi" =>  33,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  447,
                        "kota" =>  "Musi Rawas",
                        "id_provinsi" =>  33,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  448,
                        "kota" =>  "Musi Rawas Utara",
                        "id_provinsi" =>  33,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  312,
                        "kota" =>  "Nabire",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  258,
                        "kota" =>  "Nagan Raya",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  285,
                        "kota" =>  "Nagekeo",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  204,
                        "kota" =>  "Natuna",
                        "id_provinsi" =>  17,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  313,
                        "kota" =>  "Nduga",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  286,
                        "kota" =>  "Ngada",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  128,
                        "kota" =>  "Nganjuk",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  129,
                        "kota" =>  "Ngawi",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  472,
                        "kota" =>  "Nias",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  473,
                        "kota" =>  "Nias Barat",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  474,
                        "kota" =>  "Nias Selatan",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  475,
                        "kota" =>  "Nias Utara",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  196,
                        "kota" =>  "Nunukan",
                        "id_provinsi" =>  16,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  449,
                        "kota" =>  "Ogan Ilir",
                        "id_provinsi" =>  33,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  450,
                        "kota" =>  "Ogan Komering Ilir",
                        "id_provinsi" =>  33,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  451,
                        "kota" =>  "Ogan Komering Ulu",
                        "id_provinsi" =>  33,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  452,
                        "kota" =>  "Ogan Komering Ulu Selatan",
                        "id_provinsi" =>  33,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  453,
                        "kota" =>  "Ogan Komering Ulu Timur",
                        "id_provinsi" =>  33,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  130,
                        "kota" =>  "Pacitan",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  428,
                        "kota" =>  "Padang",
                        "id_provinsi" =>  32,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  476,
                        "kota" =>  "Padang Lawas",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  477,
                        "kota" =>  "Padang Lawas Utara",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  429,
                        "kota" =>  "Padang Panjang",
                        "id_provinsi" =>  32,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  430,
                        "kota" =>  "Padang Pariaman",
                        "id_provinsi" =>  32,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  478,
                        "kota" =>  "Padang Sidempuan",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  454,
                        "kota" =>  "Pagar Alam",
                        "id_provinsi" =>  33,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  479,
                        "kota" =>  "Pakpak Bharat",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  180,
                        "kota" =>  "Palangka Raya",
                        "id_provinsi" =>  14,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  455,
                        "kota" =>  "Palembang",
                        "id_provinsi" =>  33,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  367,
                        "kota" =>  "Palopo",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  385,
                        "kota" =>  "Palu",
                        "id_provinsi" =>  29,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  131,
                        "kota" =>  "Pamekasan",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  20,
                        "kota" =>  "Pandeglang",
                        "id_provinsi" =>  3,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  78,
                        "kota" =>  "Pangandaran",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  368,
                        "kota" =>  "Pangkajene Kepulauan",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  13,
                        "kota" =>  "Pangkal Pinang",
                        "id_provinsi" =>  2,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  314,
                        "kota" =>  "Paniai",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  369,
                        "kota" =>  "Parepare",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  431,
                        "kota" =>  "Pariaman",
                        "id_provinsi" =>  32,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  386,
                        "kota" =>  "Parigi Moutong",
                        "id_provinsi" =>  29,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  432,
                        "kota" =>  "Pasaman",
                        "id_provinsi" =>  32,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  433,
                        "kota" =>  "Pasaman Barat",
                        "id_provinsi" =>  32,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  191,
                        "kota" =>  "Paser",
                        "id_provinsi" =>  15,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  132,
                        "kota" =>  "Pasuruan",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  90,
                        "kota" =>  "Pati",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  434,
                        "kota" =>  "Payakumbuh",
                        "id_provinsi" =>  32,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  329,
                        "kota" =>  "Pegunungan Arfak",
                        "id_provinsi" =>  25,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  315,
                        "kota" =>  "Pegunungan Bintang",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  87,
                        "kota" =>  "Pekalongan",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  343,
                        "kota" =>  "Pekanbaru",
                        "id_provinsi" =>  26,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  344,
                        "kota" =>  "Pelalawan",
                        "id_provinsi" =>  26,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  95,
                        "kota" =>  "Pemalang",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  480,
                        "kota" =>  "Pematang Siantar",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  192,
                        "kota" =>  "Penajam Paser Utara",
                        "id_provinsi" =>  15,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  456,
                        "kota" =>  "Penukal Abab Lematang Ilir",
                        "id_provinsi" =>  33,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  214,
                        "kota" =>  "Pesawaran",
                        "id_provinsi" =>  18,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  215,
                        "kota" =>  "Pesisir Barat",
                        "id_provinsi" =>  18,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  435,
                        "kota" =>  "Pesisir Selatan",
                        "id_provinsi" =>  32,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  259,
                        "kota" =>  "Pidie",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  260,
                        "kota" =>  "Pidie Jaya",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  370,
                        "kota" =>  "Pinrang",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  45,
                        "kota" =>  "Pohuwato",
                        "id_provinsi" =>  7,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  353,
                        "kota" =>  "Polewali Mandar",
                        "id_provinsi" =>  27,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  133,
                        "kota" =>  "Ponorogo",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  151,
                        "kota" =>  "Pontianak",
                        "id_provinsi" =>  12,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  387,
                        "kota" =>  "Poso",
                        "id_provinsi" =>  29,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  457,
                        "kota" =>  "Prabumulih",
                        "id_provinsi" =>  33,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  216,
                        "kota" =>  "Pringsewu",
                        "id_provinsi" =>  18,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  134,
                        "kota" =>  "Probolinggo",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  181,
                        "kota" =>  "Pulang Pisau",
                        "id_provinsi" =>  14,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  238,
                        "kota" =>  "Pulau Morotai",
                        "id_provinsi" =>  20,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  239,
                        "kota" =>  "Pulau Taliabu",
                        "id_provinsi" =>  20,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  316,
                        "kota" =>  "Puncak",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  317,
                        "kota" =>  "Puncak Jaya",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  110,
                        "kota" =>  "Purbalingga",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  64,
                        "kota" =>  "Purwakarta",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  111,
                        "kota" =>  "Purworejo",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  330,
                        "kota" =>  "Raja Ampat",
                        "id_provinsi" =>  25,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  27,
                        "kota" =>  "Rejang Lebong",
                        "id_provinsi" =>  4,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  107,
                        "kota" =>  "Rembang",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  345,
                        "kota" =>  "Rokan Hilir",
                        "id_provinsi" =>  26,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  346,
                        "kota" =>  "Rokan Hulu",
                        "id_provinsi" =>  26,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  287,
                        "kota" =>  "Rote Ndao",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  261,
                        "kota" =>  "Sabang",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  288,
                        "kota" =>  "Sabu Raijua",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  104,
                        "kota" =>  "Salatiga",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  193,
                        "kota" =>  "Samarinda",
                        "id_provinsi" =>  15,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  152,
                        "kota" =>  "Sambas",
                        "id_provinsi" =>  12,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  481,
                        "kota" =>  "Samosir",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  135,
                        "kota" =>  "Sampang",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  153,
                        "kota" =>  "Sanggau",
                        "id_provinsi" =>  12,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  318,
                        "kota" =>  "Sarmi",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  57,
                        "kota" =>  "Sarolangun",
                        "id_provinsi" =>  8,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  436,
                        "kota" =>  "Sawah Lunto",
                        "id_provinsi" =>  32,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  154,
                        "kota" =>  "Sekadau",
                        "id_provinsi" =>  12,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  23,
                        "kota" =>  "Seluma",
                        "id_provinsi" =>  4,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  101,
                        "kota" =>  "Semarang",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  229,
                        "kota" =>  "Seram Bagian Barat",
                        "id_provinsi" =>  19,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  230,
                        "kota" =>  "Seram Bagian Timur",
                        "id_provinsi" =>  19,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  18,
                        "kota" =>  "Serang",
                        "id_provinsi" =>  3,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  482,
                        "kota" =>  "Serdang Bedagai",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  182,
                        "kota" =>  "Seruyan",
                        "id_provinsi" =>  14,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  347,
                        "kota" =>  "Siak",
                        "id_provinsi" =>  26,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  483,
                        "kota" =>  "Sibolga",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  371,
                        "kota" =>  "Sidenreng Rappang",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  136,
                        "kota" =>  "Sidoarjo",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  388,
                        "kota" =>  "Sigi",
                        "id_provinsi" =>  29,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  437,
                        "kota" =>  "Sijunjung",
                        "id_provinsi" =>  32,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  289,
                        "kota" =>  "Sikka",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  484,
                        "kota" =>  "Simalungun",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  262,
                        "kota" =>  "Simeulue",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  155,
                        "kota" =>  "Singkawang",
                        "id_provinsi" =>  12,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  372,
                        "kota" =>  "Sinjai",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  156,
                        "kota" =>  "Sintang",
                        "id_provinsi" =>  12,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  137,
                        "kota" =>  "Situbondo",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  36,
                        "kota" =>  "Sleman",
                        "id_provinsi" =>  5,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  438,
                        "kota" =>  "Solok",
                        "id_provinsi" =>  32,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  439,
                        "kota" =>  "Solok Selatan",
                        "id_provinsi" =>  32,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  373,
                        "kota" =>  "Soppeng",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  331,
                        "kota" =>  "Sorong",
                        "id_provinsi" =>  25,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  332,
                        "kota" =>  "Sorong Selatan",
                        "id_provinsi" =>  25,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  106,
                        "kota" =>  "Sragen",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  73,
                        "kota" =>  "Subang",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  263,
                        "kota" =>  "Subulussalam",
                        "id_provinsi" =>  21,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  63,
                        "kota" =>  "Sukabumi",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  183,
                        "kota" =>  "Sukamara",
                        "id_provinsi" =>  14,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  92,
                        "kota" =>  "Sukoharjo",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  290,
                        "kota" =>  "Sumba Barat",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  291,
                        "kota" =>  "Sumba Barat Daya",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  292,
                        "kota" =>  "Sumba Tengah",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  293,
                        "kota" =>  "Sumba Timur",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  271,
                        "kota" =>  "Sumbawa",
                        "id_provinsi" =>  22,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  272,
                        "kota" =>  "Sumbawa Barat",
                        "id_provinsi" =>  22,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  66,
                        "kota" =>  "Sumedang",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  138,
                        "kota" =>  "Sumenep",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  54,
                        "kota" =>  "Sungaipenuh",
                        "id_provinsi" =>  8,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  319,
                        "kota" =>  "Supiori",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  139,
                        "kota" =>  "Surabaya",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  109,
                        "kota" =>  "Surakarta",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  166,
                        "kota" =>  "Tabalong",
                        "id_provinsi" =>  13,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  4,
                        "kota" =>  "Tabanan",
                        "id_provinsi" =>  1,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  374,
                        "kota" =>  "Takalar",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  333,
                        "kota" =>  "Tambrauw",
                        "id_provinsi" =>  25,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  197,
                        "kota" =>  "Tana Tidung",
                        "id_provinsi" =>  16,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  375,
                        "kota" =>  "Tana Toraja",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  167,
                        "kota" =>  "Tanah Bumbu",
                        "id_provinsi" =>  13,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  440,
                        "kota" =>  "Tanah Datar",
                        "id_provinsi" =>  32,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  168,
                        "kota" =>  "Tanah Laut",
                        "id_provinsi" =>  13,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  19,
                        "kota" =>  "Tangerang",
                        "id_provinsi" =>  3,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  21,
                        "kota" =>  "Tangerang Selatan",
                        "id_provinsi" =>  3,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  217,
                        "kota" =>  "Tanggamus",
                        "id_provinsi" =>  18,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  485,
                        "kota" =>  "Tanjung Balai",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  50,
                        "kota" =>  "Tanjung Jabung Barat",
                        "id_provinsi" =>  8,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  58,
                        "kota" =>  "Tanjung Jabung Timur",
                        "id_provinsi" =>  8,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  205,
                        "kota" =>  "Tanjung Pinang",
                        "id_provinsi" =>  17,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  486,
                        "kota" =>  "Tapanuli Selatan",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  487,
                        "kota" =>  "Tapanuli Tengah",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  488,
                        "kota" =>  "Tapanuli Utara",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  169,
                        "kota" =>  "Tapin",
                        "id_provinsi" =>  13,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  198,
                        "kota" =>  "Tarakan",
                        "id_provinsi" =>  16,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  70,
                        "kota" =>  "Tasikmalaya",
                        "id_provinsi" =>  9,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  489,
                        "kota" =>  "Tebing Tinggi",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  49,
                        "kota" =>  "Tebo",
                        "id_provinsi" =>  8,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  96,
                        "kota" =>  "Tegal",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  334,
                        "kota" =>  "Teluk Bintuni",
                        "id_provinsi" =>  25,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  335,
                        "kota" =>  "Teluk Wondama",
                        "id_provinsi" =>  25,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  88,
                        "kota" =>  "Temanggung",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  240,
                        "kota" =>  "Ternate",
                        "id_provinsi" =>  20,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  241,
                        "kota" =>  "Tidore Kepulauan",
                        "id_provinsi" =>  20,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  294,
                        "kota" =>  "Timor Tengah Selatan",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  295,
                        "kota" =>  "Timor Tengah Utara",
                        "id_provinsi" =>  23,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  490,
                        "kota" =>  "Toba Samosir",
                        "id_provinsi" =>  34,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  389,
                        "kota" =>  "Tojo Una-Una",
                        "id_provinsi" =>  29,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  390,
                        "kota" =>  "Toli-Toli",
                        "id_provinsi" =>  29,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  320,
                        "kota" =>  "Tolikara",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  422,
                        "kota" =>  "Tomohon",
                        "id_provinsi" =>  31,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  376,
                        "kota" =>  "Toraja Utara",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  140,
                        "kota" =>  "Trenggalek",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  231,
                        "kota" =>  "Tual",
                        "id_provinsi" =>  19,
                        "kabupaten" =>  0
                    ],
                    [
                        "id" =>  141,
                        "kota" =>  "Tuban",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  218,
                        "kota" =>  "Tulang Bawang",
                        "id_provinsi" =>  18,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  219,
                        "kota" =>  "Tulang Bawang Barat",
                        "id_provinsi" =>  18,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  142,
                        "kota" =>  "Tulungagung",
                        "id_provinsi" =>  11,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  377,
                        "kota" =>  "Wajo",
                        "id_provinsi" =>  28,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  407,
                        "kota" =>  "Wakatobi",
                        "id_provinsi" =>  30,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  321,
                        "kota" =>  "Waropen",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  220,
                        "kota" =>  "Way Kanan",
                        "id_provinsi" =>  18,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  81,
                        "kota" =>  "Wonogiri",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  83,
                        "kota" =>  "Wonosobo",
                        "id_provinsi" =>  10,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  322,
                        "kota" =>  "Yahukimo",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  323,
                        "kota" =>  "Yalimo",
                        "id_provinsi" =>  24,
                        "kabupaten" =>  1
                    ],
                    [
                        "id" =>  34,
                        "kota" =>  "Yogyakarta",
                        "id_provinsi" =>  5,
                        "kabupaten" =>  0
                    ]
                )
            );
        }
    }
}
