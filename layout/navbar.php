<div class="fixed h-16 w-full z-50 shadow-md backdrop-blur-md bg-white/90" data-aos="fade-down" data-aos-delay="100" data-aos-duration="1000">
  <div x-data="{ open: false }" class="flex flex-col mx-auto w-10/12 md:items-center md:justify-between md:flex-row">
    <div class="p-3 flex flex-row items-center justify-between">
      <a href="Home"><img class="h-7 mt-1.5" src="public/imgs/logo.png" alt=""></a>
      <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
        <svg fill="orange" viewBox="0 0 20 20" class="w-6 h-6">
          <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
          <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
    <nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row uppercase">
    <a class="text-gray-600 px-4 py-3 mt-1 text-sm sm:text-base  font-semibold hover:text-sky-700 " href="Home">Beranda</a>
    <a class="text-gray-600  px-4 py-3 mt-1 text-sm sm:text-base  font-semibold hover:text-sky-700 " href="Peta">Peta</a>
      <a class="text-gray-600  px-4 py-3 mt-1 text-sm sm:text-base  font-semibold hover:text-sky-700 " href="TentangKami">TENTANG KAMI</a>
      <a class="text-gray-600  px-4 py-3 mt-1 text-sm sm:text-base  font-semibold hover:text-sky-700" href="KontakKami">Kontak Kami</a>

      
  </div>
</div>
<div class="h-16 w-full text-gray-700 z-50">
</div>