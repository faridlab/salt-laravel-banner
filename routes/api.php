<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use SaltBanner\Controllers\BannersResourcesController;

$version = config('app.API_VERSION', 'v1');

Route::middleware(['api'])
    ->prefix("api/{$version}")
    ->group(function () {

    // API: BANNERS RESOURCES
    Route::get("banners", [BannersResourcesController::class, 'index']); // get entire collection
    Route::post("banners", [BannersResourcesController::class, 'store']); // create new collection

    Route::get("banners/trash", [BannersResourcesController::class, 'trash']); // trash of collection

    Route::post("banners/import", [BannersResourcesController::class, 'import']); // import collection from external
    Route::post("banners/export", [BannersResourcesController::class, 'export']); // export entire collection
    Route::get("banners/report", [BannersResourcesController::class, 'report']); // report collection

    Route::get("banners/{id}/trashed", [BannersResourcesController::class, 'trashed'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID from trash

    // RESTORE data by ID (id), selected IDs (selected), and All data (all)
    Route::post("banners/{id}/restore", [BannersResourcesController::class, 'restore'])->where('id', '[a-zA-Z0-9-]+'); // restore collection by ID

    // DELETE data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("banners/{id}/delete", [BannersResourcesController::class, 'delete'])->where('id', '[a-zA-Z0-9-]+'); // hard delete collection by ID

    Route::get("banners/{id}", [BannersResourcesController::class, 'show'])->where('id', '[a-zA-Z0-9-]+'); // get collection by ID
    Route::put("banners/{id}", [BannersResourcesController::class, 'update'])->where('id', '[a-zA-Z0-9-]+'); // update collection by ID
    Route::patch("banners/{id}", [BannersResourcesController::class, 'patch'])->where('id', '[a-zA-Z0-9-]+'); // patch collection by ID
    // DESTROY data by ID (id), selected IDs (selected), and All data (all)
    Route::delete("banners/{id}", [BannersResourcesController::class, 'destroy'])->where('id', '[a-zA-Z0-9-]+'); // soft delete a collection by ID

});
