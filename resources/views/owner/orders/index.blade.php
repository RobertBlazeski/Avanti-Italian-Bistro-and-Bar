@extends('layouts.master')

@section('content')
<div class="container-dark">
    <h1 class="text-gold border">Orders Management</h1>
    
    <table class="table table-dark">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Items</th>
                <th>Total</th>
                <th>Address</th>
                <th>Status</th>
                <th>Ordered At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>
                        <ul class="list-unstyled">
                            @foreach($order->orderItems as $item)
                                <li>{{ $item->dish->name }} x {{ $item->quantity }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>${{ number_format($order->total, 2) }}</td>
                    <td>{{ $order->address }}</td>
                    <td>
                        @if($order->status === 'pending')
                            <form method="POST" action="{{ route('orders.updateStatus', $order) }}" class="status-form">
                                @csrf
                                <input type="hidden" name="status" value="completed">
                                <button type="submit" class="btn btn-sm btn-warning">
                                    Pending
                                </button>
                            </form>
                        @else
                            <span class="text-success">Completed</span>
                        @endif
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-gold">No orders available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection