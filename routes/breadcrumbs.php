<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Trang chủ', route('home'));
});

// Quản lý nhân viên
Breadcrumbs::for('staffs', function ($trail) {
    $trail->push('Quản lý nhân viên', route('staffs.index'));
});

// Quản lý nhân viên > Thông tin nhân viên
Breadcrumbs::for('staffs.show', function ($trail, $staff) {
    $trail->parent('staffs');
    $trail->push('Thông tin nhân viên', route('staffs.show', $staff->id));
});

// Quản lý tài khoản
Breadcrumbs::for('staffs.profile', function ($trail) {
    $trail->push('Quản lý tài khoản', route('staffs.profile'));
});
