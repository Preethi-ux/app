@extends('layouts.admin.app')

@section('title','Add new zone')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title">
                        <i class="tio-free-transform"></i>{{__('messages.zone')}} {{__('messages.setup')}}
                    </h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.zone.store')}}" method="post" class="shadow--card">
                    @csrf
                    <div class="row justify-content-between">
                        <div class="col-md-5">
                            <div class="zone-setup-instructions">
                                <div class="zone-setup-top">
                                    <h6 class="subtitle">{{translate('messages.instructions')}}</h6>
                                    <p>
                                        {{translate('messages.create_zone_by_click_on_map_and_connect_the_dots_together')}}
                                    </p>
                                </div>
                                <div class="zone-setup-item">
                                    <div class="zone-setup-icon">
                                        <i class="tio-hand-draw"></i>
                                    </div>
                                    <div class="info">
                                        {{translate('messages.use_this_drag_map_to_find_proper_area')}}
                                    </div>
                                </div>
                                <div class="zone-setup-item">
                                    <div class="zone-setup-icon">
                                        <i class="tio-free-transform"></i>
                                    </div>
                                    <div class="info">
                                        {{translate('messages.click_this_icon_to_start_pin_points_in_the_map_and_connect_them_to_draw_a_zone._minimum_3_points_required')}}
                                    </div>
                                </div>
                                <div class="instructions-image mt-4">
                                    <img src={{asset('assets/admin/img/instructions.gif')}} alt="instructions">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-7 zone-setup">
                            <div class="pl-xl-5 pl-xxl-0">
                                <div class="form-group mb-3">
                                    <label class="input-label"
                                        for="exampleFormControlInput1">{{__('messages.zone')}} {{__('messages.name')}}</label>
                                    <input id="name" type="text" name="name" class="form-control h--45px" placeholder="Ex: abc area" value="{{old('name')}}" required>
                                </div>
                                <div class="form-group mb-3" style="display: none">
                                    <label class="input-label"
                                        for="exampleFormControlInput1">{{translate('messages.Coordinates')}}<span class="input-label-secondary" title="{{__('messages.draw_your_zone_on_the_map')}}">{{__('messages.draw_your_zone_on_the_map')}}</span></label>
                                        <textarea type="text" rows="8" name="coordinates"  id="coordinates" class="form-control" readonly></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="input-label">
                                                {{translate('messages.minimum_delivery_charge')}}  ({{\App\CentralLogics\Helpers::currency_symbol()}})
                                            </label>
                                            <input id="minimum_delivery_charge" name="minimum_delivery_charge" type="number" class="form-control h--45px" placeholder="Ex: 10" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="input-label">
                                                {{translate('messages.delivery_charge_per_km')}} ({{\App\CentralLogics\Helpers::currency_symbol()}})
                                            </label>
                                            <input id="delivery_charge_per_km" name="per_km_delivery_charge" type="number" class="form-control h--45px" placeholder="Ex: 10" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="map-warper overflow-hidden" style="border-radius: 5px;">
                                    <input id="pac-input" class="controls rounded" style="height: 3em;width:fit-content;" title="{{__('messages.search_your_location_here')}}" type="text" placeholder="{{__('messages.search_here')}}"/>
                                    <div id="map-canvas" style="height: 100%; margin:0px; padding: 0px;"></div>
                                </div>
                                <div class="btn--container mt-3 justify-content-end">
                                    <button id="reset_btn" type="button" class="btn btn--reset">{{__('messages.reset')}}</button>
                                    <button type="submit" class="btn btn--primary">{{__('messages.submit')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-sm-12 col-lg-12 mb-3 my-lg-2">
                <div class="card">
                    <div class="card-header py-2 flex-wrap border-0 align-items-center">
                        <div class="search--button-wrapper">
                            <h5 class="card-title">{{__('messages.zone')}} {{__('messages.list')}}<span class="badge badge-soft-dark ml-2" id="itemCount">{{$zones->total()}}</span></h5>
                            <form action="javascript:" id="search-form" class="my-2 mr-sm-2 mr-xl-4 ml-sm-auto flex-grow-1 flex-grow-sm-0">
                                            <!-- Search -->
                                @csrf
                                <div class="input--group input-group input-group-merge input-group-flush">
                                    <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="Ex: {{__('messages.search')}} by Name" aria-label="{{__('messages.search')}}" required>
                                    <button type="submit" class="btn btn--secondary">
                                        <i class="tio-search"></i>
                                    </button>
                                </div>
                                <!-- End Search -->
                            </form>
                            <!-- Unfold -->
                            <div class="hs-unfold ml-3">
                                <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle btn export-btn btn-outline-primary btn--primary font--sm" href="javascript:;"
                                   data-hs-unfold-options='{
                                     "target": "#usersExportDropdown",
                                     "type": "css-animation"
                                   }'>
                                    <i class="tio-download-to mr-1"></i> {{__('messages.export')}}
                                </a>

                                <div id="usersExportDropdown"
                                     class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                                    {{--<span class="dropdown-header">{{__('messages.options')}}</span>
                                    <a id="export-copy" class="dropdown-item" href="javascript:;">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                             src="{{asset('assets/admin')}}/svg/illustrations/copy.svg"
                                             alt="Image Description">
                                        {{__('messages.copy')}}
                                    </a>
                                    <a id="export-print" class="dropdown-item" href="javascript:;">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                             src="{{asset('assets/admin')}}/svg/illustrations/print.svg"
                                             alt="Image Description">
                                        {{__('messages.print')}}
                                    </a>
                                    <div class="dropdown-divider"></div>--}}
                                    <span class="dropdown-header">{{__('messages.download')}} {{__('messages.options')}}</span>
{{--                                     <form action="{{route('admin.zone.export-zones')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="type" value="excel">
                                        <button type="submit">
                                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="{{asset('assets/admin')}}/svg/components/excel.svg"
                                            alt="Image Description">
                                            {{__('messages.excel')}}
                                        </button>
                                    </form> --}}
                                    <a target="__blank" id="export-excel" class="dropdown-item" href="{{route('admin.zone.export-zones', ['type'=>'excel'])}}">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="{{asset('assets/admin')}}/svg/components/excel.svg"
                                        alt="Image Description">
                                        {{__('messages.excel')}}
                                    </a>
                                    <a target="__blank" id="export-csv" class="dropdown-item" href="{{route('admin.zone.export-zones', ['type'=>'csv'])}}">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                             src="{{asset('assets/admin')}}/svg/components/placeholder-csv-format.svg"
                                             alt="Image Description">
                                        .{{__('messages.csv')}}
                                    </a>
                                    {{--<a id="export-pdf" class="dropdown-item" href="javascript:;">
                                        <img class="avatar avatar-xss avatar-4by3 mr-2"
                                             src="{{asset('assets/admin')}}/svg/components/pdf.svg"
                                             alt="Image Description">
                                        {{__('messages.pdf')}}
                                    </a>--}}
                                </div>
                            </div>
                            <!-- End Unfold -->
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table id="columnSearchDatatable"
                               class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               data-hs-datatables-options='{
                                 "order": [],
                                 "orderCellsTop": true,
                                 "paging":false
                               }'>
                            <thead class="thead-light">
                            <tr>
                                <th>{{translate('messages.sl')}}</th>
                                <th class="text-center">{{__('messages.zone')}} {{__('messages.id')}}</th>
                                <th class="pl-5">{{__('messages.name')}}</th>
                                <th class="text-center">{{__('messages.restaurants')}}</th>
                                <th class="text-center">{{__('messages.deliverymen')}}</th>
                                <th >{{__('messages.status')}}</th>
                                <th style="width:40px">{{__('messages.action')}}</th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            @foreach($zones as $key=>$zone)
                                <tr>
                                    <td>{{$key+$zones->firstItem()}}</td>
                                    <td class="text-center">
                                        <span class="move-left">
                                            {{$zone->id}}
                                        </span>
                                    </td>
                                    <td class="pl-5">
                                        <span class="d-block font-size-sm text-body">
                                            {{$zone['name']}}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="move-left">
                                            {{$zone->restaurants_count}}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="move-left">
                                            {{$zone->deliverymen_count}}
                                        </span>
                                    </td>
                                    <td>
                                        <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox{{$zone->id}}">
                                            <input type="checkbox" onclick="status_form_alert('status-{{$zone['id']}}','All the restaurants & delivery men under this zone will not be shown in the website or app', event)" class="toggle-switch-input" id="stocksCheckbox{{$zone->id}}" {{$zone->status?'checked':''}}>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                        <form action="{{route('admin.zone.status',[$zone['id'],$zone->status?0:1])}}" method="get" id="status-{{$zone['id']}}">
                                        </form>
                                    </td>
                                    <td>
                                        <div class="pl-1">
                                            <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                                                href="{{route('admin.zone.edit',[$zone['id']])}}" title="{{__('messages.edit')}} {{__('messages.zone')}}"><i class="tio-edit"></i>
                                            </a>
                                            {{--<a class="btn btn-sm btn-white" href="javascript:"
                                            onclick="form_alert('zone-{{$zone['id']}}','Want to delete this zone ?')" title="{{__('messages.delete')}} {{__('messages.zone')}}"><i class="tio-delete-outlined"></i>
                                            </a>
                                            <form action="{{route('admin.zone.delete',[$zone['id']])}}" method="post" id="zone-{{$zone['id']}}">
                                                @csrf @method('delete')
                                            </form>--}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(count($zones) === 0)
                        <div class="empty--data">
                            <img src="{{asset('/assets/admin/img/empty.png')}}" alt="public">
                            <h5>
                                {{translate('no_data_found')}}
                            </h5>
                        </div>
                        @endif
                        <div class="page-area px-4 pb-3">
                            <div class="d-flex align-items-center justify-content-end">
                                <div>
                                {!! $zones->withQueryString()->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Table -->
        </div>
    </div>

@endsection

@push('script_2')
    <script>
        function status_form_alert(id, message, e) {
            e.preventDefault();
            Swal.fire({
                title: "{{translate('messages.are_you_sure')}}",
                text: message,
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonColor: 'var(--secondary-clr)',
                confirmButtonColor: 'var(--primary-clr)',
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Yes',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $('#'+id).submit()
                }
            })
        }
    auto_grow();
    function auto_grow() {
        let element = document.getElementById("coordinates");
        element.style.height = "5px";
        element.style.height = (element.scrollHeight)+"px";
    }

    </script>
    <script>
        $(document).on('ready', function () {
            // $('#zone_wise_delivery_fee').on('change', function(){
            //     if($("#zone_wise_delivery_fee").is(':checked')){
            //         $('.shipping_input').removeAttr('readonly');
            //         $('.shipping_input').attr('required', 'required');
            //         $('.shipping_input_group').show();
            //     } else {
            //         $('.shipping_input').attr('readonly', true);
            //         $('.shipping_input').removeAttr('required');
            //         $('.shipping_input').val('');
            //         $('.shipping_input_group').hide();
            //     }
            // })
            // INITIALIZATION OF DATATABLES
            // =======================================================
            var datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

            $('#column1_search').on('keyup', function () {
                datatable
                    .columns(1)
                    .search(this.value)
                    .draw();
            });


            $('#column3_search').on('change', function () {
                datatable
                    .columns(2)
                    .search(this.value)
                    .draw();
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ \App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value }}&libraries=drawing,places&v=3.45.8"></script>

    <script>
        var map; // Global declaration of the map
        var drawingManager;
        var lastpolygon = null;
        var polygons = [];

        function resetMap(controlDiv) {
            // Set CSS for the control border.
            const controlUI = document.createElement("div");
            controlUI.style.backgroundColor = "#fff";
            controlUI.style.border = "2px solid #fff";
            controlUI.style.borderRadius = "3px";
            controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
            controlUI.style.cursor = "pointer";
            controlUI.style.marginTop = "8px";
            controlUI.style.marginBottom = "22px";
            controlUI.style.textAlign = "center";
            controlUI.title = "Reset map";
            controlDiv.appendChild(controlUI);
            // Set CSS for the control interior.
            const controlText = document.createElement("div");
            controlText.style.color = "rgb(25,25,25)";
            controlText.style.fontFamily = "Roboto,Arial,sans-serif";
            controlText.style.fontSize = "10px";
            controlText.style.lineHeight = "16px";
            controlText.style.paddingLeft = "2px";
            controlText.style.paddingRight = "2px";
            controlText.innerHTML = "X";
            controlUI.appendChild(controlText);
            // Setup the click event listeners: simply set the map to Chicago.
            controlUI.addEventListener("click", () => {
                lastpolygon.setMap(null);
                $('#coordinates').val('');

            });
        }

        function initialize() {
            @php($default_location=\App\Models\BusinessSetting::where('key','default_location')->first())
            @php($default_location=$default_location->value?json_decode($default_location->value, true):0)
            var myLatlng = { lat: {{$default_location?$default_location['lat']:'23.757989'}}, lng: {{$default_location?$default_location['lng']:'90.360587'}} };


            var myOptions = {
                zoom: 13,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
            drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: true,
                drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: [google.maps.drawing.OverlayType.POLYGON]
                },
                polygonOptions: {
                editable: true
                }
            });
            drawingManager.setMap(map);


            //get current location block
            // infoWindow = new google.maps.InfoWindow();
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    map.setCenter(pos);
                });
            }

            google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
                if(lastpolygon)
                {
                    lastpolygon.setMap(null);
                }
                $('#coordinates').val(event.overlay.getPath().getArray());
                lastpolygon = event.overlay;
                auto_grow();
            });

            const resetDiv = document.createElement("div");
            resetMap(resetDiv, lastpolygon);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(resetDiv);

            // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });
            let markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                return;
                }
                // Clear out the old markers.
                markers.forEach((marker) => {
                marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                if (!place.geometry || !place.geometry.location) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                const icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25),
                };
                // Create a marker for each place.
                markers.push(
                    new google.maps.Marker({
                    map,
                    icon,
                    title: place.name,
                    position: place.geometry.location,
                    })
                );

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
                });
                map.fitBounds(bounds);
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);


        function set_all_zones()
        {
            $.get({
                url: '{{route('admin.zone.zoneCoordinates')}}',
                dataType: 'json',
                success: function (data) {

                    console.log(data);
                    for(var i=0; i<data.length;i++)
                    {
                        polygons.push(new google.maps.Polygon({
                            paths: data[i],
                            strokeColor: "#FF0000",
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: "#FF0000",
                            fillOpacity: 0.1,
                        }));
                        polygons[i].setMap(map);
                    }

                },
            });
        }
        $(document).on('ready', function(){
            set_all_zones();
        });

    </script>
    <script>
        $('#search-form').on('submit', function () {
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('admin.zone.search')}}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#set-rows').html(data.view);
                    $('#itemCount').html(data.total);
                    $('.page-area').hide();
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });
    </script>
    <script>
        $('#reset_btn').click(function(){
            $('#name').val(null);
            $('#minimum_delivery_charge').val(null);
            $('#delivery_charge_per_km').val(null);

            lastpolygon.setMap(null);
            $('#coordinates').val(null);
        })
    </script>
@endpush
