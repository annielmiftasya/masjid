<template>
   <div>
      <Header/>
          <div class="pb-20 pt-20">  
        <div class="flex flex-row">
            <div class="md:mt-20 md:px-20 px-5 mt-10 relative md:w-9/12 w-full">
              
                <h1 class="font-bold text-blue-900 text-2xl" >Detail Keuangan Keluar</h1>
                 <img :src="path + '/Uangkeluar/' + uang_keluar.bukti " class="pt-10" alt="uang_keluar">
                  <p class="font-dm-sans font-bold text-sm pt-5 text-gray-300 uppercase">Dibuat : {{uang_keluar.date}}</p>
                 <p class="font-dm-sans font-normal text-gray-400 text-base mt-7" >Nominal : {{uang_keluar.nominal}}</p>
                  <p class="font-dm-sans font-normal text-gray-400 text-base mt-7" >Keterangan : {{uang_keluar.keterangan}}</p>
           
            </div>

           
        </div>

      
        
    </div>
      <Footer/>
   </div>
</template>
<script>
   import Header from '@/components/user/HeaderUser.vue'
   import Footer from '@/components/user/FooterUser.vue'
 import { reactive,onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import axios from "axios";


   // import VueTailwindPagination from "@ocrv/vue-tailwind-pagination";


   export default {

        components: {
            Header,
            Footer,
            // VueTailwindPagination,
        },

            data() {
    return {
      path: "http://localhost:8000",
      form: {},
    };
  },

    setup() {

    //state user dinas
    const uang_keluar= reactive({
      nominal: "",
      bukti: "",
      keterangan: "",
     date: "",
    });

    //state validation
  

    // //state user admin
    // const admin = ref("");

    //vue router
    const router = useRouter();
    const route = useRoute();

    onMounted(() => {
     
     
      axios
        .get(`http://localhost:8000/api/uang_keluar/detail/${route.params.id}`)
        .then((response) => {
          uang_keluar.nominal = response.data.data.nominal;
          uang_keluar.keterangan = response.data.data.keterangan;
          uang_keluar.bukti = response.data.data.bukti;
          uang_keluar.date = response.data.data.date;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    });

    return {
      uang_keluar,
      router,
    };
  },

}
</script>
