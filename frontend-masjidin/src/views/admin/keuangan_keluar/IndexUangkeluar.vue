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
                                         <div class="col-md-8 ml-md-0 col-8 ml-3 ">
                                    <form @submit.prevent="searchUang" method="get">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-auto">
                                            <input type="date" 
                                            class="form-control"
                                            name="search"
                                            v-model="search"
                                            required>
                                        </div>
                                        -
                                        <div class="col-auto">
                                            <input type="date"
                                            class="form-control"
                                            name="search1"
                                             v-model="search1"
                                            required>
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn btn-primary" type="submit">Cari</button>
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
                                                ) in uang_keluar.data"
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
                                                    <th style="width:370px">Rp.{{total}}</th>
                                                </tr>
                                        </table>
                                       <Pagination :data="uang_keluar" @pagination-change-page="getResult" />
                                      
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
import { onMounted} from "@vue/runtime-core";
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
          uang_keluar: {},
          total:{},
          search:'',
          search1:''
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
      methods:{
        getResult(page=1){
            const token = localStorage.getItem('token')
            axios.defaults.headers.common.Authorization = `Bearer ${token}`
          //get API from laravel backend
            axios.get('http://localhost:8000/api/admin/uang_keluar?page=' +page)
            .then((response) => {
              this.uang_keluar= response.data.data;
            })
            .catch((error) => {
              console.log(error.response.data);
              this.$router.push({ name: 'login'});
            });

             axios
            .get("http://localhost:8000/api/admin/uang_keluar/jumlah")
            .then((response) => {
              this.total= response.data;
            })
            .catch((error) => {
              console.log(error.response.data);
              this.$router.push({ name: 'login'});
            });
        },
        Delete(id, index) {
          axios.delete(`http://localhost:8000/api/admin/uang_keluar/${id}`).then(() => {
            this.uang_keluar.splice(index, 1);
            alert('delete data?')
          }).catch(error => {
            console.log(error.response.data)
          })
        },
        searchUang(){
        const token = localStorage.getItem('token')
        axios.defaults.headers.common.Authorization = `Bearer ${token}`
        var params = new URLSearchParams();
        params.append("search", this.search);
        params.append("search1", this.search1);
        var request = {
        params: params
        };
        axios.get('http://localhost:8000/api/uang_keluar/cari',request)
        .then(response =>  this.uang_keluar = response.data)
        },

      }
};
</script>
