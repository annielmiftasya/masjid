<template>
   <div>
      <Header/>
      <div class="pb-20 pt-20">  
        <div class="flex flex-row">
            <div class="md:mt-20 md:px-20 px-5 mt-10 relative md:w-9/12 w-full">
              
                <h1 class="font-bold text-blue-900 text-2xl" >{{pengajian.judul}}</h1>
                 <img :src="path + '/pengajian/' + pengajian.foto " class="pt-10" alt="pengajian">
                  <p class="font-dm-sans font-bold text-sm pt-5 text-gray-300 uppercase">Dibuat : {{pengajian.tanggal}}</p>
                 <p class="font-dm-sans font-normal text-gray-400 text-base mt-7" v-html="pengajian.deskripsi"></p>
 <!-- <iframe :src="'https://www.youtube.com/embed/4S3nWaeljFw'" class="z-0 mx-auto md:ml-10 w-44 h-36 md:w-full md:h-96 md:pt-0 pt-5 md:-mt-10"> </iframe>
  -->
                   <!-- <div class="bg-blue-opacity"  style="z-index: -10;" >
            <img class="absolute right-0 w-full h-72 md:h-full md:-mt-16 -mt-24" style="z-index: -10;" 
            src="" alt="bg-video">
          </div> -->
          <!-- <div class="flex flex-col md:flex-row md:py-20 py-5 -mt-12 ">
            <p class="font-inter text-white font-bold text-lg text-center md:text-left md:text-4xl z-0 w-full md:w-2/4 -mt-10 md:pt-16">Kenal Lebih Dekat dengan Sekolah Dasar Islam Terpadu Al-Huda</p>
               </div> -->

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

  export default {

        components: {
            Header,
            Footer,
        },
    data() {
    return {
      path: "http://localhost:8000",
      form: {},
    };
  },

    setup() {
   
    //state user dinas
    const pengajian= reactive({
      judul: "",
      foto: "",
      deskripsi: "",
      tanggal: "",
    });

    //state validation
  

    // //state user admin
    // const admin = ref("");

    //vue router
    const router = useRouter();
    const route = useRoute();

    onMounted(() => {
     
      //get API from backend
      axios
        .get(`http://localhost:8000/api/pengajian/user/${route.params.id}`)
        .then((response) => {
          pengajian.judul = response.data.data.judul;
          pengajian.deskripsi = response.data.data.deskripsi;
          pengajian.foto = response.data.data.foto;
          pengajian.tanggal = response.data.data.tanggal;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    });

    return {
      pengajian,
      router,
    };
  },


  }
</script>
