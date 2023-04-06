<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $customer->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', $customer->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('email2') }}
            {{ Form::text('email2', $customer->email2, ['class' => 'form-control' . ($errors->has('email2') ? ' is-invalid' : ''), 'placeholder' => 'Email2']) }}
            {!! $errors->first('email2', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('Email Sales Rep') }}
            {{ Form::text('emailRep', $customer->emailRep, ['class' => 'form-control' . ($errors->has('emailRep') ? ' is-invalid' : ''), 'placeholder' => 'Email Sales Rep']) }}
            {!! $errors->first('emailRep', '<div class="invalid-feedback">:message</div>') !!}
        </div>       

        @if (Auth::user()->rol == 'admin')

        <div class="form-group">
            {{ Form::label('pin') }}
            {{ Form::text('pin', $customer->pin, ['class' => 'form-control' . ($errors->has('pin') ? ' is-invalid' : ''), 'placeholder' => 'Pin']) }}
            {!! $errors->first('pin', '<div class="invalid-feedback">:message</div>') !!}
        </div>       
            
        @else
            
        <input type="hidden" name="pin" value="">
            

        @endif

        
       

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>

