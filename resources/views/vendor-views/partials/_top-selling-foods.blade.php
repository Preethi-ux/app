<!-- Header -->
<div class="card-header">
    <h5 class="card-header-title align-items-center d-flex">
        <img src="{{asset('/public/assets/admin/img/dashboard/top-selling.png')}}" alt="dashboard" class="card-header-icon mr-2 mb-1">
        <span>{{trans('messages.top_selling_foods')}}</span>
    </h5>
</div>
<!-- End Header -->

<!-- Body -->
<div class="card-body">
    <div class="row g-2">
        @foreach($top_sell as $key=>$item)
            <div class="col-md-4 col-sm-6">
                <div class="grid-card top-selling-food-card pt-0" onclick="location.href='{{route('vendor.food.view',[$item['id']])}}'">
                    <div class="position-relative">
                        <span class="sold--count-badge">
                            {{__('messages.sold')}} : {{$item['order_count']}}
                        </span>
                        <img class="rounded" style="width: 100%;height: 120px;object-fit:cover"
                            src="{{asset('storage/app/public/product')}}/{{$item['image']}}"
                            onerror="this.src='{{asset('/assets/admin/img/100x100/food.png')}}'" alt="{{$item->name}} image">
                    </div>
                    <div class="text-center mt-2">
                        <span>{{$item['name']}}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- End Body -->
