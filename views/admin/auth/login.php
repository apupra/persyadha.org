<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!doctype html>
<html lang="id" data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" dir="ltr" data-pc-theme="light">
<head>
    <title>Login | Admin Persyadha</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Favicon -->
    <link rel="icon" href="/persyadha.org/assets/frontend/images/persyda.jpg" type="image/svg+xml">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="/persyadha.org/assets/admin/auth/css/font.css" />
    <link rel="stylesheet" href="/persyadha.org/assets/admin/auth/css/tabler-icons.min.css" />
    <link rel="stylesheet" href="/persyadha.org/assets/admin/auth/css/feather.css" />
    <link rel="stylesheet" href="/persyadha.org/assets/admin/auth/css/fontawesome.css" />
    <link rel="stylesheet" href="/persyadha.org/assets/admin/auth/css/material.css" />
    <link rel="stylesheet" href="/persyadha.org/assets/admin/auth/css/style.css" id="main-style-link" />
</head>
<body>
    <!-- Loader -->
    <div class="loader-bg fixed inset-0 bg-white dark:bg-themedark-cardbg z-[1034]">
        <div class="loader-track h-[5px] w-full inline-block absolute overflow-hidden top-0">
            <div class="loader-fill w-[300px] h-[5px] bg-primary-500 absolute top-0 left-0 animate-[hitZak_0.6s_ease-in-out_infinite_alternate]"></div>
        </div>
    </div>

    <div class="auth-main relative">
        <div class="auth-wrapper v1 flex items-center w-full h-full min-h-screen">
            <div class="auth-form flex items-center justify-center grow flex-col min-h-screen relative p-6">
                <div class="w-full max-w-[350px] relative">

                    <!-- ✅ Background animasi -->
                    <div class="auth-bg ">
                        <span class="absolute top-[-100px] right-[-100px] w-[300px] h-[300px] block rounded-full bg-theme-bg-1 animate-[floating_7s_infinite]"></span>
                        <span class="absolute top-[150px] right-[-150px] w-5 h-5 block rounded-full bg-primary-500 animate-[floating_9s_infinite]"></span>
                        <span class="absolute left-[-150px] bottom-[150px] w-5 h-5 block rounded-full bg-theme-bg-1 animate-[floating_7s_infinite]"></span>
                        <span class="absolute left-[-100px] bottom-[-100px] w-[300px] h-[300px] block rounded-full bg-theme-bg-2 animate-[floating_9s_infinite]"></span>
                    </div>

                    <!-- Card Login -->
                    <div class="card sm:my-12 w-full shadow-none">
                        <div class="card-body !p-10">
                            <div class="text-center mb-8">
                                <h2 class="text-xl font-semibold text-gray-700">Login Sebagai Admin Persyadha</h2>
                            </div>

                            <!-- Error Message -->
                            <?php if (!empty($_SESSION['error'])): ?>
                                <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center">
                                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                                </div>
                            <?php endif; ?>

                            <!-- Form -->
                            <form action="/persyadha.org/manjadmin/login" method="POST" class="space-y-4">
                                <!-- Email -->
                                <div class="mb-3 input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="Email Address" required />
                                </div>

                                <!-- Password -->
                                <div class="mb-4 input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required />
                                    <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                                        <i id="togglePasswordIcon" class="fa-solid fa-eye"></i>
                                    </span>
                                </div>

                                <div class="flex mt-1 justify-between items-center flex-wrap">
                                    <div class="form-check">
                                        <input class="form-check-input input-primary" type="checkbox" id="remember" />
                                        <label class="form-check-label text-muted" for="remember">Remember me?</label>
                                    </div>
                                    <h6 class="font-normal text-primary-500 mb-0">
                                        <a href="#">Forgot Password?</a>
                                    </h6>
                                </div>
                                <div class="mt-4 text-center">
                                    <button type="submit" class="btn btn-primary mx-auto shadow-2xl w-full">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Card Login -->
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="/persyadha.org/assets/admin/auth/js/simplebar.min.js"></script>
    <script src="/persyadha.org/assets/admin/auth/js/popper.min.js"></script>
    <script src="/persyadha.org/assets/admin/auth/js/custom-icon.js"></script>
    <script src="/persyadha.org/assets/admin/auth/js/feather.min.js"></script>
    <script src="/persyadha.org/assets/admin/auth/js/component.js"></script>
    <script src="/persyadha.org/assets/admin/auth/js/theme.js"></script>
    <script src="/persyadha.org/assets/admin/auth/js/script.js"></script>

    <!-- Toggle Password -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const icon = document.getElementById("togglePasswordIcon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
