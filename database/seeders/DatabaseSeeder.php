<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Record;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

use function PHPUnit\Framework\isArray;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::factory()->create([
        //     'name' => 'Thiri Win',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('pass')
        // ]);
        // User::factory()->create([
        //     'name' => 'Aung Ko Hein',
        //     'email' => 'akh@gmail.com',
        //     'password' => Hash::make('pass')
        // ]);
        // User::factory()->create([
        //     'name' => 'Jonny',
        //     'email' => 'user@gmail.com',
        //     'password' => Hash::make('pass')
        // ]);

        // $categories = ['ဝင်ငွေ', 'ပစ္စည်းဝယ်', 'ကယ်ရီခ', 'လုပ်အားခ', 'သုံးငွေ', 'မိန်းမအပ်ငွေ', 'ဆီဖိုး'];

        // foreach ($categories as $category) {
        //     Category::create([
        //         'title' => $category,
        //         'status' => $category == 'ဝင်ငွေ' ? 'sum' : 'sub',
        //     ]);
        // }

        $filepath = database_path('../htoo.sql');
        if (File::exists($filepath)) {
            $sql = File::get($filepath);
            DB::unprepared($sql);
        }

        // inv column ပေါင်းထည့်တာပါ
        // if (!Schema::hasColumn('records', 'record_number')) {
        //     DB::statement("ALTER TABLE records ADD COLUMN record_number VARCHAR(255) NULL AFTER date");
        // }

        // Record::where('category_id', 1)
        //     ->whereNull('record_number')
        //     ->chunkById(100, function ($records) { // 👈 $records က စာရင်း ၁၀၀ ပါတဲ့ အုပ်စု
        //         foreach ($records as $record) {    // 👈 ဒါဆိုရင် တစ်ခုချင်းစီကို ကွက်တိ ရပါပြီ (Foreach တစ်ထပ်ပဲ လိုပါတယ်)
                    
        //             // ရက်စွဲကို ယူပြီး Ym format ပြောင်းမယ်
        //             $recordDate = $record->date ? \Illuminate\Support\Carbon::parse($record->date) : now();
        //             $datePrefix = $recordDate->format('Ym');

        //             // အဲဒီလအလိုက် record_number ဘယ်နှစ်ခု ရှိပြီးသားလဲ လှမ်းရေမယ်
        //             $count = Record::where('record_number', 'like', 'INV' . $datePrefix . '%')->count();
        //             $sequence = sprintf('%04d', $count + 1);

        //             // INV2026070001 ပုံစံနဲ့ update လုပ်မယ်
        //             $record->record_number = 'INV' . $datePrefix . $sequence;
        //             $record->save();
        //         }
        //     });

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
