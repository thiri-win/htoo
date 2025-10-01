<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Record;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isArray;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Thiri Win',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('pass')
        ]);

        $categories = ['ဝင်ငွေ', 'ပစ္စည်းဝယ်', 'ကယ်ရီခ', 'လုပ်အားခ', 'သုံးငွေ', 'မိန်းမအပ်ငွေ', 'ဆီဖိုး'];

        foreach ($categories as $category) {
            Category::create([
                'title' => $category,
                'status' => $category == 'ဝင်ငွေ' ? 'sum' : 'sub',
            ]);
        }



        // notion ထဲက data ရွှေ့ဖို့သုံးထားတာပါ
        // if (($handle = fopen("storage/daily.csv", "r")) !== FALSE) {
        //     fgetcsv($handle); // header row skip ပါမယ်
        //     while (($data = fgetcsv($handle)) !== FALSE) {
        //         Record::create([
        //             'date' => Carbon::createFromFormat('Y/m/d', $data[0]),
        //             'title' => $data[1],
        //             'category_id' => $data[2],
        //             'amount' => $data[3],
        //             'remark' => $data[4]
        //         ]);
        //     }
        //     fclose($handle);
        // }
        // if (($handle = fopen("storage/categories.csv", "r")) !== FALSE) {
        //     fgetcsv($handle); // header row skip ပါမယ်
        //     while (($data = fgetcsv($handle)) !== FALSE) {
        //         Category::create(['title' => $data[0]]);
        //     }
        //     fclose($handle);
        // }
    }
}
