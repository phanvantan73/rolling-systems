<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Diary;
use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staffsData = [
            [
                'id' => '171386712',
                'name' => 'Ho Gia Khanh',
                'tableId' => 1,
            ],
            [
                'id' => '495019632',
                'name' => 'Trần Long',
                'tableId' => 2,
            ],
            [
                'id' => '1774222732',
                'name' => 'Lê Hồng Hoa',
                'tableId' => 3,
            ],
            [
                'id' => '1133319532',
                'name' => 'Lê Minh Quang',
                'tableId' => 4,
            ],
            [
                'id' => '111111111',
                'name' => 'Quản lý',
                'tableId' => 5,
            ]
        ];

        DB::beginTransaction();

        try {
            Staff::insert($staffsData);
            $staffs = Staff::all()->sortBy('tableId');

            foreach ($staffs as $staff) {
                $lastName = strtolower(collect(explode(' ', $staff->name))->last());
                User::create([
                    'name' => $staff->name,
                    'email' => ($staff->id == '111111111' ? 'quanly' : $lastName) . '.abc@org.com',
                    'password' => 'password',
                    'role' => $staff->id == '111111111' ? 1 : 0,
                    'idNv' => $staff->id,
                ]);
                $diariesData = $this->generateDiariesData($staff);
                Diary::insert($diariesData);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
    }

    public function generateDiariesData($staff)
    {
        $data = [];
        $this->generateDataByDate($data, 5, $staff);
        $this->generateDataByDate($data, 6, $staff);
        $this->generateDataByDate($data, 7, $staff, true);

        return $data;
    }

    public function generateDataByDate(&$data, $month, $staff, $isNow = false)
    {
        $limit = $isNow ? Carbon::now()->day : Carbon::create(2020, $month)->daysInMonth;

        for ($i = 1; $i <= $limit; $i++) {
            array_push($data, [
                'temp' => rand(360, 380) / 10,
                'timein' => '0' . rand(6, 9) . ':' . rand(10, 59) . ':' . rand(10, 59),
                'idNv' => $staff->id,
                'timeout' => rand(16, 20) . ':' . rand(10, 59) . ':' . rand(10, 59),
                'day' => '2020-' . $month . '-' . ($i > 9 ? $i : '0' . $i),
            ]);
        }
    }
}
