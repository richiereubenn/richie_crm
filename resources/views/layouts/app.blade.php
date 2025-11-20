<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>CRM ISP</title>
  @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gray-100">
  <div class="flex">
    <aside class="w-64 bg-white border-r min-h-screen">
      <div class="p-6 border-b">
        <a href="{{ url('/') }}" class="text-xl font-bold">CRM ISP</a>
      </div>

      <nav class="p-4">
        <a href="{{ route('leads.index') }}" class="block p-3 rounded hover:bg-gray-100 {{ request()->routeIs('leads.*') ? 'bg-gray-50' : '' }}">Leads</a>
        <a href="{{ route('projects.index') }}" class="block p-3 rounded hover:bg-gray-100 {{ request()->routeIs('projects.*') ? 'bg-gray-50' : '' }}">Projects</a>
        <a href="{{ route('customers.index') }}" class="block p-3 rounded hover:bg-gray-100 {{ request()->routeIs('customers.*') ? 'bg-gray-50' : '' }}">Customers</a>
        <a href="{{ route('products.index') }}" class="block p-3 rounded hover:bg-gray-100 {{ request()->routeIs('products.*') ? 'bg-gray-50' : '' }}">Products</a>

        @if(auth()->user()->role === 'Admin')
          <a href="{{ route('users.index') }}" class="block p-3 rounded hover:bg-gray-100 {{ request()->routeIs('users.*') ? 'bg-gray-50' : '' }}">Manage User</a>
        @endif
      </nav>

      <div class="p-4 mt-auto border-t">
        <div class="text-sm text-gray-600 mb-2">Logged in as</div>
        <div class="font-medium">{{ auth()->user()->username }} <span class="text-xs text-gray-500">({{ auth()->user()->role }})</span></div>
        <form class="mt-3" method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="text-red-600" type="submit">Logout</button>
        </form>
      </div>
    </aside>

    <main class="flex-1 p-8">
      @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-200 rounded">{{ session('success') }}</div>
      @endif

      @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 border border-red-200 rounded">{{ session('error') }}</div>
      @endif

      @yield('content')
    </main>
  </div>
</body>
</html>
