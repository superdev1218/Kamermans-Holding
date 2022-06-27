@extends('dashboard.authBase')

@section('content')

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4">
              <div class="card-body">
                <h1>Login</h1>
                <p class="text-muted">Login In to your account</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <svg class="c-icon">
                          <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                        </svg>
                      </span>
                    </div>
                    <input class="form-control" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="input-group mb-4">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <svg class="c-icon">
                          <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked"></use>
                        </svg>
                      </span>
                    </div>
                    <input class="form-control" type="password" placeholder="{{ __('Password') }}" name="password" required>
                    </div>
                    <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary px-4" type="submit">{{ __('Login') }}</button>
                    </div>
                    </form>
                    <div class="col-6 text-right">
                        <a href="{{ route('password.request') }}" class="btn btn-link px-0">{{ __('Forgot Your Password?') }}</a>
                    </div>
                    </div>
              </div>
            </div>
            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center d-flex align-items-center justify-content-center">
                <div>
                  <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJ8AAAAeCAIAAAC9lVvKAAAACXBIWXMAAAsTAAALEwEAmpwYAAAGe2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxNDggNzkuMTY0MDM2LCAyMDE5LzA4LzEzLTAxOjA2OjU3ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdEV2dD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlRXZlbnQjIiB4bWxuczpwaG90b3Nob3A9Imh0dHA6Ly9ucy5hZG9iZS5jb20vcGhvdG9zaG9wLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgMjEuMCAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDIwLTExLTIzVDE4OjM3OjAyKzAzOjAwIiB4bXA6TWV0YWRhdGFEYXRlPSIyMDIwLTExLTIzVDE4OjM3OjAyKzAzOjAwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAyMC0xMS0yM1QxODozNzowMiswMzowMCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo3ZTZmYzYyZi1iZjUzLTVmNDctODlmYi1jYWQ1NzM1MjM4MzMiIHhtcE1NOkRvY3VtZW50SUQ9ImFkb2JlOmRvY2lkOnBob3Rvc2hvcDplYzJjMTNmNS1lNGNiLWM5NDAtYmJjMC1hZjdlZWM3YTliNGYiIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDoyNzdhY2YyOS1hYjZhLTA3NGEtOGVmOC1kNTM5Y2FmNDU3YTEiIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciPiA8eG1wTU06SGlzdG9yeT4gPHJkZjpTZXE+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJjcmVhdGVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjI3N2FjZjI5LWFiNmEtMDc0YS04ZWY4LWQ1MzljYWY0NTdhMSIgc3RFdnQ6d2hlbj0iMjAyMC0xMS0yM1QxODozNzowMiswMzowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIxLjAgKFdpbmRvd3MpIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo3ZTZmYzYyZi1iZjUzLTVmNDctODlmYi1jYWQ1NzM1MjM4MzMiIHN0RXZ0OndoZW49IjIwMjAtMTEtMjNUMTg6Mzc6MDIrMDM6MDAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCAyMS4wIChXaW5kb3dzKSIgc3RFdnQ6Y2hhbmdlZD0iLyIvPiA8L3JkZjpTZXE+IDwveG1wTU06SGlzdG9yeT4gPHBob3Rvc2hvcDpUZXh0TGF5ZXJzPiA8cmRmOkJhZz4gPHJkZjpsaSBwaG90b3Nob3A6TGF5ZXJOYW1lPSJDQUxBSEVYIiBwaG90b3Nob3A6TGF5ZXJUZXh0PSJDQUxBSEVYIi8+IDwvcmRmOkJhZz4gPC9waG90b3Nob3A6VGV4dExheWVycz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7VCiRhAAAOIUlEQVRoge1ae3BT15n/zrlP6cq2LL+xzEsQoAM4sMCKOGmAUGaTNNs0yeax7KTB+5gpO1PYcTadzWPSTmY7k8wypd0ZOqEE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" alt="">
                </div>
                {{-- <div>
                  <h2>Sign up</h2>
                  <p>User Registration Engine</p>
                  @if (Route::has('password.request'))
                    <a href="{{ route('register') }}" class="btn btn-primary active mt-3">{{ __('Register') }}</a>
                  @endif
                </div> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection

@section('javascript')

@endsection