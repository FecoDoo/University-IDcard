<?php
return [
    Route::rule('/', 'index/index/index'),
    
    // User
    Route::post('/user/login','api/user/login'),
    Route::rule('/user/changePwd','api/user/changePwd'),
    Route::rule('/user/getInfo','api/user/getInfo'),
    Route::rule('/user/reportLoss', 'api/user/reportLoss'),
    
    // Admin
    Route::rule('/admin/findPwd','api/admin/findPwd'),
    Route::rule('/admin/register', 'api/admin/register'),
    Route::rule('/admin/replaceCard', 'api/admin/replaceCard'),
    Route::rule('/admin/login', 'api/admin/login'),
    
    // Book
    Route::rule('/book/searchBook', 'api/book/searchBook'),
    Route::rule('/book/searchBorrow', 'api/book/searchBorrow'),
    Route::rule('/book/borrow', 'api/book/borrow'),

    // Card
    Route::post('/card/charge', 'api/card/charge'),
    Route::post('/card/consume', 'api/card/consume'),
    Route::rule('/card/getCharge', 'api/card/getCharge'),
    Route::rule('/card/getRecord', 'api/card/getRecord'),
];
