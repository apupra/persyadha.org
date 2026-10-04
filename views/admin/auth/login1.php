<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-700">Login Admin</h2>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="/persyadha.org/admin/login" method="POST" class="space-y-4">
            <div>
                <label for="email" class="block text-gray-600">Username</label>
                <input type="text" id="email" name="email" required
                       class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300 focus:outline-none">
            </div>

            <div>
                <label for="password" class="block text-gray-600">Password</label>
                <input type="password" id="password" name="password" required
                       class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300 focus:outline-none">
            </div>

            <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                Login
            </button>
        </form>
    </div>

</body>
</html>
