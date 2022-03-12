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
                        <div class="container">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Pengajian</h1>

    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4 p-3">
                        <img    :src="path + '/pengajian/' + pengajian.foto " class="card-img" alt="foto">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Judul: {{ pengajian.judul}}
                                </li>
                                <li class="list-group-item">
                                 <a v-html="pengajian.deskripsi"></a>
                                </li>
                                <li class="list-group-item">
                                    Dibuat : {{pengajian.tanggal}}
                                </li>
                                <li class="list-group-item">
                                    <a href="/pengajian">&laquo; Kembali</a>
                                </li>
                                <li class="list-group-item">
                               
                                    <form action="" method="post" class="d-inline">
                                      
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus ?')">Hapus</button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

       <pagination align="center" :data="users" @pagination-change-page="list"></pagination>
            

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
import { reactive,onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
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
      path: "http://localhost:8000",
      form: {},
    };
  },

    setup() {
    const token = localStorage.getItem("token");
    //state user dinas
    const pengajian= reactive({
      judul: "",
      foto: "",
      deskripsi: "",
      tanggal: "",
    });

    //state validation
  

    // //state user admin
    // const admin = ref("");

    //vue router
    const router = useRouter();
    const route = useRoute();

    onMounted(() => {
     
      axios.defaults.headers.common.Authorization = `Bearer ${token}`;
      //get API from backend
      axios
        .get(`http://localhost:8000/api/admin/pengajian/${route.params.id}`)
        .then((response) => {
          pengajian.judul = response.data.data.judul;
          pengajian.deskripsi = response.data.data.deskripsi;
          pengajian.foto = response.data.data.foto;
          pengajian.tanggal = response.data.data.tanggal;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    });

    return {
      pengajian,
      router,
    };
  },


 
}
</script>