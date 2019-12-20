@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" id = "all_login_box">
            <div class="login_box">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" id = "form_input">
                            <label for="email" class="col-md-4 control-label" id="email_box">メールアドレスを入力してください</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" id = "pass_input">
                            <label for="password" class="col-md-4 control-label" id="pass_box">パスワードを入力してください</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group" id="rem_input">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">        
                                    <input type="checkbox" id ="check_box1" name="remember" {{ old('remember') ? 'checked' : '' }}> 
                                    <div class="check_box_text">
                                        パスワード記憶する
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4" id = "login_btn">
                                <button type="submit" class="btn btn-primary" id = "submit_btn">
                                    ログイン
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}" id = "forget_pass">
                                    パスワードを忘れちゃった！！
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
