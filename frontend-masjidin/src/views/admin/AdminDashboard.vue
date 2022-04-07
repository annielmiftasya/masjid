<template>
   <div>
   
<Head/>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

      <Sidebar/>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

              <Header/>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                         <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Dana Infaq Online</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{online}} </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Dana Infaq Offline</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{offline}} </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Dana Pengeluaran
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Rp. {{keluar}} </div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Keuangan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{saldo}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           <Footer/>
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
  

    <!-- Bootstrap core JavaScript-->
    <!-- <script src="https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/jquery/jquery.min.js"></script> -->
    <!-- <script src="https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

    <!-- Core plugin JavaScript-->
    <!-- <script src="https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/jquery-easing/jquery.easing.min.js"></script> -->

    <!-- Custom scripts for all pages-->
    <!-- <script src="https://startbootstrap.github.io/startbootstrap-sb-admin-2/js/sb-admin-2.min.js"></script> -->

</body>

   </div>
</template>
<script>
import Head from '../../components/admin/HeadAdmin.vue'
import Sidebar from '../../components/admin/SidebarAdmin.vue'
import Footer from '../../components/admin/FooterAdmin.vue'
import Header from '../../components/admin/HeaderAdmin.vue'
import axios from "axios";
import { onMounted,ref} from "@vue/runtime-core";
import { useRouter} from "vue-router";


export default {
    components: {
        Head,
        Sidebar,
        Footer,
        Header,

    },

       setup() {
             //state token
            const token = localStorage.getItem('token')

            //inisialisasi vue router on Composition API
            const router = useRouter()

            //state user
            const online = ref('')

            //state user
            const offline = ref('')
     
            //state user
            const  keluar= ref('')

             //state user
            const  saldo= ref('')


        
       //mounted properti
            onMounted(() =>{

                //check Token exist
                if(!token) {
                    return router.push({
                        name: 'login'
                    })
                }

                axios.defaults.headers.common.Authorization = `Bearer ${token}`
                axios.get("http://localhost:8000/api/admin/uang_masuk/jumlah")
                .then((response) => {
                offline.value= response.data;
                })
                .catch((error) => {
                console.log(error.response.data);
                this.$router.push({ name: 'login'});
                });

                axios.get("http://localhost:8000/api/admin/infaq/total")
                .then((response) => {
                online.value= response.data;
                })
                .catch((error) => {
                console.log(error.response.data);
                this.$router.push({ name: 'login'});
                });

                axios.get("http://localhost:8000/api/admin/uang_keluar/jumlah")
                .then((response) => {
                keluar.value= response.data;
                })
                .catch((error) => {
                console.log(error.response.data);
                this.$router.push({ name: 'login'});
                });

                 axios.get("http://localhost:8000/api/admin/saldo")
                .then((response) => {
                saldo.value= response.data.data;
                })
                .catch((error) => {
                console.log(error.response.data);
                this.$router.push({ name: 'login'});
                });

        });

        
        //return
        return {
          token,
          online,
          offline,
          keluar,
          saldo
        };
      },
      }
</script>