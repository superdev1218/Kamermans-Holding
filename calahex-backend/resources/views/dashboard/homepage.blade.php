@extends('dashboard.base')

@section('content')

          <div class="container-fluid">
            <div class="fade-in">
              <a type="submit" href="{{url('/get_live_price')}}">Get latest Token Pair Prices</a>
              {{-- Top 4 Cards - showing members online data --}}
              {{-- @include('dashboard.dashboard-widgets.4cards') --}}
              {{-- Graph swhoing traffic data --}}
              {{-- @include('dashboard.dashboard-widgets.graph') --}}
              <!-- /.card-->
              {{-- Showing social media widgets --}}
              {{-- @include('dashboard.dashboard-widgets.socialmedia') --}}
              @include('dashboard.dashboard-widgets.boxedline')
              {{-- @include('dashboard.dashboard-widgets.processing-lines') --}}
              {{-- @include('dashboard.dashboard-widgets.table') --}}
              @include('dashboard.dashboard-widgets.token_txns')


            </div>
          </div>

@endsection

@section('javascript')

    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.11.3/api/sum().js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
              "order": [[ 3, "desc" ]],
              drawCallback: function () {
                var api = this.api();
                $( api.table().footer() ).html(
                  api.column( 2, {page:'current'} ).data().sum()
                );
              }
            });
        } );
    </script>
@endsection
