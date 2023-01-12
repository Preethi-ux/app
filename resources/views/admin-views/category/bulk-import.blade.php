@extends('layouts.admin.app')

@section('title','Categories Bulk Import')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <h1 class="page-header-title text-capitalize">
                <div class="card-header-icon d-inline-flex mr-2 img">
                    <img src="{{asset('/assets/admin/img/export.png')}}" alt="">
                </div>
                {{__('messages.categories')}} {{__('messages.bulk_import')}}
            </h1>
        </div>
        <!-- Content Row -->
        <div class="card">
            <div class="card-body p-2">
                <div class="export-steps style-2">
                    <div class="export-steps-item">
                        <div class="inner">
                            <h5>STEP 1</h5>
                            <p>
                                Download Excel File
                            </p>
                        </div>
                    </div>
                    <div class="export-steps-item">
                        <div class="inner">
                            <h5>STEP 2</h5>
                            <p>
                                Match Spread sheet data according to instruction
                            </p>
                        </div>
                    </div>
                    <div class="export-steps-item">
                        <div class="inner">
                            <h5>STEP 3</h5>
                            <p>
                                Validate data and and complete import
                            </p>
                        </div>
                    </div>
                </div>
                <div class="jumbotron  pt-1 pb-4 mb-0 bg-white">
                    <h2 class="mb-3 text-primary">Instructions</h2>
                    <p> 1. Download the format file and fill it with proper data.</p>

                    <p><p>2. You can download the example file to understand how the data must be filled.</p>

                    <p>3. Once you have downloaded and filled the format file, upload it in the form below and
                        submit.</p>

                    <p> 4. After uploading categories you need to edit them and set category's images.</p>

                    <p> 5. For parent category "position" will 0 and for sub category it will be 1.</p>

                    <p> 6. By default status will be 1, please input the right ids.</p>
                    <p> 7. For a category parent_id will be empty, for sub category it will be the category id.</p>
                </div>
                <div class="text-center pb-4">
                    <h3 class="mb-3 export--template-title">Download Spreadsheet Template</h3>
                    <div class="btn--container justify-content-center export--template-btns">
                        <a href="{{asset('assets/categories_bulk_format.xlsx')}}" download=""
                            class="btn btn-dark">Template with Existing Data</a>
                        <a href="{{asset('assets/categories_bulk_without_data_format.xlsx')}}" download=""
                            class="btn btn-dark">Template without Data</a>
                    </div>
                </div>
            </div>
        </div>

        <form class="product-form" action="{{route('admin.category.bulk-import')}}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="card mt-2 rest-part">
                <div class="card-body">
                    <h4 class="mb-3">{{__('messages.Import Categories File')}}</h4>
                    <div class="custom-file custom--file">
                        <input type="file" name="products_file" class="form-control" id="bulk__import">
                        <label class="custom-file-label" for="bulk__import">Choose File</label>
                    </div>
                </div>
                <div class="card-footer border-0">
                    <div class="btn--container justify-content-end">
                        <button type="reset" class="btn btn--reset">Clear</button>
                        <button type="submit" class="btn btn--primary">Submit</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection

@push('script')

@endpush