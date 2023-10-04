<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{url('admin/img/cj.png')}}" type="image/x-icon" />
    <title>Register Form</title>
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
            display: grid;
            place-items: center;
            padding: 2em;
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
        }

        .form form {
            display: grid;
            grid-template-rows: repeat(5, max-content);
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
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="form">
            <h1>register form</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="input-group">
                    <label for="name">Name</label>
                    <input required type="Name" name="name" id="name" autofocus placeholder="Name..." />
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input required type="email" name="email" id="email" autocomplete="email" placeholder="Email..." />
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input required type="password" name="password" id="password" placeholder="Password..." />
                </div>
                <div class="input-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input required type="password" name="password_confirmation" id="password-confirm"
                        placeholder="Confirm Password..." />
                </div>
                <div class="input-group">
                    <button type="submit">register</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>