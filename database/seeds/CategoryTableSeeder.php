<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records=['','本・コミック・雑誌','衣類','電子機器','家具','その他'];
        for($i=1;$i<=7;$i++){
            $category= new Category();
            $category->id=$i;
            $category->name=$records[$i];
            
            $category->save();
        }
    }
}
