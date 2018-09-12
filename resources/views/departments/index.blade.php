@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Отделы
            </h1>
        </div>
        <div class="row row-cards row-deck">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="card-title" href="{{Route('departments.create')}}">Создать</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                            <tr>
                                <th class="w-1">No.</th>
                                <th>Название</th>
                                <th>Количество сотрудников</th>
                                <th>Максимальная зарплата.</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($departments as $department)
                            <tr>
                                <td><span class="text-muted">{{$department->id}}</span></td>
                                <td><a href="invoice.html" class="text-inherit">{{$department->name}}</a></td>
                                <td>
                                    {{$department->count_emp}}
                                </td>
                                <td>
                                    {{$department->max_salary}}
                                </td>
                                <td class="text-right">
                                    <a href="{{Route('departments.edit',['id'=>$department->id])}}" class="btn btn-secondary btn-sm">Редактировать</a>
                                    <div class="dropdown">
                                        <form method="post" action="departments/{{$department->id}}">
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