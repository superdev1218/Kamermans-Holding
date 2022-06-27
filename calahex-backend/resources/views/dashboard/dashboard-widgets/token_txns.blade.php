<div class="row">
   <div class="col-md-12">
     <div class="card">
       <div class="card-header">Token Overview</div>
       <div class="card-body">
         <table class="table table-responsive-sm table-hover table-outline mb-0" id="myTable">
           <thead class="thead-light">
             <tr>
               {{-- <th>Token ID</th> --}}
               <th>Token Name</th>
               <th>Token Symbol</th>
               {{-- <th>Token Pair</th> --}}
               {{-- <th>Total Quantity</th> --}}
               <th>Total Value (USD)</th>
               <th>Percentage of Total</th>
             </tr>
           </thead>
           <tbody>
              @foreach ($token_based_txns as $txn)
                  <tr>
                    {{-- <td>{{$txn->token_id}}</td> --}}
                    <td>{{$txn->token_name}}</td>
                    <td>{{$txn->token_symbol}}</td>
                    {{-- <td>{{$txn->token_pair_type}}</td> --}}
                    <td>{{$txn->token_sum}}</td>
                    <td>
                      @php
                          echo round($txn->percent_of_total, 2)
                      @endphp
                      %</td>
                  </tr>
              @endforeach
           </tbody>
         </table>
       </div>
     </div>
   </div>
 </div>