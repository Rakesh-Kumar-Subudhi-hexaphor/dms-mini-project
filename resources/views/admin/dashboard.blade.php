<x-backend.app-layout>

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">DMS /</span> Dashboard
        </h4>

        <!-- Card Border Shadow -->
        <div class="row">
            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">

                            <h4 class="ms-1 mb-0">{{$user}}</h4>
                        </div>
                        <p class="mb-1">Total Users</p>

                    </div>
                </div>
            </div>
            {{-- <div class="col-sm-6 col-lg-2 mb-4">
                <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">

                            <h4 class="ms-1 mb-0">{{$blog}}</h4>
                        </div>
                        <p class="mb-1">Total Blogs</p>

                    </div>
                </div>
            </div> --}}

        </div>


    </div>
    <!-- / Content -->
</x-backend.app-layout>
