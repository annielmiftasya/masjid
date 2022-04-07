<template>
    <div>
        <div>
            <div class="mt- grid grid-cols-3  gap-3 md:gap-3 text-center items-center">
                <div class="col-span-2 md:col-span-1 lg:col-span-1 bg-white rounded-md shadow-md p-4 text-center text-xs">
                    <!-- <router-link :to="{name: 'category.index'}"> -->
                    <div>
                        <img src="@/assets/images/pray.png" width="40" class="inline-block mb-2">
                    </div>
                    <a href="#pengajian">Pengajian</a>
                    <!-- </router-link> -->
                </div>
                <div class="col-span-2 md:col-span-1 lg:col-span-1 bg-white rounded-md shadow-md p-4 text-center text-xs">
                    <!-- <router-link :to="{name: 'category.index'}"> -->
                    <div>
                        <img src="@/assets/images/menu.png" width="40" class="inline-block mb-2">
                    </div>
                    <a href="#pengumuman"> Pengumuman</a>
                   
                    <!-- </router-link> -->
                </div>
                  <div class="col-span-2 md:col-span-1 lg:col-span-1 bg-white rounded-md shadow-md p-4 text-center text-xs">
                    <router-link :to="{name: '/detail/jadwalsholat'}">
                    <div>
                        <img src="@/assets/images/quran.png" width="40" class="inline-block mb-2">
                    </div>
                    Jadwal Sholat
                    </router-link>
                </div>
                  <div class="col-span-2 md:col-span-1 lg:col-span-1 bg-white rounded-md shadow-md p-4 text-center text-xs">
                    <router-link :to="{name: '/donasi/tambah'}">
                    <div>
                        <img src="@/assets/images/infaq.png" width="40" class="inline-block mb-2">
                    </div>
                    Infaq
                    </router-link>
                </div>
                  <div class="col-span-2 md:col-span-1 lg:col-span-1 bg-white rounded-md shadow-md p-4 text-center text-xs">
                    <router-link :to="{name: '/detail/laporan'}">
                    <div>
                        <img src="@/assets/images/alms.png" width="40" class="inline-block mb-2">
                    </div>
                    Keuangan
                    </router-link>
                </div>
                 <div class="col-span-2 md:col-span-1 lg:col-span-1 bg-white rounded-md shadow-md p-4 text-center text-xs">
                    <router-link :to="{name: '/profil'}">
                    <div>
                        <img src="@/assets/images/user.png" width="40" class="inline-block mb-2">
                    </div>
                    Profil
                    </router-link>
                </div>
            </div>
        </div>
        <!-- <div>
            <div class="mt-5 grid grid-cols-4  gap-4 md:gap-4 text-center items-center">
                <div class="sm:col-span-2 md:col-span-2 lg:col-span-2 bg-white rounded-md shadow-md text-center text-xs">
                    <ContentLoader />
                </div>
            </div>
        </div> -->
    </div>
</template>

<script>
    // //hook vue
    // import { computed, onMounted  } from 'vue'
    
    // //vuex
    // import { useStore } from 'vuex'
    
    //vue content loader
    // import { ContentLoader } from 'vue-content-loader'

    export default {

        components: {
            // ContentLoader   // <-- register content loader
        },

        // setup() {

        //     //store vuex
        //     const store = useStore()

        //     //onMounted akan menjalankan action "getCategoryHome" di module "category"
        //     onMounted(() => {
        //         store.dispatch('category/getCategoryHome')
        //     })

        //     //digunakan untuk get data state "categories" di module "category" 
        //     const categories = computed(() => {
        //         return store.state.category.categories
        //     })

        //     return {
        //         categories  // <-- categories
        //     }

        // }

    }
</script>

<style>

</style>
Dari penambahan kode di atas, pertama kita impor properti computed dan hook onMounted dari Vue.

//hook vue
import { computed, onMounted  } from 'vue'