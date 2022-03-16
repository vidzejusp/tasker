@extends('errors::illustrated-layout')

@section('title', __('Draudžiamas veiksmas'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Draudžiamas veiksmas'))
