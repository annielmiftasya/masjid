//import vue router
import { createRouter, createWebHistory } from 'vue-router'


//define a routes
const routes = [
    {
        path: '/dashboard',
        name: 'dashboard',
        component: () => import( /* webpackChunkName: "dashboard" */ '@/views/admin/AdminDashboard.vue')
    },
    {
      path: '/pengumuman',
      name: 'pengumuman',
      component: () => import( /* webpackChunkName: "pengumuman" */ '@/views/admin/pengumuman/IndexPengumuman.vue')
    },
    {
      path: '/pengumuman/tambah',
      name: 'pengumuman/tambah',
      component: () => import( /* webpackChunkName: "pengumuman/tambah" */ '@/views/admin/pengumuman/TambahPengumuman.vue')
    },
    {
      path: '/pengumuman/detail',
      name: 'pengumuman/detail',
      component: () => import( /* webpackChunkName: "pengumuman/detail" */ '@/views/admin/pengumuman/DetailPengumuman.vue')
    },
    {
      path: '/pengumuman/edit/:id',
      name: 'pengumuman/edit',
      component: () => import( /* webpackChunkName: "pengumuman/edit" */ '@/views/admin/pengumuman/EditPengumuman.vue')
    },
    {
      path: '/sholat',
      name: 'sholat',
      component: () => import( /* webpackChunkName: "sholat" */ '@/views/admin/sholat/IndexJadwalsholat.vue')
    },
    {
      path: '/sholat/tambah',
      name: 'sholat/tambah',
      component: () => import( /* webpackChunkName: "sholat/tambah" */ '@/views/admin/sholat/TambahJadwalsholat.vue')
    },
    {
      path: '/sholat/edit/:id',
      name: 'sholat/edit',
      component: () => import( /* webpackChunkName: "sholat/edit" */ '@/views/admin/sholat/EditJadwalsholat.vue')
    },
    {
      path: '/pengajian',
      name: 'pengajian',
      component: () => import( /* webpackChunkName: "pengajian" */ '@/views/admin/pengajian/IndexPengajian.vue')
    },
    {
      path: '/pengajian/tambah',
      name: 'pengajian/tambah',
      component: () => import( /* webpackChunkName: "pengajian/tambah" */ '@/views/admin/pengajian/TambahPengajian.vue')
    },
    {
      path: '/pengajian/edit/:id',
      name: 'pengajian/edit',
      component: () => import( /* webpackChunkName: "pengajian/edit" */ '@/views/admin/pengajian/EditPengajian.vue')
    },
    {
      path: '/pengajian/detail/:id',
      name: 'pengajian/detail',
      component: () => import( /* webpackChunkName: "pengajian/detail" */ '@/views/admin/pengajian/DetailPengajian.vue')
    },

    {
      path: '/uangkeluar',
      name: 'uangkeluar',
      component: () => import( /* webpackChunkName: "uangkeluar" */ '@/views/admin/keuangan_keluar/IndexUangkeluar.vue')
    },
    {
      path: '/uangkeluar/tambah',
      name: 'uangkeluar/tambah',
      component: () => import( /* webpackChunkName: "uangkeluar/tambah" */ '@/views/admin/keuangan_keluar/TambahUangkeluar.vue')
    },
    {
      path: '/uangkeluar/detail/:id',
      name: 'uangkeluar/detail',
      component: () => import( /* webpackChunkName: "uangkeluar/detail" */ '@/views/admin/keuangan_keluar/DetailUangKeluar.vue')
    },
    {
      path: '/uangkeluar/edit/:id',
      name: 'uangkeluar/edit',
      component: () => import( /* webpackChunkName: "uangkeluar/edit" */ '@/views/admin/keuangan_keluar/EditUangKeluar.vue')
    },
    {
      path: '/uangmasuk',
      name: 'uangmasuk',
      component: () => import( /* webpackChunkName: "uangmasuk" */ '@/views/admin/keuangan_masuk/IndexUangMasuk.vue')
    },
    {
      path: '/uangmasuk/tambah',
      name: 'uangmasuk/tambah',
      component: () => import( /* webpackChunkName: "uangmasuk/tambah" */ '@/views/admin/keuangan_masuk/TambahUangMasuk.vue')
    },
    {
      path: '/uangmasuk/detail/:id',
      name: 'uangmasuk/detail',
      component: () => import( /* webpackChunkName: "uangmasuk/detail" */ '@/views/admin/keuangan_masuk/DetailUangMasuk.vue')
    },
    {
      path: '/uangmasuk/edit/:id',
      name: 'uangmasuk/edit',
      component: () => import( /* webpackChunkName: "uangmasuk/edit" */ '@/views/admin/keuangan_masuk/EditUangMasuk.vue')
    },
    {
      path: '/infaq',
      name: 'infaq',
      component: () => import( /* webpackChunkName: "infaq" */ '@/views/admin/infaq_online/IndexInfaq.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: () => import( /* webpackChunkName: "login" */ '@/views/admin/auth/LoginAdmin.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: () => import( /* webpackChunkName: "register" */ '@/views/admin/auth/RegisterAdmin.vue')
    },



     // USER
     {
      name: 'home',
      path: '/',
      component: () => import( /* webpackChunkName: "home" */ '@/views/user/IndexHome.vue')
  },
  {
    name: '/donasi',
    path: '/donasi',
    component: () => import( /* webpackChunkName: "donasi" */ '@/views/user/donation/IndexDonation.vue')
  },
  {
    name: '/donasi/tambah',
    path: '/donasi/tambah',
    component: () => import( /* webpackChunkName: "donasi/tambah" */ '@/views/user/donation/CreateDonation.vue')
  },
  {
    path: '/edit/profil/:id',
    name: 'edit/profil',
    component: () => import( /* webpackChunkName: "edit/profil" */ '@/views/user/profil/EditProfil.vue')
  },
  {
    name: '/profil',
    path: '/profil',
    component: () => import( /* webpackChunkName: "profil" */ '@/views/user/profil/IndexProfil.vue')
  },
  {
    name: '/update-password',
    path: '/update-password/:id',
    component: () => import( /* webpackChunkName: "update-password" */ '@/views/user/profil/UpdatePassword.vue')
  },
  {
    path: '/detail/pengajian/:id',
    name: 'detail/pengajian',
    component: () => import( /* webpackChunkName: "detail/pengajian" */ '@/views/user/detail/DetailPengajian.vue')
  },
  {
    path: '/detail/pengumuman/:id',
    name: 'detail/pengumuman',
    component: () => import( /* webpackChunkName: "detail/pengumuman" */ '@/views/user/detail/DetailPengumuman.vue')
  },
  {
    name: '/detail/jadwalsholat',
    path: '/detail/jadwalsholat',
    component: () => import( /* webpackChunkName: "detail/jadwalsholat" */ '@/views/user/detail/DetailJadwal.vue')
  },
  {
    name: '/detail/sholat',
    path: '/detail/sholat',
    component: () => import( /* webpackChunkName: "detail/sholat" */ '@/views/user/detail/DetailSholat.vue')
  },
  {
    name: '/detail/laporan',
    path: '/detail/laporan',
    component: () => import( /* webpackChunkName: "detail/laporan" */ '@/views/user/detail/DetailLaporan.vue')
  },
  {
    name: 'detail/uangkeluar',
    path: '/detail/uangkeluar/:id',
    component: () => import( /* webpackChunkName: "detail/uangkeluar" */ '@/views/user/detail/DetailUangkeluar.vue')
  },
  {
    name: 'login/user',
    path: '/login/user',
    component: () => import( /* webpackChunkName: "login/user" */ '@/views/user/auth/LoginUser.vue')
  },
  {
    name: '/register/user',
    path: '/register/user',
    component: () => import( /* webpackChunkName: "register/user" */ '@/views/user/auth/RegisterUser.vue')
  },
]

//create router
const router = createRouter({
    history: createWebHistory(),
    routes  // config routes
})

export default router