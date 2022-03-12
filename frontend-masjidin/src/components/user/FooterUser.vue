<template>
    <div>
        <div class="bg-white text-center fixed inset-x-0 bottom-0 z-10">
            <div
                class="container mx-auto grid grid-cols-4 gap-4 p-2 sm:w-full md:w-5/12"
            >
                <div>
                   <router-link :to="{name: '/'}"
                        class="w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center">
                        <img class="inline-block mb-1" width="25" height="25"
                        src="@/assets/images/home.png">
                    <span class="block text-xs">Beranda</span>
                    </router-link>
                </div>

                <div>
                    
                   <router-link :to="{name: 'donation.index'}">
                    <div class="grid grid-cols-5 gap-4 bg-gray-300 p-3 rounded-md shadow-sm mb-3">
                        <div class="col-span-5">
                        <i class="fa fa-heart" aria-hidden="true"></i> Donasi Saya
                        </div>
                    </div>
                </router-link>
                </div>

                <div>
                <router-link :to="{name: 'campaign.index'}" class="w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center">
                <img width="25" height="25" class="inline-block mb-1"
                            src="@/assets/images/flag.png">
                    <span class="tab tab-kategori block text-xs">Campaign</span>
                </router-link>
                </div>
                <div>
                    <router-link
                        :to="{ name: 'login' }"
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
    </div>
</template>

<script>
export default {};
</script>

<style></style>
