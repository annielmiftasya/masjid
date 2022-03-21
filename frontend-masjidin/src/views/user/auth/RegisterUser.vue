<template>
    <div>
        <div class="pb-20 pt-20">
            <div
                class="container mx-auto grid grid-cols-1 p-5 sm:w-full md:w-5/12"
            >
                <form @submit.prevent="register">
                    <div class="bg-gray-400 rounded-md shadow-md p-5">
                        <div class="text-xl">REGISTER AKUN</div>
                        <div class="border-2 border-gray-200 mt-3 mb-2"></div>

                        <div class="mb-2">
                            <label class="mt-2">Nama Lengkap</label>
                            <input
                                type="text"
                                class="mt-2 appearance-none w-full bg-gray-200 border border-gray-200 rounded h-7 shadow-sm placeholder-gray-600 focus:outline-none focus:placeholder-gray-600 focus:bg-white focus-within:text-gray-600 p-5"
                                placeholder="Nama Lengkap"
                                v-model="name"
                                required
                            />
                        </div>

                        <div class="mb-2">
                            <label class="mt-2">Alamat Email</label>
                            <input
                                type="email"
                               v-model="email"
                                class="mt-2 appearance-none w-full bg-gray-200 border border-gray-200 rounded h-7 shadow-sm placeholder-gray-600 focus:outline-none focus:placeholder-gray-600 focus:bg-white focus-within:text-gray-600 p-5"
                                placeholder="Alamat Email"
                                required
                            />
                        </div>

                        <div class="cols-span-1 mb-5">
                            <label class="mt-2">Password</label>
                            <input
                                type="password"
                               v-model="password"
                                class="mt-2 appearance-none w-full bg-gray-200 border border-gray-200 rounded h-7 shadow-sm placeholder-gray-600 focus:outline-none focus:placeholder-gray-600 focus:bg-white focus-within:text-gray-600 p-5"
                                placeholder="Password"
                                required
                            />
                        </div>

                        <div class="cols-span-1 mb-5">
                            <label class="mt-2">Konfirmasi Password</label>
                            <input
                                type="password"
                                v-model="password_confirmation"
                                class="mt-2 appearance-none w-full bg-gray-200 border border-gray-200 rounded h-7 shadow-sm placeholder-gray-600 focus:outline-none focus:placeholder-gray-600 focus:bg-white focus-within:text-gray-600 p-5"
                                placeholder="Konfirmasi Password"
                                required
                            />
                        </div>

                        <div>
                            <button
                                type="submit" class="bg-gray-700 py-1 px-3 text-white rounded-md shadow-md text-xl inline-block w-full focus:outline-none focus:bg-gray-900"
                            >
                                DAFTAR
                            </button>
                        </div>
                    </div>
                </form>

                <div class="text-center mt-5">
                    Sudah punya akun ?
                    <router-link
                        :to="{ name: '/login/user' }"
                        class="underline text-blue-600"
                        >Masuk Disini !</router-link
                    >
                </div>
            </div>
        </div>
      
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data () {
      return {
          name: '',
          email: '',
          password: '',
          password_confirmation: '',
          error: '',
      }
    },
   methods: {
      register() { 
              axios.post('http://localhost:8000/api/user/register', {
                  name: this.name,
                  email: this.email,
                  password: this.password,
                  password_confirmation: this.password_confirmation
                })
                .then(()=> { 
                  this.$router.push({ name: '/login/user'});
                  alert('Berhasil Daftar Akun!');
                })
               .catch(error => { 
                  console.log(error)
                  alert('Gagal Daftar Akun!');
                });
          }
      
    }
       
    }
  
</script>

<style></style>
