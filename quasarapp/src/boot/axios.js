import axios from 'axios'
import { boot } from 'quasar/wrappers'
import constants from '../constants/Constants'

const api = axios.create({ baseURL: constants.backend })
const strapi = axios.create({ baseURL: constants.strapi })

export default boot(({ app }) => {
  app.config.globalProperties.$axios = axios
  app.config.globalProperties.$api = api
  app.config.globalProperties.$strapi = strapi
})

export { axios, api, strapi }
