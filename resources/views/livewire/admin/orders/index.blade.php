<div>   
    <div class="row">
        <div class="col-md-12">
            @if (session()->has('status')) 
            <div class="alert alert-success" role="alert">
                {{ session("status") }}
            </div>
            @endif
            <div class="card">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h4 class="cart-title m-0">Orders</h4>
                    <a href="{{ url('/admin/order-history') }}" class="btn btn-sm btn-info">Order History</a>
                </div>
                <div class="card-body">
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
                                            <span class="badge bg-primary">Pending</span>
                                            @elseif ($order->status == 1)
                                            <span class="badge bg-success">Complated</span>
                                            @elseif ($order->status == 2)
                                            <span class="badge bg-warning">Shipping</span>
                                            @elseif ($order->status == 3)
                                            <span class="badge bg-danger">Cancelled</span>
                                            @elseif ($order->status == 4)
                                            <span class="badge bg-info">Proccessing</span>
                                            @elseif ($order->status == 5)
                                            <span class="badge bg-dark">Refunded</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/order/'.$order->id) }}" class="btn text-white btn-success btn-sm">View</a>
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
