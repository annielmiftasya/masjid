<template>
<div>
    <Header/>
<div class="pb-20 pt-36">
        <div class="container mx-auto grid grid-cols-1 p-5 sm:w-full md:w-5/12">

            <form @submit.prevent="login">
                <div class="bg-gray-400 rounded-md shadow-md p-5">
                    <div class="text-xl">
                        MASUK AKUN
                    </div>
                    <div class="border-2 border-gray-200 mt-3 mb-2"></div>

                    <div class="mb-5">
                        <label class="mt-2">Alamat Email</label>
                        <input type="email" 
                            class="mt-2 appearance-none w-full bg-gray-200 border border-gray-200 rounded h-7 shadow-sm placeholder-gray-600 focus:outline-none focus:placeholder-gray-600 focus:bg-white focus-within:text-gray-600 p-5"
                            placeholder="Alamat Email" v-model="email">
                    </div>

                    <div class="mb-5">
                        <label class="mt-2">Password</label>
                        <input type="password" 
                            class="mt-2 appearance-none w-full bg-gray-200 border border-gray-200 rounded h-7 shadow-sm placeholder-gray-600 focus:outline-none focus:placeholder-gray-600 focus:bg-white focus-within:text-gray-600 p-5"
                            placeholder="Password" v-model="password">
                    </div>

                    <div>
                        <button
                           type="submit" class="bg-gray-700 py-1 px-3 text-white rounded-md shadow-md text-xl inline-block w-full focus:outline-none focus:bg-gray-900">MASUK</button>
                    </div>

                </div>
            </form>

            <div class="text-center mt-5">
                Belum punya akun ? 
                <router-link :to="{name: '/register/user'}" class="underline text-blue-600">
                   <a href="">Daftar Sekarang</a> 
                    </router-link>
            </div>

        </div>
    </div>
</div>
    
</template>

<script>
import axios from 'axios'
 import Header from '@/components/user/HeaderUser.vue'
export default {
      components: {
            Header,
        },
    data () {
      return {
          email: '',
          password: '',
          error: '',
      }
    },
   methods: {
      login() { 
              axios.post('http://localhost:8000/api/user/login', {
                  email: this.email,
                  password: this.password
                })
                .then(response => { 
                  let data = response.data[0]; 
                  localStorage.setItem('token',data.token)
                  this.$router.push({ name: '/donasi/tambah'});
                  alert('Berhasil Login!');
                })
               .catch(error => { 
                  console.log(error)
                 
                });
          }
      
    }
       
    }
  
</script>

<style>

</style>