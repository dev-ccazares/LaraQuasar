<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Campaign::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'TSN',
            'date_start' => Carbon::now('UTC')->toDateString(),
            'date_end' => Carbon::now('UTC')->addYear()->subDay()->toDateString(),
            'id_sugar_campaign' => $this->faker->uuid,
            'name_sugar_campaign' => 'TSN_Sugar',
            'type' => 'CUPON',
            'company_id' => Company::factory()->create(),
        ];
    }
}
