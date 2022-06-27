@extends('dashboard.base')
@section('content')
<div class="container">
   <div class="animated fadeIn">
   <div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header">
            <i class="fa fa-align-justify"></i> User {{ $user->name }}
          </div>
         <div class="card-body">
            <h5>E-mail: {{ $user->email }}</h5>
            <h5>Estimated Total Balance: <strong>{{ $total_amount }}</strong> USDT</h5>
            <ul class="nav nav-pills">
               <li class="nav-item">
               <a class="nav-link active" data-toggle="pill" href="#balances">Balances</a>
               </li>
               <li class="nav-item">
               <a class="nav-link" data-toggle="pill" href="#manage_balances">Manage Balances</a>
               </li>
               <li class="nav-item">
               <a class="nav-link" data-toggle="pill" href="#deposit_withdraw">Deposit/Withdraw</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" data-toggle="pill" href="#log_data">Log Data</a>
               </li>
           </ul>
             <!-- Tab panes -->
            <div class="tab-content">
               {{-- Tab Balances --}}
               @include('admin.users.usershow.balances')
               {{-- Tab manage balances --}}
               @include('admin.users.usershow.manage_balances')
               {{-- Tab Deposit withdraw --}}
               @include('admin.users.usershow.deposit_withdraw')
               {{-- Tab Log Data --}}
               @include('admin.users.usershow.logs_data')

            </div>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, beatae, neque asperiores commodi in magnam eligendi facilis illum doloremque maiores velit architecto repellendus consectetur! Fugit obcaecati atque earum rerum nisi!
         </div>
      </div>
   </div>
   </div>
   </div>
</div>
@endsection

@section('javascript')
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> --}}
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
{{-- <script src="{{ asset('js/main.js') }}" defer></script> --}}
{{-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready( function () {
        $('#balances_table').DataTable({
        //   "order": [[ 3, "desc" ]]
        });
    } );
</script>    
@endsection
