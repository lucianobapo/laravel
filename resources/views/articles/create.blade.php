@extends('app')
@section('content')
    <h1>Write a New Article</h1>
    <hr>
    @include ('errors.list')

    {!! Form::model($article = new \App\Article, ['url'=>'articles']) !!}
        @include ('articles.form', ['submitButtonText'=>'Add Article'])
    {!! Form::close() !!}
@stop