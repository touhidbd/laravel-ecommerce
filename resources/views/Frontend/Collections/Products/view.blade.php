@extends('layouts.app')
@section('title', $product->name.' | eCommerce Website')
@section('description', $product->meta_description)
@section('keywords', $product->meta_keywords)

@section('content')
    <livewire:frontend.product.view :category="$category" :product="$product" :featured_product="$featured_product"/>
@endsection