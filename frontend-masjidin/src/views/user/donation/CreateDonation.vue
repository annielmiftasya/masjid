<template>
<div>
     <Header/>
  <div class="pb-20 pt-20 bg-gray-100">
     
        <div class="container mx-auto grid grid-cols-1 p-10 sm:w-full md:w-5/12">

            <div class="bg-white rounded-md shadow-md p-5">
                <div class="text-xl">
                    MASUKKAN NOMINAL INFAQ
                </div>
                <div class="border-2 border-gray-200 mt-3 mb-2"></div>

              <div class="mb-2">
                    <label class="mt-2 font-bold text-lg">Rp.</label>
                    <input type="number"
                        class="mt-2 appearance-none w-full bg-gray-200 border border-gray-200 rounded h-15 shadow-sm placeholder-gray-600 focus:outline-none focus:placeholder-gray-600 focus:bg-white focus-within:text-gray-600 p-2 text-right text-xl"
                        placeholder="0" v-model="infaq.amount">
                </div>

                <div class="mb-2">
                    <label class="mt-2 font-bold text-lg">Do'a</label>
                    <textarea rows="3" v-model="infaq.pray"
                        class="mt-2 appearance-none w-full bg-gray-200 border border-gray-200 rounded shadow-sm placeholder-gray-600 focus:outline-none focus:placeholder-gray-600 focus:bg-white focus-within:text-gray-600 p-5" placeholder="Tulis Do'a/Ucapan">
                    </textarea>
                </div>

                <button  @click="storeDonation" class="mt-4 bg-yellow-500 py-2 rounded-md shadow-md text-base w-full uppercase font-bold focus:outline-none focus:bg-yellow-600">LANJUT PEMBAYARAN</button>

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
    import { reactive } from 'vue'
    
    //hook vuex
    import { useStore } from 'vuex'
    
    //hook vue router
    import { useRoute, useRouter } from 'vue-router'
    
    //hook Toast
    import { useToast } from "vue-toastification"

  export default {

        components: {
            Header,
            Footer,
        },

         setup() {

            //store vuex
            const store = useStore()

            //route
            const route = useRoute()

            //router
            const router = useRouter()

            //toast
            const toast = useToast()

            //state donation
            const infaq = reactive({
                amount: 0,                      // <-- data nilai donasi
                pray: '',                       // <-- data kata-kata/doa
                campaignSlug: route.params.slug // <-- data "slug" dari campaign
            })

            //method store infaq
            function storeDonation() {

                //check minimal donasi
                if(infaq.amount < 10000) {
                    toast.error('Donasi Minimal Rp. 10.000')
                    return false
                }

                store.dispatch('infaq/storeDonation', infaq)
                .then(() => {

                    toast.success('Transaksi Berhasil Dibuat!')

                    //redirect ke dashboard
                    router.push({name: '/donasi'})

                })
                .catch(error => {
                    console.log(error)
                })
            }

            return {
                infaq,       // <-- state infaq
                storeDonation   // <-- method storeDonation
            }

        }
}
</script>


   