<?php

Route::group(['middleware' => ['web', 'wechat.oauth']], function () {
    Route::any('api2/Impl_getDynamicDetail2', 'Api2Controller@Impl_getDynamicDetail2');
    Route::get('/mobile_sms','MobileHomeController@mobile_sms');

    Route::post('/mobile_validate_code','MobileHomeController@mobile_validate_code');
    Route::get('/mobile_setting', 'MobileHomeController@mobile_setting');
    Route::get('/mobile_set_private','DynamicController@mobile_set_private');
    Route::get('/mobile_delete_dynamic','DynamicController@mobile_delete_dynamic');
    Route::any('/mobile_add_dynamic', 'DynamicController@mobile_add_dynamic');
    Route::get('/mobile_list_dynamic', 'DynamicController@mobile_list_dynamic');
    Route::get('/mobile_location', 'DynamicController@mobile_location');
    Route::get('/mobile_draftlist_dynamic', 'DynamicController@mobile_draftlist_dynamic');
    Route::any('/mhome', 'MobileHomeController@home');
    Route::any('/mobile', 'MobileHomeController@index');
    Route::get('/mobile_modify_dynamic','DynamicController@mobile_modify_dynamic');
});

Route::group(['middleware' => ['web']], function () {
    Route::auth();
    Route::get('home', [
        'middleware' => 'auth',
        'uses' => 'HomeController@home'
    ]);
    Route::get('/add_dynamic', 'DynamicController@add_dynamic');
    Route::get('/list_dynamic', 'DynamicController@list_dynamic');
    Route::get('/', 'HomeController@index');
    /*
     * api 接收数据
     */
    Route::any('api/Impl_addDynamic', 'ApiController@Impl_addDynamic');
    Route::any('api/Impl_addWxDynamic', 'ApiController@Impl_addWxDynamic');
    Route::any('api/test', 'ApiController@test');
    Route::any('api/Impl_uploadImg', 'ApiController@Impl_uploadImg');
    Route::any('api/Impl_uploadWxImg', 'ApiController@Impl_uploadWxImg');
    Route::any('api/Impl_uploadWxVoice', 'ApiController@Impl_uploadWxVoice');
    Route::any('api/Impl_addLikeDynamic', 'ApiController@Impl_addLikeDynamic');
    Route::any('api/Impl_isLikeDynamic', 'ApiController@Impl_isLikeDynamic');
    Route::any('api/Impl_isLikeDynamic', 'ApiController@Impl_isLikeDynamic');
    Route::any('api/Impl_dellnglat', 'ApiController@Impl_dellnglat');
    /*
    * api2  请求数据
    */
    Route::any('api2/Impl_getInChina', 'ApiController@Impl_getInChina');
    Route::any('api2/Impl_getAlbum', 'Api2Controller@Impl_getAlbum');
    Route::any('api2/Impl_getMarker', 'Api2Controller@Impl_getMarker');
    Route::any('api2/Impl_getAllShared', 'Api2Controller@Impl_getAllShared');
    Route::any('api2/Impl_getDynamicDetail', 'Api2Controller@Impl_getDynamicDetail');

    Route::any('api2/Impl_getSelfDynamic', 'Api2Controller@Impl_getSelfDynamic');
    Route::any('api2/test', 'Api2Controller@test');
    Route::any('api2/test1', 'Api2Controller@test1');

    Route::any('wechat','WechatController@serve');

    Route::any('/wechat_scan_login','PcHomeController@wechat_scan_login');
    Route::any('/check_wechat_scan_login','PcHomeController@check_wechat_scan_login');
    Route::get('/pc_user_logout','PcHomeController@pc_user_logout');
    Route::any('/api4/Impl_getDynamicDetail','Api4Controller@Impl_getDynamicDetail');
    //关注动作
    Route::any('api4/Impl_follow','Api4Controller@Impl_follow');
    //取消关注动作
    Route::any('api4/Impl_cancelFollow','Api4Controller@Impl_cancelFollow');
    //电脑端用户中心首页
    Route::any('/ucenter','PcUcenterController@index');
    //发表评论
    Route::any('/api4/Impl_postComment','Api4Controller@Impl_postComment');
    //获取动态的所有评论
    Route::any('/api4/Impl_getComments','Api4Controller@Impl_getComments');
});


