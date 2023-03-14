@extends('layouts.front')

@section('title')
    Checkout
@endsection

@section('content')

    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/')}}">Home</a>/
                <a href="{{ url('checkout')}}">Checkout</a>
            </h6>
        </div>
    </div>

    <div class="container mt-3">
        <form action="{{ url('place-order')}}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Basic Detail</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="">First Name</label>
                                    <input type="text" required name="fname" value="{{ Auth::user()->name }}" class="form-control firstname" placeholder="Enter First Name">
                                    <span id="fname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Last Name</label>
                                    <input type="text" required name="lname" value="{{ Auth::user()->lname }}" class="form-control lastname" placeholder="Enter Last Name">
                                    <span id="lname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Email</label>
                                    <input type="text" required name="email" value="{{ Auth::user()->email }}" class="form-control email" placeholder="Enter Email">
                                    <span id="email_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Phone Number</label>
                                    <input type="text" required name="phone" value="{{ Auth::user()->phone }}" class="form-control phone" placeholder="Enter Phone Number">
                                    <span id="phone_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Address 1</label>
                                    <input type="text" required name="address1" value="{{ Auth::user()->address1 }}" class="form-control address1" placeholder="Enter Address 1">
                                    <span id="address1_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Address 2</label>
                                    <input type="text" required name="address2" value="{{ Auth::user()->address2 }}" class="form-control address2" placeholder="Enter Address 2">
                                    <span id="address2_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">City</label>
                                    <input type="text" required name="city" value="{{ Auth::user()->city }}" class="form-control city" placeholder="Enter City">
                                    <span id="city_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">State</label>
                                    <input type="text" required name="state" value="{{ Auth::user()->state }}" class="form-control state" placeholder="Enter State">
                                    <span id="state_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Country</label>
                                    <input type="text" required name="country" value="{{ Auth::user()->country }}" class="form-control country" placeholder="Enter Country">
                                    <span id="country_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Pin Code</label>
                                    <input type="text" required name="pincode" value="{{ Auth::user()->pincode }}" class="form-control pincode" placeholder="Enter Pin Code">
                                    <span id="pincode_error" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Order Details</h6>
                            <hr>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total=0; @endphp
                                    @foreach ($cartitems as $item)
                                    <tr>
                                        <td>{{$item->products->name}}</td>
                                        <td>{{$item->prod_qty}}</td>
                                        <td>{{$item->products->selling_price}}</td>
                                    </tr>
                                    @php $total += $item->products->selling_price * $item->prod_qty; @endphp
                                @endforeach
                                </tbody>
                            </table>
                            @php
                                $totalUS = $total/200;
                            @endphp
                            <h6 class="px-2">Grand Total <span class="float-end">Rs {{ $total }}</span></h6>
                            <hr>
                            @if($total!='0')
                                <input type="hidden" name="payment_mode" value="COD">
                                <button type="submit" class="btn btn-success float-end w-100">Place Order | COD</button>
                                <button type="button" class="btn btn-primary w-100 mt-3 razorpay_btn">Pay with Razorpay</button>
                                <div id="paypal-button-container"></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https:/www.paypal.com/sdk/js?client-id=AZs2Jlax_z6GXz7Xo8iCfBF2PwwbatjT0fG0M--HtqzLpL8UZfLx_zbIB8SupDvz_KH98zh5OwL6QV94"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        paypal.Buttons({
            createOrder: function(data, actions){
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ $totalUS }}'
                        }
                    }]
                });
            },
            onApprove: function(data, actions){
                return actions.order.capture().then(function(details){
                    // alert('Transaction completed by '+ details.payer.name.given_name);

                    var firstname = $('.firstname').val();
                    var lastname = $('.lastname').val();
                    var email = $('.email').val();
                    var phone = $('.phone').val();
                    var address1 = $('.address1').val();
                    var address2 = $('.address2').val();
                    var city = $('.city').val();
                    var state = $('.state').val();
                    var country = $('.country').val();
                    var pincode = $('.pincode').val();
                    
                    $.ajax({
                                method: "POST",
                                url: "/place-order",
                                data: {
                                    'fname':firstname,
                                    'lname':lastname,
                                    'email':email,
                                    'phone':phone,
                                    'address1':address1,
                                    'address2':address2,
                                    'city':city,
                                    'state':state,
                                    'country':country,
                                    'pincode':pincode,
                                    'payment_mode': "Paid by Paypal",
                                    'payment_id': details.id,
                                },
                                success: function(response)
                                {
                                    swal(response.status)
                                    .then((value) => {
                                        window.location.href="/my-orders";
                                      });
                                   
                                }
                            });
                });
            }
        }).render('#paypal-button-container');
    </script>

    @endsection