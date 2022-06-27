<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Services\PoloniexService;

class HomeController extends Controller
{
    protected $poloniexService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PoloniexService $poloniexService)
    {
        $this->middleware('auth');
        $this->poloniexService = $poloniexService;
    }
    // public function __construct(DoctorProfileRepository $doctorProfileRepository)
    // {
    //     $this->doctorProfileRepository = $doctorProfileRepository;
    // }
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

        // dd($this->get_value_of_tokens());
        // $total_value_of_users_usd = DB::table('accounts')->where('account_type', '=', 'exchange')->sum('amount');
        $total_value_of_users_usd = $this->get_value_of_tokens();

        $token_based_txns = $this->get_value_of_users();   
        $token_based_txns = json_decode($token_based_txns);
        
        // Add total_percentage in each row of the tokens table data
        $total_sum = 0;
        foreach ($token_based_txns as $key => $txn) {
            // dump($txn->token_sum);
            $total_sum = $total_sum + $txn->token_sum;
            // $total_percent = ($txn->token_sum*100)/$total_value_of_users_usd;
            // $txn->percent_of_total= $total_percent;
        }
        // dump($total_value_of_users_usd);
        // dd($total_sum);
        foreach ($token_based_txns as $key => $txn) {
            $total_percent = ($txn->token_sum*100)/$total_value_of_users_usd;
            $txn->percent_of_total= $total_percent;
        }

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
        $query = DB::table('tokens');
        $query = $query->leftJoin('accounts', 'tokens.id', '=', 'accounts.token_id');
        $query = $query->leftJoin('poloniex_live_pair', 'tokens.poloniex_pair_id', '=', 'poloniex_live_pair.pair_id');
        $query = $query->groupBy('tokens.id');
        $query = $query->select([
            'token_name',
            'token_symbol',
            // 'tokens.id as token_id',
            'tokens.token_pair_type',
            'poloniex_live_pair.last'
        ]);
        $query = $query->where('accounts.account_type', '=', 'exchange');
        // $query = $query->selectRaw('sum(amount)*last as token_sum');
        $query = $query->selectRaw('sum(amount)*last as token_sum');
        // $query = $query->selectRaw('((amount)*last * 100 / (SELECT SUM(amount)*last AS s FROM accounts)) AS `percent_of_total`');
        // $query = $query->selectRaw('((sum(amount)*last * 100) / sum(sum(amount)*last)) AS `percent_of_total`');
        $query = $query->orderBy('token_sum', 'desc');
        return $query->get();
    }

    public function get_value_of_tokens(){
        $query = DB::table('tokens');
        $query = $query->leftJoin('accounts', 'tokens.id', '=', 'accounts.token_id');
        $query = $query->leftJoin('poloniex_live_pair', 'tokens.poloniex_pair_id', '=', 'poloniex_live_pair.pair_id');
        $query = $query->groupBy('tokens.id');

        $query = $query->where('accounts.account_type', '=', 'exchange');
        $query = $query->selectRaw('sum(amount)*last as sum');

        $data = $query->get();
        $num = 0;
        foreach ($data as $value) {
            // dump($value->sum);
            $num = $num + $value->sum;
        }
        // dd($num);
        // return $query->get();
        return $num;
    }

    public function get_live_price(){
        $this->poloniexService->get_live_prices();
        return back();
    }

    // public static function get_value_of_users(){
    //     $query = DB::table('accounts');
    //     $query = $query->leftJoin('tokens', 'token_id', '=', 'tokens.id');
    //     $query = $query->groupBy('token_id');
    //     $query = $query->select([
    //         'token_name',
    //         'token_symbol',
    //         // 'tokens.id as token_id',
    //         'tokens.token_pair_type',
    //     ]);
    //     $query = $query->selectRaw('sum(amount) as sum');
    //     $query = $query->selectRaw('sum(amount) * 100 / (SELECT SUM(amount) AS s FROM accounts) AS `percent_of_total`');
    //     $query = $query->orderBy('sum', 'desc');
       
    //     return $query->get();
    // }
}
