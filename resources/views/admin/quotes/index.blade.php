@extends('adminlte::page')

@section('title', 'Quotes - Admin Panel | ' . config('app.name'))

@section('content_header')
    <h1 style="display: inline-block">Quotes</h1>
    <a class="btn btn-success above-table-action" href="{{route('quotes.create')}}"><i class="glyphicon glyphicon-plus"></i> Add Quote </a>
@stop

@section('content')
    <div class="modal custom-modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete Quote</h4>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <button type="button" id="modal-close" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" id="modal-delete" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="col-sm-12 table-responsive table-hover">
                        <table id="quotes" class="table table-bordered table-striped dataTable" role="grid">
                            <thead>
                            <tr role="row">
                                <th class="sortable sorting">#</th>
                                <th class="sortable sorting">Active</th>
                                <th class="sortable sorting">Locale</th>
                                <th class="sortable sorting">Title</th>
                                <th class="sortable sorting">Text</th>
                                <th class="sortable sorting">Author</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

