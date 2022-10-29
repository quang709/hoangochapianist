@extends('pages.index')
@section('content')
<form class="bg0 p-t-75 p-b-85" action="{{route('place-order.store')}}" method="post">
	@csrf
	<div class="container">
		<div class="row" id="list-cart">
			<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
				<div class="m-l-25 m-r--38 m-lr-0-xl">
					<div class="wrap-table-shopping-cart">
						<table class="table-shopping-cart">
							<tbody>
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
								</tr>

								@if(Session::has('Cart')!=null)
								@foreach(Session::get('Cart')->products as $item)
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="upload/news/{{$item['productInfo']->image}}" alt="IMG">
										</div>
									</td>
									<td class="column-2">{{$item['productInfo']->name}}</td>
									<td class="column-3"> {{number_format($item['productInfo']->price)}}đ</td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0" name="m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m minus">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>
											<input class="mtext-104 cl3 txt-center num-product" data-price="{{$item['productInfo']->price}}" data-name="{{$item['productInfo']->name}}" data-id-update="{{$item['productInfo']->id}}" type="number" name="num-product1" value="{{$item['quanty']}}">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m plus">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									<td class="column-5"> {{number_format($item['price'])}}đ</td>
									<td>
										<a class="btn-cart-delele" id="delete-cart" data-id="{{$item['productInfo']->id}}">
											<iconify-icon icon="zmdi:close"></iconify-icon>

										</a>
									</td>
								</tr>
								@endforeach
								@endif
							</tbody>
						</table>
					</div>
					<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
				

						<div class="flex-w flex-m m-r-20 m-tb-5">
							<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" id="code" placeholder="Coupon Code">

							<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5" type="button" id="btnCoupon">
								Apply coupon
							</div>
						</div>
					
						<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" id="list-updateall">
						 	Update Cart
						</div>
					</div>
				</div>
			</div>
		
				
				
			<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">

				<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
					<h4 class="mtext-109 cl2 p-b-30">
						Cart Totals
					</h4>

					<div class="flex-w flex-t bor12 p-b-13">
						<div class="size-208">
							<span class="stext-110 cl2">
								Total Quantity:
							</span>
						</div>

						<div class="size-209">
							@if(Session::has('Cart')!=null)
							<span class="mtext-110 cl2">
								{{Session::get('Cart')->totalQuanty}}
							</span>
							@endif
						</div>
					</div>

					<div class="flex-w flex-t bor12 p-t-15 p-b-30">
						<div class="size-208 w-full-ssm">
							<span class="stext-110 cl2">
								Shipping:
							</span>
						</div>
						<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
							<div class="bor8 bg0 m-b-12">
								<select id="paymentOptions" name="payment">
									<option value="Check payment">Check payment</option>
									<option value="Direct bank Transfer">Direct bank Transfer</option>
								</select>
							</div>

							<div class="p-t-15" id="shipPing">
								<span class="stext-112 cl8">
									Full name*
								</span>
								<div class="bor8 bg0 m-b-12">
									<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name" id="name" @if(Session::has('customer')!=null) value="{{Session::get('customer')->name}}" @endif>
								</div>
								<div class="text-danger"> {{$errors->first('name')}}</div>
								<span class="stext-112 cl8">
									Email*
								</span>
								<div class="bor8 bg0 m-b-22">
									<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="email" name="email" id="email" @if(Session::has('customer')!=null) value="{{Session::get('customer')->email}}" @endif>
								</div>
								<div class="text-danger"> {{$errors->first('email')}}</div>
								<span class="stext-112 cl8">
									Phone*
								</span>
								<div class="bor8 bg0 m-b-22">
									<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="number" name="phone" id="phone" @if(Session::has('customer')!=null) value="{{Session::get('customer')->phone}}" @endif>
								</div>
								<div class="text-danger"> {{$errors->first('phone')}}</div>
								<span class="stext-112 cl8">
									Address*
								</span>
								<div class="bor8 bg0 m-b-22">
									<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address" id="address">
								</div>
								<div class="text-danger" id="errorAddress"> {{$errors->first('address')}}</div>
								<span class="stext-112 cl8">
									order notes
								</span>
								<div class="bor8 bg0 m-b-22">
									<textarea class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="note" id="note"></textarea>
								</div>




							</div>
						</div>
					</div>
              
					@if(Session::has('coupon')!=null)
					<div class="flex-w flex-t p-t-27 p-b-33">
						<div class="size-208">
							<span class="mtext-101 cl2">
								discount:
							</span>
						</div>
                     
						<div class="size-209 p-t-1">
						
							<span class="mtext-110 cl2">
							@if(Session::get('coupon')->condition == 0) 
								{{number_format(Session::get('coupon')->number)}}% 
								@elseif(Session::get('coupon')->condition == 1) 
								{{number_format(Session::get('coupon')->number)}}đ
								@endif
							</span>
						
						</div>
					</div>
					@endif
					<div class="flex-w flex-t p-t-27 p-b-33">
						<div class="size-208">
							<span class="mtext-101 cl2">
								Total:
							</span>
						</div>

						<div class="size-209 p-t-1">
							@if(Session::has('Cart')!=null)
							<span class="mtext-110 cl2"   @if(Session::get('coupon')) style=" text-decoration: line-through " @endif>
								{{number_format(Session::get("Cart")->totalPrice,'0','','.')}}đ							
							</span>
							  @if(Session::has('coupon')!=null && Session::has('coupon')==0)
							    {{ number_format(Session::get("Cart")->totalPrice - ( Session::get("Cart")->totalPrice * Session::get('coupon')->number/100)) }}đ
							 @elseif(Session::has('coupon')!=null && Session::has('coupon')==1)
							 {{ number_format(Session::get("Cart")->totalPrice -  Session::get('coupon')->number) }}đ
								@endif
							@endif
						</div>
						
					</div>

					<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04">
						Checkout
					</button>
					<div id="paypal-button-container"></div>
					<div id="paypal-button-card"></div>
					<button type="button" style="width: 295px" class="btn btn-primary" data-toggle="modal" data-target="#debitAndCredit">
						<i class="fa fa-credit-card"></i> Debit or Credit Card</button>
					@if(\Session::has('error'))
					<div class="alert alert-danger">{{ \Session::get('error') }}</div>
					{{ \Session::forget('error') }}
					@endif
					@if(\Session::has('success'))
					<div class="alert alert-success">{{ \Session::get('success') }}</div>
					{{ \Session::forget('success') }}
					@endif
				</div>

			</div>
		</div>
	</div>
</form>

<!-- Modal -->
<div class="modal fade" id="debitAndCredit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div style="margin-top: 135px; margin-left:447px" class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">PAYMENT CARD</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class='row'>

						<div class='col-md-12'>
							<div class="card">
								<div class="card-body">
								@if(\Session::has('error'))
					<div class="alert alert-danger">{{ \Session::get('error') }}</div>
				
					@endif
									<form class="form-horizontal" method="post" id="payment-form" role="form" action="">
										@csrf
										<div class="mb-3">
											<label class='control-label'>Card Number</label>
											<input autocomplete='off' class='form-control card-number' size='20' type='text' name="card_no">
										</div>
										<div class="row g-3 align-items-center">
											<div class="col-auto">
												<label class='control-label'>CVV</label>
												<input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text' name="cvvNumber">
											</div>
											<div class="col-auto">
												<label class='control-label'>Expiration</label>
												<input class='form-control card-expiry-month' placeholder='MM' size='4' type='text' name="ccExpiryMonth">
											</div>
											<div class="col-auto">
												<label class='control-label'>Year</label>
												<input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' name="ccExpiryYear">
												<input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='hidden' name="amount" value="300">
												<input  type='hidden' name="toTalPrice" @if(Session::has('Cart')!=null) value="{{(Session::get('Cart')->totalPrice)}}" @endif> 
												
											</div>
										</div>

										<div class="mb-3" style="padding-top:20px;">
											<h5 class='total'>Total:<span class='amount'>
													@if(Session::has('Cart')!=null)

													{{number_format(Session::get("Cart")->totalPrice,'0','','.')}}đ

													@endif </span></h5>
										</div>
										

										<div class="mb-3">
											<button class='form-control btn btn-success submit-button-card' type='button'>Pay »</button>
										</div>

										<div class="mb-3">
											<div class='alert-danger alert' style="display:none;">
												Please correct the errors and try again.
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection
@section('script')
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}&currency=USD&disable-funding=credit,card"></script>
<script>
	$(document).on("click", ".btn-cart-delele", function() {
		id = $(this).data("id");
		url = "{{route('cart.destroylist',":id")}}";
		url = url.replace(':id',id);
		$.ajax({
			url: url,
			type: 'GET'
		}).done(function(response) {

			renDerCartList(response.sublistcart);
			renDerCart(response.cart);
			alertify.success('delete to listcart Success ');
		});

	});
	$(document).on('click', '#list-updateall', function() {
		var list = [];
		$('table tbody tr td').find('input').each(function() {
			element = {
				id: $(this).data('id-update'),
				value: $(this).val()
			};
			list.push(element);
		});
		$.ajax({
			url: "{{route('cart.update')}}",
			type: 'POST',
			data: {
				"_token": "{{ csrf_token() }}",
				list
			},
		}).done(function(responseUpdate) {

			renDerCartList(responseUpdate.sublistcart);
			renDerCart(responseUpdate.cart);
			alertify.success('update to Cart Success ');
		});
	});
	$(document).on("click", ".btn-cart", function() {
		id = $(this).data("id");
		url = "{{route('cart.destroylist',":id")}}";
		url = url.replace(':id',id);
		$.ajax({
			url: url,
			type: 'GET'
		}).done(function(response) {
			renDerCart(response);
			renDerCartList(response);
			alertify.success('delete to Cart Success ');
		});

	});
	$(document).on('click', '.minus', function() {
		var minus = $(this).closest('div[name="m-r-0"]').find('input[name="num-product1"]').val();
		if (minus > 0) {
			$(this).closest('div[name="m-r-0"]').find('input[name="num-product1"]').val(minus - 1);
		}
	});
	$(document).on('click', '.plus', function() {
		var plus = $(this).closest('div[name="m-r-0"]').find('input[name="num-product1"]').val();
		$(this).closest('div[name="m-r-0"]').find('input[name="num-product1"]').val(++plus);
	});

	function renDerCartList(response) {

		if (response) {
			$("#list-cart").empty();
			$("#list-cart").html(response);
		}

	}

	function renDerCart(response) {

		if (response) {
			$("#change-item-cart").empty();
			$("#change-item-cart").html(response);
			$(".nav-item .js-show-cart").attr('data-notify', $("#total-quanty-cart").val());
		} else {
			$("#change-item-cart").empty();
			$(".nav-item .js-show-cart").attr('data-notify', 0);
		}

	}
	// Render the PayPal button into #paypal-button-container

	var products = [];
	$('table tbody tr td').find('input').each(function() {
		element = {
			id: $(this).data('id-update'),
			name: $(this).data('name'),
			price: $(this).data('price'),
			quantity: $(this).val()
		};
		products.push(element);
	});

	paypal.Buttons({

		// onInit is called when the button first renders
		onInit: function(data, actions) {

			// Disable the buttons
			actions.disable();

			// Listen for changes to the checkbox
			document.querySelector('#shipPing')
				.addEventListener('change', function(event) {

					// Enable or disable the button when it is checked or unchecked
					if (document.getElementById('address').value ||
						document.getElementById('name').value ||
						document.getElementById('email').value ||
						document.getElementById('phone').value) {
						actions.enable();
					} else {
						actions.disable();
					}
				});
		},

		// Call your server to set up the transaction
		createOrder: function(data, actions) {
			return fetch("{{route('paypal.create')}}", {
				method: 'post',
				body: JSON.stringify({
					price: "{{(Session::get('Cart')->totalPrice??'')}}",
				})
			}).then(function(res) {
				return res.json();
			}).then(function(orderData) {
				return orderData.id;
			});
		},

		// Call your server to finalize the transaction
		onApprove: function(data, actions) {
			return fetch("{{route('paypal.capture')}}", {
				method: 'post',
				body: JSON.stringify({
					orderId: data.orderID,
					name: $('#name').val(),
					email: $('#email').val(),
					phone: $('#phone').val(),
					address: $('#address').val(),
					note: $('#note').val(),
					payment: 'Paypal',
					customer_id: "{{(Session::get('customer')->id??'')}}",
					price: "{{(Session::get('Cart')->totalPrice??'')}}",
					products
				})
			}).then(function(res) {
				return res.json();
			}).then(function(orderData) {
				// Three cases to handle:
				//   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
				//   (2) Other non-recoverable errors -> Show a failure message
				//   (3) Successful transaction -> Show confirmation or thank you

				// This example reads a v2/checkout/orders capture response, propagated from the server
				// You could use a different API or structure for your 'orderData'
				var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

				if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
					return actions.restart(); // Recoverable state, per:
					// https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
				}

				if (errorDetail) {
					var msg = 'Sorry, your transaction could not be processed.';
					if (errorDetail.description) msg += '\n\n' + errorDetail.description;
					if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
					return alert(msg); // Show a failure message (try to avoid alerts in production environments)
				}

				// Successful capture! For demo purposes:

				console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
				var transaction = orderData.purchase_units[0].payments.captures[0];
				alert('Transaction ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

				$.ajax({
					url: "{{ route('session') }}",
					type: 'GET'
				}).done(function(responseForget) {
					renDerCartList(responseForget.sublistcart);
					renDerCart(responseForget.cart);
					alertify.success('Success');
				});
				// Replace the above to show a success message within this page, e.g.
				// const element = document.getElementById('paypal-button-container');
				// element.innerHTML = '';
				// element.innerHTML = '<h3>Thank you for your payment!</h3>';
				// Or go to another URL:  actions.redirect('thank_you.html');
			});
		}
	}).render('#paypal-button-container');

	$( document ).ready(function() {
    console.log( "ready!" );
});

	$(document).on("click", ".submit-button-card", function() {
		url = "{{route('addmoney.stripe')}}";
		$.ajax({
			url: url,
			type: 'POST',
			data:  $('#payment-form').serialize()			
		}).done(function(response) {
			//chua xu ly
      
			renDerCartList(response.sublistcart);
			renDerCart(response.cart);
		
		})
		.fail(function(data) {
			console.log(data);
    
      });
	});
	$(document).on("click", "#btnCoupon", function() {
		url = "{{route('coupon.check')}}";
		$.ajax({
			url: url,
			type: 'post',
			data: {
				"_token": "{{ csrf_token() }}",
				"code":$('#code').val()		
			},
		
		}).done(function(response) {		 
		renDerCartList(response.sublistcart);
		alertify.success(response.message);
			// renDerCart(response.cart);
		
		})
	// 	.fail(function(data) {
	// 		return	console.log(data);
    
    //   });
	});
	
</script>
@endsection