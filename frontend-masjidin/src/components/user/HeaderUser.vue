<template>
    <div>
        <!-- header -->
        <!-- <header>
            <div
                class="bg-gray-700 text-white text-center fixed inset-x-0 top-0 z-10"
            >

                <div
                    class="container grid grid-cols-10 p-3 sm:w-full md:w-5/12"
                >
                    <div
                        class="col-span-2 bg-white rounded-full h-10 w-10 p-1 mr-3 shadow-sm"
                    >
                        <router-link :to="{name: 'home'}">
                            <img src="@/assets/images/muslim.png" class="inline-block">
                        </router-link>
                    </div>
                    <div class="col-span-8">
                        <input
                            type="text"
                            class="appearance-none w-full bg-gray-500 rounded-full h-7 shadow-md placeholder-white focus:outline-none focus:placeholder-gray-600 focus:bg-white focus-within:text-gray-600 p-5"
                            placeholder="Cari yang ingin kamu bantu"
                        />
                    </div>
                </div>
            </div>
        </header> -->

  <nav class="font-sans fixed flex justify-center  text-center z-30 sm:flex-row sm:text-left sm:justify-between py-4 px-6 bg-gray-700 shadow sm:items-baseline w-full">
  <div class="p-1 md:mb-2 sm:mb-0 md:p-1 md:mr-20 pb-0">
      <router-link :to="{name: 'home'}">
                            <img src="@/assets/images/muslim.png" class="md:h-10 md:w-10  h-5 w-5 md:inline-block">
     </router-link>
     </div>
  <div class="-pt-6 md:px-20">
    <a href="/one" class="md:text-sm text-xs no-underline text-gray-100 hover:text-blue-dark ml-10">BERANDA</a>
    <a href="/one" class="md:text-sm text-xs no-underline text-gray-100 hover:text-blue-dark ml-10">INFAQ</a>
    <a href="/two" class="md:text-sm text-xs no-underline text-gray-100 hover:text-blue-dark ml-10">PENGUMUMAN</a>
    <a href="/two" class="md:text-sm text-xs no-underline text-gray-100 hover:text-blue-dark ml-10">KEUANGAN</a>
    <a href="/three" class="md:text-sm text-xs no-underline text-white hover:text-blue-dark ml-10">PENGAJIAN</a>
   

  </div>
</nav>
    </div>
</template>

<script>
export default {};
</script>

<style></style>
