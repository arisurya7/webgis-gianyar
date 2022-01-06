<?php include 'layout/header.php'; ?>
<title>Beranda | Portal Gianyar</title>
</head>

<body class="overflow-x-hidden" style="font-family:Poppins ;">
    <!-- Navbar -->

    <?php include 'layout/navbar.php'; ?>
    <!-- Hero -->
    <div class="w-10/12 mx-auto">
        <section class="relative">
            <div class=" flex flex-col-reverse lg:flex-row items-center gap-12 mt-14 lg:mt-28">
                <!-- Content -->
                <div class="flex flex-1 flex-col items-center lg:items-start" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000">
                    <h2 class="text-sky-700 text-3xl md:text-4 lg:text-5xl text-center lg:text-left mb-6">
                        Temukan Lokasi Destinasi Wisatamu!
                    </h2>
                    <p class="text-gray-00 text-lg text-center lg:text-left mb-6">
                        Kami hadir bagi kalian yang ingin mencari tempat wisata diwilayah gianyar dengan mudah! Yuk mulai coba menggunakan Portal Gianyar dengan mengklik button dibawah ini.
                    </p>
                    <div class="flex justify-center flex-wrap gap-6">
                        <button type="button" class="bg-sky-600 text-sky-100 hover:bg-sky-700 w-max py-3 px-6 rounded-md" onclick="javascript:location.href='Peta'">
                            Mulai
                        </button>
                    </div>
                </div>
                <!-- Image -->
                <div class="flex justify-center flex-1 mb-10 md:mb-16 lg:mb-0 z-10" data-aos="fade-left" data-aos-delay="300" data-aos-duration="1000">
                    <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-full md:h-full" src="public/imgs/home.png" alt="" />
                </div>
            </div>
            <!-- Rounded Rectangle -->
            <div class="
          hidden
          md:block
          overflow-hidden
          bg-sky-600
          rounded-l-full
          absolute
          h-80
          w-2/4
          top-32
          right-0
          lg:
          -bottom-28
          lg:-right-24
        " data-aos="fade-left" data-aos-delay="300" data-aos-duration="1000"></div>
        </section>
        <div class="h-44">

        </div>
    </div>

    <!-- Features -->

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>
</body>

</html>