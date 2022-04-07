<template>
   <div>
      <Header/>
      <div class="pb-20 pt-20">
            <div class="w-10 md:w-24 bg-ternary-blue opacity-60 h-6px mt-10 md:mb-5 mb-2"></div>
            <h6 class="md:text-40px pt-10px text-center text-2xl md:text-3xl font-bold font-montserrat">LAPORAN KEUANGAN MASJID</h6>
            <div class="mt-5 md:mt-10 z-0">   
                                <div class="w-full pt-4">
                       
                                  <h2 class="md:text-20px pt-10px text-xl md:text-xl font-bold font-montserrat ml-24 pb-4">Keuangan Masuk</h2>
                                      <div class="flex flex-row bg-gray-100 p-3 text-sm font-normal font-worksans border rounded-md ml-24" style="width:500px"> 
                                                <h6 class="md:w-64 w-10">Keuangan Dana Infaq Offline</h6>
                                                 <h6 class="md:w-64 w-10">Rp.{{formatPrice(offline)}}</h6>
                                       </div>
                                       <div class="flex flex-row bg-gray-100 p-3 text-sm font-normal font-worksans border rounded-md ml-24" style="width:500px"> 
                                                <h6 class="md:w-64 w-10">Keuangan Dana Infaq Online</h6>
                                                 <h6 class="md:w-64 w-10">Rp.{{formatPrice(online)}}</h6>
                                       </div>
                                        <div class="flex flex-row p-3 text-sm font-normal font-worksans border rounded-md ml-24" style="width:500px"> 
                                                <h6 class="md:w-64 w-10">Total Keuangan Masuk</h6>
                                                 <h6 class="md:w-64 w-10">Rp.{{formatPrice(saldo_masuk)}}</h6>
                                       </div>
                                </div>        
            </div>
          
            <div class="mt-5 md:mt-10 z-0">   
                                <div class="w-full pt-4">
                       
                                  <h2 class="md:text-20px pt-10px text-xl md:text-xl font-bold font-montserrat ml-24 pb-4">Keuangan Keluar</h2>
                                    <div class="flex md:flex-row flex-col md:ml-24">
                                    
                                        <div class="bg-gray-100">
                                            <div class="bg-blue-100 flex flex-row p-3 text-sm font-semibold font-worksans">
                                                <h6 class="md:w-10 w-10">No</h6>
                                                <h6 class="md:w-56 w-30">Tanggal</h6>
                                                <h6 class="md:w-64 w-20">Keterangan</h6>
                                                <h6 class="md:w-64 w-20">Nominal</h6>
                                                <h6 class="md:w-64 w-20">Aksi</h6>
                                                

                                              
                                            </div>
                                            <div v-for="(
                                                    uang_keluar, index
                                                ) in uang_keluar.data"
                                                :key="uang_keluar.id"
                                            class="flex flex-row p-3 text-sm font-normal font-worksans border rounded-md">
                                                <h6 class="md:w-10 w-10">{{ index + 1 }}</h6>
                                                <h6 class="md:w-56 w-20">{{uang_keluar.date}}</h6>
                                                <h6 class="md:w-64 w-20"> {{uang_keluar.keterangan}}</h6>
                                                <h6 class="md:w-64 w-20">Rp. {{formatPrice(uang_keluar.nominal)}}</h6>
                                                <h6 class="md:w-20 w-20"><router-link :to="{name: 'detail/uangkeluar', params: {id: uang_keluar.id }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                                Detail
                                                </router-link></h6>
                                                
                                            </div>
                                        </div>

                                        
                                      
                                    </div>
                                      <div class="flex flex-row p-3 text-sm font-normal font-worksans border rounded-md ml-24" style="width:1056px"> 
                                                <h6 class="md:w-56 w-10 ml-64">Total:</h6>
                                                 <h6 class="md:w-56 w-10 ml-10">Rp. {{formatPrice(keluar)}}</h6>
                                            </div>
                                    <VueTailwindPagination
                                    :current="currentPage1"
                                    :total="total"
                                    :per-page="perPage"
                                    @page-changed="onPageClick1($event)" class="mt-5 w-5/6 ml-24"
                                    />



                                    
                                </div>        
            </div>

            <h2 class="md:text-20px pt-12 text-xl md:text-xl font-bold font-montserrat ml-24 pb-4">Total Saldo</h2>                       
            <div class="flex flex-row p-3 text-sm font-normal font-worksans border rounded-md ml-24" style="width:500px"> 
                                                <h6 class="md:w-56 w-10">Total:</h6>
                                                 <h6 class="md:w-50 w-10">Rp.{{formatPrice(saldo)}}</h6>
                                            </div>
            
        </div>
      <Footer/>
   </div>
</template>
<script>
   import Header from '@/components/user/HeaderUser.vue'
   import Footer from '@/components/user/FooterUser.vue'
   import { onMounted, ref} from "@vue/runtime-core";
//    import { useRouter} from "vue-router";
 import axios from "axios";

   import VueTailwindPagination from "@ocrv/vue-tailwind-pagination";


   export default {

        components: {
            Header,
            Footer,
            VueTailwindPagination,
        },

        data() {
        return {
          currentPage1: 0,
          perPage: 0,
          total: 0,
          uang_keluar: {},
          search:'',
          search1:''
        }
      },
        mounted(){
        this.currentPage1 = 1;
        this.getData(this.currentPage1);
    },

        setup() {
           
            // //inisialisasi vue router on Composition API
            // const router = useRouter()

            //state user
            const online = ref('')

            //state user
            const offline = ref('')
     
            //state user
            const  keluar= ref('')

            //state user
            const  saldo_masuk= ref('')

            //state user
            const  saldo= ref('')


        
       //mounted properti
            onMounted(() =>{

                 axios.get("http://localhost:8000/api/uang_masuk/jumlah")
                .then((response) => {
                offline.value= response.data;
                })
                .catch((error) => {
                console.log(error.response.data);
                this.$router.push({ name: 'login'});
                });

                axios.get("http://localhost:8000/api/infaq/total")
                .then((response) => {
                online.value= response.data;
                })
                .catch((error) => {
                console.log(error.response.data);
                this.$router.push({ name: 'login'});
                });

                axios.get("http://localhost:8000/api/uang_keluar/jumlah")
                .then((response) => {
                keluar.value= response.data;
                })
                .catch((error) => {
                console.log(error.response.data);
                this.$router.push({ name: 'login'});
                });

               axios.get("http://localhost:8000/api/saldo/uangmasuk")
                .then((response) => {
                saldo_masuk.value= response.data.data;
                })
                .catch((error) => {
                console.log(error.response.data);
                this.$router.push({ name: 'login'});
                });

               axios.get("http://localhost:8000/api/saldo")
                .then((response) => {
                saldo.value= response.data.data;
                })
                .catch((error) => {
                console.log(error.response.data);
                this.$router.push({ name: 'login'});
                });


        });

        
        //return
        return {
          online,
          offline,
          keluar,
          saldo_masuk,
          saldo
        };
      },

    methods: {
        
      onPageClick(event) {
      this.currentPage = event;
      this.getData(this.currentPage);
    },
     async getData(pageNumber) {
     var response = await axios.get(
        `http://localhost:8000/api/uang_keluar?page=${pageNumber}`
      );
      var responseData = response.data;
      this.currentPage = responseData.page;
      this.perPage = responseData.per_page;
      this.total = responseData.total;
      this.uang_keluar = response.data.data;
    },
   
    }
}
</script>
