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
                        <!-- edit form -->
                        <form class="offcanvas offcanvas-end needs-validation" action="{{route('admin.edit-category')}}" method="POST" tabindex="-1" id="edit-category" aria-labelledby="edit-new-categoryLabel" novalidate>
                            <div class="offcanvas-header">
                                <h5 id="edit-categoryLabel" class="offcanvas-title">Edit Category</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                                <!--  -->
                                <p class="text-center">
                                    Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print inibus Bonorum et Malorum for use in a type specimen book.
                                </p>
                                <div class="form-group mb-3">
                                    <label for="category" class="form-label">Categoryo</label>
                                    <input type="text" name="category" class="form-input form-control" id="edit-category-field" placeholder="Cothings">
                                </div>
                                <!-- loader -->
                                <div id="edit-loader" data-loader="<span class='spinner-grow spinner-grow-sm' role='status' aria-hidden='true'></span><span class='visually-hidden'>Loading...</span>"></div>
                                <!-- button submit -->
                                <button type="button" data-form="edit-category" data-loader="edit-loader" class="btn btn-primary mb-1 d-grid w-100" id="btn-edit-category">Save Change</button>
                                <!-- button cancel -->
                                <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                    <!--Search Form -->
                    <div class="card-body mt-2">
                        <form class="dt_adv_search" method="POST" action="#">
                            <div class="row g-1 mb-md-1">
                                <!-- filter by category name -->
                                <div class="col-md-4">
                                    <label class="form-label">Title:</label>
                                    <input name="title" type="text" class="form-control dt-input dt-full-name" data-column="1" placeholder="Alaric Beslier" data-column-index="0" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Date:</label>
                                    <div class="mb-0">
                                        <input type="text" class="form-control dt-date flatpickr-range dt-input" data-column="5" placeholder="StartDate to EndDate" data-column-index="4" name="dt_date" />
                                        <input type="hidden" class="form-control dt-date start_date dt-input" data-column="5" data-column-index="4" name="date_from" />
                                        <input type="hidden" class="form-control dt-date end_date dt-input" name="date_to" data-column="5" data-column-index="4" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Status:</label>
                                    <select name="status" id="status" class="control form-select">
                                        <option value="">All</option>
                                        <option selected value="active">Active </option>
                                        <option value="disable">Disabled</option>
                                    </select>
                                </div>
                            </div>
                            <!-- button / filter /reset export -->
                            <div class="row g-1 mt-1">

                                <div class="col-md-8 ms-auto">
                                    <div class="row">
                                        <div class="col-md-4 ms-auto">
                                            <button class="btn btn-secondary w-100 btn-reset" type="button">Reset</button>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="btn btn-success w-100 btn-filter" type="button">Filter</button>
                                        </div>
                                    </div>


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
        order_dir: 'desc',
        form_el:".dt_adv_search"
    });

    // submit form
    $("#save-category").form_submit({
        file: false,
        datatable: false,
        form_id: "add-new-category",
        title: 'Category',
        datatable: category_table,
    });
    // edit category/form
    $("#btn-edit-category").form_submit({
        file: false,
        datatable: false,
        form_id: "edit-category",
        title: 'Category Update',
        datatable: category_table,
        reset: false,
    });
    // edit category
    $(document).on('click', ".btn-cat-edit", function() {
        // get data from cantroller button
        $("#edit-category-field").val($(this).data('category'));
        // show offcanvas
        var myOffcanvas = $("#edit-category")
        var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
        bsOffcanvas.show()
    })
</script>
@endsection