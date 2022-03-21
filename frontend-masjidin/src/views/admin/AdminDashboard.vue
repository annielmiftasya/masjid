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
                    <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>

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
import { onMounted} from "@vue/runtime-core";
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

     


        
        //mounted
        onMounted(() => {
            //check Token exist
                if(!token) {
                    return router.push({
                        name: 'login'
                    })
                }
        
          axios.defaults.headers.common.Authorization = `Bearer ${token}`
          //get API from laravel backend

        });

        
        //return
        return {
          token,
        };
      },
      }
</script>