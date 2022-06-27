<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PoloniexService
{
   public function get_live_prices(){
      $response = Http::get('https://poloniex.com/public?command=returnTicker');
      foreach ($response->json() as $key => $value) {
        DB::table('poloniex_live_pair')->where('pair_id', $value['id'])->update(['last'=>$value['last']]);
        //   DB::table('poloniex_live_pair')->insert([
        //       'pair_id'=>$value['id'],
        //       'pair'=>$key,
        //       'last'=>$value['last']
        //   ]);
      }
   }

}
?>
