@extends('dashboard.app')

@section('dashboard')

<div class="container">

    <div class="card container mt-3">
        <div class="card-header fancy-header">
                <p class="card-title">{{ __('Actions Performed') }}</p>
                <p class="card-category">{{ __('Here you can manage actions') }}</p>
        </div>
        <div class="card-body">
            <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">SN</th>
                            <th scope="col">Type</th>
                            <th scope="col">Action By</th>
                            <th scope="col">Message</th>
                            <th scope="col">Table Name</th>
                            <th scope="col">Creation Date</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1; ?>
                        @foreach ($notifications as $notification)
                            <tr>
                                <th scope="row">{{ $count }}</th>
                                <th scope="row">{{ $notification->type }}</td>
                                <td scope="row">{{ $notification->user->name}}</td>
                                <td scope="row">{{ $notification->message }}</td>
                                <td scope="row">{{ $notification->table_name }}</td>
                                <td>{{ (new DateTime($notification->created_at))->format('Y-m-d') }}</td>
                                <td>



                                        @if (Auth()->user()->role == "Super Admin")
                                            <span class="fas fa-trash-alt mx-1" data-toggle="modal" data-target="#delete-{{ $notification->id }}"></span>

                                        @else
                                            Read Only

                                        @endif

                                        <!-- Modal -->
                                        <div class="modal fade" id="delete-{{ $notification->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Notfication Record</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete {{ $notification->message }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    {!! Form::open(['action' => ['NotificationController@destroy',$notification->id], 'method' => 'POST']) !!}

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

                        {{ $notifications->links() }}

                        </tbody>
                      </table>
        </div>
    </div>

</div>

@endsection
