<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder {
    public function run(): void {
        Page::updateOrCreate(['slug'=>'home'], [
            'title'=>'Innovating Agriculture',
            'subtitle'=>'Trusted agrochemical solutions by CAC',
            'type'=>'landing',
            'hero_image'=>'/assets/hero/farm-hero.jpg',
            'is_published'=>true,
        ]);

        Page::updateOrCreate(['slug'=>'about'], [
            'title'=>'About CAC',
            'body'=>"<p>CAHAYA AGRO CHEMICAL (CAC) provides high-quality agrochemical products and registration services.</p>",
        ]);

        Page::updateOrCreate(['slug'=>'advantages'], [
            'title'=>'Our Advantages',
            'body'=>"<ul><li>Intelligent Factory</li><li>Registration Expertise</li><li>Laboratory</li><li>Platform &amp; Support</li></ul>",
        ]);
    }
}
