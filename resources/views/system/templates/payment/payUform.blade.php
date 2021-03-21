<form id="payForm" method="post" action="{{env('PAYU_URL')}}">
    <input name="merchantId"    type="hidden"  value="{{env('PAYU_MERCHANTID')}}"   >
    <input name="accountId"     type="hidden"  value="{{env('PAYU_ACCOUNT')}}" >
    <input name="description"   type="hidden"  value="{{$allProducts??''}}"  >
    <input name="referenceCode" type="hidden"  value="{{isset($order['reference'])?$order['reference'].$randy:0}}" >
    <input name="amount"        type="hidden"  value="{{$order['total']??0}}"   >
    <input name="tax"           type="hidden"  value="0"  >
    <input name="taxReturnBase" type="hidden"  value="0" >
    <input name="currency"      type="hidden"  value="COP" >
    <input name="signature"     type="hidden"  value="{{$signature??''}}"  >
    <input type="hidden" name="extra1" value="{{$order['id']??''}}">
    <input type="hidden" name="shippingAddress" value="">
    <input type="hidden" name="shippingCity" value="">
    <input type="hidden" name="shippingCountry" value="">
    <input name="buyerEmail"    type="hidden"  value="{{ session('active_user')["get_user"]["email"]}}" >
    {{-- nextStep --}}
<input name="responseUrl"    type="hidden"  value="{{env('APP_URL').'/order/'}}" >
<input name="confirmationUrl"    type="hidden"  value="{{ config('app.url_apiRequest').'api/payConfirm'}}" >
@if (isset($order['reference']))
<button class="btn btn-danger float-center mb-5 btn-block p-3 m-0"  type="submit"><strong>volver a pagar</strong></button>
@endif
  </form>
