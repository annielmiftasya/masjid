<template>
   <div class="bg-dark">
      <Head />
      <body class="bg-gradient-success pb-20">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="@/assets/images/masjid.jpg" style="height:430px">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                    </div>
                                    <form class="user" @submit.prevent="login">
                                        <div class="form-group">
                                            <input type="email" v-model="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" v-model="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                           
                                        </div>
                                        <button href="" type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                       
                                    </form>
                                    <hr>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</body>
   </div>
</template>

<script>
import Head from "../../../components/admin/HeadAdmin.vue";

import axios from 'axios'

export default {
    components: {
        Head,
     
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
              axios.post('http://localhost:8000/api/admin/login', {
                  email: this.email,
                  password: this.password
                })
                .then(response => { 
                  let data = response.data[0]; 
                  localStorage.setItem('token',data.token)
                  this.$router.push({ name: 'dashboard'});
                  alert('Berhasil Login!');
                  
                })
               .catch(error => { 
                  console.log(error)
                 
                });
          }
      
    }
       
    }


</script>
