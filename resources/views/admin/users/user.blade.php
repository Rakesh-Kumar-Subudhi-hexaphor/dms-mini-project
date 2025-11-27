<x-backend.app-layout>
    <div class="bg-white m-3 p-3">
        <!-- Role Table -->
        <div>
            <a href="{{ route('admin.users.download') }}" class="btn btn-success mb-3">Download CSV</a>
        </div>
        <div class="card">

            <div class="card-datatable table-responsive">
                <table class="datatables-users table border-top">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>User Type</th>
                            <th>Company Name</th>
                            <th>Designation</th>
                            <th>Address</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Pincode</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->fname }} {{ $role->lname }}</td>
                                <td>{{ $role->email }}</td>
                                <td>{{ $role->phone }}</td>
                                <td>{{ $role->user_type }}</td>
                                <td>{{ $role->company_name }}</td>
                                <td>{{ $role->designation }}</td>
                                <td>{{ $role->address1 }}</td>
                                <td>{{ $role->state }}</td>
                                <td>{{ $role->country }}</td>
                                <td>{{ $role->pincode }}</td>


                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Role Table -->
    </div>
</x-backend.app-layout>
