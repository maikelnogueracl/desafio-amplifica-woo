<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WooCommerceService;
use Symfony\Component\HttpFoundation\StreamedResponse;

class WooController extends Controller
{
    private WooCommerceService $woo;

    public function __construct(WooCommerceService $woo)
    {
        $this->woo = $woo;
        // Simple session gate
        if (!session('auth')) {
            // middleware-like guard
            // real apps should use Laravel auth
        }
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function products(Request $request)
    {
        $products = $this->woo->getProducts();
        return view('products.index', compact('products'));
    }

    public function orders(Request $request)
    {
        $orders = $this->woo->getOrdersLast30Days();
        return view('orders.index', compact('orders'));
    }

    public function exportProducts()
    {
        $products = $this->woo->getProducts();
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="products.csv"',
        ];
        return new StreamedResponse(function () use ($products) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['ID', 'Nombre', 'SKU', 'Precio', 'Imagen']);
            foreach ($products as $p) {
                fputcsv($out, [
                    $p['id'] ?? '',
                    $p['name'] ?? '',
                    $p['sku'] ?? '',
                    $p['price'] ?? '',
                    $p['image'] ?? '',
                ]);
            }
            fclose($out);
        }, 200, $headers);
    }

    public function exportOrders()
    {
        $orders = $this->woo->getOrdersLast30Days();
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="orders.csv"',
        ];
        return new StreamedResponse(function () use ($orders) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['ID', 'Cliente', 'Fecha', 'Estado', 'Items']);
            foreach ($orders as $o) {
                $items = array_map(function($i){
                    return ($i['name'] ?? '') . ' x' . ($i['quantity'] ?? 0);
                }, $o['items'] ?? []);
                fputcsv($out, [
                    $o['id'] ?? '',
                    $o['customer'] ?? '',
                    $o['date'] ?? '',
                    $o['status'] ?? '',
                    implode(' | ', $items),
                ]);
            }
            fclose($out);
        }, 200, $headers);
    }
}
