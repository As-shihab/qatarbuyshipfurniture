
@extends('layouts.app')

@section('content')


<main>
  <!-- ===== Blog Single Start ===== -->
  <section style="padding: 3rem 1rem; background: #f9f9f9;">
    <div style="max-width: 800px; margin: 0 auto;">

      <!-- Blog Image -->
      <img src="{{ $blog->image ? asset('storage/blog/'.$blog->image) : 'https://via.placeholder.com/800x400/4f46e5/ffffff?text=Blog' }}" 
           alt="{{ $blog->title }}" 
           style="width: 100%; display: block; margin-bottom: 1.5rem;" />

      <!-- Blog Title -->
      <h1 style="font-size: 2rem; font-weight: 700; color: #111827; margin-bottom: 1rem;">
        {{ $blog->title }}
      </h1>

      <!-- Blog Info -->
      <p style="color: #6B7280; font-size: 0.875rem; margin-bottom: 1.5rem;">
        <strong>Author:</strong> {{ $blog->author ?? 'Admin' }} |
        <strong>Published On:</strong> {{ $blog->created_at->format('d M, Y') }}
      </p>

      <!-- Blog Content -->
      <div style="color: #374151; line-height: 1.7;">
        {!! $blog->content !!}
      </div>

      <!-- Blog Additional Images -->
      @if($blog->images && count($blog->images))
        <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-top: 1.5rem;">
          @foreach($blog->images as $image)
            <img src="{{ asset('storage/blog/'.$image) }}" alt="Blog Image" style="width: 48%; display: block;">
          @endforeach
        </div>
      @endif

      <!-- Social Share -->
      <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 2rem;">
        <span style="font-weight: 700; color: #6B7280;">Share On:</span>
        <a href="#!" style="width: 36px; height: 36px; background: #4f46e5; display: flex; align-items: center; justify-content: center; color: #fff;">F</a>
        <a href="#!" style="width: 36px; height: 36px; background: #1DA1F2; display: flex; align-items: center; justify-content: center; color: #fff;">T</a>
      </div>

    </div>
  </section>
  <!-- ===== Blog Single End ===== -->
</main>




  @endsection