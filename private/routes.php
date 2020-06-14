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
	SimpleRouter::match(['get','post'], '/aanmelden/wachtwoord-vergeten', 'AanmeldenController@wachtwoordvergeten')->name( 'wachtwoord.vergeten' );
	SimpleRouter::match(['get','post'], '/aanmelden/wachtwoord-vergeten/{reset_code}', 'AanmeldenController@wachtwoordReset')->name( 'wachtwoord.reset' );
	// Emails
	SimpleRouter::get( '/aanmelden/registreren/bevestigenEmail', 'EmailController@viewsEmail' )->name( 'viewsEmail' );
	SimpleRouter::get( '/aanmelden/registreren/bevestigenEmail/{code}', 'EmailController@bevestigenEmailCode' )->name( 'bevestigenEmailCode' );
	SimpleRouter::get( '/testEmail', 'EmailController@bevestigenEmail' )->name( 'bevestigenEmail' );

	// Hulp vragen
	SimpleRouter::get( '/hulp-vragen', 'HulpController@hulpVragen' )->name( 'hulp-vragen' );
	SimpleRouter::post('/hulp-vragen/post-opslaan', 'HulpController@postOpslaan' )->name( 'post-opslaan' );

	// Detail page
	SimpleRouter::post( '/details', 'DetailsController@details' )->name( 'details' );
	SimpleRouter::get( '/details/contact/bedankt', 'DetailsController@bedanktContact')->name('bedanktContact');
	SimpleRouter::post( '/details/contact', 'DetailsController@detailsContact' )->name ( 'detailsContact' );
	
	// Gebruikers page

	// SimpleRouter::get( '/MijnAccount', 'AanmeldenController@ingelogd' )->name( 'ingelogd' );
	SimpleRouter::post('/MijnAccount/MijnInfoWijzigen','WebsiteController@update')->name('update');
	SimpleRouter::get('MijnAccount/MijnInfoWijzigen/gegevenswijzigen', "WebsiteController@infoWijzigen")->name('infoWijzigen');

	SimpleRouter::get( '/mijnAccount', 'GebruikerController@gebruikersPagina' )->name( 'gebruiker' );
	// SimpleRouter::post('/mijnAccount/MijnInfoWijzigen','GebruikerController@infoWijzigen')->name('infoWijzigen');
	SimpleRouter::post( '/mijnAccount/hulp-gehad', 'GebruikerController@hulpGehad')->name('hulp-gehad');
	SimpleRouter::get( '/mijnAccount/json', 'GebruikerController@hulpJson')->name('hulp.json');
	SimpleRouter::post( '/mijnAccount/puntenGeven', 'GebruikerController@puntenGeven')->name('punten.geven');

	SimpleRouter::get( '/mijnAccount/{page}', 'OverviewController@displayOverviewPages' )->name( 'overview.gebruikers' );



	// Admin page
	SimpleRouter::get( '/admin', 'AdminController@adminPage')->name('adminPage');
	SimpleRouter::get( '/admin/json', 'AdminController@adminJson')->name('admin.json');
	SimpleRouter::post( '/admin/banUser', 'AdminController@adminBan' )->name('admin.ban');
	SimpleRouter::get( '/admin/gelukt', 'AdminController@adminGelukt' )->name('admin.gelukt');
	
	// Overview routes
	SimpleRouter::get( '/overview', 'OverviewController@displayOverview' )->name( 'overview' );
	SimpleRouter::get( '/overview/{page}', 'OverviewController@displayOverviewPages' )->name( 'overview' );

	// Overview zoek routes
	SimpleRouter::post( '/zoeken' , 'SearchController@search')->name( 'zoeken' );
	SimpleRouter::post( '/zoeken/{page}' , 'SearchController@searchPagination')->name( 'zoekenPaginas' );

	// Shop routes
	SimpleRouter::get( 'shop' , 'ShopController@shop')->name('shop');
	SimpleRouter::match(['get','post'], 'shop/kopen/{item_id}', 'ShopController@koop')->name('kopen');
	SimpleRouter::match(['get','post'], 'shop/activate/{item_id}', 'ShopController@activeer')->name('actief');

	
	// Leaderbord routes
	SimpleRouter::get( '/leaderbord', 'LeaderbordController@Leaderbord')->name( 'leaderbord' );

	// Zoek routes

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

