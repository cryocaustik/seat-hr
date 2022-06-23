<?php

Route::group([
    'namespace' => 'Cryocaustik\SeatHr\http\controllers',
    'prefix' => 'seat-hr',
    'middleware' => [
        'web',
        'auth',
    ],
], function()
{
    Route::get('/about', [
        'uses' => 'SeatHrController@about',
        'as' => 'seat-hr.about'
    ]);

    Route::group([
        'namespace' => 'user',
        'prefix' => 'user',
    ], function () {
        Route::get('/{character?}', [
            'uses' => 'UserController@index',
            'as' => 'seat-hr.profile',
        ]);

        Route::get('/{character}/sheet', [
            'uses' => 'UserController@sheet',
            'as' => 'seat-hr.profile.sheet',
            'middleware' => 'can:character.sheet,character',
        ]);

        Route::get('/{character}/intel', [
            'uses' => 'UserController@intel',
            'as' => 'seat-hr.profile.intel',
            'middleware' => 'can:seat-hr.officer',
        ]);

        Route::group([
            'prefix' => '/{character}/applications',
        ], function () {

            // TODO: fix middleware permissions to use seat-hr permissions
            Route::get('/', [
                'uses' => 'ApplicationController@index',
                'as' => 'seat-hr.profile.applications',
                'middleware' => 'can:character.sheet,character',
            ]);

            Route::match([ 'get', 'post' ], '/apply/{corporation?}', [
                'uses' => 'ApplicationController@apply',
                'as' => 'seat-hr.profile.applications.apply',
                'middleware' => 'can:character.sheet,character',
            ]);

            Route::get('/view/{application?}', [
                'uses' => 'ApplicationController@view',
                'as' => 'seat-hr.profile.applications.view',
                'middleware' => 'can:character.sheet,character',
            ]);


        });

        Route::group([
            'prefix' => '/{character}/blacklist',
            'middleware' => 'can:seat-hr.officer',
        ], function (){
            Route::get('/', [
                'uses' => 'BlackListController@index',
                'as' => 'seat-hr.profile.blacklist',
            ]);

            Route::match(['get', 'post'], '/create', [
                'uses' => 'BlackListController@create',
                'as' => 'seat-hr.profile.blacklist.create',
            ]);

            Route::match(['get', 'post'], '/edit/{blacklist}', [
                'uses' => 'BlackListController@edit',
                'as' => 'seat-hr.profile.blacklist.edit',
            ]);

            Route::match(['get', 'post'], '/delete/{blacklist}', [
                'uses' => 'BlackListController@delete',
                'as' => 'seat-hr.profile.blacklist.delete',
            ]);
        });

        Route::group([
            'prefix' => '/{character}/kickhistory',
            'middleware' => 'can:seat-hr.officer',
        ], function (){
            Route::get('/', [
                'uses' => 'KickHistoryController@index',
                'as' => 'seat-hr.profile.kickhistory',
            ]);

            Route::match(['get', 'post'], '/create', [
                'uses' => 'KickHistoryController@create',
                'as' => 'seat-hr.profile.kickhistory.create',
            ]);

            Route::match(['get', 'post'], '/edit/{kickhistory}', [
                'uses' => 'KickHistoryController@edit',
                'as' => 'seat-hr.profile.kickhistory.edit',
            ]);

            Route::match(['get', 'post'], '/delete/{kickhistory}', [
                'uses' => 'KickHistoryController@delete',
                'as' => 'seat-hr.profile.kickhistory.delete',
            ]);
        });

        Route::group([
            'prefix' => '/{character}/notes',
            'middleware' => 'can:seat-hr.officer',
        ], function (){
            Route::get('/', [
                'uses' => 'NoteController@index',
                'as' => 'seat-hr.profile.note',
            ]);

            Route::match(['get', 'post'], '/create', [
                'uses' => 'NoteController@create',
                'as' => 'seat-hr.profile.note.create',
            ]);

            Route::match(['get', 'post'], '/edit/{note}', [
                'uses' => 'NoteController@edit',
                'as' => 'seat-hr.profile.note.edit',
            ]);

            Route::match(['get', 'post'], '/delete/{note}', [
                'uses' => 'NoteController@delete',
                'as' => 'seat-hr.profile.note.delete',
            ]);
        });

    });

    Route::group([
        'namespace' => 'review',
        'prefix' => '/review',
        'middleware' => 'can:seat-hr.officer',
    ], function () {
        Route::get('/', [
            'uses' => 'ReviewController@index',
            'as' => 'seat-hr.review.index'
        ]);

        Route::group([
            'prefix' => '/{corporation}',
        ], function(){

            Route::get('/summary', [
                'uses' => 'ReviewController@summary',
                'as' => 'seat-hr.review.summary',
            ]);

            Route::get('/applications', [
                'uses' => 'ReviewController@applications',
                'as' => 'seat-hr.review.applications',
            ]);

            Route::group([
                'prefix' => '/applications/{application}',
            ], function () {
                Route::match(['get', 'post'], '/review', [
                    'uses' => 'ReviewController@application_review',
                    'as' => 'seat-hr.review.application.review',
                ]);

                Route::match(['get', 'post'], '/approve', [
                    'uses' => 'ReviewController@application_approve',
                    'as' => 'seat-hr.review.application.approve',
                ]);

                Route::match(['get', 'post'], '/cancel', [
                    'uses' => 'ReviewController@application_cancel',
                    'as' => 'seat-hr.review.application.cancel',
                ]);

                Route::match(['get', 'post'], '/reject', [
                    'uses' => 'ReviewController@application_reject',
                    'as' => 'seat-hr.review.application.reject',
                ]);

                Route::match(['get', 'post'], '/toggle_reapply', [
                    'uses' => 'ReviewController@application_toggle_reapply',
                    'as' => 'seat-hr.review.application.toggle_reapply',
                ]);

            });

        });
    });

    Route::group([
        'namespace' => 'configuration',
        'prefix' => 'config',
        'middleware' => 'can:seat-hr.admin',
    ], function () {

        Route::group([
            'prefix' => 'corp',
        ], function () {

            Route::get('/', [
                'uses' => 'CorporationController@view',
                'as' => 'seat-hr.config.corp.view',
            ]);

            Route::match([ 'get', 'post' ], '/create', [
                'uses' => 'CorporationController@create',
                'as' => 'seat-hr.config.corp.create',
            ]);

            Route::match([ 'get', 'post' ], '/edit/{id}', [
                'uses' => 'CorporationController@edit',
                'as' => 'seat-hr.config.corp.edit',
            ]);

            Route::match([ 'get', 'post' ], '/delete/{id}', [
                'uses' => 'CorporationController@delete',
                'as' => 'seat-hr.config.corp.delete',
            ]);

        });

        Route::group([
            'prefix' => 'question',
        ], function () {

            Route::get('/', [
                'uses' => 'QuestionController@view',
                'as' => 'seat-hr.config.question.view',
            ]);

            Route::match([ 'get', 'post' ], '/create', [
                'uses' => 'QuestionController@create',
                'as' => 'seat-hr.config.question.create',
            ]);

            Route::match([ 'get', 'post' ], '/edit/{id}', [
                'uses' => 'QuestionController@edit',
                'as' => 'seat-hr.config.question.edit',
            ]);

            Route::match(['get', 'post'], '/delete/{id}', [
                'uses' => 'QuestionController@delete',
                'as' => 'seat-hr.config.question.delete',
            ]);

        });

        Route::group([
            'prefix' => 'corporation-question',
        ], function () {
            Route::get('/{id}', [
                'uses' => 'CorporationQuestionController@view',
                'as' => 'seat-hr.config.corporation-question.view',
            ]);

            Route::post('/add', [
                'uses' => 'CorporationQuestionController@add',
                'as' => 'seat-hr.config.corporation-question.add',
            ]);

            Route::post('/toggle', [
                'uses' => 'CorporationQuestionController@toggle',
                'as' => 'seat-hr.config.corporation-question.toggle',
            ]);

            Route::post('/delete', [
                'uses' => 'CorporationQuestionController@delete',
                'as' => 'seat-hr.config.corporation-question.delete',
            ]);
        });

    });

});
