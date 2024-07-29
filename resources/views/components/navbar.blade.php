<nav class="bg-white sticky top-0 z-50">
  <div class="container mx-auto">
        <div class="grid grid-cols-3 justify-between items-center h-16">
          <div></div>
            <div class="flex-shrink-0 flex items-center justify-center">
              <a href="/" class="text-[#353755] text-xl font-bold">{{ $slot }}</a>
            </div>
            <div class="flex justify-end pe-5">
              @auth
              <form action="{{ route('user.logout') }}" method="post">
                @csrf
                <input type="image" src="/images/logout.png" class="w-8" alt="" onclick="return confirm('Apakah Anda yakin ingin keluar dari Aplikasi')">
              </form>   
              @endauth
            </div>
        </div>
  </div>
  </nav>