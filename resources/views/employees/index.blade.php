@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
               Сотрудники
            </h1>
        </div>
        <div class="row row-cards row-deck">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="card-title" href="{{Route('employees.create')}}">Создать</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                            <tr>
                                <th class="w-1">No.</th>
                                <th>Имя</th>
                                <th>Фамилия</th>
                                <th>Отчество</th>
                                <th>Пол</th>
                                <th>Зарплата</th>
                                <th>Отделы</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td><span class="text-muted">{{$employee->id}}</span></td>
                                <td><a href="invoice.html" class="text-inherit">{{$employee->name}}</a></td>
                                <td>
                                    {{$employee->last_name}}
                                </td>
                                <td>
                                    {{$employee->first_name}}
                                </td>
                                <td>
                                    {{$employee->gender}}
                                </td>
                                <td>
                                    ${{$employee->salary}}
                                </td>
                                <td>{{$employee->department}}</td>
                                <td class="text-right">
                                    <a href="{{Route('employees.edit',['id'=>$employee->id])}}" class="btn btn-secondary btn-sm">Редактировать</a>
                                    <div class="dropdown">
                                        <form method="post" action="employees/{{$employee->id}}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-secondary btn-sm dropdown-toggle">Удалить</button>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection