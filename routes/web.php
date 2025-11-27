<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ExcelReportController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\LandingPages;
use App\Http\Controllers\PdfReportController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Livewire\UserComponent;
use App\Livewire\RolesComponent;
use App\Livewire\PermissionComponent;
use App\Livewire\affiliate\ViewAffiliate;
use App\Livewire\TypePayComponent;
use App\Livewire\affiliate\CreateAffiliate;
use App\Livewire\Affiliate\ViewComponent;
use App\Livewire\Agreements\AgrementComponent;
use App\Livewire\Agreements\FormAgreement;
use App\Livewire\Articles\ArticleComponent;
use App\Livewire\Articles\FormArticle;
use App\Livewire\Auth\Create;
use App\Livewire\Courses\CourseComponent;
use App\Livewire\Courses\FormCourse;
use App\Livewire\DashboardComponent;
use App\Livewire\DeceasedComponent;
use App\Livewire\Demands\DemandComponent;
use App\Livewire\Demands\DemandsDetails;
use App\Livewire\Demands\DemandsManagement;
use App\Livewire\Direcories\DirectoryComponent;
use App\Livewire\Direcories\DirectoryFormComponent;
use App\Livewire\DiscountComponent;
use App\Livewire\EventsPhoto\EventComponent;
use App\Livewire\EventsPhoto\PhotosComponent;
use App\Livewire\FeesComponent;
use App\Livewire\Finances\DebtsComponent;
use App\Livewire\Finances\DebtsDetailsComponent;
use App\Livewire\Institutions\InstitutionComponent;
use App\Livewire\Institutions\RequirementComponent;
use App\Livewire\LicenseComponent;
use App\Livewire\News\FormNew;
use App\Livewire\News\NewComponent;
use App\Livewire\PlanPayment;
use App\Livewire\ProcedureComponent;
use App\Livewire\Recognitions\RecognitionComponent;
use App\Livewire\Recognitions\RecognitionDetails;
use App\Livewire\Reports\AffiliatesReport;
use App\Livewire\Reports\ContributionAffiliate;
use App\Livewire\Reports\ContributionReport;
use App\Livewire\SpecialtyComponent;
use App\Livewire\UniversityComponent;
use App\Models\University;
use Faker\Guesser\Name;
Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});
Route::get('/', function () {
    return view('site.pages.index');
})->name('home');

Route::get('/'   ,      [App\Http\Controllers\SitePagesController::class, 'index'  ])  ->name('home');
Route::get('acerca-de', [App\Http\Controllers\SitePagesController::class, 'about'  ])  ->name('site.about');
Route::get('cursos'   , [App\Http\Controllers\SitePagesController::class, 'courses' ]) ->name('site.courses');
Route::get('contacto' , [App\Http\Controllers\SitePagesController::class, 'contact'])  ->name('site.contact');
Route::get('eventos/{count?}'  , [App\Http\Controllers\SitePagesController::class, 'events'  ]) ->name('site.events');
Route::get('eventos/{id}/images', [App\Http\Controllers\SitePagesController::class, 'eventsGalery'  ]) ->name('site.events.galery');
Route::get('noticias' , [App\Http\Controllers\SitePagesController::class, 'news'   ])  ->name('site.news');
Route::get('directorio' , [App\Http\Controllers\SitePagesController::class, 'directory'   ])  ->name('site.directory');
Route::get('convenios' , [App\Http\Controllers\SitePagesController::class, 'agreements'   ])  ->name('site.agreements');
Route::get('requisitos' , [App\Http\Controllers\SitePagesController::class, 'requirement'   ])  ->name('site.requirement');
Route::get('loginICAP', [LoginController::class, 'showLoginForm'])->name('site.login');
Route::post('/login', [LoginController::class, 'login']);



// Route::view('dashboard', 'pages.dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// routes/web.php o api.php
Route::get('/api/universities/search',[LandingPages::class,'universities' ])->name('api.universities.search');




Route::middleware(['auth','banned'])->group(function () {
    Route::get('dashboard', DashboardComponent::class)->name('dashboard.index');


    Route::get('users', App\Livewire\UserComponent::class)->name('users');
    Route::get('roles', RolesComponent::class)->name('roles');
    Route::get('permissions', PermissionComponent::class)->name('permissions');
    Route::get('affiliates', App\Livewire\Affiliate\ViewAffiliate::class)->name('view.affiliate');
    Route::get('affiliates/account/statement', ViewComponent::class)->name('affiliate.statement.account');
    Route::get('create-users/{id?}', Create::class)->name('user.create');
    Route::get('fees', FeesComponent::class)->name('fees');
    Route::get('Universities', UniversityComponent::class)->name('universities');
    Route::get('procedure', ProcedureComponent::class)->name('procedures');
    Route::get('specialties', SpecialtyComponent::class)->name('specialties');
    Route::get('procedure/details/{ide}', PlanPayment::class)->name('procedures.details');
    Route::get('affilate-register/{id?}', App\Livewire\Affiliate\CreateAffiliate::class)->name('register.affiliate');
    Route::get('demands', DemandComponent::class)->name('demands');
    Route::get('demands/details/{ide}', DemandsDetails::class)->name('demands.details');
    Route::get('demands/management/{ide}', DemandsManagement::class)->name('demands.management');
    Route::get('type', TypePayComponent::class)->name('type.pay');
    Route::get('discount', DiscountComponent::class)->name('discounts');
    Route::get('finances/{id}', DebtsDetailsComponent::class)->name('finances.details');
    Route::get('finances', DebtsComponent::class)->name('finances.debts');
    Route::get('recognitions', RecognitionComponent::class)->name('recognitions');
    Route::get('recognitions/details/{id}', RecognitionDetails::class)->name('recognitions.details');
    Route::get('deceased', DeceasedComponent::class)->name('deceased.affiliate');
    Route::get('license', LicenseComponent::class)->name('license.affiliate');
    Route::get('news/view', NewComponent::class)->name('news');
    Route::get('news/form/{id?}', FormNew::class)->name('news.form');
    Route::get('courses/view', CourseComponent::class)->name('courses');
    Route::get('courses/form/{id?}', FormCourse::class)->name('courses.form');
    Route::get('articles/view', ArticleComponent::class)->name('articles');
    Route::get('articles/form/{id?}', FormArticle::class)->name('article.form');
    Route::get('agreements/view', AgrementComponent::class)->name('agreements');
    Route::get('agreements/form/{id?}', FormAgreement::class)->name('agreement.form');
    Route::get('directories', DirectoryComponent::class)->name('directories');
    Route::get('directories/list', DirectoryFormComponent::class)->name('directories.list');
    Route::get('events', EventComponent::class)->name('events');
    Route::get('events/{id}/photos', PhotosComponent::class)->name('event.photos');
    Route::get('Insitution/configuration', InstitutionComponent::class)->name('institution.configuration');
    Route::get('Insitution/requirement', RequirementComponent::class)->name('institution.requirement');


    Route::get('prueba/requirement',[LandingPages::class,'requirement'])->name('requirement');
    Route::post('prueba/requirement',[LandingPages::class,'save'])->name('save');



    Route::get('/pdf/otro/{min}/{max}', [PdfController::class, 'generarConFpdf'])->name('generarpdf');
    Route::get('/pdf/affiliate/{min}/{max}', [PdfController::class, 'exportPDF'])->name('pdf.report');
    Route::get('/pdf/{id}', [PdfController::class, 'form'])->name('form.affiliate');
    Route::get('/pdf/listAffiliate/{id}', [PdfController::class, 'listAffiliate'])->name('pdf.listAffiliate');
    Route::get('/pdf/demands/{id}', [PdfController::class, 'demandsDetails'])->name('demandsDetails');
    Route::get('pdf/debts-details/{id}/{form}/{to}/{type?}/{fee?}', [PdfController::class, 'debt'])->name('pdf.debt');
    Route::get('pdf/report/ageAffiliate/{min}/{max}/{status?}', [PdfReportController::class, 'ageAffiliate'])->name('pdf.report.ageAffiliate');
    Route::get('pdf/report/specialitiesAffiliate', [PdfReportController::class, 'specialityAffiliate'])->name('pdf.report.specialityAffiliate');
    Route::get('pdf/report/statusAffiliate', [PdfReportController::class, 'statusAffiliate'])->name('pdf.report.statusAffiliate');
    Route::get('pdf/report/Affiliate/debts/{id}/{year}/{type?}/{concept?}', [PdfReportController::class, 'affiliateDebt'])->name('pdf.report.affiliateDebt');
    Route::get('pdf/report/contribution/{from}/{to}', [PdfReportController::class, 'contribution'])->name('pdf.report.contribution');
    Route::get('pdf/report/contribution/affiliate/{id}/{from}/{to}', [PdfReportController::class, 'contributionAffiliate'])->name('pdf.report.contribution.affiliate');


    Route::get('/reporte/list-afiliados-excel/{id}', [ExcelReportController::class, 'listAffiliates'])->name('reporte.listAffiliates-excel');
    Route::get('/reporte/status/afiliados-excel', [ExcelReportController::class, 'exportarAfiliadosExcel'])->name('reporte.afiliados-excel');
    Route::get('/reporte/speciality/afiliados-excel', [ExcelReportController::class, 'exportarAffiliatesSpecialityExcel'])->name('reporte.speciality.afiliados-excel');
    Route::get('/reporte/age/afiliados-excel/{minor}/{max}/{status?}', [ExcelReportController::class, 'exportAgeAffiliateToExcel'])->name('reporte.age.afiliados-excel');
    Route::get('/reporte/contribution-excel/{from}/{to}', [ExcelReportController::class, 'exportarContributionExcel'])->name('reporte.contribution-excel');
    Route::get('/reporte/contribution/affiliate-excel/{id}/{from}/{to}', [ExcelReportController::class, 'exportContributionAffiliateExcel'])->name('reporte.contribution.affiliate-excel');
    Route::get('/reporte/deceased/affiliate-excel', [ExcelReportController::class, 'exportDeceasedExcel'])->name('deceased.affiliate-excel');


    Route::get('report/affiliado', AffiliatesReport::class)->name('report.affiliate');
    Route::get('report/contribution', ContributionReport::class)->name('report.contribution');


    Route::get('report/contribution/{id}/{from}/{to}', ContributionAffiliate::class)->name('report.contribution.affiliate');


    
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::redirect('settings', 'settings/profile');


    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
