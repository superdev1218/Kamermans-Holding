<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_users = DB::table('users')->count();
        $crypto_payments = DB::table('crypto_payments')->where(['txConfirmed'=>1])->count();
        $crypto_payments_txn_not_confirmed = DB::table('crypto_payments')->where(['txConfirmed'=>0])->count();

        $total_pay_orders  = DB::table('payorders')->count();
        $total_pay_orders_cancelled  = DB::table('payorders')->where(['status'=>'cancelled'])->count();
        $total_pay_orders_done  = DB::table('payorders')->where(['status'=>'done'])->count();
        $total_pay_orders_waiting  = DB::table('payorders')->where(['status'=>'waiting'])->count();
        $total_pay_orders_requesting  = DB::table('payorders')->where(['status'=>'requesting'])->count();

        $total_value_of_users_usd = DB::table('accounts')
        ->groupBy('token_id')
        ->get();

        $token_based_txns = $this->get_value_of_users();    
        
        // dd($token_based_txns);
        // dd($total_value_of_users_usd);
        return view('dashboard.homepage', compact([
            'total_users',
            'crypto_payments',
            'crypto_payments_txn_not_confirmed',
            'total_pay_orders',
            'total_pay_orders_cancelled',
            'total_pay_orders_done',
            'total_pay_orders_waiting',
            'total_pay_orders_requesting',
            'token_based_txns',
            'total_value_of_users_usd'
        ]));
    }

    public static function get_value_of_users(){
        $query = DB::table('accounts');
        $query = $query->leftJoin('tokens', 'token_id', '=', 'tokens.id');
        $query = $query->groupBy('token_id');
        $query = $query->select([
            'token_name',
            'token_symbol',
            'tokens.id as token_id',
            'tokens.token_pair_type',
        ]);
        $query = $query->selectRaw('sum(amount) as sum');
        $query = $query->selectRaw('sum(amount) * 100 / (SELECT SUM(amount) AS s FROM accounts) AS `percent_of_total`');
        $query = $query->orderBy('sum', 'desc');
       
        return $query->get();
    }
}
