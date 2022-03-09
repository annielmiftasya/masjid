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
                                        Data Pengumuman
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 mr-0">
                                            <a
                                                href="/pengumuman/tambah"
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
                                                    <th>Judul</th>
                                                    <th>Tanggal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>

                                            <tbody
                                                v-for="(
                                                    pengumuman, index
                                                ) in pengumuman"
                                                :key="pengumuman.id"
                                            >
                                                <tr>
                                                    <td>{{ index + 1 }}</td>
                                                    <td>
                                                        {{ pengumuman.judul }}
                                                    </td>
                                                    <td>
                                                        {{ pengumuman.tanggal }}
                                                    </td>
                    
                                                    <td
                                                        class="px-10 py-2 text-center"
                                                    >
                                                        <router-link :to="{name: 'pengumuman/detail', params: {id: pengumuman.id }}" class="btn btn-info btn-circle btn-sm">
                                                            <i
                                                                class="fas fa-info-circle"
                                                            ></i>
                                                        </router-link>
                                                         <router-link :to="{name: 'pengumuman/edit', params: {id: pengumuman.id }}" class="btn btn-warning btn-circle btn-sm">
                                                            <i
                                                                class="fas fa-edit"
                                                            ></i>
                                                          
                                                        </router-link>
                                                        <a
                                                           @click.prevent="Delete(pengumuman.id)" 
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
import Head from "../../components/admin/HeadAdmin.vue";
import Sidebar from "../../components/admin/SidebarAdmin.vue";
import Footer from "../../components/admin/FooterAdmin.vue";
import Header from "../../components/admin/HeaderAdmin.vue";
import axios from "axios";
import { onMounted, ref } from "@vue/runtime-core";


export default {
    components: {
        Head,
        Sidebar,
        Footer,
        Header,
    },
        setup() {
        //state user
        const pengumuman = ref("");

        //state token
        const token = localStorage.getItem('token')

         //state user
        const admin = ref("");

        //mounted
        onMounted(() => {
          axios.defaults.headers.common.Authorization = `Bearer ${token}`;
          axios
            .get("http://localhost:8000/api/currentAdmin")
            .then((response) => {
              admin.value = response.data[0];
            })
            .catch((error) => {
              console.log(error.response.data);
            });

          axios.defaults.headers.common.Authorization = `Bearer ${token}`
          //get API from laravel backend
          axios
            .get("http://localhost:8000/api/admin/pengumuman")
            .then((response) => {
              pengumuman.value = response.data.data;
            })
            .catch((error) => {
              console.log(error.response.data);
            });
        });

        function Delete(id, index) {
          axios.delete(`http://localhost:8000/api/admin/pengumuman/${id}`).then(() => {
            this.pengumuman.splice(index, 1);
            alert('delete data?')
          }).catch(error => {
            console.log(error.response.data)
          })
        }

        //return
        return {
          token,
          pengumuman,
          Delete,

        };
      },
    // data() {
    //     return {
    //         pengumuman: {},
    //     };
    // },
    // created() {
    //     this.axios.get("http://localhost:8000/api/admin/pengumuman").then((response) => {
    //         this.posts = response.data;
    //     });
    // },
    // methods: {
    //     deletePost(id) {
    //         this.axios
    //             .delete(`http://localhost:8000/api/post/delete/${id}`)
    //             .then((response) => {
    //                 let i = this.posts.map((item) => item.id).indexOf(id); // find index of your object
    //                 this.posts.splice(i, 1);
    //             });
    //     },
    // },
};
</script>
