<template>
   <div>
      <Header/>
      <div class="pb-20 pt-20">
            <div class="w-10 md:w-24 bg-ternary-blue opacity-60 h-6px mt-10 md:mb-5 mb-2"></div>
            <h6 class="md:text-40px pt-10px text-center text-2xl md:text-3xl font-bold font-montserrat">JADWAL SHOLAT</h6>
            
            <div class="mt-5 md:mt-10 z-0">   
                                <div class="w-full pt-4">
                                <form @submit.prevent="searchSholat" method="get" class="ml-12 pb-4">
                                    <div date-rangepicker class="flex items-center">
                                    <div class="relative">
                                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                            </div>
                                            <input v-model="search" name="start" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
                                        </div>
                                    <span class="mx-4 text-gray-500">to</span>
                                    <div class="relative">
                                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                        </div>
                                        <input  v-model="search1" name="end" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
                                    </div>
                                       <button type="submit" class="ml-2 mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cari</button>
                                    </div>
                                 
                                </form>
                               
                                    <div class="flex md:flex-row flex-col md:ml-10">
                                        <div class="bg-gray-100">
                                            <div class="bg-blue-100 flex flex-row p-3 text-sm font-semibold font-worksans">
                                                <h6 class="md:w-10 w-10">No</h6>
                                                <h6 class="md:w-32 w-30">Tanggal</h6>
                                                <h6 class="md:w-32 w-20">Imsyak</h6>
                                                <h6 class="md:w-32 w-20">Shubuh</h6>
                                                <h6 class="md:w-32 w-20">Terbit</h6>
                                                <h6 class="md:w-32 w-20">Dhuha</h6>
                                                <h6 class="md:w-32 w-20">Dzuhur</h6>
                                                <h6 class="md:w-32 w-20">Ashar</h6>
                                                <h6 class="md:w-32 w-20">Magrib</h6>
                                                <h6 class="md:w-20 w-20">Isya</h6>

                                              
                                            </div>
                                            <div v-for="(
                                                    sholat, index
                                                ) in sholat.data"
                                                :key="sholat.id"
                                            class="flex flex-row p-3 text-sm font-normal font-worksans border rounded-md">
                                                <h6 class="md:w-10 w-10">{{ index + 1 }}</h6>
                                                <h6 class="md:w-32 w-20">{{sholat.tanggal}}</h6>
                                                <h6 class="md:w-32 w-20"> {{sholat.imsyak }}</h6>
                                                <h6 class="md:w-32 w-20"> {{sholat.shubuh }}</h6>
                                                <h6 class="md:w-32 w-20"> {{sholat.terbit }}</h6>
                                                <h6 class="md:w-32 w-20">  {{sholat.dhuha }}</h6>
                                                 <h6 class="md:w-32 w-20">{{sholat.dzuhur }}</h6>
                                                <h6 class="md:w-32 w-20">  {{sholat.ashr }}</h6>
                                                <h6 class="md:w-32 w-20"> {{sholat.magrib }}</h6>
                                                <h6 class="md:w-20 w-20"> {{sholat.isya }}</h6>
                                                
                                            </div>
                                        </div>

                                      
                                    </div>
                                    <VueTailwindPagination
                                    :current="currentPage1"
                                    :total="total"
                                    :per-page="perPage"
                                    @page-changed="onPageClick1($event)" class="mt-5"
                                    />



                                    
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
          sholat: {},
          search:'',
          search1:''
        }
      },
          mounted(){
        this.currentPage1 = 1;
        this.getData(this.currentPage1);
    },

    methods: {
        
      onPageClick(event) {
      this.currentPage = event;
      this.getData(this.currentPage);
    },
     async getData(pageNumber) {
     var response = await axios.get(
        `http://localhost:8000/api/sholat1?page=${pageNumber}`
      );
      var responseData = response.data;
      this.currentPage = responseData.page;
      this.perPage = responseData.per_page;
      this.total = responseData.total;
      this.sholat = response.data;
    },
        searchSholat(){
        var params = new URLSearchParams();
        params.append("search", this.search);
        params.append("search1", this.search1);
        var request = {
        params: params
        };
        axios.get('http://localhost:8000/api/sholat',request)
        .then(response =>  this.sholat = response.data)
        },

   
    }
}
</script>
