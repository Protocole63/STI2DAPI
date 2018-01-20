<?php

use Faker\Factory as Faker;
use App\Models\Data;
use App\Repositories\DataRepository;

trait MakeDataTrait
{
    /**
     * Create fake instance of Data and save it in database
     *
     * @param array $dataFields
     * @return Data
     */
    public function makeData($dataFields = [])
    {
        /** @var DataRepository $dataRepo */
        $dataRepo = App::make(DataRepository::class);
        $theme = $this->fakeDataData($dataFields);
        return $dataRepo->create($theme);
    }

    /**
     * Get fake instance of Data
     *
     * @param array $dataFields
     * @return Data
     */
    public function fakeData($dataFields = [])
    {
        return new Data($this->fakeDataData($dataFields));
    }

    /**
     * Get fake data of Data
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDataData($dataFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $dataFields);
    }
}
