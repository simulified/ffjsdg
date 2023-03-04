@extends('layouts.app')

@section('meta')
<meta property="og:title" content="{{ config('app.name') }} - Welcome">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current(); }}">
<meta property="og:image" content="/images/logos/small.png">
<meta property="og:description" content="{{ config('app.name') }} is a place to be.">
<meta name="theme-color" content="#0000FF">
<head>
    <style>
        #hi {
            font-size: 5em;
        }
    </style>
</head>
@endsection
@section('content')
    <main class="landing-page vh-100 vw-100 justify-content-center align-items-center d-flex">
        <div class="container text-center">
<code id="hi"></code>
<pre> </pre>
        <a href="{{ route('login') }}" class="btn btn-secondary btn-lg shadow-lg mr-3"><i class="fas fa-sign-in-alt mr-1"></i>Login</a>
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg shadow-lg"><i class="fas fa-user-plus mr-1"></i>Sign Up</a>
        </div>
    </main>
<script>
var i = 0;
var txt = 'Kapish'; /* The text */
var speed = 75; /* The speed/duration of the effect in milliseconds */

function typeWriter() {
  if (i < txt.length) {
    document.getElementById("hi").innerHTML += txt.charAt(i);
    i++;
    setTimeout(typeWriter, speed);
  }
}
typeWriter()
</script>
@endsection
