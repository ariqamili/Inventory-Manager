<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Inventory Manager') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="relative">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <span class="text-2xl font-bold text-indigo-600">📦 Inventory Manager</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Get Started
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-5xl font-bold text-gray-900 mb-6">
                    Manage Your Inventory
                    <span class="block text-indigo-600">Simple. Smart. Efficient.</span>
                </h1>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    The perfect inventory management solution for small businesses. Track products, manage stock, and record sales all in one place.
                </p>
                <div class="flex justify-center space-x-4">
                    @guest
                        <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition">
                            Start Free Trial
                        </a>
                        <a href="{{ route('login') }}" class="bg-white hover:bg-gray-50 text-indigo-600 font-bold py-3 px-8 rounded-lg text-lg border-2 border-indigo-600 transition">
                            Sign In
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition">
                            Go to Dashboard
                        </a>
                    @endguest
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Everything You Need</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition">
                    <div class="text-5xl mb-4">📦</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Product Management</h3>
                    <p class="text-gray-600">Easily add, edit, and organize your products with categories and detailed tracking.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition">
                    <div class="text-5xl mb-4">📊</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Real-Time Tracking</h3>
                    <p class="text-gray-600">Monitor stock levels in real-time with automatic low-stock alerts.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition">
                    <div class="text-5xl mb-4">💰</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Sales Tracking</h3>
                    <p class="text-gray-600">Record every sale and track your business performance effortlessly.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition">
                    <div class="text-5xl mb-4">👥</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Team Management</h3>
                    <p class="text-gray-600">Assign roles and permissions to managers and workers in your business.</p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition">
                    <div class="text-5xl mb-4">📁</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Category Organization</h3>
                    <p class="text-gray-600">Organize products into categories for easy navigation and management.</p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition">
                    <div class="text-5xl mb-4">📈</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Dashboard Insights</h3>
                    <p class="text-gray-600">Get instant insights with a comprehensive dashboard showing key metrics.</p>
                </div>
            </div>
        </div>

        <!-- How It Works Section -->
        <div class="bg-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">How It Works</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-indigo-600">1</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Create Your Account</h3>
                        <p class="text-gray-600">Sign up and set up your business profile in seconds.</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-indigo-600">2</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Add Your Products</h3>
                        <p class="text-gray-600">Import or manually add your inventory with prices and stock levels.</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-indigo-600">3</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Start Managing</h3>
                        <p class="text-gray-600">Track sales, monitor stock, and grow your business efficiently.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-indigo-600 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-white mb-4">Ready to Get Started?</h2>
                <p class="text-xl text-indigo-100 mb-8">Join businesses already managing their inventory smarter.</p>
                @guest
                    <a href="{{ route('register') }}" class="bg-white hover:bg-gray-100 text-indigo-600 font-bold py-3 px-8 rounded-lg text-lg transition">
                        Create Free Account
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="bg-white hover:bg-gray-100 text-indigo-600 font-bold py-3 px-8 rounded-lg text-lg transition">
                        Go to Your Dashboard
                    </a>
                @endguest
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-400 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p>&copy; {{ date('Y') }} Inventory Manager. Built with Laravel.</p>
            </div>
        </footer>
    </div>
</body>
</html>