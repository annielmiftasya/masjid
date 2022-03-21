<template>
    <div>
        <div class="bg-white text-center fixed inset-x-0 bottom-0 z-10">
            <div
                class="container mx-auto grid grid-cols-5 gap-5 p-2 sm:w-full md:w-5/12"
            >
                <div>
                   <router-link :to="{name: 'home'}"
                        class="w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center">
                        <img class="inline-block mb-1" width="25" height="25"
                        src="@/assets/images/home.png">
                    <span class="block text-xs">Beranda</span>
                    </router-link>
                </div>
                 <div>
                    <img
                            width="25"
                            height="25"
                            class="inline-block mb-1"
                            src="@/assets/images/flag.png"
                        />
                    <a @click.prevent="logout" class="tab tab-kategori block text-xs" href="#">
                    <span>Logout</span></a>
                </div>
                <div>
                <router-link :to="{name: '/donasi'}" class="w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center">
                <img width="25" height="25" class="inline-block mb-1"
                            src="@/assets/images/wallet.png">
                    <span class="tab tab-kategori block text-xs">Donasi Saya</span>
                </router-link>
                </div>
                <div>
                <router-link :to="{name: '/donasi/tambah'}" class="w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center">
                <img width="25" height="25" class="inline-block mb-1"
                            src="@/assets/images/heart.png">
                    <span class="tab tab-kategori block text-xs">Infaq</span>
                </router-link>
                </div>
                    <router-link
                        :to="{ name: '/profile' }"
                        class="w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center"
                    >
                        <img
                            width="25"
                            height="25"
                            class="inline-block mb-1"
                            src="@/assets/images/user.png"
                        />
                        <span class="block text-xs">Akun</span>
                    </router-link>
                </div>
                
               
            </div>
        </div>
   
</template>

<script>
export default ({
    methods: {
      getData(){
            this.isLoggedIn = localStorage.getItem("token") !==null;
        },
      logout() {
      localStorage.removeItem("token");
      this.getData();
      this.$router.push("/login/user");
    },
    }
})
</script>

<style></style>
