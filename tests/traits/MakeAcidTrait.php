<?php

use Faker\Factory as Faker;
use App\Models\Acid;
use App\Repositories\AcidRepository;

trait MakeAcidTrait
{
    /**
     * Create fake instance of Acid and save it in database
     *
     * @param array $acidFields
     * @return Acid
     */
    public function makeAcid($acidFields = [])
    {
        /** @var AcidRepository $acidRepo */
        $acidRepo = App::make(AcidRepository::class);
        $theme = $this->fakeAcidData($acidFields);
        return $acidRepo->create($theme);
    }

    /**
     * Get fake instance of Acid
     *
     * @param array $acidFields
     * @return Acid
     */
    public function fakeAcid($acidFields = [])
    {
        return new Acid($this->fakeAcidData($acidFields));
    }

    /**
     * Get fake data of Acid
     *
     * @param array $postFields
     * @return array
     */
    public function fakeAcidData($acidFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'data_id' => $fake->randomDigitNotNull,
            'level' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $acidFields);
    }
}
