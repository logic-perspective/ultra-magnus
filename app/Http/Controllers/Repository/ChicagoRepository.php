<?php

namespace App\Http\Controllers\Repository;

use Illuminate\Support\Facades\DB;

class ChicagoRepository
{
    const districtPopulations = [
        1   => 706550,
        2   => 694459,
        3   => 704050,
        4   => 702062,
        5   => 743699,
        6   => 712712,
        7   => 707513,
        8   => 724644,
        9   => 715584,
        10  => 705564,
        11  => 722745,
        12  => 713289,
    ];

    const violentCategories = [
        'HOMICIDE',
        'WEAPONS VIOLATION',
        'PUBLIC PEACE VIOLATION',
        'CRIMINAL DAMAGE',
        'ASSAULT',
        'CRIM SEXUAL ASSAULT',
        'CRIMINAL SEXUAL ASSAULT',
        'ROBBERY',
        'KIDNAPPING',
        'INTIMIDATION',
        'BATTERY',
        'STALKING',
        'OFFENSE INVOLVING CHILDREN',
    ];

    const propertyCategories = [
        'ARSON',
        'THEFT',
        'BURGLARY',
        'MOTOR VEHICLE THEFT',
        'CRIMINAL TRESPASS',
    ];

    const consensualCategories = [
        'GAMBLING',
        'OTHER NARCOTIC VIOLATION',
        'CONCEALED CARRY LICENSE VIOLATION',
        'INTERFERENCE WITH PUBLIC OFFICER',
        'PROSTITUTION',
        'SEX OFFENSE',
        'LIQUOR LAW VIOLATION',
        'PUBLIC INDECENCY',
        'DECEPTIVE PRACTICE',
        'OTHER OFFENSE',
        'OBSCENITY',
        'NARCOTICS',
        'NON-CRIMINAL',
    ];

    const organisedCategories = [
        'HUMAN TRAFFICKING',
    ];

    /**
     * @return array
     */
    public function getDistrictRates(): array
    {
        $districtRates = [];

        foreach (range(1, 5) as $district) {
            $crimes = $this->getCrimeDistrictCount($district);
            $rate = $this->getCrimeRate($district, $crimes);
            array_push($districtRates, compact(['district', 'rate']));
        }

        return $districtRates;
    }

    /**
     * @param int $district
     * @param int $crimes
     * @return float
     */
    private function getCrimeRate(int $district, int $crimes): float
    {
        return round(($crimes * 100000) / $this->getDistrictPopulation($district), 2);
    }

    /**
     * @param int $district
     * @return int
     */
    private function getDistrictPopulation(int $district): int
    {
        return self::districtPopulations[$district];
    }

    /**
     * @param int $district
     * @return int
     */
    private function getCrimeDistrictCount(int $district): int
    {
        return DB::table('chicago_crime')->where('District', $district)->count();
    }

    /**
     * @param  array $category
     * @return int
     */
    public function getCrimeCategoryCount(array $category): int
    {
        return DB::table('chicago_crime')->whereIn('Primary Type', $category)->count();
    }
}