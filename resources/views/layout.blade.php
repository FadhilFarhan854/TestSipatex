<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-jQG9xK5oY6n3zZnUjs2Y5Ty2RCZt+qJHK0RPiRA1uWvHJk+96LUm6A1Owz+CcfAOZBRWhYaV6Q5aZMjYUIc8fg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex  overflow-hidden">
        <div id="sidebar" class="fixed z-30 inset-y-0 left-0 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out">
            @include('components.sidebar')
        </div>
        <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-20 hidden"></div>
        <div class="flex-1 flex flex-col ml-0">
           
            <header class="bg-blue-400 shadow-sm flex items-center justify-between px-6 py-4">
                <button id="toggleSidebar" class="text-white focus:outline-none">
        
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>   
            </header>
            <!-- Main Content -->
            <main class="flex-1 overflow-y-hidden p-6 bg-gray-100">
                {{ $slot ?? '' }}
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
    
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        toggleBtn.addEventListener('click', () => {
            const isOpen = !sidebar.classList.contains('-translate-x-full');

            if (isOpen) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            } else {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }
        });
      
      
        overlay.addEventListener('click', () => {
          
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    </script>
</body>
</html>
