<div id="header">
		<div class="header-top">
			<div class="container">
				<div class="pull-left auto-width-left">
					<ul class="top-menu menu-beta l-inline">
						<li><a href=""><i class="fa fa-home"></i> 99 Tô Hiến Thành,Phước Mỹ, Quận Sơn Trà</a></li>
						<li><a href=""><i class="fa fa-phone"></i> 032 761 74261</a></li>
					</ul>
				</div>
				<div class="pull-right auto-width-right">
					<ul class="top-details menu-beta l-inline">

                        @if(Auth::check())
                        <li><a href="#"><i class="fa fa-user"></i>Chào bạn {{Auth::user()->full_name}}</a></li>
                        <li><a href="{{route('logout')}}">Đăng xuất</a></li>
                        @else
						<li><a href="{{ route('getSignup')}}">Đăng kí</a></li>
						<li><a href="{{ route('postLogin')}}">Đăng nhập</a></li>
                        @endif
					</ul>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-top -->
		<div class="header-body">
			<div class="container beta-relative">
				<div class="pull-left">
					<a href="{{route('trangchu') }}" id="logo"><img src="/source/assets/dest/images/logo-cake.png" width="200px" alt=""></a>
				</div>
				<div class="pull-right beta-components space-left ov">
					<div class="space10">&nbsp;</div>
					<div class="beta-comp">
						<form role="search" method="get" id="searchform" action="{{route('timkiem')}}">
					        <input type="text" value="" name="key" id="s" placeholder="Nhập từ khóa..." />
					        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
						</form>
					</div>

					<div class="beta-comp">
                    @if(Session::has('cart'))
                    @foreach ($product_cart as $product)
						<div class="cart">
							<div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng (@if(Session::has('cart')){{Session('cart')->totalQty}}@else Trống @endif) <i class="fa fa-chevron-down"></i></div>
							<div class="beta-dropdown cart-body">

								<div class="cart-item">
                                    <a  class ="cart-item-delete" href="{{route('xoagiohang',$product['item']['id'])}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></a>
									<div class="media">
										<a class="pull-left" href="#"><img src="/source/image/product/{{$product['item']['image']}}" alt=""></a>
										<div class="media-body">
											<span class="cart-item-title">{{$product['item']['name']}}</span>
											<!-- <span class="cart-item-options">Size: XS; Colar: Navy</span> -->
											<span class="cart-item-amount">{{$product['qty']}}*<span>@if($product['item']['promotion_price']==0){{number_format($product['item']['unit_price'])}}@else{{number_format($product['item']['promotion_price'])}}@endif</span></span>
										</div>
									</div>
								</div>
                                @endforeach

								<div class="cart-caption">
									<div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">@if($product['item']['promotion_price']==0){{number_format($product['item']['unit_price'])}}@else{{number_format($product['item']['promotion_price'])}}@endif đồng</span></div>
									<div class="clearfix"></div>

									<div class="center">
										<div class="space10">&nbsp;</div>
										<a href="{{ route('dathang')}}" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
							</div>
						</div> <!-- .cart -->
                        @endif
					</div>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-body -->
		<div class="header-bottom" style="background-color: #0277b8;">
			<div class="container">
				<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
				<div class="visible-xs clearfix"></div>
				<nav class="main-menu">
					<ul class="l-inline ov">
						<li><a href="{{ route('trangchu') }}">Trang chủ</a></li>
						<li><a >Sản phẩm</a>
							<ul class="sub-menu">
                                @foreach($loai_sp as $loai )
								<li><a href="{{ route('loaisanpham',$loai->id)}}">{{$loai->name}}</a></li>
                                @endforeach
							</ul>
						</li>
						<li><a href="{{ route('gioithieu')}}">Giới thiệu</a></li>
						<li><a href="{{ route('lienhe')}}">Liên hệ</a></li>
					</ul>
					<div class="clearfix"></div>
				</nav>
			</div> <!-- .container -->
		</div> <!-- .header-bottom -->
	</div> <!-- #header -->
