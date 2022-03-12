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
                               
                                 <h2 class="my-3">Form Tambah Data Pengajian</h2>
                                 <form  @submit.prevent="TambahData" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                       <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                                       <div class="col-sm-10">
                                             <input type="text" class="form-control" name="judul" v-model="form.judul" required>
                                              <div v-if="validation.judul">
                                                <div class="alert alert-danger mt-1" role="alert">
                                                    {{ validation.judul[0] }}
                                                </div>
                                             </div>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                    <div class="col-sm-10">

                                         <strong> <editor v-model="form.deskripsi" initial-value="TinyMCE has landed!"></editor></strong>
                                           
                    
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
import Editor from '@tinymce/tinymce-vue';
import Head from "../../../components/admin/HeadAdmin.vue";
import Sidebar from "../../../components/admin/SidebarAdmin.vue";
import Footer from "../../../components/admin/FooterAdmin.vue";
import Header from "../../../components/admin/HeaderAdmin.vue";
import axios from "axios";

export default {
    name: 'app',
    components: {
        Head,
        Sidebar,
        Footer,
        Header,
        'editor':Editor,
       
    },
    data(){
       return{
          editorConfig: {},
           form: ({
               
                judul: '',
                deskripsi: '',
                foto: ''
            }
            ),
         validation: []
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
    
        },
        //For getting Instant Uploaded Photo
        getFoto(){
        let foto = (this.form.foto.length > 100) ? this.form.foto : "pengajian/"+ this.form.foto;
        return foto;
        },

        //Insert foto
        TambahData(){
        // Code Baru
        let formData = new FormData();
        
        formData.append('judul', this.form.judul);
        formData.append('deskripsi', this.form.deskripsi);
        formData.append('foto', this.form.file);
        

        const token = localStorage.getItem('token')
        axios.defaults.headers.common.Authorization = `Bearer ${token}`

        axios.post(`http://localhost:8000/api/admin/pengajian`, 

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
                 this.$router.push({name: 'pengajian'});  
                 alert('Data Pengajian Berhasil Disimpan!');
                 } 
                 
                 else {
                        console.error('fail')
                          alert('Data Pengajian Gagal Disimpan!');
                 }
            })
        },
        getData(){  
          this.isLoggedIn = localStorage.getItem('token') !== null;  
        },
    },
    
};


</script>
