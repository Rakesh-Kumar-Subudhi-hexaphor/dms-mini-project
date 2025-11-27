<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
            <i class="ri-menu-fill ri-22px"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Notification -->
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-4 me-xl-1">
                <a class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                    href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                    aria-expanded="false">
                    <i class="ri-notification-2-line ri-22px"></i>

                </a>
                <ul class="dropdown-menu dropdown-menu-end py-0">

                    <!-- Header -->
                    <li class="dropdown-menu-header border-bottom py-50">
                        <div class="dropdown-header d-flex align-items-center py-2">
                            <h6 class="mb-0 me-auto">Notifications</h6>

                            <a href="javascript:void(0)" id="mark-all-read"
                                class="btn btn-text-secondary rounded-pill btn-icon" title="Mark all as read">
                                <i class="ri-mail-open-line text-heading ri-20px"></i>
                            </a>
                        </div>
                    </li>

                    <!-- List -->
                    <li class="dropdown-notifications-list scrollable-container">
                        <ul class="list-group list-group-flush">
                            @php
                                use Illuminate\Support\Facades\Auth;
                                use App\Models\Order;
                                use App\Models\Notification;

                                $user = Auth::user();

                                $allNotifications = collect();
                                $notifications = collect();

                                if ($user) {
                                    // Get all order IDs made by logged in user
                                    $orderIds = Order::where('user_id', $user->id)->pluck('id');

                                    // Unread notifications (badge count)
                                    $notifications = Notification::whereIn('order_id', $orderIds)
                                        ->where('is_read', false)
                                        ->orderBy('created_at', 'desc')
                                        ->take(5)
                                        ->get();

                                    // All notifications for dropdown UI
                                    $allNotifications = Notification::whereIn('order_id', $orderIds)
                                        ->orderBy('created_at', 'desc')
                                        ->take(20)
                                        ->get();
                                }
                            @endphp

                            @forelse($allNotifications as $noti)
                                <li class="list-group-item list-group-item-action dropdown-notifications-item"
                                    id="noti-{{ $noti->id }}" style="{{ $noti->is_read ? 'opacity:0.5;' : '' }}">

                                    <div class="d-flex" style="flex-direction: column">
                                        <div class="flex-grow-1">

                                            <small class="mb-1 d-block text-body">
                                                Order <strong>#{{ $noti->order->order_no }}</strong>
                                                status update: <strong>{{ $noti->message }}</strong>
                                            </small>

                                            <small class="text-muted">
                                                {{ $noti->created_at->diffForHumans() }}
                                            </small>
                                        </div>

                                        @if (!$noti->is_read)
                                            <button class="btn btn-sm mark-read-btn" data-id="{{ $noti->id }}"
                                                style="font-size: 10px; margin-left:10px;">
                                                Mark as Read
                                            </button>
                                        @endif
                                    </div>

                                </li>
                            @empty
                                <li class="list-group-item text-center text-muted py-3">
                                    No notifications
                                </li>
                            @endforelse

                        </ul>
                    </li>

                </ul>

            </li>
            <!--/ Notification -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('user_assets/assets/img/avatars/1.png') }}" alt class="rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="pages-account-settings-account.html">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-2">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('user_assets/assets/img/avatars/1.png') }}" alt
                                            class="rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    @if (Auth::check())
                                        <span class="fw-medium d-block small">{{ Auth::user()->name }} !</span>

                                        <small class="text-muted">{{ Auth::user()->email }}</small>
                                    @else
                                        <p>Please log in to see your dashboard.</p>
                                    @endif

                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>


                    <li>
                        <div class="d-grid px-4 pt-2 pb-1">
                            <a class="btn btn-sm btn-danger d-flex" href="{{ route('user.logout') }}" target="_blank">
                                <small class="align-middle">Logout</small>
                                <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {

        // Mark single as read
        $('.mark-read-btn').click(function() {
            let id = $(this).data('id');

            $.ajax({
                url: '/notifications/' + id + '/read',
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#noti-' + id).css('opacity', '0.5');
                    $('#noti-' + id + ' .mark-read-btn').remove();
                }
            });
        });

        // Mark all as read
        $('#mark-all-read').click(function() {
            $.ajax({
                url: '/notifications/read-all',
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('.dropdown-notifications-item').css('opacity', '0.5');
                    $('.mark-read-btn').remove();
                }
            });
        });

    });
</script>
