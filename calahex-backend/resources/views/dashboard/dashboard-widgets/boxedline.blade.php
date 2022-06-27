<div class="card">
   <div class="card-header">
     Accounts Summary
   </div>
   <div class="card-body">
    <div class="row">
      <div class="col-3">
        <div class="c-callout c-callout-info"><small class="text-muted">Total users</small>
          <div class="text-value-lg">{{$total_users, 0}}</div>
        </div>
      </div>
      <!-- /.col-->
      {{-- <div class="col-3">
       <div class="c-callout c-callout-info"><small class="text-muted">Total Crypto Payments (Txn confirmed)</small>
         <div class="text-value-lg">{{$crypto_payments, 0}}</div>
       </div>
      </div> --}}
      {{-- <div class="col-3">
        <div class="c-callout c-callout-info"><small class="text-muted">Total Crypto Payments (Txn failed)</small>
          <div class="text-value-lg">{{$crypto_payments_txn_not_confirmed, 0}}</div>
        </div>
      </div> --}}

      {{-- @include('dashboard.dashboard-widgets.payorders') --}}

      <div class="col-3">
        <div class="c-callout c-callout-warning"><small class="text-muted">Total value of all Accounts (USD)</small>
          <div class="text-value-lg">$ {{$total_value_of_users_usd, 0}}</div>
        </div>
      </div>
      


      <!-- /.col-->
    </div>
 
   </div>
 </div>