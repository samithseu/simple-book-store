<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{url('admin/img/cj.png')}}" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CJ Blog | Login Form</title>
    <style>
        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        * {
            margin: 0;
            padding: 0;
            font: inherit;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-inline: 0;
            margin-block: 0;
        }

        html {
            font-size: 87.5%;
            font-family: "Poppins", sans-serif;
            color-scheme: dark;
        }

        body {
            min-height: 100vh;
        }

        img,
        picture,
        svg,
        video {
            display: block;
            max-width: 100%;
        }

        .wrapper {
            width: 100vw;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 2em;
            gap: 1em;
        }

        .form {
            max-width: 400px;
            width: 100%;
            border: 2px solid white;
            border-radius: 1em;
            padding: 2em;
        }

        .form h1 {
            text-align: center;
            font-weight: bold;
            text-transform: capitalize;
            font-size: 2rem;
            margin-bottom: 1em;
            color: #46B678;
        }

        .form form {
            display: grid;
            grid-template-rows: repeat(3, max-content);
            gap: 2em;
        }

        .form form,
        .input-group {
            width: 100%;
            height: max-content;
        }

        .input-group {
            display: grid;
            grid-template-rows: repeat(2, max-content);
            gap: 1em;
        }

        .input-group label {
            font-size: 1.2rem;
            font-weight: 500;
            line-height: 1;
        }

        .input-group input {
            font-size: 1.2rem;
            padding: 0.3em 1em;
            outline: none;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 0.5em;
        }

        .input-group input,
        .input-group button {

            &:hover,
            &:focus,
            &:not(:placeholder-shown) {
                border: 1px solid white;
            }

            transition: 0.35s ease-out;
        }

        .input-group button {
            font-size: 1.2rem;
            padding: 0.5em 1em;
            text-transform: capitalize;
            border-radius: 0.5em;
            outline: none;
            border: none;
            cursor: pointer;
            background-color: black;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: 0.35s ease-out;
            font-weight: bold;
        }

        .input-group button:hover,
        .input-group button:focus {
            border: 1px solid white;
            background-color: rgb(81, 81, 81);
        }
        .brand {
            width: 100%;
            height: max-content;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 1em;
        }
        .brand img {
            aspect-ratio: 1/1;
            width: 70px;
        }
        .brand h2 {
            font-size: 2.5rem;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="brand">
            <img src="{{url('admin/img/cj.png')}}" alt="">
            <h2>CJ Book Store</h2>
        </div>
        <div class="form">
            @include('admin.includes.messages')
            <h1>login form</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <label for="email">Email</label>
                    <input required type="email" name="email" id="email" autocomplete="email" autofocus
                        placeholder="Email..." />
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input required type="password" name="password" id="password" placeholder="Password" />
                </div>
                <div class="input-group">
                    <button type="submit">log in</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>