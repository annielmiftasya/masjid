<template>  
   <div>
      <Head />  
    <body>

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-gradient-success">
                         <img src="@/assets/images/masjid.jpg" style="height:430px">
                    </div>
                    <div class="col-lg-7 bg-gradient-success">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user"  @submit.prevent="register">
                                <div class="form-group">
                                  
                                        <input type="text"  v-model="name" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Name">
                                  
                                </div>
                                <div class="form-group">
                                    <input type="email"  v-model="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password"  v-model="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password"  v-model="password_confirmation" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                    </div>
                                </div>
                                 <button href="" type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                 </button>
                            </form>
                            <hr>
                            <div class="text-center">
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
          password_confirmation: '',
          name:'',
          error: '',
      }
    },
   methods: {
      register() { 
              axios.post('http://localhost:8000/api/admin/register', {
                 name:this.name,
                 email: this.email,
                  password: this.password,
                  password_confirmation: this.password_confirmation
                })
             .then(()=> { 
                  this.$router.push({ name: 'login'});
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
