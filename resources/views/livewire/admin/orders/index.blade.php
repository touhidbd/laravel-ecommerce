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
                </div>
                <div class="card-header py-4">                
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="cart-title mb-2">Filter by Date:</h5>
                            <input wire:model="date" type="date" value="{{ date('Y-m-d') }}" class="form-control form-control-lg">
                        </div>
                        <div class="col-md-3">
                            <h5 class="cart-title mb-2">Filter by Status:</h5>
                            <select wire:model="status" class="form-control form-control-lg">
                                <option value="" selected>All Orders</option>
                                <option value="0">Pending</option>
                                <option value="1">Complated</option>
                                <option value="2">Shipping</option>
                                <option value="3">Cancelled</option>
                                <option value="4">Proccessing</option>
                                <option value="5">Refunded</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <h5 class="cart-title mb-2">Filter by Payment:</h5>
                            <select wire:model="payment" class="form-control form-control-lg">
                                <option value="" selected>All Payment</option>
                                <option value="cash-on-delivery">Cash on Delivery</option>
                                <option value="paid-by-paypal">Paid by Paypal</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <h5 class="cart-title mb-2">Filter by Tracking No:</h5>
                            <input wire:model="search" type="text" class="form-control form-control-lg" placeholder="Search">
                        </div>
                    </div>
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
