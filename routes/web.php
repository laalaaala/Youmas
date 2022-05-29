<?php
// NO
use App\Http\Controllers\Admin\AdminStatsController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\LoginAsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EmployeeAvailableHoursController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminTransactionsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserVerificationController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Business\BusinessBookingController;
use App\Http\Controllers\Business\BusinessPictureController;
use App\Http\Controllers\Business\BusinessController;
use App\Http\Controllers\Business\BusinessEmployeeController;
use App\Http\Controllers\Business\BusinessOpeningHoursController;
use App\Http\Controllers\Business\BusinessReviewController;
use App\Http\Controllers\Business\BusinessStatsController;
use App\Http\Controllers\Business\BusinessSubscriptionsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerBookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeWorkingHoursController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceSubcategoryController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\SupportEmailController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TransactionsController;
use App\Models\EmployeeWorkingHours;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/auth/{token}/verify', [UserVerificationController::class, 'verifyUser']);
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/**
 * Auth routes
 */
Route::middleware('guest')->group(function () {

    /**
     * Register
     */
    Route::prefix('register')->group(function () {
        Route::post('/', [RegisterController::class, 'register']);
        Route::get('/', function () {
            return view('auth.register');
        })->name('register');
        Route::get('/company', function () {
            return view('auth.company.register');
        });
        Route::get('/customer', function () {
            return view('auth.customer.register');
        });
    });

    /**
     * Login
     */

    Route::prefix('login')->group(function () {
        Route::post('/', [LoginController::class, 'login']);
        Route::get('/', function () {
            return view('auth.login');
        })->name('login');
    });
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

/**
 * Forgot password
 */
Route::group(['prefix' => 'password', 'middleware' => 'guest'], function () {
    /**
     * Send email
     */
    Route::post('/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);

    /**
     * Reset
     */
    Route::prefix('reset')->group(function () {
        Route::get('/', [ForgotPasswordController::class, 'showEmailResetView'])->name('auth.passwords.email');
        Route::get('/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/', [ResetPasswordController::class, 'reset'])->name('password.update');
    });
});


/**
 * Admin Routes
 */

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    /**
     * Users
     */
    Route::prefix('users')->group(function () {
        Route::get('/', [AdminUserController::class, 'index']);
        Route::delete('/{id}', [AdminUserController::class, 'destroy']);
        Route::get('/filter', [AdminUserController::class, 'filter']);
    });

    /**
     * FAQs
     */
    Route::prefix('faqs')->group(function () {
        Route::get('/', [FaqsController::class, 'index']);
        Route::get('/filter', [FaqsController::class, 'filter']);
        Route::post('/{id}/delete', [FaqsController::class, 'destroy']);
        Route::post('/create', [FaqsController::class, 'store']);
        Route::post('/{id}/update', [FaqsController::class, 'update']);
    });

    /**
     * Transactions
     */
    Route::prefix('transactions')->group(function () {
        Route::get('/', [AdminTransactionsController::class, 'index']);
        Route::get('/filter', [AdminTransactionsController::class, 'filter']);
        Route::post('/{id}/approve', [StripePaymentController::class, 'payout']);
    });

    /**
     * Statistics
     */
    Route::prefix('stats')->group(function () {
        Route::get('/', [AdminStatsController::class, 'index']);
        Route::get('/user', [AdminStatsController::class, 'user']);
        Route::get('/revenue', [AdminStatsController::class, 'revenue']);
    });

    /**
     * Login As
     */
    Route::get('/login-as-user/{id}', [LoginAsController::class, 'loginAsUser']);
});
Route::get('/end-session', [LoginAsController::class, 'endSession']);



/**
 * Checkout & Purchase routes
 */
Route::group(['prefix' => 'checkout', 'middleware' => ['auth', 'customer']], function () {
    Route::post('/transactions', [TransactionsController::class, 'store']);
    Route::get('/{id}', [CheckoutController::class, 'show'])->where('id', '[0-9]+')->middleware('auth');
    Route::post('/purchases', [StripePaymentController::class, 'customerPurchase']);
});

/**
 * Business Routes
 */
Route::prefix('businesses')->group(function () {

    /**
     * Public
     */
    Route::get('/', [BusinessController::class, 'index']);
    Route::get('/{id}', [BusinessController::class, 'show'])->where('id', '[0-9]+');

    Route::get('/{id}/review', [BusinessReviewController::class, 'create'])->where('id', '[0-9]+')->middleware(['auth', 'customer']);
    Route::get('/{id}/review/filter', [BusinessReviewController::class, 'filter'])->where('id', '[0-9]+')->middleware(['auth', 'customer']);
    Route::post('/{id}/review', [BusinessReviewController::class, 'store'])->where('id', '[0-9]+')->middleware(['auth', 'customer']);

    Route::get('/filter', [BusinessController::class, 'filter']);
    /**
     * Protected
     */
    Route::middleware(['auth', 'business'])->group(function () {
        /**
         * Pictures
         */
        Route::prefix('pictures')->group(function () {
            Route::get('/', [BusinessPictureController::class, 'index']);
            Route::post('/', [BusinessPictureController::class, 'store']);
            Route::delete('/{id}', [BusinessPictureController::class, 'destroy']);
        });

        /**
         * Opening Hours
         */
        Route::prefix('opening-hours')->group(function () {
            Route::get('/', [BusinessOpeningHoursController::class, 'index']);
            Route::put('/', [BusinessOpeningHoursController::class, 'update']);
        });


        /**
         * Subscriptions
         */
        Route::prefix('subscriptions')->group(function () {
            Route::get('/', [BusinessSubscriptionsController::class, 'index'])->middleware('active.subscription');
            Route::put('/{id}/update', [BusinessSubscriptionsController::class, 'update']);
            Route::post('/create-stripe-customer', [BusinessSubscriptionsController::class, 'createCustomer']);
            Route::post('/create-stripe-subscription', [BusinessSubscriptionsController::class, 'createSubscription']);
            Route::post('/cancel', [BusinessSubscriptionsController::class, 'cancel']);
            Route::post('/reactivate', [BusinessSubscriptionsController::class, 'reactivate']);
        });

        /*
        * Customers
        */
        Route::get('/customer/{id}', [CustomerBookingController::class, 'show']);
        Route::get('/transaction/{id}/status', [TransactionsController::class, 'show']);
    });
});

/**
 * Dashboard Routes
 */
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {

    /**
     * General
     */
    Route::get('/', [DashboardController::class, 'index']);

    Route::prefix('profile')->group(function () {

        Route::put('/', [ProfileController::class, 'update']);
        Route::put('/password', [ProfileController::class, 'updatePassword']);

        /**
         * Stripe (Only business)
         */
        Route::group(['prefix' => 'stripe', 'middleware' => 'business'], function () {
            Route::get('/', [ProfileController::class, 'connectStripeAccount']);
            Route::post('deauthorize', [ProfileController::class, 'deauthorizeStripeAccount']);
            Route::get('/onboarding', [ProfileController::class, 'stripeAccountOnboarding']);
        });
    });

    /**
     * Calendars
     */

    Route::get('/planning-calendar', [DashboardController::class, 'planningCalendar'])->middleware('active.subscription');
    Route::get('/booking-calendar', [BusinessBookingController::class, 'index'])->middleware('active.subscription');
    Route::post('/business/{id}/bookings/', [BusinessBookingController::class, 'store'])->middleware('active.subscription');

    /**
     * Employees
     */
    Route::prefix('employees')->group(function () {
        /**
         * General
         */
        Route::get('/', [BusinessEmployeeController::class, 'index'])->middleware('active.subscription');
        Route::post('/', [BusinessEmployeeController::class, 'store'])->middleware('active.subscription');
        Route::post('/update', [BusinessEmployeeController::class, 'update'])->middleware('active.subscription');
        Route::post('/{id}/delete', [BusinessEmployeeController::class, 'destroy'])->middleware('active.subscription');
        Route::post('/{id}/deleteImage', [BusinessEmployeeController::class, 'deleteImage'])->middleware('active.subscription');

        /**
         * Working hours
         */
        Route::get('/working-hours', [EmployeeWorkingHoursController::class, 'index']);
        Route::get('/{id}/working-hours', [EmployeeWorkingHoursController::class, 'show']);
        Route::post('/{id}/working-hours', [EmployeeWorkingHoursController::class, 'store']);
        Route::post('/{id}/working-hours/mass-deletion', [EmployeeWorkingHoursController::class, 'massDelete']);
        /**
         * Available Hours
         */
        Route::get('/{id}/available-hours', [EmployeeAvailableHoursController::class, 'index']);
        Route::post('/{id}/available-hours', [EmployeeAvailableHoursController::class, 'store']);
        Route::get('/booked-hours', [EmployeeAvailableHoursController::class, 'bookedHours']);
        Route::get('/{id}/booked-hours', [EmployeeAvailableHoursController::class, 'bookedHoursShow']);
        Route::post('/{id}/update-profile-picture', [BusinessEmployeeController::class, 'updateProfilePicture']);
        Route::delete('/{id}/booked-hours', [EmployeeAvailableHoursController::class, 'bookedHoursDelete']);
        Route::delete('/{id}/working-hours', [EmployeeAvailableHoursController::class, 'destroy']);
    });

    Route::get('/business/employees/filter', [BusinessEmployeeController::class, 'filter']);
    Route::get('/business/{id}/services', [ServiceController::class, 'businessServices']);

    /**
     * Services
     */
    Route::group(['prefix' => 'services', 'middleware' => 'active.subscription'], function () {
        Route::get('/', [ServiceController::class, 'index']);
        Route::post('/', [ServiceController::class, 'store']);
        Route::post('/{id}/delete', [ServiceController::class, 'destroy']);
        Route::post('/update', [ServiceController::class, 'update']);
        Route::get('/subcategories', [ServiceController::class, 'subCategories']);

        /**
         * Categories
         */
        Route::prefix('categories')->group(function () {
            Route::get('/', [ServiceCategoryController::class, 'index']);
            Route::get('/{id}/subcategories', [ServiceSubcategoryController::class, 'index']);
            Route::get('/{category_id}/subcategories/{subcategory_id}/services', [ServiceController::class, 'index']);
        });
    });

    Route::group(['prefix' => 'statistics', 'middleware' => 'active.subscription'], function () {
        Route::get('/', [BusinessStatsController::class, 'index'])->middleware('business');
        Route::get('/all', [BusinessStatsController::class, 'all'])->middleware('business');
    });

    Route::post('/transactions/{id}/refund', [TransactionsController::class, 'refund']);

    /**
     * Support routes
     */
    Route::prefix('support')->group(function () {
        Route::get('/', [SupportEmailController::class, 'index']);
        Route::post('/', [SupportEmailController::class, 'sendEmail']);
    });

    Route::get('/favorites', [FavoritesController::class, 'index']);



    Route::get('/bookings', [CustomerBookingController::class, 'index'])->name('bookings');
    Route::put('/bookings/{id}', [CustomerBookingController::class, 'update']);
});

/**
 * Public
 */
Route::get('/faq', [FaqsController::class, 'show'])->name('faqs');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

Route::get('/services', function () {
    return view('services');
})->name('services');

// Route::get('/test', [TestController::class, 'test']);


Route::group(['prefix' => 'favorites', 'middleware' => ['auth', 'customer']], function () {
    Route::post('/{id}/add', [FavoritesController::class, 'store']);
    Route::post('/{id}/remove', [FavoritesController::class, 'delete']);
});