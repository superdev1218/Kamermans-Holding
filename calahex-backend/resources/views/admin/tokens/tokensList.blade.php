@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Token') }}</div>
                    <div class="card-body">
                        <div class="row">
                          <a href="{{ route('tokens.create') }}" class="btn btn-primary m-2">{{ __('Add Token') }}</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped" id="myTokenTable">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Symbol</th>
                              <th>Decimal</th>
                              <th>Whitepaper</th>
                              <th>Pair Type</th>
                              <th>Logo</th>
                              <th>Status</th>
                              <th>Process</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($tokens as $token)
                              <tr>
                                <td><strong>{{ $token->token_name }}</strong></td>
                                <td>{{ $token->token_symbol }}</td>
                                <td>{{ $token->token_decimal }}</td>
                                <td class="text-wrap">
                                  @if ($token->token_whitepaper != '')
                                    <a href="{{ $token->token_whitepaper }}" target="_blank">
                                      WHITEPAPER LINK
                                    </a>
                                  @endif
                                    
                                </td>
                                <td>{{ $token->token_pair_type }}</td>
                                <td><img src="{{ $token->token_logo }}" class="token-logo" /></td>
                                <td>
                                  <span class="{{ $token->token_status->class }}">
                                      {{ $token->token_status->name }}
                                  </span>
                                </td>
                                <td>
                                  <a href="{{ url('/tokens/' . $token->id . '/edit') }}" class="btn btn-block btn-primary mb-1">Edit</a>
                            
                                    @if($token->status == 1)
                                        <form action="{{ route('tokens.approve', $token->id ) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button class="btn btn-block btn-success mb-1">Approve</button>
                                        </form>
                                    @else
                                        <form action="{{ route('tokens.approve', $token->id ) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button class="btn btn-block btn-success mb-1" disabled>Approve</button>
                                        </form>
                                    @endif
                          
                                    @if($token->status == 1)
                                        <form action="{{ route('tokens.block', $token->id ) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button class="btn btn-block btn-danger mb-1" disabled>Block</button>
                                        </form>
                                    @elseif($token->status == 2)
                                        <form action="{{ route('tokens.block', $token->id ) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button class="btn btn-block btn-danger mb-1">Block</button>
                                        </form>
                                    @elseif($token->status == 3)
                                        <form action="{{ route('tokens.block', $token->id ) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button class="btn btn-block btn-danger mb-1">Unblock</button>
                                        </form>
                                    @endif
                               
                                  <form action="{{ route('tokens.destroy', $token->id ) }}" method="POST">
                                      @method('DELETE')
                                      @csrf
                                      <button class="btn btn-block btn-danger mb-1">Delete</button>
                                  </form>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


{{-- @section('javascript')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready( function () {
        $('#myTokenTable').DataTable({
          // "order": [[ 3, "desc" ]]
        });
    } );
</script>
@endsection --}}

@section('javascript')

    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#myTokenTable').DataTable({
              // "order": [[ 3, "desc" ]]
            });
        } );
    </script>
@endsection
