import { createApp } from "vue";
import App from "./App.vue";

/**
 * import Toastr
 */
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
// import LaravelVuePagination from 'laravel-vue-tailwind-pagination';


/**
 * Tailwind CSS
 */
import "../index.css";

/**
 * Mixins
 */
import mixins from "./mixins";

/**
 * Vue Router
 */
import router from "./router";

/**
 * Vuex
 */
import store from "./store";
// var filter = function(text, length, clamp){
//    clamp = clamp || '...';
//    var node = document.createElement('div');
//    node.innerHTML = text;
//    var content = node.textContent;
//    return content.length > length ? content.slice(0, length) + clamp : content;
// };




//create App Vue
const app = createApp(App);
// app.config.productionTip = false;
// app.filter('truncate', filter)

//gunakan "Toast" di Vue Js dengan plugin "use"
app.use(Toast);

//gunakan "Mixins" di Vue Js dengan plugin "use"
app.mixin(mixins);

// app.use(LaravelVuePagination);
//gunakan "router" di Vue Js dengan plugin "use"
app.use(router);
// app.filter('truncate', filter);
//gunakan "store" di Vue Js dengan plugin "use"
app.use(store);

app.mount("#app");

