<?php
return [
    Route::rule('/', 'index/index/index'),
    Route::post('/user/login','api/user/login'),
    Route::rule('/user/changePwd','api/user/changePwd'),
    Route::rule('/user/getInfo','api/user/getInfo'),
    Route::rule('/admin/findPwd','api/admin/findPwd'),

    Route::rule('/book/searchbook', 'api/book/searchBook'),
    Route::rule('/book/searchborrow', 'api/book/searchBorrow'),
];
