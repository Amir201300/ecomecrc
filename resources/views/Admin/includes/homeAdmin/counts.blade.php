<div class="card-group">
    <!-- Card -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="m-r-10">
                    <span class="btn btn-circle btn-lg bg-danger">
                        <i class="fa fa-users text-white"></i>
                    </span>
                </div>
                <div>
                    عدد العملاء
                </div>
                <div class="ml-auto">
                    <h2 class="m-b-0 font-light">{{getCounts(new \App\Models\User())}}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Card -->
    <!-- Card -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="m-r-10">
                    <span class="btn btn-circle btn-lg btn-info">
                        <i class="icon-Checked-User"></i>
                    </span>
                </div>
                <div>
                    عدد الموظفين

                </div>
                <div class="ml-auto">
                    <h2 class="m-b-0 font-light">{{getCounts(new \App\Models\Admin())}}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Card -->
    <!-- Card -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="m-r-10">
                    <span class="btn btn-circle btn-lg bg-success">
                        <i class="fa fa-user text-white"></i>
                    </span>
                </div>
                <div>
                    عدد الموردون

                </div>
                <div class="ml-auto">
                    <h2 class="m-b-0 font-light">{{getCounts(new \App\Models\Supplier())}}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Card -->
    <!-- Card -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="m-r-10">
                    <span class="btn btn-circle btn-lg bg-warning">
                        <i class="fab fa-first-order text-white"></i>
                    </span>
                </div>
                <div>
                    عدد الفواتير

                </div>
                <div class="ml-auto">
                    <h2 class="m-b-0 font-light">{{getCounts(new \App\Models\InvoiceSale())}}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Card -->
    <!-- Column -->


</div>

