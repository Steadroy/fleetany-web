@extends('layouts.default')

@section('header')
	@if ($user->id)
	{{--*/ $operation = 'update' /*--}}
	<span class="mdl-layout-title">{{$user->name}}</span>
	@else
	{{--*/ $operation = 'create' /*--}}
	<span class="mdl-layout-title">{{Lang::get("general.User")}}</span>
	@endif
@stop

@section('content')

@permission($operation.'.user')

<div class="">
	<section class="demo-section demo-section--textfield demo-page--textfield mdl-upgraded">
		<div class="demo-preview-block">

@if (!$user->id)
{!! Form::open(['route' => 'user.store']) !!}
@else
{!! Form::model('$user', [
        'method'=>'PUT',
        'route' => ['user.update',$user->id]
    ]) !!}
@endif

			
			<div class="mdl-textfield mdl-js-textfield is-upgraded is-focused mdl-textfield--floating-label @if ($errors->has('name')) is-invalid is-dirty @endif"" data-upgraded="eP">
         		{!!Form::text('name', $user->name, ['class' => 'mdl-textfield__input'])!!}
				{!!Form::label('name', Lang::get('general.name'), ['class' => 'mdl-color-text--primary-contrast mdl-textfield__label is-dirty'])!!}
				<span class="mdl-textfield__error">{{ $errors->first('name') }}</span>
			</div>
						
			<div class="mdl-textfield mdl-js-textfield is-upgraded is-focused mdl-textfield--floating-label @if ($errors->has('email')) is-invalid is-dirty @endif"" data-upgraded="eP">
         		@if (empty($user->email) && empty($user->password) || !empty($user->password))
         		{!!Form::email('email', $user->email, ['class' => 'mdl-textfield__input'])!!}
				@else
				{!!Form::email('email', $user->email, ['class' => 'mdl-textfield__input', 'readonly' => 'true'])!!}
				@endif
				{!!Form::label('email', Lang::get('general.email'), ['class' => 'mdl-color-text--primary-contrast mdl-textfield__label is-dirty'])!!}
				<span class="mdl-textfield__error">{{ $errors->first('email') }}</span>
			</div>
				
			@if (empty($user->email) && empty($user->password) || !empty($user->password))		
			<div class="mdl-textfield mdl-js-textfield is-upgraded is-focused mdl-textfield--floating-label @if ($errors->has('password')) is-invalid is-dirty @endif"" data-upgraded="eP">
         		{!!Form::password('password', ['class' => 'mdl-textfield__input'])!!}
				{!!Form::label('password', Lang::get('general.password'), ['class' => 'mdl-color-text--primary-contrast mdl-textfield__label is-dirty'])!!}
				<span class="mdl-textfield__error">{{ $errors->first('password') }}</span>
			</div>
			@endif

    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @if ($errors->has('role_id')) is-invalid is-dirty @endif"">
                {!!Form::select('role_id', $role, $user->role_id, ['class' => 'mdl-textfield__input'])!!}
       			{!!Form::label('role_id', Lang::get('general.role_id'), ['class' => 'mdl-color-text--primary-contrast mdl-textfield__label is-dirty'])!!}
            	<span class="mdl-textfield__error">{{ $errors->first('role_id') }}</span>
            </div>

    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label @if ($errors->has('language')) is-invalid is-dirty @endif"">
                {!!Form::select('language', $language, $user->language, ['class' => 'mdl-textfield__input'])!!}
       			{!!Form::label('language', Lang::get('general.language'), ['class' => 'mdl-color-text--primary-contrast mdl-textfield__label is-dirty'])!!}
            	<span class="mdl-textfield__error">{{ $errors->first('language') }}</span>
            </div>
						
			@include ('contact.shared-fields')

			<div class="mdl-card__actions">
				<button type="submit" class="mdl-button mdl-color--primary mdl-color-text--accent-contrast mdl-js-button mdl-button--raised mdl-button--colored">
                  {{ Lang::get('general.Send') }} 
                </button>
			</div>
	
{!! Form::close() !!}

		</div>
	</section>
</div>

@else
<div class="alert alert-info">
	{{Lang::get("general.accessdenied")}}
</div>
@endpermission

@stop