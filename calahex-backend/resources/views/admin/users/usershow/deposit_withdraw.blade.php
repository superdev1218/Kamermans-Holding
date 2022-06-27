
    <div class="tab-pane container fade  mt-4 pb-5" id="deposit_withdraw">

            <form action ="{{route('users.manage',$user->id)}}" method = "POST">
                @csrf
                <div class = "row">
            <div class = "col-sm-6">
                <div class="form-group d-flex">
                    <label for="inputZip" style="margin-right:20px;">BTC</label>
                    <input type="number" step="0.000001" class="form-control mr-2 @error('btc') is-invalid @enderror" name = "btc" value = "0" required>
                </div>
                <div class="form-group d-flex">
                    <label for="inputZip" style="margin-right:18px;">ETH</label>
                    <input type="number" step="0.0001" class="form-control mr-2 @error('eth') is-invalid @enderror" name = "eth" value = "0" required>
                </div>
                <div class="form-group d-flex">
                    <label for="inputZip" style="margin-right:10px;">USDT</label>
                    <input type="number" step="0.01" class="form-control mr-2 @error('usdt') is-invalid @enderror" name = "usdt" value = "0" required>
                </div>
                <div class="form-group d-flex">
                    <label for="inputZip" style="margin-right:10px;">SXP</label>
                    <input type="number" step="0.01" class="form-control mr-2 @error('sxp') is-invalid @enderror" name = "sxp" value = "0" required>
                </div>
            </div>
            <div class = "col-sm-6">
                <div class="form-group d-flex">
                    <label for="inputZip" style="margin-right:20px;">REPV2</label>
                    <input type="number" step="0.000001" class="form-control mr-2 @error('rep') is-invalid @enderror" name = "rep" value = "0" required>
                </div>
                <div class="form-group d-flex">
                    <label for="inputZip" style="margin-right:18px;">YFI</label>
                    <input type="number" step="0.0001" class="form-control mr-2 @error('yfi') is-invalid @enderror" name = "yfi" value = "0" required>
                </div>
                <div class="form-group d-flex">
                    <label for="inputZip" style="margin-right:10px;">UNI</label>
                    <input type="number" step="0.01" class="form-control mr-2 @error('uni') is-invalid @enderror" name = "uni" value = "0" required>
                </div>
                <div class="form-group d-flex">
                    <label for="inputZip" style="margin-right:10px;">LINK</label>
                    <input type="number" step="0.01" class="form-control mr-2 @error('link') is-invalid @enderror" name = "link" value = "0" required>
                </div>
            </div>
            <input type = "hidden" name = "id" value = "{{$user->id}}">
            <a href="{{ route('users.index') }}" class="float-right btn btn-primary" style="margin-top:10px;">{{ __('Back') }}</a>
            <button type="submit" class="float-right btn btn-success mr-2" style="margin-top:10px;">Save</button>   
       
        </div>
       </form>
     </div>
