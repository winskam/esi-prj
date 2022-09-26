<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'id' => 10000,
            'first_name' => "Mathieu",
            'last_name' => "Letest",
        ]);
        DB::table('students')->insert([
            'id' => 20000,
            'first_name' => "Guillaume",
            'last_name' => "Retest",
        ]);
        DB::table('students')->insert([
            'id' => 43009,
            'first_name' => "Mehdi",
            'last_name' => "Boudakhani",
        ]);
        DB::table('students')->insert([
            'id' => 48502,
            'first_name' => "Alistair",
            'last_name' => "CLEREBAUT",
        ]);
        DB::table('students')->insert([
            'id' => 49720,
            'first_name' => "Elvin",
            'last_name' => "BUSSCHAERT",
        ]);
        DB::table('students')->insert([
            'id' => 49880,
            'first_name' => "Nathan",
            'last_name' => "Descheemaeker",
        ]);
        DB::table('students')->insert([
            'id' => 52006,
            'first_name' => "Olivier",
            'last_name' => "Dyck",
        ]);
        DB::table('students')->insert([
            'id' => 52094,
            'first_name' => "Michael",
            'last_name' => "Zumot",
        ]);
        DB::table('students')->insert([
            'id' => 52144,
            'first_name' => "Manal",
            'last_name' => "Sbai",
        ]);
        DB::table('students')->insert([
            'id' => 52275,
            'first_name' => "Nicolas",
            'last_name' => "FEROUMONT",
        ]);
        DB::table('students')->insert([
            'id' => 52446,
            'first_name' => "Thomas",
            'last_name' => "Devolder",
        ]);
        DB::table('students')->insert([
            'id' => 52711,
            'first_name' => "Emmanuel",
            'last_name' => "Ezeagwula",
        ]);
        DB::table('students')->insert([
            'id' => 52817,
            'first_name' => "Guillaume",
            'last_name' => "PATTYN",
        ]);
        DB::table('students')->insert([
            'id' => 52828,
            'first_name' => "Koray",
            'last_name' => "KUTLU",
        ]);
        DB::table('students')->insert([
            'id' => 54018,
            'first_name' => "Basile",
            'last_name' => "ROUTIER",
        ]);
        DB::table('students')->insert([
            'id' => 54170,
            'first_name' => "Nicolas",
            'last_name' => "D'HONDT",
        ]);
        DB::table('students')->insert([
            'id' => 54230,
            'first_name' => "Ilias",
            'last_name' => "Faek",
        ]);
        DB::table('students')->insert([
            'id' => 54259,
            'first_name' => "Haïtham",
            'last_name' => "MESSAST",
        ]);
        DB::table('students')->insert([
            'id' => 54332,
            'first_name' => "Arnaud",
            'last_name' => "MALCHAIR",
        ]);
        DB::table('students')->insert([
            'id' => 55047,
            'first_name' => "Marika",
            'last_name' => "Winska",
        ]);
        DB::table('students')->insert([
            'id' => 55315,
            'first_name' => "Oscar",
            'last_name' => "Tison",
        ]);
        DB::table('students')->insert([
            'id' => 42969,
            'first_name' => "Sebastian",
            'last_name' => "LAPINSKI",
        ]);
        DB::table('students')->insert([
            'id' => 42482,
            'first_name' => "Imad",
            'last_name' => "SRIKHI",
        ]);
        DB::table('students')->insert([
            'id' => 48982,
            'first_name' => "Jules",
            'last_name' => "Ruzindana-Rukundo",
        ]);
        DB::table('students')->insert([
            'id' => 52128,
            'first_name' => "Emile",
            'last_name' => "Lahdo",
        ]);
        DB::table('students')->insert([
            'id' => 52279,
            'first_name' => "Sohail",
            'last_name' => "HANINE EL GARRAI",
        ]);
        DB::table('students')->insert([
            'id' => 53135,
            'first_name' => "Jan",
            'last_name' => "SCHUMACHER VINCKE",
        ]);
        DB::table('students')->insert([
            'id' => 54356,
            'first_name' => "Hosam",
            'last_name' => "KANAN",
        ]);
        DB::table('students')->insert([
            'id' => 55243,
            'first_name' => "Valentin",
            'last_name' => "KOLA",
        ]);
        DB::table('students')->insert([
            'id' => 49773,
            'first_name' => "Thierno",
            'last_name' => "DIALLO",
        ]);
        DB::table('students')->insert([
            'id' => 49262,
            'first_name' => "Meihdi",
            'last_name' => "El Amouri",
        ]);
        DB::table('students')->insert([
            'id' => 52112,
            'first_name' => "Kawtar",
            'last_name' => "Mhassni",
        ]);
    }
}
