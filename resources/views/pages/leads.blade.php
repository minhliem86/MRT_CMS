@extends('layouts.default')

@section('content')
    <div class="container-fluid">
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
                <div class="dataTable-container pb-5">
                    <div class="wrap-table table-responsive">
                        <table class="table table-bordered" id="table-leads">
                            <thead>
                            <tr>
                                <th width="10%">Register Date</th>
                                <th width="10%">LeadID</th>
                                <th>Product</th>
                                <th>Campaign</th>
                                <th>Media Channel</th>
                                <th width="10%">Full Name</th>
                                <th width="10%">Phone</th>
                                <th width="10%">Email</th>

                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>  <!-- end datatable container -->
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function(){
            $('.datepicker').datepicker({
                'format': 'yyyy-mm-dd',
                autoclose: true,
                endDate: '1'
            });
            let datatable = $('#table-leads').DataTable({
                iDisplayLength: 20,
                lengthChange: false,
                processing: true,
                serverSide: true,
                ajax: {
                    url:"{{route('cms.getLeadsAjax')}}",
                    data: function(d){
                        d.campaign = $('select[name=campaign]').val();
                        d.from = $('input[name=date_from]').val();
                        d.to = $('input[name=date_to]').val();
                    }
                },
                columns: [
                    {data: 'register', name : 'register'},
                    {data: 'id_customer', name : 'id_customer'},
                    {data: 'product_name', name : 'product_name'},
                    {data: 'campaign_name', name : 'campaign_name'},
                    {data: 'media_name', name : 'media_name'},
                    {data: 'fullname', name : 'fullname'},
                    {data: 'phone', name : 'phone'},
                    {data: 'email', name : 'email'},
                ],
            })
            $('.form-search').on('submit', function(e) {
                datatable.draw();
                e.preventDefault();
            });
        });
    </script>
@stop