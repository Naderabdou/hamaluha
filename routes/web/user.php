<?php

use App\Http\Controllers\Site\General\ProductController;
Route::get('/products/{slug}/download', [ProductController::class, 'download'])->name('products.download');
