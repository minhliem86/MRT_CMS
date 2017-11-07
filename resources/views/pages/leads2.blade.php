@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-4">
            <div class="search-container mb-5">
                <form action="" method="POST" class="form-search">
                    {!! Form::token() !!}
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="">From</label>
                            <input type="text" name="date_from" class="form-control datepicker" placeholder="From...">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">To</label>
                            <input type="text" name="date_to" class="form-control datepicker" placeholder="To...">
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::select('campaign',["" => "Campaign"]+$campaign,'',['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <button type="reset" class="btn btn-outline-warning">Refresh</button>
                        <button type="submit" class="btn btn-outline-primary">Search</button>
                    </div>

                </form>
            </div>  <!-- end search-container-->
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            {!! $html->table() !!}
        </div>
    </div>
@stop

@section('script')
    {!! $html->scripts() !!}
@stop