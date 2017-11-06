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
                            <button type="submit" class="btn btn-outline-primary">Search</button>
                        </div>

                    </form>
                </div>  <!-- end search-container-->
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="dataTable-container pb-5">
                    <table class="table table-responsive table-bordered" id="table-leads">
                        <thead>
                            <tr>
                                <th>Register Date</th>
                                <th>LeadID</th>
                                <th>Full Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Product</th>
                                <th>Campaign</th>
                                <th>Media Channel</th>

                            </tr>
                        </thead>
                    </table>
                </div>  <!-- end datatable container -->
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function(){
            $('.datepicker').datepicker();
            let datatable = $('#table-leads').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url:"{{route('cms.getLeadsAjax')}}",
                    data: function(d){
                        d.campaign = $('select[name=campaign]').val();
                    }
                },
                columns: [
                    {data: 'register', name : 'register'},
                    {data: 'id_customer', name : 'id_customer'},
                    {data: 'campaign_name', name : 'campaign_name'},
                ],
                iDisplayLength: 20
            })
            $('.form-search').on('submit', function(e) {
                datatable.draw();
                e.preventDefault();
            });
        });
    </script>
@stop