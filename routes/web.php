<?php

use App\Http\Controllers\System\CarouselImageController;
use App\Http\Controllers\System\SiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\System\UserController;
use App\Http\Controllers\System\PostController;
use App\Http\Controllers\System\SchoolController;
use App\Http\Controllers\System\MultimediaController;
use App\Http\Controllers\System\EventController;
use App\Http\Controllers\System\CourseController;
use App\Http\Controllers\System\CertificationController;
use App\Http\Controllers\System\ProgramController;
use App\Http\Controllers\System\FaqQuestionController;
use App\Http\Controllers\System\VideoController;
use App\Http\Controllers\System\LinkController;
use App\Http\Controllers\System\BannerOneInformationController;
use App\Http\Controllers\System\BannerTwoInformationController;
use App\Http\Controllers\System\ClientTestimonialController;
use App\Http\Controllers\System\MessageContactController;


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

Auth::routes([
    'register' => false,
    'verify'   => true,
    'reset'    => false
]);

Route::group(['middleware' => 'auth'], function () {

    # Routes Welcome
    Route::get('/', function () { return view('welcome'); });

    # Routes Dashboard
    Route::get('/dashboard', function() { return view('dashboard'); })->name('dashboard');

    # Routes Home
    Route::controller(HomeController::class)
        ->group(function () {

            Route::get('home', 'index')->name('home');
            Route::get('403', 'unauthorized')->name('403');

        });

    #Routes multimedia
    Route::controller(MultimediaController::class)
        ->prefix('multimedia')
        ->as('multimedia-')
        ->group(function () {

            Route::post('upload-image', 'uploadImage')->name('upload-image');

        });

    #Routes group of configuration menu
    Route::group(['prefix' => 'configuration'], function () {

        #Routes users
        Route::controller(UserController::class)
            ->prefix('users')
            ->as('user-')
            ->group(function () {

                Route::get('index', 'index')->name('index');

        });

        #Routes schools
        Route::controller(SchoolController::class)
            ->prefix('schools')
            ->as('school-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');

        });

    });

    #Routes group of publications menu
    Route::group(['prefix' => 'publications'], function () {

        #Routes posts
        Route::controller(PostController::class)
            ->prefix('posts')
            ->as('post-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');
                Route::get('preview/{id}', 'preview')->name('preview');

        });

        #Routes sites
        Route::controller(SiteController::class)
            ->prefix('sites')
            ->as('site-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');

        });

        #Routes carousel images
        Route::controller(CarouselImageController::class)
            ->prefix('carousel-images')
            ->as('carousel-image-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');

        });

        #Routes events
        Route::controller(EventController::class)
            ->prefix('events')
            ->as('event-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');

        });

        #Routes courses
        Route::controller(CourseController::class)
            ->prefix('courses')
            ->as('course-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');

        });

        #Routes certifications
        Route::controller(CertificationController::class)
            ->prefix('certifications')
            ->as('certification-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');

        });

        #Routes programs
        Route::controller(ProgramController::class)
            ->prefix('programs')
            ->as('program-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');

        });

        #Routes faq-questions
        Route::controller(FaqQuestionController::class)
            ->prefix('faq-questions')
            ->as('faq-question-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');

        });

        #Routes videos
        Route::controller(VideoController::class)
            ->prefix('videos')
            ->as('video-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');

         });

        #Routes links
        Route::controller(LinkController::class)
            ->prefix('links')
            ->as('link-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');

            });

        #Routes banner one informations
        Route::controller(BannerOneInformationController::class)
            ->prefix('banner-one-informations')
            ->as('bannerOneInformation-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');

            });

        #Routes banner two informations
        Route::controller(BannerTwoInformationController::class)
            ->prefix('banner-two-informations')
            ->as('bannerTwoInformation-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');

            });

        #Routes message contact
        Route::controller(MessageContactController::class)
            ->prefix('message-contact')
            ->as('messageContact-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('generateExcel/{typeMessage?}', 'generateExcel')->name('generateExcel');

            });

        #Routes client comments
        Route::controller(ClientTestimonialController::class)
            ->prefix('client-testimonials')
            ->as('clientTestimonial-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');

            });

    });

    Route::post('/ruta-del-backend', function (Illuminate\Http\Request $request) {
        $inputValue = $request->input('input_value');

        $selectValue = $request->input('select_value');

        // Lógica adicional para procesar el valor recibido

        return response()->json([
            'input_value'  => $inputValue,
            'select_value' => $selectValue,
        ]);

        /*$inputValue = $request->input('input_value');

        $selectValue = $request->input('select_value');

        // Lógica adicional para procesar el valor recibido

        return response()->json([
                'input_value'  => $inputValue,
                'select_value' => $selectValue,
                'has_cost'     => '0'
            ]
        );*/

    });

});
