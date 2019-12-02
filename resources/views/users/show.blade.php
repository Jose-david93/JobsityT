@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/custom/users.js') }}"></script>
@endpush


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

                @auth
                    @if(Auth::user()->name_tweet == $entry->name_tweet )
                        <a class="btn btn-primary" href="{{ route('edit_entry',['id' => $entry->id]) }}">{{ __('Edit Entry') }}</a>
                    @endif
                @endauth
            </article>
        @endforeach
        {{ $entries->links() }}
    </section>
    <aside>
        @isset($tweets)
            @foreach ($tweets as $tweet)
                @if (!(isset($tweet->hide)))
                    <div class="tweet">
                        <div class="profile">
                            <img class="picture" src="{{ $tweet->user->profile_image_url_https }}" alt="picture">
                            <div class="name">
                                <strong>{{$tweet->user->name}}</strong>
                                <span>{{"@".$tweet->user->screen_name}}</span>
                            </div>
                            @auth
                                @if(Auth::user()->name_tweet == $entry->name_tweet )
                                    <input type="checkbox" @if(isset($tweet->adminHide)) checked @endif id="tweet-{{ $tweet->id }}" class="chk-visible-tweet" name="tweet-{{ $tweet->id }}" />
                                        <label class="hide-tweet" for="tweet-{{ $tweet->id }}" data-idUser="{{Auth::user()->id}}" data-tweet="{{ $tweet->id }}">
                                        <img width="30px"  class="tweet-eye" src="https://www.trzcacak.rs/myfile/full/117-1171494_png-file-svg-crossed-eye-icon-png.png">
                                    </label>
                                @endif
                            @endauth
                            <div class="text">{{ $tweet->text }}</div>

                            <div class="footer-tweet"><span class="date-text">{{ $entry->created_at }} • <a target="_blank" href="https://twitter.com/{{$tweet->user->screen_name}}">Twitter</a></span></div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endisset
    </aside>
</div>
@endsection

