<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Order::class);

        return view('dashboard.order.index', [
            'orders' => Order::with('user')->get(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        Gate::authorize('view', $order);

        return view('dashboard.order.show', [
            'order' => $order->load(['products']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        dd($request->all());
        $order->update([
            'status' => $request->status,
        ]);

        return to_route('dashboard.order.index')->with('success', __('Order updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        Gate::authorize('delete', $order);

        $order->delete();

        return to_route('dashboard.order.index')->with('success', __('Order deleted successfully.'));
    }
}
