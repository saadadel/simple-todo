@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="text-right">
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Task</a>
        </div>
        <div class="row my-5">
            <div class="col-md-4 text-center todo">
                <div class="bg-danger h3">
                    TODO
                </div>
                <div class="cards">

                </div>
                {{-- <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                            content.</p>
                        <a href="#" class="card-link text-primary">Edit</a>
                        <a href="#" class="card-link text-danger">Delete</a>
                    </div>
                </div> --}}
            </div>
            <div class="col-md-4 text-center in-progress">
                <div class="bg-warning h3">
                    IN PROGRESS
                </div>
                <div class="cards">

                </div>
            </div>
            <div class="col-md-4 text-center done">
                <div class="bg-success h3">
                    DONE
                </div>
                <div class="cards">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <form id="add-form" method="post">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter Task Title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Enter Task Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Example select</label>
                        <select class="form-control" name="status" id="status">
                        <option class="text-danger bg-dark" value="todo">TODO</option>
                        <option class="text-warning bg-dark" value="in-progress">In PROGRESS</option>
                        <option class="text-success bg-dark" value="done">DONE</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary add-modal-close" data-dismiss="modal">Close</button>
                <button id="add-btn" type="button" class="btn btn-primary">Add</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <form id="edit-form" method="post">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter Task Title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" placeholder="Enter Task Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Example select</label>
                        <select class="form-control" name="status">
                        <option class="text-danger bg-dark" value="todo">TODO</option>
                        <option class="text-warning bg-dark" value="in-progress">In PROGRESS</option>
                        <option class="text-success bg-dark" value="done">DONE</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary add-modal-close" data-dismiss="modal">Close</button>
                <button id="edit-btn" type="button" class="btn btn-primary">Edit</button>
            </div>
            </div>
        </div>
    </div>
@endsection