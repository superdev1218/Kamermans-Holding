<div class="tab-pane container fade mt-4" id="log_data">
   <table class="table table-responsive table-striped" id="logs_data_table">
       <thead>
           <tr>
               <th>Type</th>
               <th>Token</th>
               <th>Amount</th>
               <th>Status</th>
               <th>Datetime</th>
               <th>Price</th>
               <th>Amount(left)</th>
               <th>Amount(total)</th>
               <th>Detail</th>
               <th>Address</th>
               <th>PaymentID</th>
               <th>Account</th>
           </tr>
       </thead>
       <tbody>
           @foreach(json_decode($logData) as $log)
               <tr>
                   <td>{{$log->type}}</td>
                   <td>{{$log->token}}</td>
                   <td>{{$log->amount}}</td>
                   <td>{{$log->status}}</td>
                   <td>{{$log->datetime}}</td>
                   <td>{{$log->price}}</td>
                   <td>{{$log->amount_left}}</td>
                   <td>{{$log->amount_total}}</td>
                   <td>{{$log->detail}}</td>
                   <td>{{$log->address}}</td>
                   <td>{{$log->payment_id}}</td>
                   <td>{{$log->account}}</td>
               </tr>
           @endforeach
       </tbody>
   </table>
</div>