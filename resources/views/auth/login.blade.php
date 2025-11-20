<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login - CRM ISP</title>
  @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="w-full max-w-md bg-white p-8 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Login</h1>

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Username</label>
        <input name="username" value="{{ old('username') }}" class="w-full border rounded px-3 py-2" required autofocus>
        @error('username') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Password</label>
        <input name="password" type="password" class="w-full border rounded px-3 py-2" required>
        @error('password') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
      </div>

      <div class="flex items-center justify-between">
        <div></div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Login</button>
      </div>
    </form>
  </div>
</body>
</html>
