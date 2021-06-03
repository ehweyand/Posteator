@component('mail::message')
# Your post was liked

{{ $liker->name }} liked one of your posts.

{{-- No botão a ação vai ser exibir aquela tela de post individual para exibição --}}
@component('mail::button', ['url' => route('posts.show', $post) ])
    View Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent