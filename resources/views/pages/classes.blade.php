@extends('dashboard.app')

@section('dashboard')

<div class="container">

    <div class="card container mt-3">
        <div class="card-header fancy-header">
                <p class="card-title">{{ __('Class') }}</p>
                <p class="card-category">{{ __('Here you can manage class') }}</p>
        </div>
        <div class="card-body">
            <button class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#exampleModalCenter">Add Class</button>
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-theme-color">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add New Class</h5>
                            <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                <span class = "text-white" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['action' => 'ClassesController@store','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group row">
                                {{ Form::label('classes','Class',['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::text('classes','',['placeholder' => 'class e.g. Primary One', 'class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            {{ Form::submit('Save',['class' => 'mt-2 btn btn-primary']) }}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">SN</th>
                            <th scope="col">Class</th>
                            <th scope="col">Creation Date</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1; ?>
                        @foreach ($classes as $c)
                            <tr>
                                <th scope="row">{{ $count }}</th>
                                <th scope="row">{{ $c->classes }}</th>
                                <td>{{ (new DateTime($c->created_at))->format('Y-m-d') }}</td>
                                <td>
                                    <span data-toggle="modal" data-target="#edit-{{ $c->id }}" class="fas fa-pen-alt mx-1"></span>

                                    <div class="modal fade bd-example-modal-lg" id="edit-{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-theme-color">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit {{ $c->classes }} Record</h5>
                                                        <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span class = "text-white" aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!! Form::open(['action' => ['ClassesController@update',$c->id],'method' => 'PUT']) !!}
                                                        <div class="form-group row">
                                                            {{ Form::label('classes','Classes',['class' => 'col-sm-2']) }}
                                                            <div class="col-sm-10">
                                                                {{ Form::text('classes',$c->classes,['placeholder' => 'classes e.g. 2012/2013', 'class' => 'form-control']) }}
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        {{Form::hidden('_method','PUT')}}
                                                        {{ Form::submit('Save',['class' => 'mt-2 btn btn-primary']) }}

                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <span class="fas fa-trash-alt mx-1" data-toggle="modal" data-target="#delete-{{ $c->id }}"></span>
                                        <!-- Modal -->
                                        <div class="modal fade" id="delete-{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Class Record</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete {{ $c->classes }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    {!! Form::open(['action' => ['ClassesController@destroy',$c->id], 'method' => 'POST']) !!}

                                                    {{ Form::hidden('_method','DELETE') }}`

                                                    {{ Form::button('Delete',['type' => 'submit', 'class' => 'btn btn-primary']  )}}

                                                    {!! Form::close() !!}

                                                    </div>
                                                </div>
                                                </div>
                                            </div>





                                </td>
                            </tr>
                            <?php $count++ ?>
                            @endforeach

                        {{ $classes->links() }}

                        </tbody>
                      </table>
        </div>
    </div>

</div>

@endsection
