<template>
   <div>
      <Header/>
      <div class="pb-20 pt-20">
            <div class="w-10 md:w-24 bg-ternary-blue opacity-60 h-6px mt-10 md:mb-5 mb-2"></div>
            <h6 class="md:text-40px pt-10px text-center text-2xl md:text-3xl font-bold font-montserrat">JADWAL SHOLAT</h6>
            
            <div class="mt-5 md:mt-10 z-0">   
                                <div class="w-full pt-4">
                                    <div class="flex md:flex-row flex-col md:ml-10">
                                        <div class="bg-gray-100">
                                            <div class="bg-blue-100 flex flex-row p-3 text-sm font-semibold font-worksans">
                                                <h6 class="md:w-10 w-10">No</h6>
                                                <h6 class="md:w-44 w-30">Tanggal</h6>
                                                <h6 class="md:w-32 w-20">Imsyak</h6>
                                                <h6 class="md:w-32 w-20">Shubuh</h6>
                                                <h6 class="md:w-32 w-20">Terbit</h6>
                                                <h6 class="md:w-32 w-20">Dhuha</h6>
                                                <h6 class="md:w-32 w-20">Dzuhur</h6>
                                                <h6 class="md:w-32 w-20">Ashar</h6>
                                                <h6 class="md:w-32 w-20">Magrib</h6>
                                                <h6 class="md:w-16 w-20">Isya</h6>

                                              
                                            </div>
                                            <div v-for="(sholat, index) in sholat" :key="sholat.id"
                                            class="flex flex-row p-3 text-sm font-normal font-worksans border rounded-md">
                                                <h6 class="md:w-10 w-10">{{ index + 1 }}</h6>
                                                <h6 class="md:w-44 w-20">{{sholat.tanggal}}</h6>
                                                <h6 class="md:w-32 w-20"> {{sholat.imsak }}</h6>
                                                <h6 class="md:w-32 w-20"> {{sholat.subuh }}</h6>
                                                <h6 class="md:w-32 w-20"> {{sholat.terbit }}</h6>
                                                <h6 class="md:w-32 w-20">  {{sholat.dhuha }}</h6>
                                                 <h6 class="md:w-32 w-20">{{sholat.dzuhur }}</h6>
                                                <h6 class="md:w-32 w-20">  {{sholat.ashar }}</h6>
                                                <h6 class="md:w-32 w-20"> {{sholat.maghrib }}</h6>
                                                <h6 class="md:w-16 w-20"> {{sholat.isya }}</h6>
                                                
                                            </div>
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
   import Footer from '@/components/user/FooterUser.vue'
//    import { onMounted} from "@vue/runtime-core";
//    import { useRouter} from "vue-router";
 import axios from "axios";




   export default {

        components: {
            Header,
            Footer,
          
        },

        data() {
        return {
          sholat: {},
        }
      },
      created() {
            axios.get(`http://localhost:8000/api/sholat3`).then(response => {
                this.sholat = response.data.data.jadwal;
            });
        }




   
}
</script>
