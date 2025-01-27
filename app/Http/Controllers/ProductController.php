<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function getProductDetail(Request $request)
    {
        // รับค่า Access Token และ SKU จาก Request
        $accessToken = $request->header('Authorization');
        $sku = $request->input('sku');

        if (!$accessToken) {
            return response()->json(['error' => 'Access token is required'], 400);
        }

        if (!$sku) {
            return response()->json(['error' => 'Product SKU is required'], 400);
        }

        // เรียก API ภายนอกด้วย Guzzle
        $response = Http::withHeaders([
            'Authorization' => $accessToken,
        ])->get('https://dev-sme.sepplatform.com/api/get/product', [
            'sku' => $sku
        ]);

        // ตรวจสอบผลลัพธ์จาก API
        if ($response->failed()) {
            return response()->json(['error' => 'Unable to fetch product details'], 500);
        }

        // ส่งผลลัพธ์จาก API กลับมา
        return response()->json($response->json());
    }
}
