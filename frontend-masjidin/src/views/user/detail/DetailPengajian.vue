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
