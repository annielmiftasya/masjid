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

            <div class="md:mt-10 mt-6 md:px-20 px-5 mt-30 md:pt-20 md:mb-30 mb-5 bg-white">
            <div class="w-10 md:w-24 bg-ternary-blue opacity-60 h-6px mt-1 md:mb-5 mb-2"></div>
            <h6 class="md:text-40px text-base md:text-2xl font-bold font-montserrat text-secondary-blue">Pengumuman</h6>
            <div class="z-20 grid md:grid-cols-3 grid-cols-2 gap-6 mt-10">
                <div class="rounded-xl border md:w-80 md:h-80 h-56">
                    <img src="@/assets/images/alquran.jpg" alt="Berita" class="rounded-xl md:w-80 w-80 md:h-44 h-32 md:object-cover">
                    <p class="font-dm-sans font-medium md:text-xl text-sm text-six-blue md:py-3 py-2 md:px-4 px-2">HAI SEMUA</p>
                    <p class="font-dm-sans font-medium md:text-base text-xs text-primary-black opacity-60 md:px-4 px-2 md:mb-4 mb-2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat ab provident quisquam numquam, consectetur eaque inventore labore error voluptatem magni. Doloribus quaerat ad repellendus debitis delectus totam rerum nihil expedita?</p>
                    <template :cell(actions)="row">
                        <button variant="warning" class="text-xs border-2 md:px-2 px-1 md:py-2 py-1 rounded-3xl md:mx-4 mx-1 hover:bg-ternary-blue hover:text-white">Baca Selengkapnya</button>
                    </template>
                </div>
                  <div class="rounded-xl border md:w-80 md:h-80 h-56">
                    <img src="@/assets/images/alquran.jpg" alt="Berita" class="rounded-xl md:w-80 w-80 md:h-44 h-32 md:object-cover">
                    <p class="font-dm-sans font-medium md:text-xl text-sm text-six-blue md:py-3 py-2 md:px-4 px-2">HAI SEMUA</p>
                    <p class="font-dm-sans font-medium md:text-base text-xs text-primary-black opacity-60 md:px-4 px-2 md:mb-4 mb-2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat ab provident quisquam numquam, consectetur eaque inventore labore error voluptatem magni. Doloribus quaerat ad repellendus debitis delectus totam rerum nihil expedita?</p>
                    <template :cell(actions)="row">
                        <button variant="warning" class="text-xs border-2 md:px-2 px-1 md:py-2 py-1 rounded-3xl md:mx-4 mx-1 hover:bg-ternary-blue hover:text-white">Baca Selengkapnya</button>
                    </template>
                </div>
                  <div class="rounded-xl border md:w-80 md:h-80 h-56">
                    <img src="@/assets/images/alquran.jpg" alt="Berita" class="rounded-xl md:w-80 w-80 md:h-44 h-32 md:object-cover">
                    <p class="font-dm-sans font-medium md:text-xl text-sm text-six-blue md:py-3 py-2 md:px-4 px-2">HAI SEMUA</p>
                    <p class="font-dm-sans font-medium md:text-base text-xs text-primary-black opacity-60 md:px-4 px-2 md:mb-4 mb-2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat ab provident quisquam numquam, consectetur eaque inventore labore error voluptatem magni. Doloribus quaerat ad repellendus debitis delectus totam rerum nihil expedita?</p>
                    <template :cell(actions)="row">
                        <button variant="warning" class="text-xs border-2 md:px-2 px-1 md:py-2 py-1 rounded-3xl md:mx-4 mx-1 hover:bg-ternary-blue hover:text-white">Baca Selengkapnya</button>
                    </template>
                </div>
            </div>
            
            </div>

<!-- Berita -->
            <div class="md:mt-36 mt-20 pt-20 md:px-20 pb-20 px-5 mt-10 -z-30 md:mb-40 mb-10 bg-indigo-50">
            <div class="w-10 md:w-24 bg-ternary-blue opacity-60 h-6px mt-5 md:mb-5 mb-2"></div>
            <h6 class="md:text-40px text-base md:text-2xl font-bold font-montserrat text-secondary-blue">Berita</h6>

            <div class="md:block hidden md:mt-10">
              <div class="flex flex-row items-center">
              
                <div class="mt-5">
                  <img src="@/assets/images/alquran.jpg" alt="Pengumuman" class="md:w-500px w-445px h-64">
                </div>
                  <div class="md:mt-0 mt-5 md:w-2/4 w-full ml-20">
                      <h6 class="font-dm-sans font-medium text-xl text-six-blue">hai</h6>
                      <p class="font-dm-sans font-normal text-base text-gray-700 my-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta saepe explicabo autem debitis ratione commodi suscipit? Iste, corporis fugiat maiores pariatur ipsum doloremque dolores saepe totam dignissimos facere sunt error.</p>
                    <div>
                      <template>
                          
                          <button class="border-2 px-2 py-2 rounded-2xl">Baca Selengkapnya</button>
                      </template>
                    </div>
                  </div>
              </div>
            </div>
            
            <!-- MOBILE -->
            <div class="inline w-full md:hidden block">
                <div class="md:float-right pt-10 md:px-20">
                    <div class="mt-5">
                        <img src="@/assets/images/alquran.jpg" alt="Pengumuman" class="md:w-500px w-full h-64 md:object-cover">
                    </div>
                </div>
                <div class="md:mt-0 mt-5 md:w-3/5 w-full items-center">
                    <h6 class="font-dm-sans font-medium text-xl text-six-blue">hai</h6>
                    <p class="font-dm-sans font-normal text-base text-gray-400 my-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, nulla asperiores! Architecto quae iusto optio perspiciatis vero vel error labore, quia enim quaerat, harum id minima dolore quasi totam tempora!</p>
                  <div>
                    <template :cell(actions)="row">
                        <button variant="warning" size="sm" class="text-xs border-2 md:px-2 px-1 md:py-2 py-1 rounded-3xl md:mx-4 mx-1 hover:bg-ternary-blue hover:text-white">Baca Selengkapnya</button>
                    </template>
                  </div>
                </div>
            </div>
        </div>

        

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

    //vue content loader
    // import { FacebookLoader } from 'vue-content-loader'

    export default {

        components: {
            Header,
            Footer,
            Slider,         // <-- register component slider
            CategoryHome,   // <-- register component CategoryHome
            // FacebookLoader  // <-- register component FacebooLoader dari Vue Content Loader
        },

        // setup() {

        //     //store vuex
        //     const store = useStore()

        //     //onMounted akan menjalankan action "getCampaign" di module "campaign"
        //     onMounted(() => {
        //         store.dispatch('campaign/getCampaign')
        //     })

        //     //digunakan untuk get data  state "campaigns" di module "campaign" 
        //     const campaigns = computed(() => {
        //         return store.state.campaign.campaigns
        //     })

        //     return {
        //         campaigns,      // <-- return campaigns
        //     }

        // }

    }
</script>