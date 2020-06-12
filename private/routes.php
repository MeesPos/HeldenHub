<?php

use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;
use Website\Controllers\GebruikerController;
use Website\Controllers\WebsiteController;

SimpleRouter::setDefaultNamespace( 'Website\Controllers' );

SimpleRouter::group( [ 'prefix' => site_url() ], function () {

	// START: Zet hier al eigen routes
	// Lees de docs, daar zie je hoe je routes kunt maken: https://github.com/skipperbent/simple-php-router#routes

	// Home
	SimpleRouter::get( '/', 'WebsiteController@home' )->name( 'home' );

	// Aanmeldpagina
	SimpleRouter::get( '/aanmelden', 'AanmeldenController@aanmelden' )->name( 'aanmelden' );
	SimpleRouter::post('/aanmelden/registreren','AanmeldenController@registreer')->name('registreer');
	SimpleRouter::post('/aanmelden/login','AanmeldenController@login')->name('login');

	// Emails
	SimpleRouter::get( '/aanmelden/registreren/bevestigenEmail', 'WebsiteController@viewsEmail' )->name( 'viewsEmail' );
	SimpleRouter::get( '/aanmelden/registreren/bevestigenEmail/{code}', 'WebsiteController@bevestigenEmailCode' )->name( 'bevestigenEmailCode' );
	SimpleRouter::get( '/testEmail', 'WebsiteController@bevestigenEmail' )->name( 'bevestigenEmail' );

	// Hulp vragen
	SimpleRouter::get( '/hulp-vragen', 'HulpController@hulpVragen' )->name( 'hulp-vragen' );
	SimpleRouter::post('/hulp-vragen/post-opslaan', 'HulpController@postOpslaan' )->name( 'post-opslaan' );

	// Detail page
	SimpleRouter::post( '/details', 'DetailsController@details' )->name( 'details' );
	SimpleRouter::get( '/details/contact/bedankt', 'DetailsController@bedanktContact')->name('bedanktContact');
	SimpleRouter::post( '/details/contact', 'DetailsController@detailsContact' )->name ( 'detailsContact' );
	
	// Gebruikers page
	SimpleRouter::get( '/mijnAccount', 'GebruikerController@gebruikersPagina' )->name( 'gebruiker' );
	SimpleRouter::post('/mijnAccount/MijnInfoWijzigen','GebruikerController@infoWijzigen')->name('infoWijzigen');
	SimpleRouter::post( '/mijnAccount/hulp-gehad', 'GebruikerController@hulpGehad')->name('hulp-gehad');
	SimpleRouter::get( '/mijnAccount/json', 'GebruikerController@hulpJson')->name('hulp.json');
	SimpleRouter::post( '/mijnAccount/puntenGeven', 'GebruikerController@puntenGeven')->name('punten.geven');
	
	// Admin page
	SimpleRouter::get( '/admin', 'AdminController@adminPage')->name('adminPage');
	SimpleRouter::get( '/admin/json', 'AdminController@adminJson')->name('admin.json');
	SimpleRouter::post( '/admin/banUser', 'AdminController@adminBan' )->name('admin.ban');
	SimpleRouter::get( '/admin/gelukt', 'AdminController@adminGelukt' )->name('admin.gelukt');
	
	// Overview routes
	SimpleRouter::get( '/overview', 'OverviewController@displayOverview' )->name( 'overview' );
	SimpleRouter::get( '/overview/{page}', 'OverviewController@displayOverviewPages' )->name( 'overview' );

	// Overige routes
	SimpleRouter::get( '/uitloggen', 'WebsiteController@loguit' )->name( 'loguit' );

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

