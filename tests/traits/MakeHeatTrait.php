<?php

use Faker\Factory as Faker;
use App\Models\Heat;
use App\Repositories\HeatRepository;

trait MakeHeatTrait
{
    /**
     * Create fake instance of Heat and save it in database
     *
     * @param array $heatFields
     * @return Heat
     */
    public function makeHeat($heatFields = [])
    {
        /** @var HeatRepository $heatRepo */
        $heatRepo = App::make(HeatRepository::class);
        $theme = $this->fakeHeatData($heatFields);
        return $heatRepo->create($theme);
    }

    /**
     * Get fake instance of Heat
     *
     * @param array $heatFields
     * @return Heat
     */
    public function fakeHeat($heatFields = [])
    {
        return new Heat($this->fakeHeatData($heatFields));
    }

    /**
     * Get fake data of Heat
     *
     * @param array $postFields
     * @return array
     */
    public function fakeHeatData($heatFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'data_id' => $fake->randomDigitNotNull,
            'level' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $heatFields);
    }
}
