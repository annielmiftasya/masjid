<template>
    <div>
        <Head />
        <body id="page-top" style="font-family: 'Quicksand', sans-serif">
            <!-- Page Wrapper -->
            <div id="wrapper">
                <Sidebar />

                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">
                    <!-- Main Content -->
                    <div id="content">
                        <Header />
                        
                        <!-- Begin Page Content -->
                        <div class="container-fluid">
                            <!-- Page Heading -->
                            


                            <!-- DataTales Example -->
                         <div class="row">
                             <div class="col-lg">
                               
                                 <h2 class="my-3">Form Edit Data Jadwal Sholat</h2>
                                 <form  @submit.prevent="update" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                       <label for="judul" class="col-sm-2 col-form-label">Tanggal</label>
                                       <div class="col-sm-10">
                                             <input type="date" class="form-control" name="tanggal" v-model="form.tanggal" required>
                                           
                                       </div>
                                       
                                    </div>
                                    <div class="form-group row">
                                    <label for="deskripsi" class="col-sm-2 col-form-label">Imsyak</label>
                                    <div class="col-sm-3">
                                             <input type="time" class="form-control" name="imsyak" v-model="form.imsyak" required>
                                             
                                       </div>
                                    <label for="deskripsi" class="col-sm-2 col-form-label">Shubuh</label>
                                    <div class="col-sm-3">
                                             <input type="time" class="form-control" name="shubuh" v-model="form.shubuh" required>
                                         
                                       </div>
                                   
                                    </div>
                                     <div class="form-group row">
                                    <label for="deskripsi" class="col-sm-2 col-form-label">Terbit</label>
                                    <div class="col-sm-3">
                                             <input type="time" class="form-control" name="terbit" v-model="form.terbit" required>
                                             
                                       </div>
                                    <label for="deskripsi" class="col-sm-2 col-form-label">Dhuha</label>
                                    <div class="col-sm-3">
                                             <input type="time" class="form-control" name="dhuha" v-model="form.dhuha" required>
                                         
                                       </div>
                                   
                                    </div>
                                   
                                     <div class="form-group row">
                                    <label for="deskripsi" class="col-sm-2 col-form-label">Dzuhur</label>
                                    <div class="col-sm-3">
                                             <input type="time" class="form-control" name="dzuhur" v-model="form.dzuhur" required>
                                             
                                       </div>
                                    <label for="deskripsi" class="col-sm-2 col-form-label">Ashr</label>
                                    <div class="col-sm-3">
                                             <input type="time" class="form-control" name="ashr" v-model="form.ashr" required>
                                         
                                       </div>
                                   
                                    </div>
                                     <div class="form-group row">
                                    <label for="deskripsi" class="col-sm-2 col-form-label">Magrib</label>
                                    <div class="col-sm-3">
                                             <input type="time" class="form-control" name="magrib" v-model="form.magrib" required>
                                             
                                       </div>
                                    <label for="deskripsi" class="col-sm-2 col-form-label">Isya</label>
                                    <div class="col-sm-3">
                                             <input type="time" class="form-control" name="isya" v-model="form.isya" required>
                                         
                                       </div>
                                   
                                    </div>
                                   
                                    

                                    <div class="form-group row">
                                       <div class="col-sm-10">
                                             <button type="submit" class="btn btn-primary">Tambah Data</button>
                                       </div>
                                    </div>
                                 </form>
                           </div>
                        </div>
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- End of Main Content -->

                    <Footer />
                </div>
                <!-- End of Content Wrapper -->
            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
           
        </body>
    </div>
</template>
<script>

import Head from "../../../components/admin/HeadAdmin.vue";
import Sidebar from "../../../components/admin/SidebarAdmin.vue";
import Footer from "../../../components/admin/FooterAdmin.vue";
import Header from "../../../components/admin/HeaderAdmin.vue";
// import { reactive, ref, onMounted } from "vue";
// import { useRouter, useRoute } from "vue-router";
import axios from "axios";


export default {
    components: {
        Head,
        Sidebar,
        Footer,
        Header,
        

    },

data() {
        return {
        // ref
            form: ({
                tanggal: '',
                imsyak: '',
                shubuh: '',
                terbit: '',
                dhuha: '',
                dzuhur: '',
                ashr: '',
                magrib: '',
                isya: '',
            })
        }
    },
    methods: {
      
  
        //Insert Photo
        update(){
        // Code Baru
        let formData = new FormData();

        formData.append('tanggal', this.form.tanggal);
        formData.append('imsyak', this.form.imsyak);
        formData.append('shubuh', this.form.shubuh);
        formData.append('terbit', this.form.terbit);
        formData.append('dhuha', this.form.dhuha);
        formData.append('dzuhur', this.form.dzuhur);
        formData.append('ashr', this.form.ashr);
        formData.append('magrib', this.form.magrib);
        formData.append('isya', this.form.isya);
        

        const token = localStorage.getItem('token')
        axios.defaults.headers.common.Authorization = `Bearer ${token}`

        axios.post(`http://localhost:8000/api/admin/sholat/${this.$route.params.id}`, 
            // Code Baru
            formData, {
            
            }
        )
            .then((response)=> {
                console.log(response.data)
                 console.log(response.data.status)
                 if (response.data.status === 'success') {
                 this.$router.push({name: 'sholat'});  
                 alert('Data Jadwal Sholat Berhasil Disimpan!');
                 } 
                 
                 else {
                        console.error('fail')
                          alert('Data Jadwal Sholat Gagal Disimpan!');
                 }
            })
        },
        getData(){  
          this.isLoggedIn = localStorage.getItem('token') !== null;  
        },
        logout(){
            localStorage.removeItem('token')
            this.getData()  
            this.$router.push('/login')
        }
    },
    beforeMount(){ 
          const token = localStorage.getItem('token')
          axios.defaults.headers.common.Authorization = `Bearer ${token}`
  
          axios.get(`http://localhost:8000/api/admin/sholat/${this.$route.params.id}`)
          .then(response => { 
              this.form.tanggal = response.data.data.tanggal;
              this.form.imsyak= response.data.data.imsyak;
              this.form.shubuh = response.data.data.shubuh;
               this.form.terbit= response.data.data.terbit;
              this.form.dhuha = response.data.data.dhuha;
               this.form.dzuhur= response.data.data.dzuhur;
              this.form.ashr = response.data.data.ashr;
               this.form.magrib= response.data.data.magrib;
              this.form.isya = response.data.data.isya;
          })
          .catch(error => {
              console.error(error);
          }) 
      },

  //   data() {
  //   return {
  //     path: "http://localhost:8000",
  //     form: {},
  //   };
  // },

  //   setup() {
  //   const token = localStorage.getItem("token");
  //   //state user dinas
  //   const pengumuman= reactive({
  //     judul: "",
  //     foto: "",
  //    deksripsi: "",
  //     tanggal: "",
  //   });

  //   //state validation
  //   const validation = ref([]);

  //   //state user admin
  //   const admin = ref("");

  //   //vue router
  //   const router = useRouter();
  //   const route = useRoute();

  //   onMounted(() => {
  //     axios.defaults.headers.common.Authorization = `Bearer ${token}`;
  //     axios
  //       .get("http://localhost:8000/api/currentAdmin")
  //       .then((response) => {
  //         admin.value = response.data[0];
  //       })
  //       .catch((error) => {
  //         console.log(error.response.data);
  //       });

  //     axios.defaults.headers.common.Authorization = `Bearer ${token}`;
  //     //get API from backend
  //     axios
  //       .get(`http://localhost:8000/api/admin/pengumuman/${route.params.id}`)
  //       .then((response) => {
  //         pengumuman.judul = response.data.data.judul;
  //         pengumuman.deskripsi= response.data.data.isi;
  //         pengumuman.foto = response.data.data.foto;
  //         pengumuman.tanggal = response.data.data.tanggal;
  //       })
  //       .catch((error) => {
  //         console.log(error.response.data);
  //       });
  //   });

  //   return {
  //     pengumuman,
  //     validation,
  //     router,
  //     admin,
  //   };
  // },


 
}


</script>
