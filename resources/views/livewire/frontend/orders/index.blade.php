<div>
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">My Orders</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <div class="cart-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Tracking No</th>
                                    <th>Payment Mode</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->tracking_no }}</td>
                                        <td>{{ $order->payment_mode }}</td>
                                        <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            @if ($order->status == 0)
                                            <span class="badge badge-primary">Pending</span>
                                            @elseif ($order->status == 1)
                                            <span class="badge badge-success">Complated</span>
                                            @elseif ($order->status == 2)
                                            <span class="badge badge-warning">Shipping</span>
                                            @elseif ($order->status == 3)
                                            <span class="badge badge-danger">Cancelled</span>
                                            @elseif ($order->status == 4)
                                            <span class="badge badge-info">Proccessing</span>
                                            @elseif ($order->status == 5)
                                            <span class="badge badge-dark">Refunded</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('orders/'.$order->id) }}" class="btn btn-success btn-sm">View</a>
                                        </td>
                                    </tr>                                    
                                @empty
                                    <tr>
                                        <td colspan="8">No orders found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4 justify-content-center">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>

</div>
