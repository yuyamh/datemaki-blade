@extends('errors::layout')

@section('title', __('Unauthorized'))
@section('code', '401 Unauthorized')
@section('message', 'アクセスするには認証が必要です。')
