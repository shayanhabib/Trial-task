@if( isset($_GET['success']) && $_GET['success'] == '1' )

Your new password sent to your email... 

@endif()

<main class="forgot-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Forget password</h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('forgot.custom') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email" class="form-control" name="email" value="test@xyz.com" required
                                    autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Reset Password</button>
                            </div>
                        </form>
                        <a href="{{ route('login') }}">Already have an account, login?</a><BR>
                        <a href="{{ route('register') }}">Not have an account, sign up?</a><BR>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>