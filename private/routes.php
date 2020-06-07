<?php

use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;
use Website\Controllers\WebsiteController;

SimpleRouter::setDefaultNamespace( 'Website\Controllers' );

SimpleRouter::group( [ 'prefix' => site_url() ], function () {

	// START: Zet hier al eigen routes
	// Lees de docs, daar zie je hoe je routes kunt maken: https://github.com/skipperbent/simple-php-router#routes

	SimpleRouter::get( '/', 'WebsiteController@home' )->name( 'home' );
	SimpleRouter::get( '/aanmelden', 'WebsiteController@aanmelden' )->name( 'aanmelden' );
	SimpleRouter::get( '/admin', 'WebsiteController@adminPage')->name('adminPage');
	SimpleRouter::get( '/hulp-vragen', 'WebsiteController@hulpVragen' )->name( 'hulp-vragen' );
	SimpleRouter::get( '/details', 'WebsiteController@details' )->name( 'details' );
	SimpleRouter::get( '/overzicht', 'WebsiteController@overzicht' )->name( 'overzicht' );
	SimpleRouter::post('/hulp-vragen/post-opslaan', 'WebsiteController@postOpslaan' )->name( 'post-opslaan' );
	SimpleRouter::post( '/details/contact', 'WebsiteController@detailsContact' )->name ( 'detailsContact' );
	SimpleRouter::post('/aanmelden/registreren','WebsiteController@registreer')->name('registreer');
	SimpleRouter::post('/aanmelden/login','WebsiteController@login')->name('login');
	SimpleRouter::get( '/MijnAccount', 'WebsiteController@ingelogd' )->name( 'ingelogd' );
	SimpleRouter::get( '/Uitloggen', 'WebsiteController@loguit' )->name( 'loguit' );
	SimpleRouter::get( '/details/contact/bedankt', 'WebsiteController@bedanktContact')->name('bedanktContact');

	// STOP: Tot hier al je eigen URL's zetten

	SimpleRouter::get( '/not-found', function () {
		http_response_code( 404 );

		return '404 Page not Found';
	} );

} );


// Dit zorgt er voor dat bij een niet bestaande route, de 404 pagina wordt getoond
SimpleRouter::error( function ( Request $request, \Exception $exception ) {
	if ( $exception instanceof NotFoundHttpException && $exception->getCode() === 404 ) {
		response()->redirect( site_url() . 'not-found' );
	}

} );

