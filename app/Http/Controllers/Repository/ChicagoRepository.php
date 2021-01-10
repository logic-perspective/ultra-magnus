<?php

namespace App\Http\Controllers\Repository;

use App\Chicago;

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

    const months = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];

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
        return Chicago::where('District', $district)->count();
    }

    /**
     * @param  array $category
     * @return int
     */
    public function getCrimeCategoryCount(array $category): int
    {
        return Chicago::whereIn('Primary Type', $category)->count();
    }

    /**
     * @return array
     */
    public function getOffences(): array
    {
        $offences = [];
        foreach (range(1, 12) as $calenderMonth) {
            $prefix = $calenderMonth < 10 ? '0' : '';
            array_push($offences, Chicago::where('Date', 'LIKE', $prefix . $calenderMonth . '/%')->count());
        }
        return array_combine(self::months,  $offences);
    }

    /**
     * @return array
     */
    public function getArrests(): array
    {
        $arrests = [];
        foreach (range(1, 12) as $calenderMonth) {
            $prefix = $calenderMonth < 10 ? '0' : '';
            array_push($arrests, Chicago::where('Date', 'LIKE', $prefix . $calenderMonth . '/%')->where('Arrest', 'true')->count());
        }
        return array_combine(self::months,  $arrests);
    }

    /**
     * @return array
     */
    public function getDomestic(): array
    {
        $domestic = [];
        foreach (range(1, 12) as $calenderMonth) {
            $prefix = $calenderMonth < 10 ? '0' : '';
            array_push($domestic, Chicago::where('Date', 'LIKE', $prefix . $calenderMonth . '/%')->where('Domestic', 'true')->count());
        }
        return array_combine(self::months,  $domestic);
    }
}