<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $projects = [

            [
                'item_id' => '1',
                'business_nature_id' => '1',
                'code' => '17',
                'name_en' => 'Japanese University - Phase 3',
                'name_ar' => 'الجامعة اليابانية - المرحلة 3',
                'type' => 'comprehensive',
            ],
            [
                'item_id' => '1',
                'business_nature_id' => '1',
                'code' => '18',
                'name_en' => 'pedestrian bridges',
                'name_ar' => 'كباري المشاة',
                'type' => 'Excl',
            ],
            [
                'item_id' => '1',
                'business_nature_id' => '1',
                'code' => '19',
                'name_en' => 'Entity repositories',
                'name_ar' => 'مستودعات الكيان',
                'type' => 'comprehensive',
            ],
            [
                'item_id' => '1',
                'business_nature_id' => '1',
                'code' => '20',
                'name_en' => 'Entity repositories 2',
                'name_ar' => 'مستودعات الكيان 2',
                'type' => 'comprehensive',
            ],
            [
                'item_id' => '1',
                'business_nature_id' => '2',
                'code' => '21',
                'name_en' => 'Qena University Jamalsat',
                'name_ar' => 'جمالونات جامعة قنا',
                'type' => 'comprehensive',
            ],
            [
                'item_id' => '1',
                'business_nature_id' => '1',
                'code' => '22',
                'name_en' => 'Military Colleges - Administrative Capital',
                'name_ar' => 'الكليات العسكرية - العاصمة الإدارية',
                'type' => 'comprehensive',
            ],
            [
                'item_id' => '1',
                'business_nature_id' => '1',
                'code' => '23',
                'name_en' => 'Siwa Networks',
                'name_ar' => 'شبكات سيوة',
                'type' => 'comprehensive',
            ],
            [
                'item_id' => '1',
                'business_nature_id' => '1',
                'code' => '24',
                'name_en' => 'Creativity Factory',
                'name_ar' => 'مصنع الإبداع',
                'type' => 'comprehensive',
            ],
            [
                'item_id' => '1',
                'business_nature_id' => '1',
                'code' => '25',
                'name_en' => 'Minia National University',
                'name_ar' => 'جامعة المنيا الأهلية',
                'type' => 'comprehensive',
            ],
            [
                'item_id' => '1',
                'business_nature_id' => '1',
                'code' => '26',
                'name_en' => 'Hikestep Hanger',
                'name_ar' => 'هناجر الهايكستب',
                'type' => 'comprehensive',
            ],
            [
                'item_id' => '1',
                'business_nature_id' => '1',
                'code' => '27',
                'name_en' => 'Mosque No. 4 - Administrative Capital',
                'name_ar' => 'مسجد رقم 4 - العاصمة الإدارية',
                'type' => 'comprehensive',
            ],
            [
                'item_id' => '1',
                'business_nature_id' => '3',
                'code' => '28',
                'name_en' => 'Umbrellas of the administrative capital',
                'name_ar' => 'مظلات العاصمة الإدارية',
                'type' => 'comprehensive',
            ],
            [
                'item_id' => '1',
                'business_nature_id' => '1',
                'code' => '29',
                'name_en' => 'Suez Road Tunnel',
                'name_ar' => 'نفق طريق السويس',
                'type' => 'comprehensive',
            ],
            [
                'item_id' => '1',
                'business_nature_id' => '1',
                'code' => '30',
                'name_en' => 'coast line',
                'name_ar' => 'خط الساحل',
                'type' => 'comprehensive',
            ],
            [
                'code' => '31',
                'name_en' => 'Jafjafa Industrial Complex',
                'name_ar' => 'مجمع الصناعات بجفجافة',
                'type' => 'comprehensive',
                'item_id' => '1',
                'business_nature_id' => '1',

            ],
            [
                'code' => '0',
                'name_en' => '0',
                'name_ar' => '0',
                'item_id' => '2',
                'type' => '0',
                'business_nature_id' => '4',

            ],

        ];


        foreach ($projects as $project) {
            Project::create([
                'code' => $project['code'],
                'name_en' => $project['name_en'],
                'type' => $project['type'],
                'name_ar' => $project['name_ar'],
                'item_id' => $project['item_id'],
                'business_nature_id' => $project['business_nature_id'],

            ]);
        }
    }
}
