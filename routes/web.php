<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RequisitionController;
use App\Http\Controllers\SpecialtiesController;
use App\Http\Controllers\Administration\LoanController;
use App\Http\Controllers\Administration\MenuController;
use App\Http\Controllers\Administration\UnitController;
use App\Http\Controllers\Administration\AssetController;
use App\Http\Controllers\Administration\BrandController;
use App\Http\Controllers\Administration\ChairController;
use App\Http\Controllers\Administration\FloorController;
use App\Http\Controllers\Administration\GraphController;
use App\Http\Controllers\Administration\IssueController;
use App\Http\Controllers\Administration\LeaveController;
use App\Http\Controllers\Administration\OfferController;
use App\Http\Controllers\Administration\OrderController;
use App\Http\Controllers\Administration\TableController;
use App\Http\Controllers\Administration\ReportController;
use App\Http\Controllers\Administration\SliderController;
use App\Http\Controllers\Administration\AccountController;
use App\Http\Controllers\Administration\BookingController;
use App\Http\Controllers\Administration\ServiceController;
use App\Http\Controllers\Administration\WebsiteController;
use App\Http\Controllers\Administration\CategoryController;
use App\Http\Controllers\Administration\CustomerController;
use App\Http\Controllers\Administration\DisposalController;
use App\Http\Controllers\Administration\DistrictController;
use App\Http\Controllers\Administration\EmployeeController;
use App\Http\Controllers\Administration\MaterialController;
use App\Http\Controllers\Administration\PurchaseController;
use App\Http\Controllers\Administration\SupplierController;
use App\Http\Controllers\Frontend\AuthenticationController;
use App\Http\Controllers\Administration\LeaveTypeController;
use App\Http\Controllers\Administration\ReferenceController;
use App\Http\Controllers\Administration\DepartmentController;
use App\Http\Controllers\Administration\InvestmentController;
use App\Http\Controllers\Administration\DesignationController;
use App\Http\Controllers\Administration\IssueReturnController;
use App\Http\Controllers\Administration\ServiceHeadController;
use App\Http\Controllers\Administration\MenuCategoryController;
use App\Http\Controllers\Administration\BankTransactionController;
use App\Http\Controllers\Administration\CustomerPaymentController;
use App\Http\Controllers\Administration\SupplierPaymentController;
use App\Http\Controllers\Administration\MaterialPurchaseController;
use App\Http\Controllers\Administration\PrivacyPolicyController;
use App\Http\Controllers\Administration\TableTypeController;
use App\Http\Controllers\Administration\TermsAndConditionController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CateringController;
use App\Http\Controllers\CocktailsController;
use App\Http\Controllers\Frontend\CustomerBookingController;
use App\Http\Controllers\LunchController;

Route::fallback(function () {
    return view('error.404');
})->middleware('auth');

Route::get('clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:cache');
    return back();
});

// Website Routes 
Route::get('/', [FrontEndController::class, 'home'])->name('home');
Route::get('/about-us', [FrontEndController::class, 'aboutUs'])->name('aboutUs');
Route::get('/checkout', [FrontEndController::class, 'checkout'])->name('checkout');
Route::get('/location', [FrontEndController::class, 'location'])->name('locations');
Route::get('/our-menu', [FrontEndController::class, 'menu'])->name('menu');
Route::get('/cocktail-menu', [FrontEndController::class, 'cocktailMenu'])->name('cocktailMenu');
Route::get('/photo_view', [FrontEndController::class, 'photos'])->name('photos');
Route::get('/blogs', [FrontEndController::class, 'blogs'])->name('blogs');
Route::get('/blog_details/{slug}', [FrontEndController::class, 'blog_details'])->name('blog_details');
Route::get('/privacy-policy', [FrontEndController::class, 'privacy'])->name('privacy');
Route::get('/terms', [FrontEndController::class, 'terms'])->name('terms');
Route::get('/contact', [FrontEndController::class, 'contact'])->name('contact');
Route::post('/storeMessage', [FrontEndController::class, 'storeMessage']);
Route::post('/saveBooking', [FrontEndController::class, 'bookingStore'])->name('saveBooking');
Route::get('/confirmBooking', [FrontEndController::class, 'confirmBooking'])->name('confirmBooking');
Route::post('/makeBooking', [FrontEndController::class, 'makeBooking'])->name('makeBooking');
Route::post('/get-captcha', [FrontEndController::class, 'getCaptcha'])->name('get.captcha');

// Call Data 
Route::get('/get-categories', [FrontEndController::class, 'getCategories'])->name('getCategories');
Route::get('/get-menus', [FrontEndController::class, 'getMenus'])->name('getMenus');
Route::get('/get-current-customer', [FrontEndController::class, 'getCustomer'])->name('getCustomer');
Route::post('/confirm-order', [FrontEndController::class, 'orderConfirm'])->name('orderConfirm');
Route::get('/bookingCancel/{id}', [FrontEndController::class, 'booking_cancel'])->name('booking.cancel');
Route::get('/orderCancel/{id}', [FrontEndController::class, 'order_cancel'])->name('order.cancel');
Route::get('/order_invoice/{id}', [FrontEndController::class, 'order_invoice'])->name('order.customer.invoice');

// Customer Routes 
// Route::post('/checkoutCustomerCheck', [AuthenticationController::class, 'checkoutCustomerCheck']);
Route::post('/auth/customer', [AuthenticationController::class, 'authCheck'])->name('authCheck');
Route::get('/customer/login', [AuthenticationController::class, 'customerLogin'])->name('customerLogin');
Route::get('/customer-logout', [AuthenticationController::class, 'customerLogout'])->name('customerLogout');
Route::get('/customer/register', [AuthenticationController::class, 'register'])->name('register');
Route::post('/registration', [AuthenticationController::class, 'registrationStore'])->name('registration.store');
Route::get('/profile', [AuthenticationController::class, 'profile'])->name('profile');
Route::put('/profile/update', [AuthenticationController::class, 'profileUpdate'])->name('profile.update');
Route::put('/profile/address/update', [AuthenticationController::class, 'profileAddressUpdate'])->name('profile.address.update');

// password reset route
Route::put('/password-update', [AuthenticationController::class, 'passwordUpdate'])->name('password.change');
Route::get('/forgot-password', [AuthenticationController::class, 'password'])->name('password');
Route::post('/forgot-password', [AuthenticationController::class, 'ForgotPassword'])->name('ForgotPassword');
Route::get('/reset-password/{token}', [AuthenticationController::class, 'ResetPassword'])->name('ResetPassword');
Route::post('/reset-password-store', [AuthenticationController::class, 'ResetPass'])->name('ResetPass');

// Bookings Routes  
Route::match(['get', 'post'], '/get-category', [CustomerBookingController::class, 'getCategory'])->name('getCategory');
Route::match(['get', 'post'], '/get-room-list', [CustomerBookingController::class, 'roomList'])->name('roomList');
Route::match(['get', 'post'], '/get-booking', [CustomerBookingController::class, 'index'])->name('getBooking');
Route::get('/confirm-booking-invoice/{id}', [CustomerBookingController::class, 'bookingInvoice'])->name('get.bookingInvoice');
Route::get('/get-categories', [FrontEndController::class, 'getCategories'])->name('getCategories');
Route::get('/get-menus', [FrontEndController::class, 'getMenus'])->name('getMenus');
// Route::get('/register', [FrontEndController::class, 'register'])->name('register');

// Admin Login
Route::get('/login', [LoginController::class, 'showUserLoginForm'])->name('user.login.show');
Route::post('/login', [LoginController::class, 'login'])->name('user.login');
Route::get('/logout', [DashboardController::class, 'Logout'])->middleware('auth')->name('user.logout');

// dashboard route
Route::group(['prefix' => 'module'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/{module}', [DashboardController::class, 'module'])->name('module.access');
});

//user create and profile route
Route::get('user', [UserController::class, 'create'])->name('user.create')->middleware('useractivity');
Route::post('get-user', [UserController::class, 'index'])->name('user.index');
Route::post('add-user', [UserController::class, 'store'])->name('user.store');
Route::post('update-user', [UserController::class, 'update'])->name('user.update');
Route::post('delete-user', [UserController::class, 'destroy'])->name('user.destroy');
Route::post('status-change', [UserController::class, 'userStatus'])->name('user.userStatus');
Route::get('user-profile', [UserController::class, 'userProfile'])->name('user.userProfile')->middleware('useractivity');
Route::post('user-profile-update', [UserController::class, 'userprofileUpdate'])->name('user.userprofileUpdate')->middleware('useractivity');
Route::get('user-access/{id}', [UserController::class, 'userAccess'])->name('user.userAccess')->middleware('useractivity');
Route::post('get-user-access', [UserController::class, 'getUserAccess'])->name('user.getUserAccess');
Route::post('add-user-access', [UserController::class, 'addUserAccess'])->name('user.addUserAccess');
Route::get('user-activity', [UserController::class, 'userActivity'])->name('user.activity')->middleware('useractivity');
Route::post('get-user-activity', [UserController::class, 'getUserActivity'])->name('user.activity.get');
Route::post('delete-user-activity', [UserController::class, 'destroyUserActivity'])->name('user.activity.destroy');

//username check
Route::post('check-user', [UserController::class, 'checkUser'])->name('user.checkuser');
Route::get('company-profile', [DashboardController::class, 'company'])->name('company.profile')->middleware('useractivity');
Route::post('update-company', [DashboardController::class, 'updateCompany'])->name('update.company')->middleware('useractivity');
Route::get('get-company', [DashboardController::class, 'getCompany'])->name('get.company.profile');

// Administration Module 
// district route
Route::get('district', [DistrictController::class, 'create'])->name('district.create')->middleware('useractivity');
Route::get('get-district', [DistrictController::class, 'index'])->name('district.index');
Route::post('district', [DistrictController::class, 'store'])->name('district.store');
Route::post('update-district', [DistrictController::class, 'update'])->name('district.update');
Route::post('delete-district', [DistrictController::class, 'destroy'])->name('district.destroy');

// supplier route
Route::get('supplier', [SupplierController::class, 'create'])->name('supplier.create')->middleware('useractivity');
Route::match(['get', 'post'], 'get-supplier', [SupplierController::class, 'index'])->name('supplier.index');
Route::post('supplier', [SupplierController::class, 'store'])->name('supplier.store');
Route::post('update-supplier', [SupplierController::class, 'update'])->name('supplier.update');
Route::post('delete-supplier', [SupplierController::class, 'destroy'])->name('supplier.destroy');
Route::get('supplierlist', [SupplierController::class, 'supplierList'])->name('supplier.list')->middleware('useractivity');

// Guest route
Route::get('customer', [CustomerController::class, 'create'])->name('customer.create')->middleware('useractivity');
Route::match(['get', 'post'], 'get-customer', [CustomerController::class, 'index'])->name('customer.index');
Route::post('customer', [CustomerController::class, 'store'])->name('customer.store');
Route::post('update-customer', [CustomerController::class, 'update'])->name('customer.update');
Route::post('delete-customer', [CustomerController::class, 'destroy'])->name('customer.destroy');
Route::get('customerlist', [CustomerController::class, 'customerList'])->name('customer.list')->middleware('useractivity');

// floor route
Route::get('floor', [FloorController::class, 'create'])->name('floor.create')->middleware('useractivity');
Route::match(['get', 'post'], 'get-floor', [FloorController::class, 'index'])->name('floor.index');
Route::post('floor', [FloorController::class, 'store'])->name('floor.store');
Route::post('update-floor', [FloorController::class, 'update'])->name('floor.update');
Route::post('delete-floor', [FloorController::class, 'destroy'])->name('floor.destroy');

// tabletype route
Route::get('tabletype', [TableTypeController::class, 'create'])->name('tabletype.create')->middleware('useractivity');
Route::get('get-tabletype', [TableTypeController::class, 'index'])->name('tabletype.index');
Route::post('tabletype', [TableTypeController::class, 'store'])->name('tabletype.store');
Route::post('update-tabletype', [TableTypeController::class, 'update'])->name('tabletype.update');
Route::post('delete-tabletype', [TableTypeController::class, 'destroy'])->name('tabletype.destroy');

// table category route
Route::get('category', [CategoryController::class, 'create'])->name('category.create')->middleware('useractivity');
Route::get('get-category', [CategoryController::class, 'index'])->name('category.index');
Route::post('category', [CategoryController::class, 'store'])->name('category.store');
Route::post('update-category', [CategoryController::class, 'update'])->name('category.update');
Route::post('delete-category', [CategoryController::class, 'destroy'])->name('category.destroy');

// table route
Route::get('table', [TableController::class, 'create'])->name('table.create')->middleware('useractivity');
Route::match(['get', 'post'], 'get-table', [TableController::class, 'index'])->name('table.index');
Route::post('table', [TableController::class, 'store'])->name('table.store');
Route::post('update-table', [TableController::class, 'update'])->name('table.update');
Route::post('delete-table', [TableController::class, 'destroy'])->name('table.destroy');
Route::get('tablelist', [TableController::class, 'tableList'])->name('table.tableList');
Route::match(['get', 'post'], 'get-table-list', [TableController::class, 'getTableList'])->name('get.getTableList');

// chair route
Route::get('chair', [ChairController::class, 'create'])->name('chair.create')->middleware('useractivity');
Route::match(['get', 'post'], 'get-chair', [ChairController::class, 'index'])->name('chair.index');
Route::post('chair', [ChairController::class, 'store'])->name('chair.store');
Route::post('update-chair', [ChairController::class, 'update'])->name('chair.update');
Route::post('delete-chair', [ChairController::class, 'destroy'])->name('chair.destroy');

// Reference route
Route::get('reference', [ReferenceController::class, 'create'])->name('reference.create')->middleware('useractivity');
Route::match(['get', 'post'], 'get-reference', [ReferenceController::class, 'index'])->name('get.reference');
Route::post('add-reference', [ReferenceController::class, 'store'])->name('add.reference');
Route::post('update-reference', [ReferenceController::class, 'update'])->name('update.reference');
Route::post('delete-reference', [ReferenceController::class, 'destroy'])->name('delete.reference');

// HR & PAYROLL MODULE 
// department route
Route::get('department', [DepartmentController::class, 'create'])->name('department.create')->middleware('useractivity');
Route::get('get-department', [DepartmentController::class, 'index'])->name('department.index');
Route::post('department', [DepartmentController::class, 'store'])->name('department.store');
Route::post('update-department', [DepartmentController::class, 'update'])->name('department.update');
Route::post('delete-department', [DepartmentController::class, 'destroy'])->name('department.destroy');

// designation route
Route::get('designation', [DesignationController::class, 'create'])->name('designation.create')->middleware('useractivity');
Route::get('get-designation', [DesignationController::class, 'index'])->name('designation.index');
Route::post('designation', [DesignationController::class, 'store'])->name('designation.store');
Route::post('update-designation', [DesignationController::class, 'update'])->name('designation.update');
Route::post('delete-designation', [DesignationController::class, 'destroy'])->name('designation.destroy');

// Leave Type route
Route::get('leave-type', [LeaveTypeController::class, 'create'])->name('leave.type.create')->middleware('useractivity');
Route::get('get-leave-type', [LeaveTypeController::class, 'index'])->name('leave.type.index');
Route::post('leave-type', [LeaveTypeController::class, 'store'])->name('leave.type.store');
Route::post('update-leave-type', [LeaveTypeController::class, 'update'])->name('leave.type.update');
Route::post('delete-leave-type', [LeaveTypeController::class, 'destroy'])->name('leave.type.destroy');

// Leave Entry route
Route::get('leave', [LeaveController::class, 'create'])->name('leave.create')->middleware('useractivity');
Route::match(['get', 'post'], 'get-leaves', [LeaveController::class, 'index'])->name('leave.index');
Route::post('leave', [LeaveController::class, 'store'])->name('leave.store');
Route::post('update-leave', [LeaveController::class, 'update'])->name('leave.update');
Route::post('delete-leave', [LeaveController::class, 'destroy'])->name('leave.destroy');
Route::get('leave-record', [LeaveController::class, 'record'])->name('leave.record')->middleware('useractivity');

// Employee route
Route::get('employee/{id?}', [EmployeeController::class, 'create'])->name('employee.create')->middleware('useractivity');
Route::get('employee-list', [EmployeeController::class, 'list'])->name('employee.list')->middleware('useractivity');
Route::match(['get', 'post'], 'get-employee', [EmployeeController::class, 'index'])->name('employee.index');
Route::post('add-employee', [EmployeeController::class, 'store'])->name('employee.store');
Route::post('update-employee', [EmployeeController::class, 'update'])->name('employee.update');
Route::post('delete-employee', [EmployeeController::class, 'destroy'])->name('employee.destroy');
Route::get('employee-salary', [EmployeeController::class, 'salary'])->name('employee.salary');
Route::post('check-payment-month', [EmployeeController::class, 'checkPaymentMonth'])->name('check.payment.month');
Route::post('get-payments', [EmployeeController::class, 'getPayment'])->name('get.salary.payment');
Route::post('add-salary-payment', [EmployeeController::class, 'addPayment'])->name('add.salary.payment');
Route::post('update-salary-payment', [EmployeeController::class, 'updatePayment'])->name('update.salary.payment');
Route::get('salaryRecord', [EmployeeController::class, 'salaryRecord'])->name('salary.record');
Route::post('get-salary-details', [EmployeeController::class, 'getSalaryDetails'])->name('salary.payment.detail');
Route::get('salary-sheet-print/{id}', [EmployeeController::class, 'salaryInvoicePrint'])->name('salary.invoice.print');
Route::post('delete-salary-payment', [EmployeeController::class, 'destroySalaryPayment'])->name('destroy.salary.payment');

// Account Module All Route 
// Account route
Route::get('account', [AccountController::class, 'create'])->name('account.create')->middleware('useractivity');
Route::get('get-accounts', [AccountController::class, 'index'])->name('get.account');
Route::post('add-account', [AccountController::class, 'store'])->name('add.account');
Route::post('update-account', [AccountController::class, 'update'])->name('update.account');
Route::post('delete-account', [AccountController::class, 'destroy'])->name('delete.account');

// Cash transaction route
Route::get('cash-transaction', [AccountController::class, 'cashTransaction'])->name('cash.transaction')->middleware('useractivity');
Route::match(['get', 'post'], 'get-cash-transactions', [AccountController::class, 'getCashTransaction'])->name('get.cash.transaction');
Route::post('add-cash-transaction', [AccountController::class, 'cashTransactionStore'])->name('add.cash.transaction');
Route::post('update-cash-transaction', [AccountController::class, 'cashTransactionUpdate'])->name('update.cash.transaction');
Route::post('delete-cash-transaction', [AccountController::class, 'cashTransactionDestroy'])->name('delete.cash.transaction');
Route::get('cash-ledger', [AccountController::class, 'cashLedger'])->name('cash.ledger')->middleware('useractivity');
Route::post('get-cash-ledger', [AccountController::class, 'getCashLedger'])->name('get.cash.ledger');
Route::get('cash-view', [AccountController::class, 'cashView'])->name('cash.view')->middleware('useractivity');
Route::get('cash-statement', [AccountController::class, 'cashStatement'])->name('cash.statement')->middleware('useractivity');
Route::get('cash-transaction-report', [AccountController::class, 'cashTransactionReport'])->name('cash.transaction.report')->middleware('useractivity');

// Bank account route
Route::get('bank-account', [BankTransactionController::class, 'create'])->name('bank.account.create')->middleware('useractivity');
Route::get('get-bank-accounts', [BankTransactionController::class, 'index'])->name('get.bank.account');
Route::post('add-bank-account', [BankTransactionController::class, 'store'])->name('add.bank.account');
Route::post('update-bank-account', [BankTransactionController::class, 'update'])->name('update.bank.account');
Route::post('change-account-status', [BankTransactionController::class, 'changeStatus'])->name('change.account.status');

// Bank transaction route
Route::get('bank-transaction', [BankTransactionController::class, 'bankTransaction'])->name('bank.transaction')->middleware('useractivity');
Route::match(['get', 'post'], 'get-bank-transactions', [BankTransactionController::class, 'getBankTransaction'])->name('get.bank.transaction');
Route::post('add-bank-transaction', [BankTransactionController::class, 'bankTransactionStore'])->name('add.bank.transaction');
Route::post('update-bank-transaction', [BankTransactionController::class, 'bankTransactionUpdate'])->name('update.bank.transaction');
Route::post('delete-bank-transaction', [BankTransactionController::class, 'bankTransactionDestroy'])->name('delete.bank.transaction');
Route::get('bank-ledger', [BankTransactionController::class, 'bankLedger'])->name('bank.ledger')->middleware('useractivity');
Route::post('bank-transaction-summary', [BankTransactionController::class, 'getBankTransactionSummary'])->name('bank.transaction.summary');
Route::post('get-bank-ledger', [BankTransactionController::class, 'getBankLedger'])->name('get.bank.ledger');
Route::get('bank-transaction-record', [BankTransactionController::class, 'bankTransactionRecord'])->name('bank.transaction.record');

// Guest Payment Route
Route::get('customer-payment/{id?}', [CustomerPaymentController::class, 'create'])->name('customer.payment')->middleware('useractivity');
Route::match(['get', 'post'], 'get-customer-payments', [CustomerPaymentController::class, 'index'])->name('get.customer.payment');
Route::post('add-customer-payment', [CustomerPaymentController::class, 'store'])->name('add.customer.payment');
Route::post('update-customer-payment', [CustomerPaymentController::class, 'update'])->name('update.customer.payment');
Route::post('delete-customer-payment', [CustomerPaymentController::class, 'destroy'])->name('delete.customer.payment');
Route::get('customer-ledger', [CustomerPaymentController::class, 'customerLedger'])->name('customer.customerLedger')->middleware('useractivity');
Route::post('get-customer-ledger', [CustomerPaymentController::class, 'getcustomerLedger'])->name('get.customer.ledger');
Route::get('customer-due', [CustomerPaymentController::class, 'customerDue'])->name('customer.due')->middleware('useractivity');
Route::post('get-customer-due', [CustomerPaymentController::class, 'getCustomerDue'])->name('get.customer.due');
Route::get('payment-invoice/{slug}/{id}', [CustomerPaymentController::class, 'invoice'])->name('payment.invoice');
Route::get('customer-payment-history', [CustomerPaymentController::class, 'customerPaymentHistory'])->name('customer.payment.history')->middleware('useractivity');

// Supplier Payment Route
Route::get('supplier-payment', [SupplierPaymentController::class, 'create'])->name('supplier.payment')->middleware('useractivity');
Route::match(['get', 'post'], 'get-supplier-payments', [SupplierPaymentController::class, 'index'])->name('get.supplier.payment');
Route::post('add-supplier-payment', [SupplierPaymentController::class, 'store'])->name('add.supplier.payment');
Route::post('update-supplier-payment', [SupplierPaymentController::class, 'update'])->name('update.supplier.payment');
Route::post('delete-supplier-payment', [SupplierPaymentController::class, 'destroy'])->name('delete.supplier.payment');
Route::get('supplier-ledger', [SupplierPaymentController::class, 'supplierLedger'])->name('supplier.supplierLedger')->middleware('useractivity');
Route::post('get-supplier-ledger', [SupplierPaymentController::class, 'getsupplierLedger'])->name('get.supplier.ledger');
Route::get('supplier-due', [SupplierPaymentController::class, 'supplierDue'])->name('supplier.due')->middleware('useractivity');
Route::post('get-supplier-due', [SupplierPaymentController::class, 'getsupplierDue'])->name('get.supplier.due');
Route::get('payment-invoice/{id}', [SupplierPaymentController::class, 'invoice'])->name('supplier.payment.invoice');
Route::get('supplier-payment-history', [SupplierPaymentController::class, 'supplierPaymentHistory'])->name('supplier.payment.history')->middleware('useractivity');

// Loan Account Route
Route::get('loan-account', [LoanController::class, 'accountCreate'])->name('loan.account.create')->middleware('useractivity');
Route::match(['get', 'post'], 'get-loan-accounts', [LoanController::class, 'getAccounts'])->name('get.loan.account');
Route::post('add-loan-account', [LoanController::class, 'accountStore'])->name('add.loan.account');
Route::post('update-loan-account', [LoanController::class, 'accountUpdate'])->name('update.loan.account');
Route::post('delete-loan-account', [LoanController::class, 'accountDestroy'])->name('delete.loan.account');

// Loan Transaction Route
Route::get('loan-transaction', [LoanController::class, 'loanTransaction'])->name('loan.transaction')->middleware('useractivity');
Route::match(['get', 'post'], 'get-loan-transactions', [LoanController::class, 'getLoanTransaction'])->name('get.loan.transaction');
Route::post('add-loan-transaction', [LoanController::class, 'loanTransactionStore'])->name('add.loan.transaction');
Route::post('update-loan-transaction', [LoanController::class, 'loanTransactionUpdate'])->name('update.loan.transaction');
Route::post('delete-loan-transaction', [LoanController::class, 'loanTransactionDestroy'])->name('delete.loan.transaction');
Route::get('loan-view', [LoanController::class, 'loanView'])->name('loan.view');
Route::get('loan-transaction-report', [LoanController::class, 'loanTransactionReport'])->name('loan.transaction.report');
Route::get('loan-ledger', [LoanController::class, 'loanLedger'])->name('loan.ledger');
Route::post('get-loan-ledger', [LoanController::class, 'getLoanLedger'])->name('get.loan.ledger');
Route::post('loan-transaction-summary', [LoanController::class, 'loanTransactionSummery'])->name('loan.transaction.summary');

// Investment Account Route
Route::get('investment-account', [InvestmentController::class, 'accountCreate'])->name('investment.account.create')->middleware('useractivity');
Route::get('get-investment-accounts', [InvestmentController::class, 'getAccounts'])->name('get.investment.account');
Route::post('add-investment-account', [InvestmentController::class, 'accountStore'])->name('add.investment.account');
Route::post('update-investment-account', [InvestmentController::class, 'accountUpdate'])->name('update.investment.account');
Route::post('delete-investment-account', [InvestmentController::class, 'accountDestroy'])->name('delete.investment.account');

// Investment Transaction Route
Route::get('investment-transaction', [InvestmentController::class, 'investmentTransaction'])->name('investment.transaction')->middleware('useractivity');
Route::match(['get', 'post'], 'get-investment-transactions', [InvestmentController::class, 'getInvestmentTransaction'])->name('get.investment.transaction');
Route::post('add-investment-transaction', [InvestmentController::class, 'investmentTransactionStore'])->name('add.investment.transaction');
Route::post('update-investment-transaction', [InvestmentController::class, 'investmentTransactionUpdate'])->name('update.investment.transaction');
Route::post('delete-investment-transaction', [InvestmentController::class, 'investmentTransactionDestroy'])->name('delete.investment.transaction');
Route::get('investment-view', [InvestmentController::class, 'investmentView'])->name('investment.view');
Route::get('investment-transaction-report', [InvestmentController::class, 'investmentTransactionReport'])->name('investment.transaction.report');
Route::get('investment-ledger', [InvestmentController::class, 'investmentLedger'])->name('investment.ledger');
Route::post('get-investment-ledger', [InvestmentController::class, 'getInvestmentLedger'])->name('get.investment.ledger');
Route::post('investment-transaction-summary', [InvestmentController::class, 'getInvestmentTransactionSummary'])->name('investment.transaction.summary');

// Report Module Route 
Route::get('/profitLoss', [ReportController::class, 'profitLoss'])->name('profit.loss')->middleware('useractivity');
Route::get('/balance-sheet', [ReportController::class, 'balanceSheet'])->name('report.balance.sheet')->middleware('useractivity');
Route::post('/get-balance-sheet', [ReportController::class, 'getbalanceSheet'])->name('report.getbalance.sheet');
Route::get('/balance-inout', [ReportController::class, 'balanceInOut'])->name('report.balance.inout')->middleware('useractivity');
Route::get('/daybook', [ReportController::class, 'dayBook'])->name('report.daybook')->middleware('useractivity');
Route::post('/get-profit-loss', [ReportController::class, 'getProfitLoss'])->name('get.profit.loss');
Route::post('/get_other_income_expense', [ReportController::class, 'getOtherIncomeExpense'])->name('other.income.expense');
Route::post('/get-cashandbank-balance', [ReportController::class, 'getCashAndBankBalance'])->name('get.cashandbank.balance');

// Booking Module Route 
Route::get('booking/{id?}', [BookingController::class, 'create'])->name('booking.create')->middleware('useractivity');
Route::match(['get', 'post'], 'get-booking', [BookingController::class, 'index'])->name('get.booking');
Route::post('save-booking', [BookingController::class, 'store'])->name('save.booking');
Route::post('update-booking', [BookingController::class, 'update'])->name('update.booking');
Route::post('delete-booking', [BookingController::class, 'destroy'])->name('delete.booking');
Route::match(['get', 'post'], 'get-available-table', [BookingController::class, 'singleAvailableTable'])->name('get.availabletable');
Route::match(['get', 'post'], 'get-tablecalendar', [BookingController::class, 'tableBookingCalendar'])->name('get.tablecalendar');
Route::get('booking-record', [BookingController::class, 'bookingRecord'])->name('booking.bookingRecord')->middleware('useractivity');
Route::get('checkin-record', [BookingController::class, 'checkinRecord'])->name('checkin.checkinRecord')->middleware('useractivity');
Route::get('billing-record', [BookingController::class, 'billingRecord'])->name('billing.billingRecord')->middleware('useractivity');
Route::get('booking-invoice-print/{id}', [BookingController::class, 'bookingInvoice'])->name('booking.invoice')->middleware('useractivity');
Route::get('checkin', [BookingController::class, 'checkIn'])->name('checkin.create')->middleware('useractivity');
Route::post('save-checkin', [BookingController::class, 'saveCheckin'])->name('store.checkin');
Route::get('/booking/checkout', [BookingController::class, 'checkOut'])->name('checkout.create')->middleware('useractivity');
Route::get('/booking/checkout', [BookingController::class, 'checkOut'])->name('checkout.create')->middleware('useractivity');
Route::get('/booking/checkout', [BookingController::class, 'checkOut'])->name('checkout.create')->middleware('useractivity');
Route::post('save-checkout', [BookingController::class, 'saveCheckOut'])->name('checkout.store');
Route::get('checkin-list', [BookingController::class, 'checkinList'])->name('checkin.list')->middleware('useractivity');
Route::post('get-checkin-list', [BookingController::class, 'getCheckinList'])->name('get.checkin.list');
Route::get('billing-invoice', [BookingController::class, 'billingInvoice'])->name('billing.invoice')->middleware('useractivity');
Route::get('billing-invoice-print/{id}', [BookingController::class, 'billingInvoicePrint'])->name('billing.invoicePrint')->middleware('useractivity');

// Restaurant Module Route 
// Menu category route
Route::get('menu-category', [MenuCategoryController::class, 'create'])->name('menu.category.create')->middleware('useractivity');
Route::get('get-menu-category', [MenuCategoryController::class, 'index'])->name('menu.category.index');
Route::post('menu-category', [MenuCategoryController::class, 'store'])->name('menu.category.store');
Route::post('update-menu-category', [MenuCategoryController::class, 'update'])->name('menu.category.update');
Route::post('delete-menu-category', [MenuCategoryController::class, 'destroy'])->name('menu.category.destroy');

// Unit route
Route::get('unit', [UnitController::class, 'create'])->name('unit.create')->middleware('useractivity');
Route::get('get-unit', [UnitController::class, 'index'])->name('unit.index');
Route::post('unit', [UnitController::class, 'store'])->name('unit.store');
Route::post('update-unit', [UnitController::class, 'update'])->name('unit.update');
Route::post('delete-unit', [UnitController::class, 'destroy'])->name('unit.destroy');

// Menu route
Route::get('menu', [MenuController::class, 'create'])->name('menu.create')->middleware('useractivity');
Route::match(['get', 'post'], 'get-menu', [MenuController::class, 'index'])->name('menu.index');
Route::post('menu', [MenuController::class, 'store'])->name('menu.store');
Route::post('update-menu', [MenuController::class, 'update'])->name('menu.update');
Route::post('delete-menu', [MenuController::class, 'destroy'])->name('menu.destroy');
Route::post('update-status', [MenuController::class, 'updateStatus'])->name('menu.status.update');
Route::get('menuList', [MenuController::class, 'menuList'])->name('menu.list')->middleware('useractivity');

// Order route
Route::get('order/{id?}', [OrderController::class, 'create'])->name('order.create')->middleware('useractivity');
Route::get('orderList', [OrderController::class, 'index'])->name('order.list')->middleware('useractivity');
Route::get('pendingOrder', [OrderController::class, 'pending'])->name('pending.order')->middleware('useractivity');
Route::match(['get', 'post'], 'get-order', [OrderController::class, 'getOrder'])->name('get.order');
Route::post('get-order-details', [OrderController::class, 'orderDetails'])->name('order.details');
Route::post('get-order-by-chair', [OrderController::class, 'orderDetailsByChair'])->name('order.detailsbytable');
Route::post('add-order', [OrderController::class, 'store'])->name('order.store');
Route::post('update-order', [OrderController::class, 'update'])->name('order.update');
Route::post('add-draft-order', [OrderController::class, 'storeDraft'])->name('order.storeDraft');
Route::post('update-draft-order', [OrderController::class, 'updateDraft'])->name('order.updateDraft');
Route::post('delete-order', [OrderController::class, 'destroy'])->name('order.delete');
Route::post('approve-order', [OrderController::class, 'approve'])->name('order.approve');
Route::get('order-invoice-print/{id}', [OrderController::class, 'orderInvoicePrint'])->name('order.invoice')->middleware('useractivity');

// kitchen
Route::get('kitchen_pending_order', [OrderController::class, 'pendingList'])->name('pending.delivery')->middleware('useractivity');
Route::get('kitchen_delivered_order', [OrderController::class, 'deliveredOrderList'])->name('kitchen_delivered.order')->middleware('useractivity');
Route::post('kitchen_approve_order', [OrderController::class, 'kitchenApprove']);
Route::get('tableBooking', [OrderController::class, 'tableBooking'])->name('tableBooking.order')->middleware('useractivity');
Route::post('get-table-bookings', [OrderController::class, 'tableBookingList'])->name('order.tableBookingList');
Route::post('approve-table-booking', [OrderController::class, 'approveBooking'])->name('order.approveBooking');
Route::post('cancel-table-booking', [OrderController::class, 'cancelBooking'])->name('order.cancelBooking');
Route::post('delete-table-booking', [OrderController::class, 'destroyBooking'])->name('order.deleteBooking');

//Pay First Order Route
Route::get('payFirst/{id?}', [OrderController::class, 'payFirst'])->name('order.payFirst')->middleware('useractivity');
Route::post('add-payFirst-order', [OrderController::class, 'storePayFirst'])->name('order.storePayFirst');
Route::post('update-payFirst-order', [OrderController::class, 'updatePayFirst'])->name('order.updatePayFirst');
Route::post('delete-payFirst-order', [OrderController::class, 'destroyPayFirst'])->name('order.destroyPayFirst');

// Material route
Route::get('material', [MaterialController::class, 'create'])->name('material.create')->middleware('useractivity');
Route::match(['get', 'post'], 'get-material', [MaterialController::class, 'index'])->name('material.index');
Route::post('material', [MaterialController::class, 'store'])->name('material.store');
Route::post('update-material', [MaterialController::class, 'update'])->name('material.update');
Route::post('delete-material', [MaterialController::class, 'destroy'])->name('material.destroy');
Route::get('productionList', [MaterialController::class, 'productionList'])->name('production.list');
Route::match(['get', 'post'], 'get-production', [MaterialController::class, 'getProduction'])->name('get.production');
Route::post('get-production-details', [MaterialController::class, 'productionDetails'])->name('production.details');
Route::get('materialStock', [MaterialController::class, 'stock'])->name('material.stock');
Route::post('get-material-stock', [MaterialController::class, 'getStock'])->name('get.material.stock');
Route::get('production-invoice-print/{id}', [MaterialController::class, 'productInvoicePrint'])->name('production.invoice')->middleware('useractivity');

// Material Purchase Route
Route::get('materialPurchase/{id?}', [MaterialPurchaseController::class, 'create'])->name('material.purchase.create')->middleware('useractivity');
Route::get('materialPurchaseList', [MaterialPurchaseController::class, 'index'])->name('material.purchase.list')->middleware('useractivity');
Route::match(['get', 'post'], 'get-material-purchase', [MaterialPurchaseController::class, 'get'])->name('get.materila.purchase');
Route::post('get-material-purchase-details', [MaterialPurchaseController::class, 'details'])->name('material.purchase.details');
Route::post('add-material-purchase', [MaterialPurchaseController::class, 'store'])->name('material.purchase.store');
Route::post('update-material-purchase', [MaterialPurchaseController::class, 'update'])->name('material.purchase.update');
Route::post('delete-material-purchase', [MaterialPurchaseController::class, 'destroy'])->name('material.purchase.delete');
Route::get('material-purchase-invoice-print/{id}', [MaterialPurchaseController::class, 'invoicePrint'])->name('material.purchase.invoice')->middleware('useractivity');

// Requisition Route
Route::get('requisition/{id?}', [RequisitionController::class, 'create'])->name('requisition.create')->middleware('useractivity');
Route::get('requisitionList', [RequisitionController::class, 'index'])->name('requisition.list')->middleware('useractivity');
Route::match(['get', 'post'], 'get-requisition', [RequisitionController::class, 'get']);
Route::post('get-requisition-details', [RequisitionController::class, 'details']);
Route::post('add-requisition', [RequisitionController::class, 'store']);
Route::post('update-requisition', [RequisitionController::class, 'update']);
Route::post('delete-requisition', [RequisitionController::class, 'destroy']);
Route::post('requisition_status', [RequisitionController::class, 'status']);
Route::get('requisition-invoice-print/{id}', [RequisitionController::class, 'invoicePrint'])->middleware('useractivity');

// Inventory Module All Route 
// Brand Route
Route::get('brand', [BrandController::class, 'create'])->name('brand.create')->middleware('useractivity');
Route::get('get-brand', [BrandController::class, 'index'])->name('brand.index');
Route::post('brand', [BrandController::class, 'store'])->name('brand.store');
Route::post('update-brand', [BrandController::class, 'update'])->name('brand.update');
Route::post('delete-brand', [BrandController::class, 'destroy'])->name('brand.destroy');

// Asset Route
Route::get('asset', [AssetController::class, 'create'])->name('asset.create')->middleware('useractivity');
Route::match(['get', 'post'], 'get-asset', [AssetController::class, 'index'])->name('asset.index');
Route::post('asset', [AssetController::class, 'store'])->name('asset.store');
Route::post('update-asset', [AssetController::class, 'update'])->name('asset.update');
Route::post('delete-asset', [AssetController::class, 'destroy'])->name('asset.destroy');
Route::get('assetList', [AssetController::class, 'assetList'])->name('asset.list')->middleware('useractivity');
Route::post('get-asset-stock', [AssetController::class, 'assetStock'])->name('asset.stock');
Route::post('get-issue-asset', [AssetController::class, 'getIssueAsset'])->name('get.issue.asset');

// Purchase Route
Route::get('purchase/{id?}', [PurchaseController::class, 'create'])->name('purchase.create')->middleware('useractivity');
Route::get('purchaseList', [PurchaseController::class, 'index'])->name('purchase.list')->middleware('useractivity');
Route::match(['get', 'post'], 'get-purchase', [PurchaseController::class, 'get'])->name('get.purchase');
Route::post('get-purchase-details', [PurchaseController::class, 'details'])->name('purchase.details');
Route::post('add-purchase', [PurchaseController::class, 'store'])->name('purchase.store');
Route::post('update-purchase', [PurchaseController::class, 'update'])->name('purchase.update');
Route::post('delete-purchase', [PurchaseController::class, 'destroy'])->name('purchase.delete');
Route::get('purchase-invoice-print/{id}', [PurchaseController::class, 'invoicePrint'])->name('purchase.invoice')->middleware('useractivity');

// Disposal Route
Route::get('disposal/{id?}', [DisposalController::class, 'create'])->name('disposal.create')->middleware('useractivity');
Route::get('disposalList', [DisposalController::class, 'index'])->name('disposal.list')->middleware('useractivity');
Route::match(['get', 'post'], 'get-disposal', [DisposalController::class, 'get'])->name('get.disposal');
Route::post('get-disposal-details', [DisposalController::class, 'details'])->name('disposal.details');
Route::post('add-disposal', [DisposalController::class, 'store'])->name('disposal.store');
Route::post('update-disposal', [DisposalController::class, 'update'])->name('disposal.update');
Route::post('delete-disposal', [DisposalController::class, 'destroy'])->name('disposal.delete');

// Issue Route
Route::get('issue/{id?}', [IssueController::class, 'create'])->name('issue.create')->middleware('useractivity');
Route::get('issueList', [IssueController::class, 'index'])->name('issue.list')->middleware('useractivity');
Route::match(['get', 'post'], 'get-issue', [IssueController::class, 'get'])->name('get.issue');
Route::post('get-issue-details', [IssueController::class, 'details'])->name('issue.details');
Route::post('add-issue', [IssueController::class, 'store'])->name('issue.store');
Route::post('update-issue', [IssueController::class, 'update'])->name('issue.update');
Route::post('delete-issue', [IssueController::class, 'destroy'])->name('issue.delete');
Route::get('issue-invoice-print/{id}', [IssueController::class, 'invoicePrint'])->name('issue.invoice')->middleware('useractivity');

// issue return
Route::get('issueReturn', [IssueReturnController::class, 'create'])->name('issue.return')->middleware('useractivity');
Route::get('issueReturnList', [IssueReturnController::class, 'index'])->name('issue.return.list')->middleware('useractivity');
Route::post('get-asset-for-return', [IssueReturnController::class, 'getAssetForReturn']);
Route::post('add-asset-return', [IssueReturnController::class, 'store']);
Route::get('issue-return-invoice-print/{id}', [IssueReturnController::class, 'invoice'])->name('issue.return.invoice')->middleware('useractivity');
Route::match(['get', 'post'], 'get-issue-return', [IssueReturnController::class, 'get'])->name('get.issue.return');
Route::post('get-issue-return-details', [IssueReturnController::class, 'details'])->name('issue.return.details');
Route::post('delete-issue-return', [IssueReturnController::class, 'destroy'])->name('issue.return.delete');

// Service Module All Route 
// Asset Route
Route::get('service-head', [ServiceHeadController::class, 'create'])->name('service.head.create')->middleware('useractivity');
Route::match(['get', 'post'], 'get-service-head', [ServiceHeadController::class, 'index'])->name('service.head.index');
Route::post('service-head', [ServiceHeadController::class, 'store'])->name('service.head.store');
Route::post('update-service-head', [ServiceHeadController::class, 'update'])->name('service.head.update');
Route::post('delete-service-head', [ServiceHeadController::class, 'destroy'])->name('service.head.destroy');
Route::get('serviceHeadList', [ServiceHeadController::class, 'list'])->name('service.head.list')->middleware('useractivity');

// Service Route
Route::get('service', [ServiceController::class, 'create'])->name('service.create')->middleware('useractivity');
Route::match(['get', 'post'], 'get-service', [ServiceController::class, 'index'])->name('service.index');
Route::post('service', [ServiceController::class, 'store'])->name('service.store');
Route::post('update-service', [ServiceController::class, 'update'])->name('service.update');
Route::post('delete-service', [ServiceController::class, 'destroy'])->name('service.destroy');
Route::get('serviceList', [ServiceController::class, 'list'])->name('service.list')->middleware('useractivity');
Route::post('get_checkin_customer', [ServiceController::class, 'getCheckinCustomer'])->name('get.checkin.customer');

// Business Monitor Module All Route 
Route::get('graph', [GraphController::class, 'create'])->name('graph.create')->middleware('useractivity');
Route::match(['post', 'get'], 'get-overall-data', [GraphController::class, 'index'])->name('overall.index');
Route::match(['post', 'get'], 'get-graph-data', [GraphController::class, 'graph'])->name('graph.index');
Route::match(['post', 'get'], 'get-top-data', [GraphController::class, 'topData'])->name('topdata.index');

// Website Module All Route 
//management route
Route::get('management', [WebsiteController::class, 'manage'])->name('management.create')->middleware('useractivity');
Route::match(['get', 'post'], 'get-management', [WebsiteController::class, 'getManage'])->name('management.index');
Route::post('management', [WebsiteController::class, 'manageStore'])->name('management.store');
Route::post('update-management', [WebsiteController::class, 'manageUpdate'])->name('management.update');
Route::post('delete-management', [WebsiteController::class, 'manageDestroy'])->name('management.destroy');

//gallery route
Route::get('gallery', [WebsiteController::class, 'gallery'])->name('gallery.create')->middleware('useractivity');
Route::match(['get', 'post'], 'get-gallery', [WebsiteController::class, 'getGallery'])->name('gallery.index');
Route::post('gallery', [WebsiteController::class, 'galleryStore'])->name('gallery.store');
Route::post('update-gallery', [WebsiteController::class, 'galleryUpdate'])->name('gallery.update');
Route::post('delete-gallery', [WebsiteController::class, 'galleryDestroy'])->name('gallery.destroy');

//about route
Route::get('about', [WebsiteController::class, 'aboutpage'])->name('about.create')->middleware('useractivity');
Route::post('update-about', [WebsiteController::class, 'aboutUpdate'])->name('about.update');
Route::match(['get', 'post'], 'get-about', [WebsiteController::class, 'getAbout'])->name('about.index');

//Lunch route
Route::get('lunch', [LunchController::class, 'index']);
Route::post('update-lunch', [LunchController::class, 'update']);
Route::match(['get', 'post'], 'get-lunch', [LunchController::class, 'get']);

//Catering route
Route::get('catering', [CateringController::class, 'index']);
Route::post('update-catering', [CateringController::class, 'update']);
Route::match(['get', 'post'], 'get-catering', [CateringController::class, 'get']);

//slider route
Route::get('slider', [SliderController::class, 'create'])->name('slider.create')->middleware('useractivity');
Route::get('get-slider', [SliderController::class, 'index'])->name('slider.index');
Route::post('slider', [SliderController::class, 'store'])->name('slider.store');
Route::post('update-slider', [SliderController::class, 'update'])->name('slider.update');
Route::post('delete-slider', [SliderController::class, 'destroy'])->name('slider.destroy');

//specialties route
Route::get('specialties', [SpecialtiesController::class, 'create'])->name('specialties.create')->middleware('useractivity');
Route::get('get-specialties', [SpecialtiesController::class, 'index'])->name('specialties.index');
Route::post('store-specialties', [SpecialtiesController::class, 'store'])->name('specialties.store');
Route::post('update-specialties', [SpecialtiesController::class, 'update'])->name('specialties.update');
Route::post('update-banner-specialties', [SpecialtiesController::class, 'updateBanner'])->name('specialties.updateBanner');
Route::post('delete-specialties', [SpecialtiesController::class, 'destroy'])->name('specialties.destroy');

//Blog route
Route::get('blog', [BlogController::class, 'create'])->name('blog.create')->middleware('useractivity');
Route::get('get-blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('get-blog-categories', [BlogController::class, 'getCategories']);
Route::post('storeBlogCategory', [BlogController::class, 'storeCategory']);
Route::post('store-blog', [BlogController::class, 'store'])->name('blog.store');
Route::post('update-blog', [BlogController::class, 'update'])->name('blog.update');
Route::post('delete-blog', [BlogController::class, 'destroy'])->name('blog.destroy');

//Cocktail route
Route::get('cocktails-description', [CocktailsController::class, 'cocktaileDesc'])->name('cocktaileDesc')->middleware('useractivity');
Route::post('update-description-cocktails', [CocktailsController::class, 'description']);
Route::get('concktailsEntry', [CocktailsController::class, 'create'])->name('cocktails.create')->middleware('useractivity');
Route::get('get-cocktails', [CocktailsController::class, 'index'])->name('cocktails.index');
Route::get('get-categoryCocktails', [CocktailsController::class, 'getCategory']);
Route::post('store-cocktails', [CocktailsController::class, 'store'])->name('cocktails.store');
Route::post('store-categoryCocktails', [CocktailsController::class, 'storeCategory'])->name('cocktails.store');
Route::post('update-cocktails', [CocktailsController::class, 'update'])->name('cocktails.update');
Route::post('update-banner-cocktails', [CocktailsController::class, 'updateBanner'])->name('cocktails.updateBanner');
Route::post('delete-cocktails', [CocktailsController::class, 'destroy'])->name('cocktails.destroy');

//offer route
Route::get('offer', [OfferController::class, 'create'])->name('offer.create')->middleware('useractivity');
Route::get('get-offer', [OfferController::class, 'index'])->name('offer.index');
Route::post('offer', [OfferController::class, 'store'])->name('offer.store');
Route::post('update-offer', [OfferController::class, 'update'])->name('offer.update');
Route::post('delete-offer', [OfferController::class, 'destroy'])->name('offer.destroy');

//terms and condition routes
Route::get('terms_and_conditions', [TermsAndConditionController::class, 'index'])->name('terms.index');
Route::get('get_terms_and_conditions', [TermsAndConditionController::class, 'getTerms'])->name('terms.get');
Route::post('terms_and_conditions', [TermsAndConditionController::class, 'store'])->name('terms.store');
Route::get('terms_and_conditions/{id}/edit', [TermsAndConditionController::class, 'edit'])->name('terms.edit');
Route::put('terms_and_conditions/{id}', [TermsAndConditionController::class, 'update'])->name('terms.update');
Route::delete('terms_and_conditions/{id}', [TermsAndConditionController::class, 'destroy'])->name('terms.destroy');

// privacy policy routes
Route::get('privacy_policy', [PrivacyPolicyController::class, 'index'])->name('privacy.index');
Route::get('get_privacy_policy', [PrivacyPolicyController::class, 'getPrivacies'])->name('privacy.get');
Route::post('privacy_policy', [PrivacyPolicyController::class, 'store'])->name('privacy.store');
Route::get('privacy_policy/{id}/edit', [PrivacyPolicyController::class, 'edit'])->name('privacy.edit');
Route::put('privacy_policy/{id}', [PrivacyPolicyController::class, 'update'])->name('privacy.update');
Route::delete('privacy_policy/{id}', [PrivacyPolicyController::class, 'destroy'])->name('privacy.destroy');

//messages route
Route::get('messages', [WebsiteController::class, 'messages_index'])->name('messages.index');
Route::get('get-messages', [WebsiteController::class, 'messages_get']);
Route::post('update-read-status', [WebsiteController::class, 'update_messages_status']);
Route::post('delete-message', [WebsiteController::class, 'delete_messages']);
