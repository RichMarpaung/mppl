<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
$orders = Order::with('user', 'service')->get(); // Ambil data pesanan beserta relasi user dan service
    return view('adminpage.order.index', compact('orders'));
    }

   public function update(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:pending,diproses,selesai,canceled', // Validasi status
    ]);

    try {
        $order->status = $request->status; // Perbarui status pesanan
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Status pesanan berhasil diperbarui.');
    } catch (\Exception $e) {
        return redirect()->route('admin.orders.index')->with('error', 'Terjadi kesalahan saat memperbarui status pesanan.');
    }
}
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    $request->validate([
        'service_id' => 'required|exists:services,id',
        'srs' => 'nullable|file|mimes:pdf|max:2048',
    ]);

    // Simpan file SRS jika ada
    $srsPath = $request->file('srs') ? $request->file('srs')->store('srs', 'public') : null;

    // Simpan data pesanan
    Order::create([
        'user_id' => Auth::id(),
        'service_id' => $request->service_id,
        'srs' => $srsPath,
        'status' => 'pending',
    ]);

    // Kirim flash message
    return redirect()->route('dashboard.page')->with('success', 'Pesanan berhasil dikirim.');
}

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
{
    try {
        $order->delete(); // Hapus pesanan dari database
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->route('orders.index')->with('error', 'Terjadi kesalahan saat menghapus pesanan.');
    }
}
}
