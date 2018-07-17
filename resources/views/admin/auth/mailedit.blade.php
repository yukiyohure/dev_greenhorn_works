@extends('partials.admin_nav')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">メールアドレス変更</div>
                <div class="panel-body">
                     {!! Form::open(['route' => 'adminmailupdate']) !!}
                     {!! Form::hidden('mquery', $url['m']) !!}
                       <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">メールアドレスの入力</label>

                           <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required>

                               @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                                <button type="submit" class="btn btn-primary">
                                    送信
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection
