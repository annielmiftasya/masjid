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
                               
                                 <h2 class="my-3">Form Edit Data Keuangan Keluar</h2>
                                 <form  @submit.prevent="update" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                       <label for="nominal" class="col-sm-2 col-form-label">Nominal</label>
                                       <div class="col-sm-10">
                                             <input type="number" class="form-control" name="nominal" v-model="form.nominal" required>
                                             
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                     <div class="col-sm-10">
                                             <input type="text" class="form-control" name="keterangan" v-model="form.keterangan" required>
                                             
                                       </div>
                                    </div>
                                   
                                     <div class="form-group row">
                                            <label for="photo" class="col-sm-2 col-form-label">Bukti Bayar<span style="color:red">*</span></label>
                                           
                                             <div class="input-group col-sm-10">
                                               
                                                <div class="custom-file mb-1 ">
                                                    <input type="file" class="form-control"  style="height:50px" id="file" ref="bukti" @change='uploadFoto' required>
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
                nominal: '',
               keterangan: '',
                bukti: ''
            })
        }
    },
    methods: {
        uploadFoto(e){
        let file = e.target.files[0];
        this.form.file = file;
        let reader = new FileReader();  
        reader.onloadend = () => {
            this.form.bukti = reader.result;
        }              
        reader.readAsDataURL(file);        
        },
        //For getting Instant Uploaded foto
        getPhoto(){
        let photo = (this.form.bukti.length > 100) ? this.form.bukti : "Uangkeluar/"+ this.form.bukti;
        return photo;
        },
        //Insert Photo
        update(){
        // Code Baru
        let formData = new FormData();

        formData.append('nominal', this.form.nominal);
        formData.append('keterangan', this.form.keterangan);
        formData.append('bukti', this.form.file);
        

        const token = localStorage.getItem('token')
        axios.defaults.headers.common.Authorization = `Bearer ${token}`

        axios.post(`http://localhost:8000/api/admin/uang_keluar/${this.$route.params.id}`, 
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
                 this.$router.push({name: 'uangkeluar'});  
                 alert('Data keuangan keluar Berhasil Disimpan!');
                 } 
                 
                 else {
                        console.error('fail')
                          alert('Data keuangan keluar Gagal Disimpan!');
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
  
          axios.get(`http://localhost:8000/api/admin/uang_keluar/detail/${this.$route.params.id}`)
          .then(response => { 
              this.form.nominal = response.data.data.nominal;
              this.form.keterangan= response.data.data.keterangan;
              this.form.bukti = response.data.data.bukti;
          })
          .catch(error => {
              console.error(error);
          }) 
      },

  

 
}


</script>
