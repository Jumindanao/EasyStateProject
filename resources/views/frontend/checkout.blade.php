@extends('layouts.front')

@section('title')
    Check Out
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}" style="text-decoration: none; color: inherit;">
                    Home
                </a> /
                <a href="{{ url('checkout') }}" style="text-decoration: none; color: inherit;">
                    Checkout
                </a> /
            </h6>
        </div>
    </div>

    <div class="container mt-5">
        <form action="{{ url('place-order') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>User Details</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="firstname">First Name:</label>
                                    <input type="text" class="form-control firstname" value="{{ Auth::user()->name }}"
                                        name="fname" placeholder="First name" required>
                                    <span id="fname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastname">Last Name:</label>
                                    <input type="text" class="form-control lastname" value="{{ Auth::user()->lastname }}"
                                        name="lname" placeholder="Last name" required>
                                    <span id="lname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control email" value="{{ Auth::user()->email }}"
                                        name="email" placeholder="email" required>
                                    <span id="email_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="phone">Phone number:</label>
                                    <input type="text" class="form-control phone" value="{{ Auth::user()->phone }}"
                                        name="phone" placeholder="Phone number" required>
                                    <span id="phone_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="address">Address:</label>
                                    <input type="text" class="form-control address" value="{{ Auth::user()->address }}"
                                        name="address" placeholder="Address" required>
                                    <span id="address_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="city">City:</label>
                                    <input type="text" class="form-control city" value="{{ Auth::user()->city }}"
                                        name="city" placeholder="City" required>
                                    <span id="city_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="state">State:</label>
                                    <input type="text" class="form-control state" value="{{ Auth::user()->state }}"
                                        name="state" placeholder="State" required>
                                    <span id="state_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="pincode">pincode:</label>
                                    <input type="text" class="form-control pincode" value="{{ Auth::user()->pincode }}"
                                        name="pincode" placeholder="Pincode" required>
                                    <span id="pincode_error" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Transaction Details</h6>
                            <hr>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Property Name</th>
                                        <th>Quantity </th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0; @endphp
                                    @foreach ($cartitems as $item)
                                        <tr>
                                            @php $total += ($item->products->selling_price * $item->productquantity) @endphp
                                            <td>{{ $item->products->prodname }}</td>
                                            <td>{{ $item->productquantity }}</td>
                                            <td>{{ $item->products->selling_price }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h6 class="px-2">Overall Total:<span class="float-end">Php {{ $total }}</span></h6>
                            <hr>
                            @if (count($cartitems) > 0)
                                <button type="button" class="btn btn-primary w-100 mt-3 razorpay_btn">Pay With
                                    Razorpay</button>

                                <div id="paypal-button-container"></div>
                            @else
                                <h4 class="text-center">No Propery in Saved Properties</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script
        src="https://www.paypal.com/sdk/js?client-id=AfLVznobpICzDMJuaqZ5sLQQfk9Bw6ZtyP1dguZY_7RaJrGF4IEoVUAJHmhF1OA-AlYPkdNDNvmgglc5">
    </script>
    <script>
        paypal.Buttons({
            // Order is created on the server and the order id is returned
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ $total }}'
                        }
                    }]

                });

            },
            // Finalize the transaction on the server after payer approval
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    //alert('Transaction completed by '+details.payer.name.given_name);
                    var firstname = $('.firstname').val();
                    var lastname = $('.lastname').val();
                    var email = $('.email').val();
                    var phone = $('.phone').val();
                    var address = $('.address').val();
                    var city = $('.city').val();
                    var state = $('.state').val();
                    var pincode = $('.pincode').val();
                    $.ajax({
                        method: "POST",
                        url: "/place-order",
                        data: {
                            'fname': firstname,
                            'lname': lastname,
                            'email': email,
                            'phone': phone,
                            'address': address,
                            'city': city,
                            'state': state,
                            'pincode': pincode,
                            'payment_mode': " Paypal",
                            'payment_id': details.id,
                        },
                        success: function(response) {
                            window.location.href = "/my-orders";
                        }
                    });
                });
            }
        }).render('#paypal-button-container');
    </script>
@endsection
