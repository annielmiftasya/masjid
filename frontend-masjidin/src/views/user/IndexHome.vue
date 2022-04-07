<template>
<div>
<Header/>
<div class="pb-5 pt-1">
        <div class="container mx-auto grid grid-cols-1 sm:w-full" >

            <!-- slider -->
            <div class="shadow-md text-sm">
                <Slider />
            </div>

            <div class="md:-mb-10 pb-20 md:-mt-30 bg-white text-center">
      <div class="inline w-full">
        <div class="md:float-right pt-10 md:px-20 p-10 md:ml-0 md:pt-20">
           <img src="@/assets/images/alquran.jpg" class="pt-30 w-full h-1/3">
        </div>
        <div class="md:px-20 px-5">
          <h5 class="pt-10 md:pt-28 text-2xl md:text-left md:text-44px font-bold">Masjid Al - Muhajirin Kota Kediri</h5>
          <div class="w-full md:w-1/2 h-1px mt-1 md:mt-3" style="height:5px; background-color: rgb(16 185 129)"></div>
          <div class="md:w-8/12 w-full">
            <p class="pt-4 md:pt-8 text-justify font-normal text-primary-black">
                 Merupakan tempat untuk ibadah sholat, penguatan keimanan dan keislaman, pengembangan ilmu dan pemikiran, perkaderan pemimpin ummat dan bangsa, serta silaturahmi dan penguatan ukhuwah. 
                 Kita jaga kedamaian dalam keragaman dan kita bina kesadaran ketauhidan. Masjid Al - Muhajirin Kota Kediri mengelola uang infaq dari jamaah secara totalitas dan bijak, untuk mengadakan segudang program kegiatan, fasilitas serta logistik untuk jamaah demi kemaslahatan umat. </p>
          </div>
             </div>
      </div>
            </div>
            
            <div class=" px-10 pt-1 pb-10 md:px-20 md:mt-5 bg-gray-200 mt-24 md:-mb-10 md:z-10 rounded-xl" >
               <h5 class="pt-10 md:pt-10 md:pb-10 text-2xl md:text-center md:text-80px font-bold">Layanan Kami</h5>
          <CategoryHome />
            </div>

           <!-- Pengumuman -->
          <section id="pengumuman">
              <div class="md:mt-10 mt-6 md:px-20 px-5 mt-30 md:pt-20 md:mb-30 mb-5 bg-white">
            <div class="w-10 md:w-24 bg-ternary-blue opacity-60 h-6px mt-1 md:mb-5 mb-2"></div>
            <h6 class="md:text-40px text-base md:text-2xl font-bold font-montserrat text-secondary-blue">Pengumuman</h6>
            <div class="z-20 grid md:grid-cols-3 grid-cols-2 gap-6 mt-10">
                <div class="rounded-xl border md:w-80 md:h-96 h-80" v-for="(pengumuman) in pengumuman.data"  v-bind:key="pengumuman.id">
                    <img  :src="path + '/pengumuman/' + pengumuman.foto" alt="Pengumuman"  class="rounded-xl md:w-90 w-80 md:h-60 h-32 md:object-cover">
                    <p class="font-dm-sans font-medium md:text-xl text-sm text-six-blue md:py-3 py-2 md:px-4 px-2">{{pengumuman.judul}}</p>
                     
                    <p class="font-dm-sans font-medium md:text-base text-xs text-primary-black opacity-60 md:px-4 px-2 md:mb-4 mb-2">{{pengumuman.tanggal}}</p>
                     <router-link :to="{name: 'detail/pengumuman', params: {id: pengumuman.id }}" class="border-2 px-2 py-2 rounded-2xl mt-3 ml-2 bg-white">
                        Baca Selengkapnya
                    </router-link>
                </div>
            </div>
                <VueTailwindPagination
      :current="currentPage1"
      :total="total"
      :per-page="perPage"
      @page-changed="onPageClick1($event)" class="mt-5"
    />
            </div>
          </section>
          

            <!-- Pengajian -->
            <section id="pengajian">
            <div class="md:mt-36 mt-20 pt-20 md:px-20 pb-20 px-5 mt-10 -z-30 md:mb-40 mb-10 bg-indigo-50">
            <div class="w-10 md:w-24 bg-ternary-blue opacity-60 h-6px mt-5 md:mb-5 mb-2"></div>
            <h6 class="md:text-40px text-base md:text-2xl font-bold font-montserrat text-secondary-blue">Pengajian</h6>

            <div class="md:block hidden md:mt-10">
              <div class="flex flex-row items-center mt-5"   
              v-for="(pengajian) in pengajian.data"  v-bind:key="pengajian.id">
              
                <div class="mt-5">
                  <img :src="path + '/Pengajian/' + pengajian.foto" alt="Pengumuman" style="width:400px; height:250px">
                </div>
                  <div class="md:mt-0 mt-5 md:w-2/4 w-full ml-10">
                      <h6 class="font-dm-sans font-medium text-xl text-six-blue">{{pengajian.judul}}</h6>
                      <p class="mt-3 pb-5 text-sm">{{pengajian.tanggal}}</p>
                        <router-link :to="{name: 'detail/pengajian', params: {id: pengajian.id }}" class="border-2 px-2 py-2 rounded-2xl mt-10 bg-white">
                        Baca Selengkapnya
                        </router-link>
                    <div>
                      
                   
                    </div>
                  </div>
              </div>
                 <VueTailwindPagination
      :current="currentPage"
      :total="total"
      :per-page="perPage"
      @page-changed="onPageClick($event)" class="mt-5"
    />
               
              <!-- <LaravelVuePagination :data="pengajian" @pagination-change-page="getResult"  /> -->
              <div class="mt-5">

  </div>
                                      
            </div>
             

        </div>
            </section>
          

        

            <div>
                      <!-- categoryHome -->
          
            <!-- campaign -->
            </div>

      

        
        
        </div>

    </div>
    
    <Footer/>
</div>

   
</template>

<script>

    // //hook vue
    // import { computed, onMounted } from 'vue'

    // //vuex
    // import { useStore } from 'vuex'

    //component slider
    import Slider from '@/components/user/SliderUser.vue'

    //component categoryHome
    import CategoryHome from '@/components/user/CategoryHome.vue'
    import Header from '@/components/user/HeaderUser.vue'
    import Footer from '@/components/user/FooterUser.vue'
    import axios from "axios";
 
  // import "@ocrv/vue-tailwind-pagination/dist/style.css";
import VueTailwindPagination from "@ocrv/vue-tailwind-pagination";

    

    export default {
       
        components: {
            Header,
            Footer,
            Slider,     
            CategoryHome, 
            VueTailwindPagination,
           
        },
         data() {
        return {
          path: "http://localhost:8000",
           currentPage: 0,
           currentPage1: 0,
           perPage: 0,
           total: 0,
           pengajian: {},
           pengumuman:{},
          
        }
      },
    mounted(){
        // this.getResult();
        this.currentPage = 1;
        this.getData(this.currentPage);

        this.currentPage1 = 1;
        this.getData1(this.currentPage1);
    },

     
    
   methods:{
        

      onPageClick(event) {
      this.currentPage = event;
      this.getData(this.currentPage);
    },
        onPageClick1(event) {
      this.currentPage1 = event;
      this.getData1(this.currentPage1);
    },
    async getData(pageNumber) {
      var response = await axios.get(
        `http://localhost:8000/api/pengajian/user?page=${pageNumber}`
      );
      var responseData = response.data;
      this.currentPage = responseData.page;
      this.perPage = responseData.per_page;
      this.total = responseData.total;
      this.pengajian = response.data;
    },
     async getData1(pageNumber) {
      var response = await axios.get(
        `http://localhost:8000/api/pengumuman/user?page=${pageNumber}`
      );
      var responseData = response.data;
      this.currentPage1 = responseData.page;
      this.perPage = responseData.per_page;
      this.total = responseData.total;
      this.pengumuman = response.data;
    },
        
       
            
   },

};
     

    
</script>   