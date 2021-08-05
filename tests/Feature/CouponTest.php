<?php

namespace Tests\Feature;

use App\Models\Agencies;
use App\Models\Campaign;
use App\Models\Contact;
use App\Models\Coupon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CouponTest extends TestCase
{

    private $coupons;
    use RefreshDatabase, WithFaker;
    protected function setUp(): void
    {
        parent::setUp();
        $campaign = Campaign::factory()->create(['company_id' => 1]);
        $this->coupons = Coupon::factory(10)->create(['campaign_id' => $campaign->id]);
    }

    public function testShowView()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('coupons');
        $response->assertOk();
        $response->assertViewIs('coupons.index');
        $agencies = Agencies::select('cb_agencias.id as code', 'cb_agencias.name')
            ->join('cb_agencias_cb_lineanegocio_c', 'cb_agencias.id', '=', 'cb_agencias_cb_lineanegociocb_agencias_ida')
            ->join('cb_lineanegocio', 'cb_lineanegocio.id', '=', 'cb_agencias_cb_lineanegociocb_lineanegocio_idb')
            ->where('cb_lineanegocio.name', 'NUEVOS')
            ->where('cb_agencias.deleted', 0)
            ->where('cb_agencias_cb_lineanegocio_c.deleted', 0)
            ->orderBy('cb_agencias.name')->get();
        $response->assertViewHas('agencies', json_encode($agencies));
    }

}
