<x-user.app-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-6 mb-6">
            <!-- Sales Overview-->
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1"> Overview</h5>
                            {{-- <div class="dropdown">
                                <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-1" type="button"
                                    id="salesOverview" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="ri-more-2-line ri-20px"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesOverview">
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                </div>
                            </div> --}}
                        </div>
                        {{-- <div class="d-flex align-items-center card-subtitle">
                            <div class="me-2">Total 42.5k Sales</div>
                            <div class="d-flex align-items-center text-success">
                                <p class="mb-0 fw-medium">+18%</p>
                                <i class="ri-arrow-up-s-line ri-20px"></i>
                            </div>
                        </div> --}}
                    </div>
                    <div class="card-body d-flex justify-content-between flex-wrap gap-4">
                        <a href="{{ route('user.product') }}" class="d-flex align-items-center gap-3">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded">
                                    <i class="ri-user-star-line ri-24px"></i>
                                </div>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{ $product }}</h5>
                                <p class="mb-0">Total Products</p>
                            </div>
                        </a>
                        <a href="{{ route('user.order.list') }}" class="d-flex align-items-center gap-3">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-warning rounded">
                                    <i class="ri-pie-chart-2-line ri-24px"></i>
                                </div>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{ $orders }}</h5>
                                <p class="mb-0">Total Orders</p>
                            </div>
                        </a>
                        {{-- <div class="d-flex align-items-center gap-3">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-info rounded">
                                    <i class="ri-arrow-left-right-line ri-24px"></i>
                                </div>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">2,450k</h5>
                                <p class="mb-0">New Transactions</p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <!--/ Sales Overview-->

            {{-- <!-- Ratings -->
            <div class="col-lg-3 col-sm-6">
                <div class="card h-100">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-body">
                                <div class="card-info mb-5">
                                    <h6 class="mb-2 text-nowrap">Ratings</h6>
                                    <div class="badge bg-label-primary rounded-pill lh-xs">
                                        Year of 2021
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-0 me-2">8.14k</h4>
                                    <p class="mb-0 text-success">+15.6%</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-end d-flex align-items-end">
                            <div class="card-body pb-0 pt-7">
                                <img src="{{asset('user_assets/assets/img/illustrations/card-ratings-illustration.png')}}" alt="Ratings"
                                    class="img-fluid" width="95" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Ratings -->

            <!-- Sessions -->
            <div class="col-lg-3 col-sm-6">
                <div class="card h-100">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-body">
                                <div class="card-info mb-5">
                                    <h6 class="mb-2 text-nowrap">Sessions</h6>
                                    <div class="badge bg-label-success rounded-pill lh-xs">
                                        Last Month
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-0 me-2">12.2k</h4>
                                    <p class="mb-0 text-danger">-25.5%</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-end d-flex align-items-end">
                            <div class="card-body pb-0 pt-7">
                                <img src="{{asset('user_assets/assets/img/illustrations/card-session-illustration.png')}}" alt="Ratings"
                                    class="img-fluid" width="81" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Sessions --> --}}


        </div>

    </div>
    <!-- / Content -->

</x-user.app-layout>
