import { createApp } from 'vue'
import App from './App.vue'


//import router
import router from './router'

// /**
//  * Vuex  
//  */
//  import store from './store'

/**
 * import Toastr
 */
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

// /**
//  * Tailwind CSS
// */
// import './index.css'
/**
 * Mixins
 */
import mixins from './mixins'

//create App Vue
const app = createApp(App)

//use vue router
app.use(router)

//gunakan "Toast" di Vue Js dengan plugin "use"
app.use(Toast)

//gunakan "Mixins" di Vue Js dengan plugin "use"
app.mixin(mixins)



app.mount('#app')