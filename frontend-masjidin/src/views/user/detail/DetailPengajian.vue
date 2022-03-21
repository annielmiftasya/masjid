<template>
   <div>
      <Header/>
      <div class="pb-20 pt-20">  
        <div class="flex flex-row">
            <div class="md:mt-20 md:px-20 px-5 mt-10 relative md:w-9/12 w-full">
              
                <h1 class="font-bold text-blue-900 text-2xl" >Ini Pengajian</h1>
                 <img src="@/assets/images/bg-video.png" class="pt-10" alt="">
                  <p class="font-dm-sans font-bold text-sm pt-5 text-gray-300 uppercase">Dibuat : 05-02-2001</p>
                 <p class="font-dm-sans font-normal text-gray-400 text-base mt-7">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam doloremque ipsam, quo commodi minima rem ad saepe doloribus nobis distinctio illum velit exercitationem placeat praesentium quos corrupti ea magnam possimus.</p>
            </div>

           
        </div>

      
        
    </div>
      <Footer/>
   </div>
</template>
<script>
   import Header from '@/components/user/HeaderUser.vue'
   import Footer from '@/components/user/FooterUser.vue'
  export default {

        components: {
            Header,
            Footer,
        },
}
</script>
