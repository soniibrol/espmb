@extends('vendor.material.layouts.app')

@section('vendorcss')
<link href="{{ url('css/bootstrap-select.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="card">
        <div class="card-header"><h2>Menu Management<small>Create New Menu</small></h2></div>
        <div class="card-body card-padding">
        	<form class="form-horizontal" role="form" method="POST" action="{{ url('master/menu') }}">
        		{{ csrf_field() }}
	            <div class="form-group">
	                <label for="menu_name" class="col-sm-2 control-label">Menu Name</label>
	                <div class="col-sm-10">
	                    <div class="fg-line">
	                        <input type="text" class="form-control input-sm" name="menu_name" id="menu_name" placeholder="Menu Name" required="true" maxlength="100" value="{{ old('menu_name') }}">
	                    </div>
	                    @if ($errors->has('menu_name'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('menu_name') }}</strong>
			                </span>
			            @endif
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="module_id" class="col-sm-2 control-label">URL</label>
	                <div class="col-sm-10">
	                    <div class="fg-line">
	                        <select name="module_id" id="module_id" class="selectpicker" data-live-search="true" required="true">
	                        	<option value=""></option>
                                @foreach ($modules as $row)
                                	{!! $selected = '' !!}
                                	@if($row->module_id==old('module_id'))
                                		{!! $selected = 'selected' !!}
                                	@endif
								    <option value="{{ $row->module_id }}" {{ $selected }}>{{ $row->module_url }}</option>
								@endforeach
                            </select>
	                    </div>
	                    @if ($errors->has('module_id'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('module_id') }}</strong>
			                </span>
			            @endif
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="menu_icon" class="col-sm-2 control-label">Icon</label>
	                <div class="col-sm-10">
	                    <div class="fg-line">
	                        <input type="text" class="form-control input-sm" name="menu_icon" id="menu_icon" placeholder="Menu Icon" maxlength="100" value="{{ old('menu_icon') }}">
	                    </div>
	                    @if ($errors->has('menu_icon'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('menu_icon') }}</strong>
			                </span>
			            @endif
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="menu_parent" class="col-sm-2 control-label">Parent</label>
	                <div class="col-sm-10">
	                    <div class="fg-line">
	                        <select name="menu_parent" id="menu_parent" class="selectpicker" data-live-search="true" required="true">
	                        	<option value=""></option>
	                        	<option value="0">ROOT</option>
	                        	@foreach($parents as $key => $val)
	                        		<option value="{{ $key }}">{{ $val }}</option>
	                        	@endforeach
                            </select>
	                    </div>
	                    @if ($errors->has('menu_parent'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('menu_parent') }}</strong>
			                </span>
			            @endif
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="menu_order" class="col-sm-2 control-label">Order</label>
	                <div class="col-sm-10">
	                    <div class="fg-line">
	                        <!-- <input type="number" name="menu_order" id="menu_order" class="form-control input-sm" placeholder="Menu Order" min="1" max="10" required="true" value="{{ old('menu_order') }}"> -->
	                        <div class="select">
		                        <select name="menu_order" id="menu_order" class="selectpicker" data-live-search="true" required="true">
		                        	<option value=""></option>
		                        </select>
	                        </div>
	                    </div>
	                    @if ($errors->has('menu_order'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('menu_order') }}</strong>
			                </span>
			            @endif
	                </div>
	            </div>
	            <div class="form-group">
	                <label for="menu_desc" class="col-sm-2 control-label">Description</label>
	                <div class="col-sm-10">
	                    <div class="fg-line">
	                        <textarea name="menu_desc" id="menu_desc" class="form-control input-sm" placeholder="Description">{{ old('menu_desc') }}</textarea>
	                    </div>
	                    @if ($errors->has('menu_desc'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('menu_desc') }}</strong>
			                </span>
			            @endif
	                </div>
	            </div>
	            <div class="form-group">
	                <div class="col-sm-offset-2 col-sm-10">
	                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
	                    <a href="{{ url('master/menu') }}" class="btn btn-danger btn-sm">Back</a>
	                </div>
	            </div>
	        </form>
        </div>
    </div>
@endsection

@section('vendorjs')
<script src="{{ url('js/bootstrap-select.min.js') }}"></script>
<script src="{{ url('js/input-mask.min.js') }}"></script>
@endsection

@section('customjs')
<script src="{{ url('js/master/menu-create.js') }}"></script>
@endsection