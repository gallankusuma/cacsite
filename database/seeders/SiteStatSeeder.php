<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\SiteStat;

class SiteStatSeeder extends Seeder {
    public function run(): void {
        foreach ([
            'branches'=>8,
            'factories'=>3,
            'countries'=>25,
            'registrations'=>120,
        ] as $k=>$v) {
            SiteStat::updateOrCreate(['key'=>$k], ['value_int'=>$v]);
        }
    }
}
