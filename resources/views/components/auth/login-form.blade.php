

<style>


#loader {
    opacity: 1;
    transition: opacity 0.3s ease;
}
#loader.d-none {
    opacity: 0;
    pointer-events: none;
}

    </style>

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 animated fadeIn col-lg-6 center-screen">
            <div class="card w-90  p-4">
                <div class="card-body">
                    <h4>SIGN IN</h4>
                    <br />
                    <input id="email" placeholder="User Email" class="form-control" type="email" />
                    <br />
                    <input id="password" placeholder="User Password" class="form-control" type="password" />
                    <br />
                    <button onclick="SubmitLogin()" class="btn w-100 bg-gradient-primary">Next</button>
                    <hr />
                    <div class="float-end mt-3">
                        <span>
                            <a class="text-center ms-3 h6" href="{{ url('/userRegistration') }}">Sign Up </a>
                            <span class="ms-1">|</span>
                            <a class="text-center ms-3 h6" href="{{ url('/sendOtp') }}">Forget Password</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

async function SubmitLogin() {
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    if (email.length === 0) {
        errorToast("Email is required");
    } else if (password.length === 0) {
        errorToast("Password is required");
    } else {
        try {
            showLoader();
            let res = await axios.post("/user_login", { email: email, password: password });
            hideLoader();

            if (res.status === 200 && res.data['status'] === 'success') {
                // Small delay so loader can disappear smoothly
                setTimeout(() => {
                    window.location.href = "/dashboard";
                }, 300);
            } else {
                errorToast(res.data['message']);
            }
        } catch (err) {
            hideLoader();
            console.error("Login error:", err);
            errorToast("Login failed. Try again.");
        }
    }
}

  </script>
