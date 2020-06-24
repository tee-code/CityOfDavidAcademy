@extends('dashboard.app')

@section('dashboard')

<div class="container">

    <div class="card container mt-3">
        <div class="card-header fancy-header">
                <p class="card-title">{{ __('Sections') }}</p>
                <p class="card-category">{{ __('Here you can manage sections') }}</p>
        </div>
        <div class="card-body">
            <button class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#exampleModalCenter">Add Section</button>
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-theme-color">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add New Section</h5>
                            <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                <span class = "text-white" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['action' => 'SectionsController@store','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group row">
                                {{ Form::label('section','Section',['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::text('section','',['placeholder' => 'section e.g. 2012/2013', 'class' => 'form-control']) }}
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
                            <th scope="col">Section</th>
                            <th scope="col">Creation Date</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1; ?>
                        @foreach ($sections as $section)
                            <tr>
                                <th scope="row">{{ $count }}</th>
                                <th scope="row">{{ $section->section }}</th>
                                <td>{{ (new DateTime($section->created_at))->format('Y-m-d') }}</td>
                                <td>
                                    <span data-toggle="modal" data-target="#edit-{{ $section->id }}" class="fas fa-pen-alt mx-1"></span>

                                    <div class="modal fade bd-example-modal-lg" id="edit-{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-theme-color">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit {{ $section->section }} Record</h5>
                                                        <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span class = "text-white" aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!! Form::open(['action' => ['SectionsController@update',$section->id],'method' => 'PUT']) !!}
                                                        <div class="form-group row">
                                                            {{ Form::label('section','Section',['class' => 'col-sm-2']) }}
                                                            <div class="col-sm-10">
                                                                {{ Form::text('section',$section->section,['placeholder' => 'section e.g. 2012/2013', 'class' => 'form-control']) }}
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

                                        <span class="fas fa-trash-alt mx-1" data-toggle="modal" data-target="#delete-{{ $section->id }}"></span>
                                        <!-- Modal -->
                                        <div class="modal fade" id="delete-{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Section Record</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete {{ $section->section }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    {!! Form::open(['action' => ['SectionsController@destroy',$section->id], 'method' => 'POST']) !!}

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

                        {{ $sections->links() }}

                        </tbody>
                      </table>
        </div>
    </div>

</div>

@endsection
