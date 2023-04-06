<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('itemnumber') }}
            {{ Form::text('itemnumber', $product->itemnumber, ['class' => 'form-control' . ($errors->has('itemnumber') ? ' is-invalid' : ''), 'placeholder' => 'Itemnumber']) }}
            {!! $errors->first('itemnumber', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $product->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $product->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('upc') }}
            {{ Form::text('upc', $product->upc, ['class' => 'form-control' . ($errors->has('upc') ? ' is-invalid' : ''), 'placeholder' => 'Upc']) }}
            {!! $errors->first('upc', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('pallet') }}
            {{ Form::text('pallet', $product->pallet, ['class' => 'form-control' . ($errors->has('pallet') ? ' is-invalid' : ''), 'placeholder' => 'Pallet']) }}
            {!! $errors->first('pallet', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('price') }}
            {{ Form::text('price', $product->price, ['class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''), 'placeholder' => 'Price']) }}
            {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
        </div>


        {{-- <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $product->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div> --}}


        <div class="form-group">            
            {{ Form::hidden('user_id', Auth::id(), ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>