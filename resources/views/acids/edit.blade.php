@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Acid
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($acid, ['route' => ['acids.update', $acid->id], 'method' => 'patch']) !!}

                        @include('acids.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection