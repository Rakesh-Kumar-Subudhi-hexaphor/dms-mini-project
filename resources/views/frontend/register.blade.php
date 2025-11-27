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

        #signup-modal {
            width: 100%;
        }

        span.badge.bg-secondary.category-tag {
            background: antiquewhite;
            margin-right: 10px;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 42px;
        }

        span.badge.bg-primary.selected-tag {
            background: lightgreen;
            margin-right: 10px;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 42px;
            color: #ffffff;
        }

        #categories-list {
            margin: 10px 0;
        }

        #selected-tags {
            margin: 10px 0;
        }
    </style>
    <section class="section login-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <section class="section-login">
                        <div id="signup-modal">
                            <div class="form-title">
                                <h4>Sign Up</h4>
                                <div class="signup">
                                    Already a member? <a href="{{ route('user.login') }}">Login</a>
                                </div>
                            </div>

                            <form id="signupform" action="{{ route('register.store') }}" enctype="multipart/form-data"
                                name="signupform" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="name-wrap">
                                            <label for="user-name">Name</label>
                                            <input type="text" value="" class="input" id="user-name"
                                                name="name">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="email-wrap">
                                            <label for="user-email">Your email address</label>
                                            <input type="email" value="" class="input" id="user-email2"
                                                name="email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="email-wrap">
                                            <label for="user-email">Your Phone number</label>
                                            <input type="text" value="" class="input" id="user-email2"
                                                name="phone">
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="user-email">Address</label>
                                                <textarea type="text" value="" class="input" id="user-email2" name="address" rows="5"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="pass-wrap">
                                                <label for="user-pass">Password</label>
                                                <input type="password" value="" class="input" id="user-pass2"
                                                    name="password" placeholder="*******">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="pass-wrap">
                                                <label for="user-pass">Confirm Password</label>
                                                <input type="password" name="confirm_password" value=""
                                                    class="input" id="user-pass2" placeholder="*******">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="submit-login">
                                                <input type="submit" class="submit">
                                            </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </section>
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        let selectedIds = [];

        $(document).on('click', '.category-tag', function() {
            let id = $(this).data('id');
            let name = $(this).clone() // clone element
                .children() // remove children (<b>+</b>)
                .remove()
                .end()
                .text()
                .trim();

            // Already selected? then ignore
            if (selectedIds.includes(id)) return;

            // Add to selected list
            selectedIds.push(id);

            // Update hidden input
            $('#area_of_interest').val(selectedIds.join(','));

            // Show as selected tag
            $('#selected-tags').append(`
            <span class="badge bg-primary selected-tag" data-id="${id}" style="cursor:pointer;">
                ${name} <b>x</b>
            </span>
        `);
        });

        // Remove tag when clicking "x"
        $(document).on('click', '.selected-tag', function() {
            let id = $(this).data('id');

            // Remove from array
            selectedIds = selectedIds.filter(e => e != id);

            // Update hidden input
            $('#area_of_interest').val(selectedIds.join(','));

            // Remove from UI
            $(this).remove();
        });
    </script>
    {{-- <script>
        function toggleOtherInput() {
            var userTypeSelect = document.getElementById("user-type-select");
            var emailWrap = document.getElementById("other");

            // Show the input box if 'Other' is selected, otherwise hide it
            if (userTypeSelect.value === "other") {
                emailWrap.style.display = "block";
            } else {
                emailWrap.style.display = "none";
            }
        }
    </script> --}}
</x-frontend.app-layout>
