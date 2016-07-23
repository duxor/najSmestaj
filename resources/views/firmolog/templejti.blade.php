@extends('firmolog.master')
@section('container')
    <div class="col-md-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Osnovni Izgled <span class="badge bg-blue">aktivan</span></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-floppy-o"></i></button>
                </div>
            </div>
            <div class="box-body">
                <img src="/templejt/plavi-izgled/screenshot.jpg" width="100%">
            </div>
            <div class="box-footer">
                <a href="/administration/izmeni-sadrzaj" class="btn btn-flat btn-primary">Izmeni sadržaj</a>
            </div>
        </div>
    </div>
@endsection
@section('end-script')

@endsection





