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
                                        Data Keuangan Keluar
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 mr-0">
                                            <a
                                                href="/uangkeluar/tambah"
                                                class="btn btn-success mb-3"
                                                >Tambah Data</a
                                            >
                                        </div>
                                        <div class="col-6 ml-0">
                                            <form action="" method="post">
                                                <div class="input-group mb-3">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="Masukkan keyword pencarian.."
                                                        name="keyword"
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
                                                    <th>Tanggal</th>
                                                    <th>Keterangan</th>
                                                    <th>Nominal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                                
                                            </thead>
                                       
                                            <tbody
                                                v-for="(
                                                    uang_keluar, index
                                                ) in uang_keluar"
                                                :key="uang_keluar.id"
                                            >
                                                <tr>
                                                    <td>{{ index + 1 }}</td>
                                                    <td>
                                                        {{ uang_keluar.date }}
                                                    </td>
                                                    <td>
                                                        {{ uang_keluar.keterangan }}
                                                    </td>
                                                        <td>
                                                        Rp. {{ uang_keluar.nominal }}
                                                    </td>
                    
                                                    <td
                                                        class="px-10 py-2 text-center"
                                                    >
                                                        <router-link :to="{name: 'uangkeluar/detail', params: {id: uang_keluar.id }}" class="btn btn-info btn-circle btn-sm">
                                                            <i
                                                                class="fas fa-info-circle"
                                                            ></i>
                                                        </router-link>
                                                         <router-link :to="{name: 'uangkeluar/edit', params: {id: uang_keluar.id }}" class="btn btn-warning btn-circle btn-sm">
                                                            <i
                                                                class="fas fa-edit"
                                                            ></i>
                                                          
                                                        </router-link>
                                                        <a
                                                           @click.prevent="Delete(uang_keluar.id)" 
                                                            class="btn btn-danger btn-circle btn-sm"
                                                        >
                                                            <i
                                                                class="fas fa-trash"
                                                            ></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                               
                                                
                                            </tbody>
                                                  
                                        </table>
                                        <table class="table table-bordered">
                                                <tr class="d-flex justify-content-end ">
                                                    
                                                    <th style="width:290px">Total Pengeluaran</th>
                                                    <th style="width:370px">Rp. {{total.data}}</th>
                                                </tr>
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
import { onMounted, ref} from "@vue/runtime-core";
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
        const uang_keluar = ref("");

         //state user
        const total = ref("");


        
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
          axios
            .get("http://localhost:8000/api/admin/uang_keluar")
            .then((response) => {
              uang_keluar.value = response.data.data;
            })
            .catch((error) => {
              console.log(error.response.data);
              this.$router.push({ name: 'login'});
            });

             axios
            .get("http://localhost:8000/api/admin/uang_keluar/jumlah")
            .then((response) => {
              total.value = response.data;
            })
            .catch((error) => {
              console.log(error.response.data);
              this.$router.push({ name: 'login'});
            });
        });

        function Delete(id, index) {
          axios.delete(`http://localhost:8000/api/admin/uang_keluar/${id}`).then(() => {
            this.uang_keluar.splice(index, 1);
            alert('delete data?')
          }).catch(error => {
            console.log(error.response.data)
          })
        }

        //return
        return {
          token,
          uang_keluar,
          total,
          Delete,

        };
      },
   
};
</script>
