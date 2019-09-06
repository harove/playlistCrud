@extends('layouts.master')

@section('css')
<!-- Dropzone css -->
<link href="{{ URL::asset('plugins/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title">File Upload</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Veltrix</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
        <li class="breadcrumb-item active">File Upload</li>
   </ol>
</div>
@endsection

@section('content')
<div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
            
                                            <h4 class="mt-0 header-title">Dropzone</h4>
                                            <p class="text-muted m-b-30">DropzoneJS is an open source library
                                                that provides drag’n’drop file uploads with image previews.
                                            </p>
            
                                            <div class="m-b-30">
                                                <form action="#" class="dropzone">
                                                    <div class="fallback">
                                                        <input name="file" type="file" multiple="multiple">
                                                    </div>
                                                </form>
                                            </div>
            
                                            <div class="text-center m-t-15">
                                                <button type="button" class="btn btn-primary waves-effect waves-light">Send Files</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
            
                                        <div class="table-responsive">
                                                                <table class="table table-striped mb-0">
                    
                                                                    <thead>
                                                                        <tr>

                                                                            <th>Nombre del Vídeo</th>
                                                                            <th>Tamaño</th>
                                                                            <th>Progreso</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <th scope="row">generacion_perdida.mp4</th>
                                                                            <td> 404 MB</td>
                                                                            <td><div class="progress m-b-15">
                                                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div></td>
                                                                        </tr>
                                                                        
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->        
@endsection

@section('script')
<!-- Dropzone js -->
<script src="{{ URL::asset('plugins/dropzone/dist/dropzone.js') }}"></script>
@endsection