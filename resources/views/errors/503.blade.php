@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('We are already working to solve the problem.'))
@section('button-link', __('/'))
@section('button-text', __('Back to Homepage'))
