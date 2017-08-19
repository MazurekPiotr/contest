@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Contest
        @endcomponent
    @endslot
    Hey {{ $user->firstName }} you won {{ $contest->name }}!
    @slot('footer')
        @component('mail::footer')
            © Contest
        @endcomponent
    @endslot
@endcomponent