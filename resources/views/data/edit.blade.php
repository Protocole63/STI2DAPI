@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Data
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($data, ['route' => ['data.update', $data->id], 'method' => 'patch']) !!}

                        @include('data.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection