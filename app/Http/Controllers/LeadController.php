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
use Yajra\Datatables\Html\Builder;

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

    public function getTest(Request $request,Builder $htmlbuilder)
    {
//        $data = DB::table('customer')->select('register_date', 'id_customer')->whereDate('register_date','<','2017-11-06')->first();
        $campaign = DB::table('campaign')->orderby('id', 'desc')->lists('name','name');
        if($request->ajax()){
            $data = DB::connection('mysql')
                ->table('customer')
                ->leftJoin('campaign', 'customer.id_campaign', '=', 'campaign.id')
                ->leftJoin('media', 'customer.id_media', '=', 'media.id')
                ->leftJoin('product', 'customer.id_program', '=', 'product.id')
                ->leftJoin('corporat_ref.center as cen', 'customer.id_center', '=','cen.id')
                ->leftJoin('corporat_ref.city as ci', 'customer.id_city', '=','ci.id')
                ->select('id_customer', 'campaign.name as campaign_name', 'media.name as media_name', 'product.name as product_name', 'fullname', 'ci.name as name_city','cen.name_vi as center_name', 'customer.phone as phone', 'customer.mobile as mobile', 'customer.email as email', 'customer.register_date as register')
                ->orderBy('customer.id','desc');
            $datatable = Datatables::of($data);
            if($campaign = $request->get('campaign')){
                $datatable->where('campaign.name','like',"%$campaign%");
            }
            if($from = $request->get('from') && $to = $request->get('to')){
                $datatable->whereBetween('customer.register_date',[$from, $to]);
            }else if($from = $request->get('from')){
                $datatable->whereDate('customer.register_date','>=',$from);
            }else if($to = $request->get('to')){
                $datatable->whereDate('customer.register_date','<=',$to);
            }else{

            }
            return $datatable->make(true);
        }
        $html = $htmlbuilder->columns([
                'register',
                'id_customer',
                'product_name',
                'campaign_name',
                'media_name',
                'fullname',
                'phone',
                'email',
                'center_name'
            ])
//            ->addColumn(['data'=>'register', 'name' => 'register', 'title'=>'Register Date'])
//            ->addColumn(['data'=>'id_customer', 'name' => 'id_customer', 'title'=>'Lead ID'])
//            ->addColumn(['data'=>'product_name', 'name' => 'product_name', 'title'=>'Product'])
//            ->addColumn(['data'=>'campaign_name', 'name' => 'campaign_name', 'title'=>'Campaign'])
//            ->addColumn(['data'=>'media_name', 'name' => 'media_name', 'title'=>'Media Channel'])
//            ->addColumn(['data'=>'fullname', 'name' => 'fullname', 'title'=>'Media Channel'])
//            ->addColumn(['data'=>'phone', 'name' => 'phone', 'title'=>'Phone'])
//            ->addColumn(['data'=>'email', 'name' => 'email', 'title'=>'Email'])
//            ->addColumn(['data'=>'center_name', 'name' => 'center_name', 'title'=>'Center'])
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['csv', 'excel', 'pdf'],
            ]);

        return view('pages.leads2', compact('html','campaign'));
    }

    public function ajaxLead(Request $request)
    {
        if($request->ajax()){
            $data = DB::connection('mysql')
                ->table('customer')
                ->leftJoin('campaign', 'customer.id_campaign', '=', 'campaign.id')
                ->leftJoin('media', 'customer.id_media', '=', 'media.id')
                ->leftJoin('product', 'customer.id_program', '=', 'product.id')
                ->leftJoin('corporat_ref.center as cen', 'customer.id_center', '=','cen.id')
                ->leftJoin('corporat_ref.city as ci', 'customer.id_city', '=','ci.id')
                ->select('id_customer', 'campaign.name as campaign_name', 'media.name as media_name', 'product.name as product_name', 'fullname', 'ci.name as name_city','cen.name_vi as center_name', 'customer.phone as phone', 'customer.mobile as mobile', 'customer.email as email', 'customer.register_date as register')
                ->orderBy('customer.id','desc');
            $datatable = Datatables::of($data);
            if($campaign = $request->get('campaign')){
                $datatable->where('campaign.name','like',"%$campaign%");
            }
            if($from = $request->get('from') && $to = $request->get('to')){
                $datatable->whereBetween('customer.register_date',[$from, $to]);
            }else if($from = $request->get('from')){
                $datatable->whereDate('customer.register_date','>=',$from);
            }else if($to = $request->get('to')){
                $datatable->whereDate('customer.register_date','<=',$to);
            }else{

            }
            return $datatable->make(true);
        }
        $html = $htmlbuilder
            ->addColumn(['data'=>'register', 'name' => 'register', 'title'=>'Register Date'])
            ->addColumn(['data'=>'id_customer', 'name' => 'id_customer', 'title'=>'Lead ID'])
            ->addColumn(['data'=>'product_name', 'name' => 'product_name', 'title'=>'Product'])
            ->addColumn(['data'=>'campaign_name', 'name' => 'campaign_name', 'title'=>'Campaign'])
            ->addColumn(['data'=>'media_name', 'name' => 'media_name', 'title'=>'Media Channel'])
            ->addColumn(['data'=>'fullname', 'name' => 'fullname', 'title'=>'Media Channel'])
            ->addColumn(['data'=>'phone', 'name' => 'phone', 'title'=>'Phone'])
            ->addColumn(['data'=>'email', 'name' => 'email', 'title'=>'Email'])
            ->addColumn(['data'=>'center_name', 'name' => 'center_name', 'title'=>'Center']);

        return view('pages.leads', compact('html'));


    }

}
