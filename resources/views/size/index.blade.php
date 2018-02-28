@extends('layouts.master')
@section('page_title','Sizes')

@section('content')

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                <a href="{{url('sizes/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
              </h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                @foreach($sizes as $size)
                <tr>
                  <td>{{$size->id}}</td>
                  <td>{{$size->name}}</td>
                  <td>{{$size->code}}</td>
                  <td>
                    @if($size->status)
                    <span class="label label-success">Active</span>
                    @else
                    <span class="label label-danger">Inactive</span>
                    @endif
                  </td>
                  <td>
                    
                    {!!Form::open(['url'=>'sizes/'.$size->id,'method'=>'DELETE'])!!}
                    <a href="{{url('sizes/'.$size->id .'/edit')}}" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span></a>
                        <button type="submit" class="btn btn-danger">
                            <span class="glyphicon glyphicon-trash"/>
                        </button>
                    {{Form::token()}}

                    {{Form::close()}}
                  </td>
                </tr>
                @endforeach
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>

@endsection