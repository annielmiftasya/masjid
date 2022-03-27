<template>
   <div>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <!-- Sidebar -->
        <ul class="sidebar navbar-nav bg-gradient-success sidebar sidebar-dark accordion " id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Kegiatan Masjid</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/sholat">Jadwal Sholat</a>
                        <a class="collapse-item" href="/pengajian">Pengajian</a>
                        <a class="collapse-item" href="/pengumuman">Pengumuman</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Pengelolaan Dana Infaq</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/infaq">Dana Infaq Online</a>
                        <a class="collapse-item" href="/uangmasuk">Dana Infaq Offline</a>
                        <a class="collapse-item" href="/uangkeluar">Uang Keluar</a>
                    </div>
                </div>
            </li>


            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Profile</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a @click.prevent="logout" class="nav-link" href="#">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Logout</span></a>
            </li>

        </ul>
        <!-- End of Sidebar -->
   </div>
</template>

<script>
export default {
   
 mounted(){
        let script1 = document.createElement("script");
            script1.setAttribute(
            "src",
            "https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/jquery/jquery.min.js"
            );
            document.head.appendChild(script1);

            let script2 = document.createElement("script");
            script2.setAttribute(
            "src",
            "https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js"
            );
            document.head.appendChild(script2);

            let script3 = document.createElement("script");
            script3.setAttribute(
            "src",
            "https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/jquery-easing/jquery.easing.min.js"
            );
            document.head.appendChild(script3);

            let script4 = document.createElement("script");
            script4.setAttribute(
            "src",
            "https://startbootstrap.github.io/startbootstrap-sb-admin-2/js/sb-admin-2.min.js"
            );
            document.head.appendChild(script3);

          
    },
    methods: {
        getData(){
            this.isLoggedIn = localStorage.getItem("token") !==null;
        },
        logout() {
        localStorage.removeItem("token");
        this.getData();
        this.$router.push("/login");
    },
      
    }

}
</script>
<style>
   .sidebar{
      font-family: 'Quicksand', sans-serif;
   }
</style>
