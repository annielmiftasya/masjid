<template>
<div>
    <Header/>
   <div class="pb-20 pt-20">
        <div class="container mx-auto grid grid-cols-1 p-10 sm:w-full md:w-5/12">

            <div v-for="p in profil" :key="p.id" >

                <div class="bg-white p-5 rounded-md shadow-md mb-5">
                    <div class="flex flex-col justify-center items-center relative">
                        <div>
                            <img :src="p.avatar" class="rounded-full w-28 h-28 object-cover">
                        </div>
                 
                    </div>
                </div>

                <div class="bg-white p-3 rounded-md shadow-md">
                    <div class="grid grid-cols-1 gap-4">

                        <div class="mb-2">
                            <label class="mt-2">Nama Lengkap</label>
                            <p>{{p.name}}</p>
                            <!-- <input type="text"
                                class="mt-2 appearance-none w-full bg-gray-200 rounded h-7 shadow-sm placeholder-gray-700 focus:outline-none focus:placeholder-gray-600 focus:bg-gray-300 focus-within:text-gray-600 p-5"
                                placeholder="Nama Lengkap" v-model="p.name" readonly> -->
                        </div>

                        <div class="mb-2">
                            <label class="mt-2">Alamat Email</label>
                            <p>{{p.email}}</p>
                            <!-- <input type="email"
                                class="mt-2 appearance-none w-full bg-gray-200 opacity-70 rounded h-7 shadow-sm placeholder-gray-600 focus:outline-none focus:placeholder-gray-600 focus:bg-gray-300 focus-within:text-gray-600 p-5"
                             placeholder="Alamat Email" v-model="p.email" readonly> -->
                        </div>

                        <div>
                            <router-link :to="{name: 'edit/profil', params: {id: p.id }}" class="mt-3 bg-gray-700 text-white p-2 w-full rounded-md shadow-md focus:outline-none">
                                UPDATE PROFILE
                            </router-link>
                             <router-link :to="{name: '/update-password', params: {id: p.id }}" class="mt-5 ml-5 bg-blue-600 text-white p-2 w-full rounded-md shadow-md focus:outline-none">
                                EDIT PASSWORD
                            </router-link>
                           
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
   import Footer from '@/components/user/FooterDonasi.vue'
   import axios from "axios";
   import { onMounted } from "vue";
   import { useRouter } from "vue-router";

    

  export default {

        components: {
            Header,
            Footer,
        },
  
  
    data() {
    return {
      path: "http://localhost:8000",
      profil: []
    };
  },

    setup() {
    const token = localStorage.getItem("token");
    

    //state validation
  

    // //state user admin
    // const admin = ref("");

    //vue router
    const router = useRouter();
      //state token


    onMounted(() => {
      //check Token exist
                if(!token) {
                    return router.push({
                        name: 'login/user'
                    })
                }
      
    });

    return {
      router,
    };
  },
  beforeMount(){ 
          const token = localStorage.getItem('token')
          axios.defaults.headers.common.Authorization = `Bearer ${token}`
  
          axios.get('http://localhost:8000/api/user/profile')
          .then(response => { 
              this.profil = response.data.data;
          })
          .catch(error => {
              console.error(error);
          }) 
      },


 
}


    

</script>


   