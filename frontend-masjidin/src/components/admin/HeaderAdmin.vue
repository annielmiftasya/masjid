<template>
   <div>
        <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                     <h5>Sistem Informasi Masjid Al-Muhajirin</h5>
                  

                    <!-- Topbar Navbar -->
                
                </nav>
                <!-- End of Topbar -->
   </div>
</template>

<script>


export default ({
    methods: {
      logout() {
      localStorage.removeItem("token");
      this.getData();
      this.$router.push("/login");
    },
    }
})
</script>
