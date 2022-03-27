<template>
<div>
    <Header/>
   <div class="pb-20 pt-20">
        <div class="container mx-auto grid grid-cols-1 p-10 sm:w-full md:w-5/12">

            <form @submit.prevent="update" method="POST" enctype="multipart/form-data">

                <div class="bg-white p-5 rounded-md shadow-md mb-5">
                    <div class="flex flex-col justify-center items-center relative">
                        <div>
                            <img :src="form.avatar" class="rounded-full w-28 h-28 object-cover">
                        </div>
                        <div class="mt-4">
                            <input type="file" @change="uploadFoto"  ref="avatar" id="file" class="rounded bg-gray-300 p-2 w-full shadow-sm">
                        </div>
                    </div>
                </div>

                <div class="bg-white p-3 rounded-md shadow-md">
                    <div class="grid grid-cols-1 gap-4">

                        <div class="mb-2">
                            <label class="mt-2">Nama Lengkap</label>
                            <input type="text"
                                class="mt-2 appearance-none w-full bg-gray-200 rounded h-7 shadow-sm placeholder-gray-700 focus:outline-none focus:placeholder-gray-600 focus:bg-gray-300 focus-within:text-gray-600 p-5"
                                placeholder="Nama Lengkap" v-model="form.name">
                        </div>

                        <div class="mb-2">
                            <label class="mt-2">Alamat Email</label>
                            <input type="email"
                                class="mt-2 appearance-none w-full bg-gray-200 opacity-70 rounded h-7 shadow-sm placeholder-gray-600 focus:outline-none focus:placeholder-gray-600 focus:bg-gray-300 focus-within:text-gray-600 p-5"
                             placeholder="Alamat Email" v-model="form.email">
                        </div>

                        <div>
                            <button type="submit" class="mt-3 bg-gray-700 text-white p-2 w-full rounded-md shadow-md focus:outline-none">
                                UPDATE PROFILE
                            </button>
                        </div>

                    </div>
                </div>

            </form>

        </div>
    </div>
    <Footer/>
</div>
  
</template>

<script>
   import Header from '@/components/user/HeaderUser.vue'
   import Footer from '@/components/user/FooterDonasi.vue'
   import axios from "axios";
   import { useRouter} from "vue-router";

    

  export default {

        components: {
            Header,
            Footer,
        },
  
  
    data() {
        return {
        // ref
           form: ({
                name: '',
                avatar: ''
            })
        }


    },
    methods: {
        uploadFoto(e){
        let file = e.target.files[0];

        this.form.file = file;
        let reader = new FileReader();  
        reader.onloadend = () => {
            this.form.avatar = reader.result;
        }              
        reader.readAsDataURL(file);        
        },
     
        getPhoto() {
            // let photo =
            //     this.form.foto.length > 0
            //         ? this.user.data.photo_responses[0]["path"].split("/").pop()
            //         : null;
            // return photo;
             
        let photo = (this.form.avatar.length > 100) ? this.form.avatar : "users/"+ this.form.avatar;
        return photo;
     
        },
        //Insert Photo
        update(){
        // Code Baru
        let formData = new FormData();

        formData.append('name', this.form.name);
        formData.append('avatar', this.form.file);
        

        const token = localStorage.getItem('token')
        axios.defaults.headers.common.Authorization = `Bearer ${token}`

        axios.post(`http://localhost:8000/api/user/profil}`, 
            // Code Baru
            formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
            }
        )
            .then((response)=> {
                console.log(response.data)
                 console.log(response.data.status)
                 if (response.data.status === 'success') {
                 this.$router.push({name: '/donasi'});  
                 alert('Data Pengumuman Berhasil Disimpan!');
                 } 
                 
                 else {
                        console.error('fail')
                          alert('Data Pengumuman Gagal Disimpan!');
                 }
            })
        },
        getData(){  
          this.isLoggedIn = localStorage.getItem('token') !== null;  
        },
    },
    beforeMount(){ 
          const token = localStorage.getItem('token')
          const router = useRouter()
          //check Token exist
                if(!token) {
                    return router.push({
                        name: '/login/user'
                    })
                }
          axios.defaults.headers.common.Authorization = `Bearer ${token}`
  
          axios.get(`http://localhost:8000/api/user/profile`)
          .then(response => { 
              this.form.name = response.data.data.name;
              this.form.email = response.data.data.email;
              this.form.avatar = response.data.data.avatar;
          })
          .catch(error => {
              console.error(error);
          }) 
      },


 
}


    

</script>


   