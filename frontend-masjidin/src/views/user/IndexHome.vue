<template>
<div>
<Header/>
<div class="pb-20 pt-20">
        <div class="container mx-auto grid grid-cols-1 p-3 sm:w-full md:w-5/12">

            <!-- slider -->
            <div class="grid grid-cols-1 bg-white rounded shadow-md p-1 text-sm">
                <Slider />
            </div>

            <!-- categoryHome -->
            <CategoryHome />

            <!-- campaign -->

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

    // //vue content loader
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