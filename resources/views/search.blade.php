@extends('skeleton')

@section('content')

<nav class="navbar bg-light">
    <form class="form-inline w-100">
        <input name="search_site" class="form-control mr-sm-12" type="search" placeholder="What site are you curious about it?" aria-label="Search">
        <button class="btn btn-outline-success my-12 my-sm-12" type="submit">Search</button>
    </form>
</nav>

@isset($tags)
    @include('list-stats')
@endisset

@stop