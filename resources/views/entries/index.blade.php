@extends('layouts.app')

@section('content')
<div class="model">
    <section>
        @foreach ($entries as $entry)
        <article>
            <h3 class="no-margin">
                {{ $entry->title }}
            </h3>
            <span class="date-text">{{ $entry->name }} {{ $entry->creation_date }}</span>
            <p>
                {{ $entry->content }}
            </p>

                <a class="btn btn-primary" href="{{ route('user',['id' => $entry->idUser,'name_tweet' =>$entry->name_tweet]) }}">{{ __('Perfil') }}</a>
            @auth
                @if(Auth::user()->name_tweet == $entry->name_tweet )
                    <a class="btn btn-primary" href="{{ route('edit_entry',['id' => $entry->id]) }}">{{ __('Edit Entry') }}</a>
                @endif
            @endauth
           
        </article>
        @endforeach
        {{ $entries->links() }}
    </section>
</div>

@endsection