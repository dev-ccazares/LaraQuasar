<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidCouponRequest;
use App\Models\Agencies;
use App\Models\Contacts;
use App\Models\Coupons;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class CouponsController extends Controller
{
    public function index()
    {
      $agencies = Agencies::getAllCodeNameByLine('NUEVOS');
      $data['agencies'] = json_encode($agencies);
      return view('coupons.index',$data);
    }

    public function validateCoupon (ValidCouponRequest $request){
      try{
        $opportunity_id = Coupons::where('code',$request->getCode())->where('status_coupon',1)->pluck('opportunity_id')->first();
        $client = Contacts::selectRaw("CONCAT(contacts_cstm.numero_identificacion_c, ' - ',contacts.first_name, ' ', contacts.last_name) as client")
                                      ->join('opportunities_contacts','contact_id','contacts.id')
                                      ->join('contacts_cstm','contacts_cstm.id_c','contacts.id')
                                      ->where('opportunities_contacts.deleted',0)
                                      ->where('contacts.deleted',0)
                                      ->where('opportunities_contacts.opportunity_id',$opportunity_id)
                                      ->pluck('client')
                                      ->first();
        return response()->json(['msg' => isset($client) ? 'Código de cupón válido' : 'Cliente no encontrado, notifique al área de CRM','data' => $client , 'swap' => (isset($client) ? true :false) ], Response::HTTP_ACCEPTED);
      }catch (\Exception $e){
        return response()->json(['error' => '!Error¡ No se pudo validar','msg' => $e->getMessage() . '- Line: '.$e->getLine(). '- Archivo: '.$e->getFile()], Response::HTTP_INTERNAL_SERVER_ERROR);
      }
    }

    public function update (Request $request)
    {
        try {
            \DB::connection(get_connection())->beginTransaction();
            $update = array(
                'status_coupon' => 2 ,
                'agency_id' => $request->get('agency_id') ,
                'date_swap' => Carbon::now('UTC')->toDateString()
            );
            $update = Coupons::where('code',$request->get('code'))->update($update);
            \DB::connection(get_connection())->commit();
            return response()->json(['msg' => 'Se guardo correctamente','data' => $update], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            \DB::connection(get_connection())->rollBack();
            return response()->json(['error' => '!Error¡ No se pudo cajear el cupón', 'msg' => $e->getMessage() . '- Line: ' . $e->getLine() . '- Archivo: ' . $e->getFile()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
