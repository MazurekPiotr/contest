@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Contest
        @endcomponent
    @endslot
    Hey admin, in the attachment you will find the entries of today!
    @slot('footer')
        @component('mail::footer')
            © Contest
        @endcomponent
    @endslot
@endcomponent