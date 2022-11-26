@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
@section('message2', __("Sorry, we can't find that page. You'll find lots to explore on the home page."))
@section('button-link', __('/'))
@section('button-text', __('Back to Homepage'))
