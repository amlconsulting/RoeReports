@extends('layouts.app')

@section('content')
{{ var_dump(Auth::User()) }}
@endsection
