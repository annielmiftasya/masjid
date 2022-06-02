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
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6
                                        class="m-0 font-weight-bold text-primary"
                                    >
                                        Data Pengajian
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 mr-0">
                                            <a
                                                href="/pengajian/tambah"
                                                class="btn btn-success mb-3"
                                                >Tambah Data</a
                                            >
                                        </div>
                                        <div class="col-6 ml-0">
                                            <form @submit.prevent="searchPengajian" method="post">
                                                <div class="input-group mb-3">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="Masukkan keyword pencarian.."
                                                        name="keyword"
                                                        v-model="search"
                                                    />
                                                    <div
                                                        class="input-group-append"
                                                    >
                                                        <button
                                                            class="btn btn-outline-primary"
                                                            type="submit"
                                                            id="button-addon2"
                                                        >
                                                            Cari
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table
                                            class="table table-bordered"
                                            id="dataTable"
                                            width="100%"
                                            cellspacing="0"
                                        >
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th width="500px">Judul</th>
                                                    <th>Tanggal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>

                                            <tbody
                                              
                                            >
                                                <tr   v-for="(
                                                    pengajian, index
                                                ) in pengajian.data"
                                                :key="pengajian.id">
                                                    
                                                    <td>{{ index + 1 }}</td>
                                                    <td>
                                                        {{pengajian.judul }}
                                                    </td>
                                                    <td>
                                                        {{pengajian.tanggal }}
                                                    </td>
                    
                                                    <td
                                                        class="px-10 py-2 text-center"
                                                    >
                                                        <router-link :to="{name: 'pengajian/detail', params: {id: pengajian.id }}" class="btn btn-info btn-circle btn-sm">
                                                            <i
                                                                class="fas fa-info-circle"
                                                            ></i>
                                                        </router-link>
                                                         <router-link :to="{name: 'pengajian/edit', params: {id: pengajian.id }}" class="btn btn-warning btn-circle btn-sm">
                                                            <i
                                                                class="fas fa-edit"
                                                            ></i>
                                                          
                                                        </router-link>
                                                        <a
                                                           @click.prevent="Delete(pengajian.id)" 
                                                            class="btn btn-danger btn-circle btn-sm"
                                                        >
                                                            <i
                                                                class="fas fa-trash"
                                                            ></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                    <Pagination :data="pengajian" @pagination-change-page="getResult" />
                                            </tbody>
                                        </table>
                                    
                                    </div>
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
        </body>
    </div>
</template>
<script>
import Head from "../../../components/admin/HeadAdmin.vue";
import Sidebar from "../../../components/admin/SidebarAdmin.vue";
import Footer from "../../../components/admin/FooterAdmin.vue";
import Header from "../../../components/admin/HeaderAdmin.vue";
import axios from "axios";
import { onMounted } from "@vue/runtime-core";
import { useRouter} from "vue-router";
import LaravelVuePagination from 'laravel-vue-pagination';



export default {
    components: {
        'Pagination': LaravelVuePagination,
        Head,
        Sidebar,
        Footer,
        Header,
    },
        data() {
        return {
          pengajian: {},
          search:'',
        }
      },

    mounted(){
        this.getResult();
    },
    setup() {

               //state token
            const token = localStorage.getItem('token')

            //inisialisasi vue router on Composition API
            const router = useRouter()

                // //state user
                // const pengajian = ref("");

   

        
        //mounted
        onMounted(() => {
            //check Token exist
                if(!token) {
                    return router.push({
                        name: 'login'
                    })
                }
       
        }); 

        //return
        return {
          token,
       };
    },
    
    methods: {
        searchPengajian(){
         const token = localStorage.getItem('token')
        axios.defaults.headers.common.Authorization = `Bearer ${token}`
        axios.get('http://localhost:8000/api/admin/pengajian?search=' + this.search)
        .then(response =>  this.pengajian = response.data)
        },
         getResult(page = 1) {
             const token = localStorage.getItem('token')
             axios.defaults.headers.common.Authorization = `Bearer ${token}`
            axios.get('http://localhost:8000/api/admin/pengajian?page=' + page)
                .then(response => {
                    this.pengajian = response.data;
                });
        },
        Delete(id) {
          axios.delete(`http://localhost:8000/api/admin/pengajian/${id}`).then(() => {
         this.getResult();
            alert('Apakah anda yakin ingin menghapus data ini?')
          }).catch(error => {
            console.log(error.response.data)
          })
        }
    }
  
   
};
</script>
