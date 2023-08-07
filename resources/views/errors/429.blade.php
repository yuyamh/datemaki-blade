@extends('errors::layout')

@section('title', __('Too Many Requests'))
@section('code', '429 Too Many Requests')
@section('message', 'しばらくしてから再度お試しください。')
