<?php
Route::post('login','Api\V1\Auth\LoginController@login');

/**
 * Routes for logged in users
 */
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('auth/check', 'Api\V1\Auth\LoginController@check');

    Route::post('logout','Api\V1\Auth\LogoutController@logout');

    Route::get('unread-notifications','Api\V1\Notifications\NotificationController@unreadNotifications');
    Route::get('unread-notifications-count','Api\V1\Notifications\NotificationController@unreadNotificationsCount');
});

?>