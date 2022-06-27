<div  class="tab-pane container active" id="balances">
   <h3 style="text-align:center;">Balances</h3>
   <table class="table  display" id="balances_table" style="width:100%">
       <thead>
           <tr>
               <th>Token</th>
               <th>Exchange</th>
               <th>Margin</th>
               <th>Futures</th>
               <th>Savings</th>
               <th>Pool</th>
           </tr>
       </thead>
       <tbody>
           @foreach(json_decode($balances) as $balance)
               <tr>
                   <td>{{$balance->token_symbol}}</td>
                   <td>{{$balance->exchange_balance}}</td>
                   <td>{{$balance->margin_balance}}</td>
                   <td>{{$balance->futures_balance}}</td>
                   <td>{{$balance->savings_balance}}</td>
                   <td>{{$balance->pool_balance}}</td>
               </tr>
           @endforeach
       </tbody>
   </table>
</div>