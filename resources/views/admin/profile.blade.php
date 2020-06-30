@extends('adminlte::page')

@section('content_header')
    <h1>Quản lý tài khoản</h1>
    {{ Breadcrumbs::render('staffs.profile') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ $staff->user->avatar }}" alt="User profile picture">
                    <h3 class="profile-username text-center">{{ $staff->name }}</h3>
                    <p class="text-muted text-center">Lập trình viên</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                        <b>Người theo dõi</b> <a class="pull-right">1,322</a>
                        </li>
                        <li class="list-group-item">
                        <b>Đã theo dõi</b> <a class="pull-right">543</a>
                        </li>
                        <li class="list-group-item">
                        <b>Bạn bè</b> <a class="pull-right">13,287</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin cơ bản</h3>
                </div>
                <div class="box-body">
                    <strong><i class="fa fa-envelope margin-r-5"></i>Email</strong>
                    <p class="text-muted">{{ $staff->user->email }}</p>
                    <hr>
                    <strong><i class="fa fa-book margin-r-5"></i>Học vấn</strong>
                    <p class="text-muted">
                        Đại học bách khoa Đà Nẵng
                    </p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i>Địa chỉ</strong>
                    <p class="text-muted">Liên Chiểu, Đà Nẵng</p>
                    <hr>
                    <strong><i class="fa fa-pencil margin-r-5"></i> Kỹ năng</strong>
                    <p>
                    <span class="label label-danger">UI Design</span>
                    <span class="label label-success">Coding</span>
                    <span class="label label-info">Javascript</span>
                    <span class="label label-warning">PHP</span>
                    <span class="label label-primary">Node.js</span>
                    </p>

                    <hr>

                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#timeline" data-toggle="tab" aria-expanded="true">Dòng thời gian</a></li>
                    <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Cài đặt</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="timeline">
                        <ul class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            <li class="time-label">
                                <span class="bg-red">
                                    10 Feb. 2014
                                </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                            <i class="fa fa-envelope bg-blue"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                <div class="timeline-body">
                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                quora plaxo ideeli hulu weebly balihoo...
                                </div>
                                <div class="timeline-footer">
                                <a class="btn btn-primary btn-xs">Read more</a>
                                <a class="btn btn-danger btn-xs">Delete</a>
                                </div>
                            </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <li>
                            <i class="fa fa-user bg-aqua"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                                </h3>
                            </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <li>
                            <i class="fa fa-comments bg-yellow"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                <div class="timeline-body">
                                Take me to your leader!
                                Switzerland is small and neutral!
                                We are more like Germany, ambitious and misunderstood!
                                </div>
                                <div class="timeline-footer">
                                <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                </div>
                            </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline time label -->
                            <li class="time-label">
                                <span class="bg-green">
                                    3 Jan. 2014
                                </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                            <i class="fa fa-camera bg-purple"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                <div class="timeline-body">
                                <img src="http://placehold.it/150x100" alt="..." class="margin">
                                <img src="http://placehold.it/150x100" alt="..." class="margin">
                                <img src="http://placehold.it/150x100" alt="..." class="margin">
                                <img src="http://placehold.it/150x100" alt="..." class="margin">
                                </div>
                            </div>
                            </li>
                            <!-- END timeline item -->
                            <li>
                            <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane" id="settings">
                        <form class="form-horizontal" method="POST" action="{{ route('staffs.update_profile') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ $staff->user->id }}">
                            <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name" class="col-sm-2 control-label">Tên</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password" class="col-sm-2 control-label">Mật khẩu</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                <label for="password_confirmation" class="col-sm-2 control-label">Nhập lại mật khẩu</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
