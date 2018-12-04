    <div class="form-group row">

        <div class="col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
            {{--<input id="name" placeholder="الاسم" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}
            {{Form::label('name', ' الاسم ')}}
            {!! Form::text('name',isset($user->name)? $user->name : null ,['class' => 'form-control']) !!}
            @if ($errors->has('name'))
                <span class="help-block" >
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">

        <div class="col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">

            {{--<input id="email" placeholder="البريد الالكتروني" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus required>--}}
            {{Form::label('email', ' البريد الالكتروني ')}}

            {!! Form::email('email',isset($user->email)? $user->email : null ,['class' => 'form-control']) !!}

        @if ($errors->has('email'))
                <span class="help-block" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
    @if(Auth::user()->admin ==1 )
    <div class="form-group row">
        <div class="col-md-6 {{ $errors->has('admin') ? ' has-error' : '' }}">
            {{--<input id="email" placeholder="البريد الالكتروني" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus required>--}}
        {{Form::label('admin', ' العضوية ')}}

        {!! Form::select('admin',['0' => ' عضو ','1'=>'مدير'], isset($user->admin)? ($user->admin == 0 ? '0' : '1') : '0',['class' => 'form-control']) !!}

        @if ($errors->has('admin'))
                <span class="help-block" role="alert">
                    <strong>{{ $errors->first('admin') }}</strong>
                </span>
            @endif
        </div>
    </div>
    @endif
    @if(!isset($user))
    <div class="form-group row">

        <div class="col-md-6 {{ $errors->has('password') ? ' has-error' : '' }}">
            {{Form::label('password', 'كلمة المرور ')}}

            <input id="password" placeholder="الباسورد" type="password" class="form-control" name="password" autofocus required>

            @if ($errors->has('password'))
                <span class="help-block" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <div class="col-md-6">
                {{Form::label('password', 'تاكيد كلمة المرور ')}}

                <input id="password-confirm" placeholder="اعادة ادخال الباسورد" type="password" class="form-control" name="password_confirmation" autofocus required>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
    @else
        <input type="hidden" value="{{$user->id}}" name="id" readonly >
    @endif

    <div class="form-group row mb-2">
        <div class="col-md-1 ">
            <button type="submit" class="btn btn-success">
                تسجيل عضو
            </button>
        </div>
    </div>

