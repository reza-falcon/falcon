@extends('layouts.admin-layout')
@section('content')
<div class="content-body">
    <!-- Responsive Datatable -->
    <section id="responsive-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">All Categories</h4>
                        <!-- add new offcanvas -->
                        <button class="btn btn-outline-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#add-new-category" aria-controls="add-new-category">
                            Add New
                        </button>
                        <!-- add new form -->
                        <form class="offcanvas offcanvas-end needs-validation" action="{{route('admin.new-category')}}" method="POST" tabindex="-1" id="add-new-category" aria-labelledby="add-new-categoryLabel" novalidate>
                            <div class="offcanvas-header">
                                <h5 id="add-new-categoryLabel" class="offcanvas-title">Add New Category</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                                <!--  -->
                                <p class="text-center">
                                    Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print inibus Bonorum et Malorum for use in a type specimen book.
                                </p>
                                <div class="form-group mb-3">
                                    <label for="category" class="form-label">Categoryo</label>
                                    <input type="text" name="category" class="form-input form-control" placeholder="Cothings">
                                </div>
                                <!-- loader -->
                                <div id="loader-id" data-loader="<span class='spinner-grow spinner-grow-sm' role='status' aria-hidden='true'></span><span class='visually-hidden'>Loading...</span>"></div>
                                <!-- button submit -->
                                <button type="button" data-form="add-new-category" data-loader="loader-id" class="btn btn-primary mb-1 d-grid w-100" id="save-category">Save Category</button>
                                <!-- button cancel -->
                                <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                    <!--Search Form -->
                    <div class="card-body mt-2">
                        <form class="dt_adv_search" method="POST">
                            <div class="row g-1 mb-md-1">
                                <div class="col-md-4">
                                    <label class="form-label">Name:</label>
                                    <input type="text" class="form-control dt-input dt-full-name" data-column="1" placeholder="Alaric Beslier" data-column-index="0" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Email:</label>
                                    <input type="text" class="form-control dt-input" data-column="2" placeholder="demo@example.com" data-column-index="1" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Post:</label>
                                    <input type="text" class="form-control dt-input" data-column="3" placeholder="Web designer" data-column-index="2" />
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="col-md-4">
                                    <label class="form-label">City:</label>
                                    <input type="text" class="form-control dt-input" data-column="4" placeholder="Balky" data-column-index="3" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Date:</label>
                                    <div class="mb-0">
                                        <input type="text" class="form-control dt-date flatpickr-range dt-input" data-column="5" placeholder="StartDate to EndDate" data-column-index="4" name="dt_date" />
                                        <input type="hidden" class="form-control dt-date start_date dt-input" data-column="5" data-column-index="4" name="value_from_start_date" />
                                        <input type="hidden" class="form-control dt-date end_date dt-input" name="value_from_end_date" data-column="5" data-column-index="4" />
                                    </div>
                                </div>
                                <div class="col-md-4 input-wrapper">
                                    <label class="form-label">Salary:</label>
                                    <input type="text" class="form-control dt-input" data-column="6" placeholder="10000" data-column-index="5" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-datatable">
                        <table class="dt-responsive table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Title</th>
                                    <th>Create Date</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Title</th>
                                    <th>Create Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Responsive Datatable -->
</div>
@endsection
@section('script')
<script src="{{asset('assets/js/datatables/z-datatable.js')}}"></script>
<script>
    // fetch data from db
    var category_table = $('.dt-responsive').z_datatable({
        columns: [{
                data: 'responsive_id'
            },
            {
                data: 'title'
            },
            {
                data: 'create_date'
            },
            {
                data: 'status'
            },
            {
                data: 'action'
            },
        ],
        url: '/admin/datatable/category',
        order_col: 1,
        order_dir: 'desc'
    });

    // submit form
    $("#save-category").form_submit({
        file: false,
        datatable: false,
        form_id: "add-new-category",
        title: 'Category',
        datatable: category_table,
    });
</script>
@endsection