@component('mail::message')
# Your Post was Liked

{{ $liker->name }} liked one of your post

@component('mail::button', ['url' => route('posts.show',$post) ])
    View Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
