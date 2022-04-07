<template>
<div>
    <Header/>
<div class="pb-20 pt-20">
        <div class="container mx-auto grid grid-cols-1 p-3 sm:w-full md:w-5/12">

                <div class="bg-white rounded-md shadow-md p-5">

                <div class="text-xl">
                    RIWAYAT INFAQ SAYA
                </div>
                <div class="border-2 border-gray-200 mt-3 mb-2"></div>

                <div v-if="infaqs.length > 0">
                    <div class="mt-5 grid grid-cols-4 gap-4">

                        <div class="col-span-4" v-for="infaq in infaqs" :key="infaq.id">
                            <div class="bg-gray-200 rounded-md shadow-sm p-2">
                                <figure class="md:flex rounded-xl md:p-0">
                                 
                                    <div class="w-full pt-6 p-5 md:p-3 text-center md:text-left space-y-4">
                                        
                                        <figcaption class="font-medium">
                                            <p class="text-xs text-gray-500 mt-5">
                                                <span class="font-bold text-gray-500 mr-3">{{ infaq.created_at }}</span>
                                                <span class="font-bold text-blue-900">Rp. {{ formatPrice(infaq.amount) }}</span>
                                            </p>
                                        </figcaption>
                                        <div v-if="infaq.status == 'pending'">
                                            <button @click="payment(infaq.snap_token)" class="w-full bg-yellow-600 rounded shadow-sm text-xs py-1 px-2 focus:outline-none">BAYAR SEKARANG</button>
                                        </div>
                                    </div>
                                    <div class="ml-auto text-sm text-gray-500 underline">
                                        <div v-if="infaq.status == 'success'">
                                            <button class="bg-green-500 border-2 border-green-500 rounded shadow-sm text-xs py-1 px-2 text-black focus:outline-none">Berhasil</button>
                                        </div>
                                        <div v-else-if="infaq.status == 'pending'">
                                            <button class="bg-yellow-500 border-2 border-yellow-500 rounded shadow-sm text-xs py-1 px-2 text-black focus:outline-none">Pending</button>
                                        </div>
                                        <div v-else-if="infaq.status == 'expired'">
                                            <button class="bg-red-500 border-2 border-red-500 rounded shadow-sm text-xs py-1 px-2 text-black focus:outline-none">Dibatalkan</button>
                                        </div>
                                        <div v-else-if="infaq.status == 'failed'">
                                            <button class="bg-red-500 border-2 border-red-500 rounded shadow-sm text-xs py-1 px-2 text-black focus:outline-none">Dibatalkan</button>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>

                    </div>

                    <div class="text-center mt-7" v-show="nextExists">
                        <button @click="loadMore"
                            class="bg-gray-700 text-white p-1 px-3 rounded-md shadow-md focus:outline-none focus:bg-gray-900 cursor-pointer">LIHAT
                            SEMUA <i class="fa fa-long-arrow-alt-right"></i></button>
                    </div>

                </div>
                <div v-else>

                    <div class="mb-3 bg-red-500 text-white p-4 rounded-md">
                        Anda Belum Memiliki Transaksi Donasi Saat ini!
                    </div>

                </div>
            </div>

        </div>
    </div>
    <Footer/>
</div>
    
</template>


<script>
   import Header from '@/components/user/HeaderUser.vue'
   import Footer from '@/components/user/FooterDonasi.vue'

       //hook vue
    import { computed, onMounted } from 'vue'

    //hook vuex
    import { useStore } from 'vuex'

    //hook vue router
    import { useRouter } from 'vue-router'
  export default {

        components: {
            Header,
            Footer,
        },

          setup() {

            //store vuex
            const store = useStore()
            
              //state token
            const token = localStorage.getItem('token')
            //router
            const router = useRouter()
            
 

           
            //onMounted akan menjalankan action "getDonation" di module "donation"
            onMounted(() => {
               
                if(!token) {
                    return router.push({
                        name: 'login/user'
                    })
                }
       
                store.dispatch('infaq/getDonation')
            })

            //digunakan untuk get data state "donations" di module "donation" 
            const infaqs = computed(() => {
                return store.state.infaq.infaqs
            })

            //digunakan untuk get data state "nextExists" di module "donation" 
            const nextExists = computed(() => {
                return store.state.infaq.nextExists
            })

            //digunakan untuk get data state "nextPage" di module "infaq" 
            const nextPage = computed(() => {
                return store.state.infaq.nextPage
            })

            //loadMore function
            function loadMore() {
                store.dispatch('infaq/getLoadMore', nextPage.value)
            }

            //function payment "Midtrans"
            function payment(snap_token) {

                window.snap.pay(snap_token, {

                    onSuccess: function () {
                        router.push({name: '/donasi/tambah'})  
                    },
                    onPending: function () {
                        router.push({name: '/donasi/tambah'})
                    },
                    onError: function () {
                        router.push({name: '/donasi/tambah'})  
                    }
                })

            }

            return {
                infaqs,      // <-- return donations
                nextExists,     // <-- return nextExists
                nextPage,       // <-- return nextPage
                loadMore,       // <-- return loadMore
                payment,        // <-- return payment Midtrans Snap
                token,
            }

        }
}
</script>

<style>

</style>