//import axios
import axios from 'axios'

const Api = axios.create({
    //set default endpoint API
    baseURL: 'https://www.developbymiftasya.me/api/'
})

export default Api
