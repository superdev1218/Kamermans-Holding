<div class="tab-pane container fade  mt-1" id="manage_balances">
   <h3 style="text-align:center;margin-top:20px;">Manage Balances</h3>
   <div class="row">
       <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
           <h5><br/><br/>Exchange:</h5>
       </div>
       <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4" style="padding:10px 20px 10px 30px;">
           <label>Token</label>
           <select class="form-control" name="title" id="exchange_token" onchange="tokenSelect('exchange')">
               <option value="0"></option>
               @foreach($tokens as $token)
                   <option value="{{ $token->id }}">{{ $token->token_symbol }}</option>
               @endforeach
           </select>
       </div>
       <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4" style="padding:10px 20px 10px 30px;">
           <label>Amount</label>
           <input type="number" step="0.0000001" class="form-control" id="exchange_amount" value="">
       </div>
       <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2" style="padding:10px 20px 10px 30px;">
           <br/>
           <a class="btn btn-success float-right" onclick="tokenSave('exchange')">Save</a>
       </div>
   </div>   
</div>