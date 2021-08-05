<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Contact;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CouponFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => Str::upper(Str::random(9)),
            'campaign_id' => Campaign::factory()->create(),
            'contact_id' => Contact::factory()->create(),
            'date_assign' => Carbon::now('UTC')->toDateString(),
            'date_validity' => Carbon::now('UTC')->addYear()->subDay()->toDateString()
        ];
    }
}
