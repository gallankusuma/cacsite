<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder {
    public function run(): void {
        $cats = [
            ['slug'=>'insecticides','name'=>'Insecticides'],
            ['slug'=>'herbicides','name'=>'Herbicides'],
            ['slug'=>'fungicides','name'=>'Fungicides'],
            ['slug'=>'nematicides','name'=>'Nematicides'],
            ['slug'=>'sunshade-products','name'=>'Sunshade Products'],
            ['slug'=>'biologicals','name'=>'Biologicals'],
        ];
        foreach ($cats as $i=>$c) {
            ProductCategory::updateOrCreate(['slug'=>$c['slug']], array_merge($c, ['sort_order'=>$i]));
        }
    }
}
