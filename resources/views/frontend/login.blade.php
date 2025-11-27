<x-frontend.app-layout>
    <style>
        input::placeholder {
            color: red;
            /* Change 'red' to any color you want */
            opacity: .3;
            /* Optional: adjust the opacity of the placeholder text */
        }

        #other {
            display: none;
            /* Initially hide the input box */
        }
    </style>
    <section class="section login-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <section class="section-login">
                        <div id="signup-modal" class="login">
                            <div class="form-title">
                                <h4>Login</h4>
                                <div class="signup">
                                    No account yet? <a href="{{route('register')}}">Sign Up</a>
                                </div>
                            </div>

                            <form id="signupform" action="{{route('user.login.post')}}" method="post">
                                @csrf
                               
                                <div class="email-wrap">
                                    <label for="user-email">Your email address</label>
                                    <input type="email" size="30" value="" class="input" id="user-email"
                                        name="email">
                                </div>
                                <div class="pass-wrap">
                                    <label for="user-pass">Password</label>
                                    <input type="password" size="30" value="" class="input" id="user-pass"
                                        name="password">
                                </div>

                                <div class="submit-login">
                                    <input type="submit" class="submit">
                                </div>
                            </form>
                        </div>
                    </section>
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section>


   
</x-frontend.app-layout>
