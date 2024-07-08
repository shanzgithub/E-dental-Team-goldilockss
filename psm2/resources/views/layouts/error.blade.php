<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.errorhead')
     </head>
<body class="antialiased">
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                <section>
                    @yield('subject')
                </section>
                
            </div>
        </div>
    </div>
</body>

</html>