@if(Session::has("Cart") != null)
<div class="header-cart-content flex-w js-pscroll">
	<ul class="header-cart-wrapitem w-full">
		<div class="container">
			@foreach(Session::get("Cart")->products as $item)
			<div class="row bottom">
				<div class="col header-cart-item-img">
					<img src="upload/news/{{$item['productInfo']->image}}" alt="IMG">
				</div>
				<div class="col-6">
					<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
						{{$item['productInfo']->name}}
					</a>
					<span class="header-cart-item-info">
						{{$item['quanty']}} x {{number_format($item['productInfo']->price)}}đ
					</span>
				</div>
				<div class="col ">
					<a class="btn-cart" data-id="{{$item['productInfo']->id}}">
						<iconify-icon icon="zmdi:close"></iconify-icon>
					</a>
				</div>
			</div>
			@endforeach
		</div>
	</ul>
	<div class="w-full">
		<div class="header-cart-total w-full p-tb-40">
			Total: {{number_format(Session::get("Cart")->totalPrice,'0','','.')}}đ
		</div>
		<input type="number" hidden id="total-quanty-cart"  value="{{Session::get('Cart')->totalQuanty}}">
		<div class="header-cart-buttons flex-w w-full">
			<a href="{{route('cart.list')}}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
				View Cart
			</a>

			<a href="" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
				Check Out
			</a>
		</div>
	</div>

</div>

@endif