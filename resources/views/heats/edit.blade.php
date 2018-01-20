@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Heat
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($heat, ['route' => ['heats.update', $heat->id], 'method' => 'patch']) !!}

                        @include('heats.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection