@extends('banhang.layout.master')
@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản Phẩm</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{route('trangchu')}}">Trang Chủ</a> / <span>Thông tin chi tiết</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">

					<div class="row">
						<div class="col-sm-4">
                        <img src="/source/image/product/{{$product->image }}"alt="">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<p class="single-item-title"><h2>{{$product->name}}</h2></p>
								<p class="single-item-price">
									@if($product->promotion_price !=0)
												<span class="flash-del">{{number_format($product->unit_price)}}</span>
												<span class="flash-sale">{{number_format($product->promotion_price)}}</span>
												@else
												<span>{{number_format($product->unit_price)}}</span>
												@endif
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">
								<p>{{$product->description}}</p>
							</div>
							<div class="space20">&nbsp;</div>

							<p>Options:</p>
							<div class="single-item-options">
								<!-- <select class="wc-select" name="size">
									<option>Size</option>
									<option value="XS">XS</option>
									<option value="S">S</option>
									<option value="M">M</option>
									<option value="L">L</option>
									<option value="XL">XL</option>
								</select>
								<select class="wc-select" name="color">
									<option>Color</option>
									<option value="Red">Red</option>
									<option value="Green">Green</option>
									<option value="Yellow">Yellow</option>
									<option value="Black">Black</option>
									<option value="White">White</option>
								</select> -->
								<select class="wc-select" name="color">
									<option>Số lượng</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<a class="add-to-cart" href="{{route('themgiohang',$product->id)}}"><i class="fa fa-shopping-cart"></i></a>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">Mô tả</a></li>
							<li><a href="#tab-reviews">Reviews (0)</a></li>
						</ul>

						<div class="panel" id="tab-description">
							<p>{{$product->description}}</p>
							<p> </p>
						</div>
						<div class="panel" id="tab-reviews">
							<p>No Reviews</p>
						</div>
					</div>
					<div class="space50">&nbsp;</div>
					<div class="beta-products-list">
						<h4>Sản phẩm liên quan</h4>

						<div class="row">
                            @foreach ($product_tt as $tt )
							<div class="col-sm-4">
								<div class="single-item">
									<div class="single-item-header">
										<a href="product.html"><img src="/source/image/product/{{$tt->image}}" alt=""></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$tt->name}}</p>
										<p class="single-item-price">
                                        @if($tt->promotion_price==0)
												<span class="flash-sale">{{number_format($tt->unit_price)}}Vnđ</span>
												@else
												<span class="flash-del">{{number_format($tt->unit_price)}}Vnđ</span>
												<span class="flash-sale">{{number_format($tt->promotion_price)}} Vnđ</span>
												@endif
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="{{route('themgiohang',$tt->id)}}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{route('chitietsanpham',$tt->id)}}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
                            @endforeach
						</div>
                        <div class="row">{{$product_tt->links()}}</div>
					</div> <!-- .beta-products-list -->
				</div>
				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Bán chạy nhất</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="/source/assets/dest/images/products/sales/1.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="/source/assets/dest/images/products/sales/2.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="/source/assets/dest/images/products/sales/3.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="/source/assets/dest/images/products/sales/4.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- best sellers widget -->
					<div class="widget">
						<h3 class="widget-title">Sản phẩm mới</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
                            @foreach($product_tt as $new)
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="/source/image/product/{{$new->image}}" alt=""></a>
									<div class="media-body">
										{{$new->name}}
										<span style="font-size:15px;"class="beta-sales-price">{{number_format($new->unit_price)}} đồng</span>
									</div>
								</div>
                                @endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
