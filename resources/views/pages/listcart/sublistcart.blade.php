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
