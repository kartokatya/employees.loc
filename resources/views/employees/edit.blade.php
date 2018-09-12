@extends('layouts.app')
@section('content')
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="" method="post" class="card">
                        {{csrf_field()}}
                        <div class="card-header">
                            <h3 class="card-title">Добавление сотрудника</h3>
                        </div>
                        <div class="card-body">
                            <fieldset class="form-fieldset">
                                <div class="form-group">
                                    <label class="form-label">Имя<span class="form-required">*</span></label>
                                    <input type="text" name="name" class="form-control" value="{{$employee->name}}" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Фамилия<span class="form-required">*</span></label>
                                    <input type="text" name="last_name" class="form-control" value="{{$employee->last_name}}" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Отчество</label>
                                    <input type="text" name="first_name" class="form-control" value="{{$employee->first_name}}" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Пол</label>
                                    <input type="text" name="gender" class="form-control"  value="{{$employee->gender}}"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Зарплата<span class="form-required">*</span></label>
                                    <input type="text" name="salary" class="form-control" value="{{$employee->salary}}" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Отделы<span class="form-required">*</span></label>

                                    <select class="form-control" multiple="multiple" name="department[]" value="">
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}" <?foreach($employee->department as $val) if($department->name==$val)echo"selected";?>>{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>
                        </div>
                        <div class="card-footer text-right">
                            <div class="d-flex">
                                <a href="javascript:void(0)" class="btn btn-link">Cancel</a>
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