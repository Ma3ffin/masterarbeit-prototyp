<?php
/**
 * Created by PhpStorm.
 * User: mwoller
 * Date: 03.10.2018
 * Time: 11:04
 */

namespace Mwoller\Consultmenow\Updates;

use Mwoller\Consultmenow\Models\Company;
use Mwoller\Consultmenow\Models\Consultant;
use Mwoller\Consultmenow\Models\Criteria;
use Mwoller\Consultmenow\Models\CriteriaRating;
use Mwoller\Consultmenow\Models\Rating;
use October\Rain\Database\Updates\Seeder;
use PhpParser\Node\Expr\List_;
use RainLab\User\Models\User;

class ConsultmenowSeeder extends Seeder
{

    public function run()
    {

        $this->truncateTables();

        $this->seedTables();

    }

    private function truncateTables()
    {
        CriteriaRating::truncate();
        Rating::truncate();
        Criteria::truncate();
        Consultant::truncate();
        Company::truncate();
    }

    private function seedTables()
    {
        Criteria::create(['name' => 'Fachliche Kompetenz']);
        Criteria::create(['name' => 'Termintreue']);
        Criteria::create(['name' => 'Kreativität']);
        Criteria::create(['name' => 'Soziale Kompetenz']);
        Criteria::create(['name' => 'Aufbereitung der Lösungsansätze']);
        Criteria::create(['name' => 'Analytische Kompetenz']);

        $criteriaList = Criteria::all();

        $companyOne = Company::create(['name' => 'Beratung GmbH']);
        $companyTwo = Company::create(['name' => 'Unternehmenshilfe AG']);

        $consultantOne =Consultant::create(['firstname' => 'Hans', 'lastname' => 'Huber', 'company' => $companyOne]);
        $consultantTwo = Consultant::create(['firstname' => 'Marlene', 'lastname' => 'Meier', 'company' => $companyOne]);
        $consultantThree = Consultant::create(['firstname' => 'Max', 'lastname' => 'Müller', 'company' => $companyTwo]);

        $ratingOne = Rating::create(['consultant' => $consultantOne , 'user' => User::first()]);
        $ratingTwo = Rating::create(['consultant' => $consultantOne , 'user' => User::first()]);

        foreach ($criteriaList as $criteria) {
            CriteriaRating::create(['rating' => $ratingOne, 'criteria' => $criteria, 'value' => rand(1, 5)]);
        }

        foreach ($criteriaList as $criteria) {
            CriteriaRating::create(['rating' => $ratingTwo, 'criteria' => $criteria, 'value' => rand(1, 5)]);
        }
    }
}
