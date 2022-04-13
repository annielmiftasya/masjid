//import axios
import axios from 'axios'

const Api = axios.create({
    //set default endpoint API
    baseURL: 'https://masjid.almuhajirin.kediri.id/api'
})

export default Api