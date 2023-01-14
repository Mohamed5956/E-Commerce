@extends('layouts.front')

@section('title')
    Check Out
@endsection

@section('content')
    <div class="container mt-5">
        <form action="{{ url('/place-order') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>basic details</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="fname">First Name</label>
                                    {{-- value="{{old('pincode',$user->pincode)}}" --}}
                                    <input type="text" name="fname" id="fname" value="{{ Auth::user()->name }}"
                                        class="form-control firstname" placeholder="Enter your first name">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                    <span id="fname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="lname">Last Name</label>
                                    <input type="text" name="lname" id="lname" value="{{ Auth::user()->lname }}"
                                        class="form-control lastname" placeholder="Enter your last name">
                                    <span class="text-danger">{{ $errors->first('lname') }}</span>
                                    <span id="lname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" value="{{ Auth::user()->email }}"
                                        class="form-control email" placeholder="Enter your Email">
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                    <span id="email_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="phone">phone Number</label>
                                    <input type="text" name="phone" id="phone" value="{{ Auth::user()->phone }}"
                                        class="form-control phone" placeholder="Enter your Phone number">
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    <span id="phone_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="address1">Address1</label>
                                    <input type="text" name="address1" id="address1" value="{{ Auth::user()->address1 }}"
                                        class="form-control address1" placeholder="Enter your Address1">
                                    <span class="text-danger">{{ $errors->first('address1') }}</span>
                                    <span id="add1_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="address2">Address2</label>
                                    <input type="text" name="address2" id="address2" value="{{ Auth::user()->address2 }}"
                                        class="form-control address2" placeholder="Enter your Address2">
                                    <span class="text-danger">{{ $errors->first('address2') }}</span>
                                    <span id="add2_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" name="city" id="city" value="{{ Auth::user()->city }}"
                                        class="form-control city" placeholder="Enter your city">
                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                                    <span id="city_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="state">State</label>
                                    <input type="text" name="state" id="state" value="{{ Auth::user()->state }}"
                                        class="form-control state" placeholder="Enter your state">
                                    <span class="text-danger">{{ $errors->first('state') }}</span>
                                    <span id="state_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="country">Country</label>
                                    <input type="text" name="country" id="country" value="{{ Auth::user()->country }}"
                                        class="form-control country" placeholder="Enter your country">
                                    <span class="text-danger">{{ $errors->first('country') }}</span>
                                    <span id="country_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="pincode">Pin Code</label>
                                    <input type="text" name="pincode" id="pincode" value="{{ Auth::user()->pincode }}"
                                        class="form-control pincode" placeholder="Enter your pin-code">
                                    <span class="text-danger">{{ $errors->first('pincode') }}</span>
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
                            <table class="table table-striped table-border">
                                <thead>
                                    <th>Name</th>
                                    <th>quantity</th>
                                    <th>price</th>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $item)
                                        <tr>
                                            <td>{{ $item->products->name }}</td>
                                            <td>{{ $item->prod_qty }}</td>
                                            <td>{{ $item->products->selling_price }}</td>
                                        </tr>
                                    @endforeach
                                    <td>Total Price : {{ $total_price }}</td>
                                </tbody>
                            </table>
                            <hr>
                            <button type="submit" class="btn btn-success w-100 ">Place Order</button>
                            <button type="button" class="btn btn-primary w-100 mt-3 razorpay">Pay with Razorpay</button>
                            <div id="paypal-button-container" class="w-100 mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script
        src="https://www.paypal.com/sdk/js?client-id=AVz4sl0QfPxq90VOzV_0hapbQtrFGnqdxuarsjAaBk-F3UUCnKvPqC2jefmoTlPOvE1Ndx9ySoCrhYdF&currency=USD">
    </script>
    <script>
        paypal.Buttons({
            onClick: function() {
                // Show a validation error if the checkbox is not checked
                if (!document.getElementByID('fname').value || !document.getElementById('lname').value
                || !document.getElementById('phone').value || !document.getElementById('country').value
                || !document.getElementById('state').value || !document.getElementById('city').value ) {
                    document.querySelector('#error').classList.remove('hidden');
                }
            },
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: "{{$total_price}}"// Can also reference a variable or function
                        }
                    }]
                });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For dev/demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    const transaction = orderData.purchase_units[0].payments.captures[0];
                    alert(
                        `Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`
                        );
                    // When ready to go live, remove the alert and show a success message within this page. For example:
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                });
            }
        }).render('#paypal-button-container');
    </script>
@endsection
