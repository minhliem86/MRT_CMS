<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Campaign;
use App\Models\Media;
use App\Models\Lead;
use App\Models\Product;
use DB;
use Yajra\Datatables\Datatables;

class LeadController extends Controller
{

    /**
     *
     */
    public function getLead(Request $request)
    {
        $campaign = DB::table('campaign')->orderby('id', 'desc')->lists('name','name');
        return view('pages.leads', compact('campaign'));
    }

    public function ajaxLead(Request $request)
    {
        $data = DB::connection('mysql')
            ->table('customer')
            ->leftJoin('campaign', 'customer.id_campaign', '=', 'campaign.id')
            ->leftJoin('media', 'customer.id_media', '=', 'media.id')
            ->leftJoin('product', 'customer.id_program', '=', 'product.id')
            ->leftJoin('corporat_ref.center as cen', 'customer.id_center', '=','cen.id')
            ->leftJoin('corporat_ref.city as ci', 'customer.id_city', '=','ci.id')
            ->select('id_customer', 'campaign.name as campaign_name', 'media.name as media_name', 'product.name as product_name', 'fullname', 'ci.name as name_city','cen.name_vi as center_name', 'customer.phone as phone', 'customer.mobile as mobile', 'customer.email as email', 'customer.register_date as register')
            ->orderBy('customer.id','desc')
            ->take(5000);
        $datatable = Datatables::of($data);
        if($campaign = $request->get('campaign')){
            $datatable->where('campaign.name','like',"%$campaign%");
        }

        return $datatable->make(true);
    }

}