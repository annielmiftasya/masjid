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
      component: () => import( /* webpackChunkName: "pengumuman" */ '@/views/admin/IndexPengumuman.vue')
    },
    {
      path: '/pengumuman/tambah',
      name: 'pengumuman/tambah',
      component: () => import( /* webpackChunkName: "pengumuman/tambah" */ '@/views/admin/TambahPengumuman.vue')
    },
    {
      path: '/pengumuman/detail',
      name: 'pengumuman/detail',
      component: () => import( /* webpackChunkName: "pengumuman/detail" */ '@/views/admin/DetailPengumuman.vue')
    },
    {
      path: '/pengumuman/edit/:id',
      name: 'pengumuman/edit',
      component: () => import( /* webpackChunkName: "pengumuman/edit" */ '@/views/admin/EditPengumuman.vue')
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
      path: '/login',
      name: 'login',
      component: () => import( /* webpackChunkName: "login" */ '@/views/admin/LoginAdmin.vue')
    },
     // USER
     {
      name: 'home',
      path: '/',
      component: () => import( /* webpackChunkName: "home" */ '@/views/user/IndexHome.vue')
  },
  
    
    
]

//create router
const router = createRouter({
    history: createWebHistory(),
    routes  // config routes
})

export default router