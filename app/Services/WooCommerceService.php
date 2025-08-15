<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Carbon;

class WooCommerceService
{
    private Client $client;
    private string $baseUrl;
    private string $ck;
    private string $cs;

    public function __construct()
    {
        $this->baseUrl = rtrim(env('WC_BASE_URL'), '/');
        $this->ck = env('WC_CONSUMER_KEY', '');
        $this->cs = env('WC_CONSUMER_SECRET', '');
        $this->client = new Client([
            'verify' => false, // evitar errores SSL en entornos de prueba
            'timeout' => 20,
        ]);
    }

    private function get($path, $query = [])
    {
        $query = array_merge($query, [
            'consumer_key' => $this->ck,
            'consumer_secret' => $this->cs,
        ]);

        $url = $this->baseUrl . '/wp-json/wc/v3' . $path;

        $res = $this->client->get($url, ['query' => $query]);
        return json_decode($res->getBody()->getContents(), true);
    }

    public function getProducts(): array
    {
        $data = $this->get('/products', ['per_page' => 50]);
        $mapped = [];
        foreach ($data as $p) {
            $mapped[] = [
                'id' => $p['id'] ?? null,
                'name' => $p['name'] ?? '',
                'sku' => $p['sku'] ?? '',
                'price' => $p['price'] ?? '',
                'image' => $p['images'][0]['src'] ?? null,
            ];
        }
        return $mapped;
    }

    public function getOrdersLast30Days(): array
    {
        $after = Carbon::now()->subDays(30)->toIso8601String();
        $data = $this->get('/orders', [
            'per_page' => 50,
            'after' => $after,
        ]);

        $mapped = [];
        foreach ($data as $o) {
            $items = [];
            foreach ($o['line_items'] ?? [] as $li) {
                $items[] = [
                    'name' => $li['name'] ?? '',
                    'quantity' => $li['quantity'] ?? 0,
                ];
            }
            $customer = '';
            if (!empty($o['billing'])) {
                $customer = trim(($o['billing']['first_name'] ?? '') . ' ' . ($o['billing']['last_name'] ?? ''));
            }
            $mapped[] = [
                'id' => $o['id'] ?? null,
                'customer' => $customer,
                'date' => $o['date_created'] ?? '',
                'status' => $o['status'] ?? '',
                'items' => $items,
            ];
        }
        return $mapped;
    }
}
