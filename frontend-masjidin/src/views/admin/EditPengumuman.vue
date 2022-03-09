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
                               
                                 <h2 class="my-3">Form Edit Data Pengumuman</h2>
                                 <form  @submit.prevent="update" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                       <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                                       <div class="col-sm-10">
                                             <input type="text" class="form-control" name="judul" v-model="form.judul" required>
                                             
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="isi" class="col-sm-2 col-form-label">Isi</label>
                                    <div class="col-sm-10">

                                         <strong> <editor v-model="form.isi" initial-value="TinyMCE has landed!"></editor></strong>
                                          
                    
                                    </div>
                                    </div>
                                   
                                     <div class="form-group row">
                                            <label for="photo" class="col-sm-2 col-form-label">Foto<span style="color:red">*</span></label>
                                           
                                             <div class="input-group col-sm-10">
                                               
                                                <div class="custom-file mb-1 ">
                                                    <input type="file" class="form-control"  style="height:50px" id="file" ref="foto" @change='uploadFoto' required>
                                                </div>

        
                                            </div>
                                        </div>

                                    <div class="form-group row">
                                       <div class="col-sm-10">
                                             <button type="submit" class="btn btn-primary">Edit Data</button>
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
import Editor from '@tinymce/tinymce-vue';
import Head from "../../components/admin/HeadAdmin.vue";
import Sidebar from "../../components/admin/SidebarAdmin.vue";
import Footer from "../../components/admin/FooterAdmin.vue";
import Header from "../../components/admin/HeaderAdmin.vue";
// import { reactive, ref, onMounted } from "vue";
// import { useRouter, useRoute } from "vue-router";
import axios from "axios";


export default {
    components: {
        Head,
        Sidebar,
        Footer,
        Header,
         'editor':Editor,

    },

data() {
        return {
        // ref
            form: ({
                judul: '',
                isi: '',
                foto: ''
            })
        }
    },
    methods: {
        uploadFoto(e){
        let file = e.target.files[0];
        this.form.file = file;
        let reader = new FileReader();  
        reader.onloadend = () => {
            this.form.foto = reader.result;
        }              
        reader.readAsDataURL(file);        
        },
        //For getting Instant Uploaded foto
        getPhoto(){
        let photo = (this.form.foto.length > 100) ? this.form.foto : "pengumuman/"+ this.form.foto;
        return photo;
        },
        //Insert Photo
        update(){
        // Code Baru
        let formData = new FormData();

        formData.append('judul', this.form.judul);
        formData.append('isi', this.form.isi);
        formData.append('foto', this.form.file);
        

        const token = localStorage.getItem('token')
        axios.defaults.headers.common.Authorization = `Bearer ${token}`

        axios.post(`http://localhost:8000/api/admin/pengumuman/${this.$route.params.id}`, 
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
                 this.$router.push({name: 'pengumuman'});  
                 alert('Data Pengumuman Berhasil Disimpan!');
                 } 
                 
                 else {
                        console.error('fail')
                          alert('Data Pengumuman Gagal Disimpan!');
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
  
          axios.get(`http://localhost:8000/api/admin/pengumuman/${this.$route.params.id}`)
          .then(response => { 
              this.form.judul = response.data.data.judul;
              this.form.isi = response.data.data.isi;
              this.form.foto = response.data.data.foto;
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
  //     isi: "",
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
  //         pengumuman.isi = response.data.data.isi;
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
