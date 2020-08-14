<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('languages')->delete();
        
        $languages = array(
            array(
                "name" => "English",
                "code" => "EN"
            ),
            array(
                "name" => "Hindi",
                "code" => "HI"),
             array(
                "name" => "Assamese",
                "code" => "BD"
            ),
            array(
                "name" => "Bengali",
                "code" => "BN"
            ),
            array(
                "name" => "Gujarati",
                "code" => "GA"),
            array(
                "name" => "Kannada",
                "code" => "KN"),
            array(
                "name" => "Kashmiri",
                "code" => "KS"),
            array(
                "name" => "Konkani",
                "code" => "KO"),
            array(
                "name" => "Malayalam",
                 "code" => "ML"),
            array(
                "name" => "Manipuri",
                "code" => "MN"),
            array(
                "name" => "Marathi",
                "code" => "MR"),
            array(
                "name" => "Nepali",
                "code" => "NE"),
            array(
                "name" => "Oriya",
                "code" => "OR"),
            array(
                "name" => "Punjabi",
                "code" => "PU"),
            array(
                "name" => "Tamil",
                "code" => "TA"),
            array(
                "name" => "Telugu",
                "code" => "TE")
           
        );

		DB::table('languages')->insert($languages);
 

    }
}
