@extends('banhang.layout.master')
@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm </h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{route('trangchu')}}">Home</a> / <span>Sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-3">
						<ul class="aside-menu">
                            @foreach ($types as $type)
							<li><a href="{{route('loaisanpham',$type->id)}}">{{$type->name}}</a></li>
                            @endforeach

						</ul>
					</div>
					<div class="col-sm-9">
						<div class="beta-products-list">
							<h4>Sản Phẩm Mới</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tìm thấy {{count($type_products)}} sản phẩm</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
                                @foreach ($type_products as $type )
								<div class="col-sm-4">
									<div class="single-item">
                                    @if($type->promotion_price!=0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
										<div class="single-item-header">
											<a href="{{route('chitietsanpham',$type->id)}}"><img src="/source/image/product/{{$type->image}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$type->name}}</p>
											<p class="single-item-price">
                                                @if($type->promotion_price != 0)
                                            <span class="flash-del">{{number_format($type->unit_price)}}Vnđ</span>
												<span class="flash-sale">{{number_format($type->promotion_price)}} Vnđ</span>
                                                @else
                                                <span>{{number_format($type->unit_price)}}Vnđ</span>
                                                @endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="{{route('themgiohang',$type->id)}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('chitietsanpham',$type->id)}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
                                @endforeach
							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Sản phẩm hàng đầu</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tìm thấy {{count($other_products)}} sản phẩm</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
                            @foreach ($other_products as $other )
								<div class="col-sm-4">
									<div class="single-item">
                                    @if($other->promotion_price!=0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
										<div class="single-item-header">
											<a href="product.html"><img src="/source/image/product/{{$other->image}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$other->name}}</p>
											<p class="single-item-price">
                                                @if($other->promotion_price != 0)
                                            <span class="flash-del">{{number_format($other->unit_price)}}Vnđ</span>
												<span class="flash-sale">{{number_format($other->promotion_price)}} Vnđ</span>
                                                @else
                                                <span>{{number_format($other->unit_price)}}Vnđ</span>
                                                @endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="{{route('themgiohang',$other->id)}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('chitietsanpham',$other->id)}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
                                @endforeach
							</div>
                            <div class="row">{{$other_products->links()}}</div>
							<div class="space40">&nbsp;</div>

						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
    @endsection
