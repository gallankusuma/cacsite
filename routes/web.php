<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Pages\Index as AdminPagesIndex;
use App\Livewire\Admin\PageSections\Editor as AdminPageSectionsEditor;
use App\Livewire\Admin\ProductCategories\Index as AdminProductCategoriesIndex;
use App\Livewire\Admin\Products\Index as AdminProductsIndex;
use App\Livewire\Admin\Certificates\Index as AdminCertificatesIndex;
use App\Livewire\Admin\Branches\Index as AdminBranchesIndex;
use App\Livewire\Admin\Stats\Index as AdminStatsIndex;
use App\Livewire\Admin\Inquiries\Index as AdminInquiriesIndex;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
	// PUBLIC ROUTES (biarkan kayak sekarang)
Route::get('/', \App\Livewire\Home\Index::class);
Route::get('/about', \App\Livewire\Pages\Show::class)->name('about');
Route::get('/advantages', \App\Livewire\Pages\Show::class)->name('advantages');
Route::get('/page/{slug}', \App\Livewire\Pages\Show::class)->name('page.show');
Route::get('/products', \App\Livewire\Products\CategoryIndex::class)->name('products.categories');
Route::get('/products/{slug}', \App\Livewire\Products\ListItems::class)->name('products.list');
Route::get('/product/{slug}', \App\Livewire\Products\Show::class)->name('products.show');
Route::get('/certificates', \App\Livewire\Certificates\Index::class)->name('certs');
Route::get('/contact', \App\Livewire\Contact\ContactForm::class)->name('contact');
Route::get('/careers', \App\Livewire\Contact\CareerForm::class)->name('careers');

	Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', \App\Livewire\Admin\Dashboard::class)->name('dashboard');
    Route::get('/pages', \App\Livewire\Admin\Pages\Index::class)->name('pages');
    Route::get('/pages/{page}/sections', \App\Livewire\Admin\PageSections\Editor::class)->name('pages.sections');
    Route::get('/product-categories', \App\Livewire\Admin\ProductCategories\Index::class)->name('product-categories');
    Route::get('/products', \App\Livewire\Admin\Products\Index::class)->name('products');
    Route::get('/certificates', \App\Livewire\Admin\Certificates\Index::class)->name('certificates');
    Route::get('/branches', \App\Livewire\Admin\Branches\Index::class)->name('branches');
    Route::get('/site-stats', \App\Livewire\Admin\Stats\Index::class)->name('stats');
    Route::get('/inquiries', \App\Livewire\Admin\Inquiries\Index::class)->name('inquiries');
});


require __DIR__.'/auth.php';
