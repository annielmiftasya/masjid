<template>
<div>
    <Header/>
   <div class="pb-20 pt-20">
        <div class="container mx-auto grid grid-cols-1 p-10 sm:w-full md:w-5/12">

            <form @submit.prevent="update" method="POST">

                <div class="bg-white p-3 rounded-md shadow-md">
                    <div class="grid grid-cols-1 gap-4">

                        <div class="mb-2">
                            <label class="mt-2">Password Baru</label>
                            <input type="password"
                                class="mt-2 appearance-none w-full bg-gray-200 rounded h-7 shadow-sm placeholder-gray-700 focus:outline-none focus:placeholder-gray-600 focus:bg-gray-300 focus-within:text-gray-600 p-5"
                                placeholder="Password Baru" v-model="form.password">
                        </div>

                        <div class="mb-2">
                            <label class="mt-2">Konfirmasi Password Baru</label>
                            <input type="password"
                                class="mt-2 appearance-none w-full bg-gray-200 rounded h-7 shadow-sm placeholder-gray-700 focus:outline-none focus:placeholder-gray-600 focus:bg-gray-300 focus-within:text-gray-600 p-5"
                                placeholder="Konfirmasi Password Baru" v-model="form.password_confirmation">
                        </div>

                        <div>
                            <button type="submit" class="mt-3 bg-gray-700 text-white p-2 w-full rounded-md shadow-md focus:outline-none">
                                UPDATE PASSWORD
                            </button>
                        </div>

                    </div>
                </div>

            </form>

        </div>
    </div>
    <Footer/>
</div>
  
</template>

<script>
   import Header from '@/components/user/HeaderUser.vue'
   import Footer from '@/components/user/FooterDonasi.vue'
    import axios from "axios";
  
   export default {

        components: {
            Header,
            Footer,
        },
  
  
     data() {
        return {
        // ref
            form: ({
                password: '',
                password_confirmation: '',
            })
        }
    },
    methods: {
         //Insert Photo
        update(){
        // Code Baru
        let formData = new FormData();

        formData.append('password', this.form.password);
        formData.append('password_confirmation', this.form.password_confirmation);
        

        const token = localStorage.getItem('token')
        axios.defaults.headers.common.Authorization = `Bearer ${token}`

        axios.post(`http://localhost:8000/api/user/profile/password/${this.$route.params.id}`, 
            // Code Baru
            formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
            }
        )
            .then((response)=> {
                console.log(response.data)
                 console.log(response.data.status)
                 if (response.data.status === 'success') {
                 this.$router.push({name: '/profil'});  
                 alert('Password Berhasil Dirubah!');
                 } 
                 
                 else {
                        console.error('fail')
                          alert('Password Gagal Dirubah!');
                 }
            })
        },
        getData(){  
          this.isLoggedIn = localStorage.getItem('token') !== null;  
        },

  


 
},
  
  }
</script>


   