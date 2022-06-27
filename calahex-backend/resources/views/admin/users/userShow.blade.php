@extends('dashboard.base')

@section('content')

        <div class="container">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> User {{ $user->profile->first_name ??'' }}
                    </div>
                    <div class="card-body">
                    <form action ="{{route('users.manage',$user->id)}}" method = "POST">
                        @csrf
                        <h5>E-mail: {{ $user->email }}<br/><br/></h5>
                        <h5>Estimated Total Balance: <strong>{{ $total_amount }}</strong> USDT<br/></h5>
                    </form>
                    <ul class="nav nav-pills">
                        <li class="nav-item  mr-1 ">
                        <a class="nav-link bg-dark text-white active" data-toggle="pill" href="#balances">Balances</a>
                        </li>
                        <li class="nav-item mr-1">
                        <a class="nav-link bg-dark text-white" data-toggle="pill" href="#manage_balances">Manage Balances</a>
                        </li>
                        <li class="nav-item mr-1">
                        <a class="nav-link bg-dark text-white" data-toggle="pill" href="#deposit_withdraw">Deposit/Withdraw</a>
                        </li>
                        <li class="nav-item mr-1">
                            <a class="nav-link bg-dark text-white" data-toggle="pill" href="#log_data">Log Data</a>
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
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    {{-- <script src="{{ asset('js/Chart.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script> --}}
    <script src="{{ asset('js/main.js') }}" defer></script>
    {{-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#balances_table').DataTable({
            //   "order": [[ 3, "desc" ]]
            });
            $('#logs_data_table').DataTable({
            //   "order": [[ 3, "desc" ]]
            });
        } );
    </script>

    <script>
        function logDetail(index){
            alert(index)
        }
        function tokenSelect(type){   
            var accounts = {!! $accounts !!}
            var selected = false;
            var token = document.getElementById(type+"_token").value;
            accounts.forEach(item=>{
                if(item['token_id'] == token && item['account_type'] == type){
                    document.getElementById(type+"_amount").value = Number(Math.round(item['amount']+'e7')+'e-7') ;
                    selected = true;
                }
            })
            if(selected == false) document.getElementById(type+"_amount").value = 0;
        }
        function tokenSave(type){
            var token = document.getElementById(type+"_token").value;
            var amount = document.getElementById(type+"_amount").value;
            $.ajax({
                url: "{{route('users.setBalance')}}",
                method: "POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    type: type,
                    token: token,
                    amount: amount,
                    user_id: {{$user->id}}
                },
                success: function(result){
                    if(result == 'No Change')
                        // alert("No balance changed.")
                        toastr.warning("No balance changed.");
                    else{
                        // alert(type+" account's "+token+" balance is changed into "+amount);
                        toastr.success(type+" account's "+token+" balance is changed into "+amount);
                        location.reload();
                    }
                        
                }
            });
        }
        function futuresClick(e){
            document.getElementById('inlineCheckbox11').checked = e.checked;
            if(e.checked == true) document.getElementById('inlineCheckbox15').value = 1;
            else document.getElementById('inlineCheckbox15').value = 0;
            document.getElementById('inlineCheckbox2').checked = e.checked;
            if(document.getElementById('inlineCheckbox1').checked ==true && document.getElementById('inlineCheckbox2').checked ==true){
                document.getElementById('inlineCheckbox8').checked = true;
                document.getElementById('inlineCheckbox14').value = 1;
            }
            else {
                document.getElementById('inlineCheckbox8').checked = false;
                document.getElementById('inlineCheckbox14').value = 0;
            }
        }
        function savingPaidClick() {
            if(document.getElementById('inlineCheckbox1').checked ==true && document.getElementById('inlineCheckbox2').checked ==true){
                document.getElementById('inlineCheckbox8').checked = true;
                document.getElementById('inlineCheckbox14').value = 1;
            }
            else {
                document.getElementById('inlineCheckbox8').checked = false;
                document.getElementById('inlineCheckbox14').value = 0;
            }

        }
        function savingVerifiedClick() {

            if(document.getElementById('inlineCheckbox1').checked ==true && document.getElementById('inlineCheckbox2').checked ==true){
                document.getElementById('inlineCheckbox8').checked = true;
                document.getElementById('inlineCheckbox14').value = 1;
            }
            else {
                document.getElementById('inlineCheckbox8').checked = false;
                document.getElementById('inlineCheckbox14').value = 0;
            }
            document.getElementById('inlineCheckbox7').checked = document.getElementById('inlineCheckbox2').checked;
            document.getElementById('inlineCheckbox11').checked = document.getElementById('inlineCheckbox7').checked;
        }
        function poolPaidClick() {
            if(document.getElementById('inlineCheckbox3').checked ==true && document.getElementById('inlineCheckbox4').checked ==true){
                document.getElementById('inlineCheckbox9').checked = true;
                document.getElementById('inlineCheckbox13').value = 1;
            }
            else{
                document.getElementById('inlineCheckbox9').checked = false;
                document.getElementById('inlineCheckbox13').value = 0;
            }
        }
        function poolVerifiedClick() {
            if(document.getElementById('inlineCheckbox3').checked ==true && document.getElementById('inlineCheckbox4').checked ==true){
                document.getElementById('inlineCheckbox9').checked = true;
                document.getElementById('inlineCheckbox13').value = 1;
            }
            else{
                document.getElementById('inlineCheckbox9').checked = false;
                document.getElementById('inlineCheckbox13').value = 0;
            }
        }

        function marginPaidClick() {
            if(document.getElementById('inlineCheckbox5').checked ==true && document.getElementById('inlineCheckbox6').checked ==true){
                document.getElementById('inlineCheckbox10').checked = true;
                document.getElementById('inlineCheckbox12').value = 1;
            }

            else{
                document.getElementById('inlineCheckbox10').checked = false;
                document.getElementById('inlineCheckbox12').value = 0;
            }
        }
        function marginVerifiedClick() {
            if(document.getElementById('inlineCheckbox5').checked ==true && document.getElementById('inlineCheckbox6').checked ==true) {
                document.getElementById('inlineCheckbox12').value = 1;
                document.getElementById('inlineCheckbox10').checked = true;
            }
            else{
                document.getElementById('inlineCheckbox10').checked = false;
                document.getElementById('inlineCheckbox12').value = 0;
            }

        }
    </script>
@endsection
