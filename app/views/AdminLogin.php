<div class="container h-100 d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-6 col-lg-4">
        <div class="bg-secondary p-5 rounded shadow">
            <div class="text-center mb-4">
                <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Takalo</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Takalo</span>
                </a>
            </div>
            <h3 class="text-center mb-4">Admin Login</h3>

            <form action="/adminLogin" method="POST">
                <div class="form-group">
                    <label for="username" class="font-weight-bold">Username</label>
                    <input type="text" class="form-control py-4" id="username" name="username"
                        placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label for="email" class="font-weight-bold">Email</label>
                    <input type="email" class="form-control py-4" id="email" name="email"
                        placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="password" class="font-weight-bold">Password</label>
                    <input type="password" class="form-control py-4" id="password" name="password"
                        placeholder="Enter password" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold">Login</button>

                <div class="text-center mt-3">
                    <a href="/register" class="text-dark">Register</a>
                </div>
            </form>
        </div>
    </div>
</div>
