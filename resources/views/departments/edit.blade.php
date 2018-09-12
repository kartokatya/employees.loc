@extends('layouts.app')
@section('content')
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="" method="post" class="card">
                        {{csrf_field()}}
                        <div class="card-header">
                            <h3 class="card-title">Редактирование отдела</h3>
                        </div>
                        <div class="card-body">
                            <fieldset class="form-fieldset">
                                <div class="form-group">
                                    <label class="form-label">Название отдела</label>
                                    <input type="text" name="name" class="form-control" value="{{$department->name}}" />
                                </div>
                            </fieldset>
                        </div>
                        <div class="card-footer text-right">
                            <div class="d-flex">
                                <a href="{{Route('departments')}}" class="btn btn-link">Cancel</a>
                                <button type="submit" class="btn btn-primary ml-auto">Send data</button>
                            </div>
                        </div>
                    </form>
                    @if (count($errors))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection