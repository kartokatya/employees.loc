@extends('layouts.app')
@section('content')

            <div class="container">
                <div class="page-header">
                    <h1 class="page-title">
                        Dashboard
                    </h1>
                </div>
                <div class="row row-cards row-deck">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">СЕТКА</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        @foreach($departments as $department)
                                            <th>{{$department->name}}</th>
                                        @endforeach

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>

                                        @for($j=0;$j<count($employees);$j++)
                                            <?php $depart=explode(',',$employees[$j]->department);?>
                                        <tr><td><span class='text-muted'>{{$employees[$j]->name}}</span></td>
                                            @foreach($departments as $dep)
                                                <td>

                                                @for($k = 0;$k<count($depart);$k++)

                                                    @if($depart[$k]==$dep->name)
                                                            +
                                                        @else
                                                        @endif

                                                    @endfor
                                                </td>
                                          {{--@foreach($depart as $val)
                                                <td>+</td>
                                            @endforeach--}}
                                            @endforeach
                                        </tr>

                                    @endfor
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection